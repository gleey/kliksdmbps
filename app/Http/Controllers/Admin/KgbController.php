<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KgbData;
use Illuminate\Http\Request;

class KgbController extends Controller
{
    /**
     * The 12 official kabupaten/kota + provinsi options used by BPS Sulut,
     * matching the original application's exact value set.
     */
    public const KABKOTA_OPTIONS = [
        'Provinsi Sulawesi Utara',
        'Kota Manado', 'Kota Bitung', 'Kota Tomohon', 'Kota Kotamobagu',
        'Kab. Minahasa', 'Kab. Minahasa Utara', 'Kab. Minahasa Selatan', 'Kab. Minahasa Tenggara',
        'Kab. Bolaang Mongondow', 'Kab. Kepulauan Sangihe', 'Kab. Kepulauan Talaud',
    ];

    public const BULAN_NAMA = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
    ];

    public function index(Request $request)
    {
        $bulan   = $request->get('bulan');
        $kabkota = $request->get('kabkota');

        $query = KgbData::query();
        if ($bulan)   $query->where('bulan', $bulan);
        if ($kabkota) $query->where('kabkota', $kabkota);

        $data        = $query->orderBy('nama')->get();
        $bulanList   = KgbData::distinct()->orderByDesc('bulan')->pluck('bulan');
        $kabkotaList = KgbData::distinct()->orderBy('kabkota')->pluck('kabkota');

        $kabkotaOptions = self::KABKOTA_OPTIONS;
        $bulanNamaOptions = self::BULAN_NAMA;

        return view('admin.kgb.index', compact(
            'data', 'bulanList', 'kabkotaList', 'bulan', 'kabkota', 'kabkotaOptions', 'bulanNamaOptions'
        ));
    }

    /**
     * Bulk insert from frontend XLSX.js parse result.
     * Receives JSON: { kabkota, bulan, rows: [{nama}] }
     * `bulan` is a free-text label like "Januari 2026", matching the original schema.
     */
    public function bulkStore(Request $request)
    {
        $request->validate([
            'kabkota'       => 'required|string|max:100',
            'bulan'         => 'required|string|max:50',
            'rows'          => 'required|array|min:1|max:5000',
            'rows.*.nama'   => 'required|string|max:255',
        ]);

        $kabkota    = $request->kabkota;
        $bulan      = $request->bulan;
        $insertedAt = now();

        $rows = collect($request->rows)->map(fn($r) => [
            'id'          => (string) \Illuminate\Support\Str::uuid(),
            'kabkota'     => $kabkota,
            'bulan'       => $bulan,
            'nama'        => $r['nama'],
            'uploaded_at' => $insertedAt,
            'created_at'  => $insertedAt,
            'updated_at'  => $insertedAt,
        ])->toArray();

        // Replace existing data for this kabkota+bulan before re-inserting (matches original "upload replaces" behavior)
        KgbData::where('kabkota', $kabkota)->where('bulan', $bulan)->delete();
        KgbData::insert($rows);

        return response()->json([
            'success' => true,
            'count'   => count($rows),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nama'    => 'required|string|max:255',
            'kabkota' => 'required|string|max:100',
            'bulan'   => 'required|string|max:50',
        ]);

        KgbData::findOrFail($id)->update($data);

        return back()->with('success', 'Data KGB berhasil diperbarui.');
    }

    public function destroyRow(string $id)
    {
        KgbData::findOrFail($id)->delete();
        return back()->with('success', 'Data KGB berhasil dihapus.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'kabkota' => 'required|string',
            'bulan'   => 'required|string',
        ]);

        KgbData::where('kabkota', $request->kabkota)
               ->where('bulan', $request->bulan)
               ->delete();

        return back()->with('success', 'Data KGB berhasil dihapus.');
    }
}
