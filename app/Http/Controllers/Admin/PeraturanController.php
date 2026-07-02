<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    public function index()
    {
        $peraturan = Peraturan::orderByDesc('tahun')->get();
        return view('admin.peraturan.index', compact('peraturan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:500',
            'nomor'     => 'nullable|string|max:100',
            'tahun'     => 'nullable|string|max:10',
            'kategori'  => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:1000',
            'url'       => 'nullable|url|max:500',
        ]);
        Peraturan::create($data);
        return back()->with('success', 'Peraturan berhasil ditambahkan.');
    }

    public function update(Request $request, Peraturan $peraturan)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:500',
            'nomor'     => 'nullable|string|max:100',
            'tahun'     => 'nullable|string|max:10',
            'kategori'  => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:1000',
            'url'       => 'nullable|url|max:500',
        ]);
        $peraturan->update($data);
        return back()->with('success', 'Peraturan berhasil diperbarui.');
    }

    public function destroy(Peraturan $peraturan)
    {
        $peraturan->delete();
        return back()->with('success', 'Peraturan berhasil dihapus.');
    }
}
