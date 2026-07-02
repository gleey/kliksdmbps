<?php

namespace App\Http\Controllers;

use App\Models\{
    Setting, Pengumuman, Gallery, TimKerja, Faq,
    KpData, KpRequirement, KpJadwal,
    KgbData, UjiKompetensi, Peraturan,
    TugasBelajarPersyaratan, TugasBelajarDokumen,
    KarisKarsuPersyaratan, KarisKarsuDokumen,
    PerkawinanPertamaPersyaratan, PerkawinanPertamaDokumen,
    PensiunPersyaratan, PensiunDokumen,
};
use Illuminate\Http\Request;

class PublicController extends Controller
{
    private function sharedData(): array
    {
        return [
            'scrollingText' => Setting::get(
                'scrolling_text',
                'Selamat Datang di KLIK-SDM — Kemudahan Layanan Informasi Kepegawaian BPS Provinsi Sulawesi Utara'
            ),
        ];
    }

    // ── Home ──────────────────────────────────────────────────
    public function home()
    {
        $pengumuman = Pengumuman::active()->latest()->take(5)->get();
        return view('pages.home.index', array_merge($this->sharedData(), compact('pengumuman')));
    }

    // ── Kenaikan Pangkat ──────────────────────────────────────
    public function kenaikanPangkat()
    {
        $requirements = KpRequirement::orderBy('sort_order')->get();
        $jadwal       = KpJadwal::orderBy('sort_order')->get();
        return view('pages.kenaikan-pangkat.index', array_merge(
            $this->sharedData(), compact('requirements', 'jadwal')
        ));
    }

    public function kpDataJson()
    {
        $month = request('month');
        $query = KpData::query();
        if ($month && $month !== 'all') $query->where('month', $month);
        return response()->json($query->orderBy('name')->get());
    }

    // ── KGB ───────────────────────────────────────────────────
    public function kgb()
    {
        $kabkotaList = KgbData::distinct()->orderBy('kabkota')->pluck('kabkota');
        $bulanList   = KgbData::distinct()->orderByDesc('bulan')->pluck('bulan');
        return view('pages.kgb.index', array_merge(
            $this->sharedData(), compact('kabkotaList', 'bulanList')
        ));
    }

    public function kgbDataJson()
    {
        $bulan   = request('bulan');
        $kabkota = request('kabkota');
        $search  = request('search');

        $query = KgbData::query();
        if ($bulan)   $query->where('bulan', $bulan);
        if ($kabkota) $query->where('kabkota', $kabkota);
        if ($search)  $query->where('nama', 'like', "%{$search}%");

        return response()->json($query->orderBy('nama')->get());
    }

    // ── Uji Kompetensi ────────────────────────────────────────
    public function ujiKompetensi()
    {
        $jenisList   = UjiKompetensi::distinct()->orderBy('jenis')->pluck('jenis');
        $periodeList = UjiKompetensi::distinct()->orderByDesc('periode')->pluck('periode');
        return view('pages.uji-kompetensi.index', array_merge(
            $this->sharedData(), compact('jenisList', 'periodeList')
        ));
    }

    public function ujiKompetensiJson()
    {
        $jenis   = request('jenis');
        $periode = request('periode');
        $status  = request('status');

        $query = UjiKompetensi::query();
        if ($jenis)   $query->where('jenis', $jenis);
        if ($periode) $query->where('periode', $periode);
        if ($status)  $query->where('status', $status);

        return response()->json($query->orderBy('name')->get());
    }

    // ── Tugas Belajar ─────────────────────────────────────────
    public function tugasBelajar()
    {
        $persyaratan = TugasBelajarPersyaratan::orderBy('sort_order')->get();
        $dokumen     = TugasBelajarDokumen::orderBy('sort_order')->get();
        return view('pages.tugas-belajar.index', array_merge(
            $this->sharedData(), compact('persyaratan', 'dokumen')
        ));
    }

    // ── Karis / Karsu ─────────────────────────────────────────
    public function karisKarsu()
    {
        $persyaratan = KarisKarsuPersyaratan::orderBy('sort_order')->get();
        $dokumen     = KarisKarsuDokumen::orderBy('sort_order')->get();
        return view('pages.karis-karsu.index', array_merge(
            $this->sharedData(), compact('persyaratan', 'dokumen')
        ));
    }

    // ── Perkawinan Pertama ────────────────────────────────────
    public function perkawinanPertama()
    {
        $persyaratan = PerkawinanPertamaPersyaratan::orderBy('sort_order')->get();
        $dokumen     = PerkawinanPertamaDokumen::orderBy('sort_order')->get();
        return view('pages.perkawinan-pertama.index', array_merge(
            $this->sharedData(), compact('persyaratan', 'dokumen')
        ));
    }

    // ── Pensiun ───────────────────────────────────────────────
    public function pensiun()
    {
        $persyaratan = PensiunPersyaratan::orderBy('sort_order')->get();
        $dokumen     = PensiunDokumen::orderBy('sort_order')->get();
        return view('pages.pensiun.index', array_merge(
            $this->sharedData(), compact('persyaratan', 'dokumen')
        ));
    }

    // ── Peraturan ─────────────────────────────────────────────
    public function peraturan()
    {
        $kategori = request('kategori');
        $query    = Peraturan::query();
        if ($kategori) $query->where('kategori', $kategori);

        $peraturan       = $query->orderByDesc('tahun')->get();
        $kategoriList    = Peraturan::distinct()->orderBy('kategori')->pluck('kategori');
        return view('pages.peraturan.index', array_merge(
            $this->sharedData(), compact('peraturan', 'kategoriList', 'kategori')
        ));
    }

    // ── Gallery ───────────────────────────────────────────────
    public function gallery()
    {
        $gallery = Gallery::orderByDesc('created_at')->get();
        return view('pages.gallery.index', array_merge($this->sharedData(), compact('gallery')));
    }

    // ── Tim Kerja ─────────────────────────────────────────────
    public function timKerja()
    {
        $tim = TimKerja::orderBy('sort_order')->get();
        return view('pages.tim-kerja.index', array_merge($this->sharedData(), compact('tim')));
    }

    // ── FAQ ───────────────────────────────────────────────────
    public function faq()
    {
        $faq = Faq::orderByDesc('created_at')->get();
        return view('pages.faq.index', array_merge($this->sharedData(), compact('faq')));
    }

    public function faqStore(Request $request)
    {
        $data = $request->validate(['question' => 'required|string|max:1000']);
        Faq::create($data);
        return back()->with('success', 'Pertanyaan berhasil dikirim.');
    }

    // ── Kontak ────────────────────────────────────────────────
    public function kontak()
    {
        return view('pages.kontak.index', $this->sharedData());
    }
}
