<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UjiKompetensi;
use Illuminate\Http\Request;

class UjiKompetensiController extends Controller
{
    public function index(Request $request)
    {
        $jenis   = $request->get('jenis');
        $periode = $request->get('periode');
        $status  = $request->get('status');

        $query = UjiKompetensi::query();
        if ($jenis)   $query->where('jenis', $jenis);
        if ($periode) $query->where('periode', $periode);
        if ($status)  $query->where('status', $status);

        $data        = $query->orderBy('name')->get();
        $jenisList   = UjiKompetensi::distinct()->orderBy('jenis')->pluck('jenis');
        $periodeList = UjiKompetensi::distinct()->orderByDesc('periode')->pluck('periode');

        return view('admin.uji-kompetensi.index',
            compact('data', 'jenisList', 'periodeList', 'jenis', 'periode', 'status')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis'      => 'required|string|max:100',
            'periode'    => 'required|string|max:50',
            'name'       => 'required|string|max:255',
            'nip'        => 'required|string|max:30',
            'tanggal'    => 'nullable|string|max:50',
            'status'     => 'required|in:Lulus,Tidak Lulus,Belum',
            'keterangan' => 'nullable|string|max:500',
        ]);
        UjiKompetensi::create($data);
        return back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, UjiKompetensi $ujiKompetensi)
    {
        $data = $request->validate([
            'jenis'      => 'required|string|max:100',
            'periode'    => 'required|string|max:50',
            'name'       => 'required|string|max:255',
            'nip'        => 'required|string|max:30',
            'tanggal'    => 'nullable|string|max:50',
            'status'     => 'required|in:Lulus,Tidak Lulus,Belum',
            'keterangan' => 'nullable|string|max:500',
        ]);
        $ujiKompetensi->update($data);
        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(UjiKompetensi $ujiKompetensi)
    {
        $ujiKompetensi->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
