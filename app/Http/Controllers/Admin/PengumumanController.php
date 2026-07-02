<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderByDesc('date')->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'date'    => 'nullable|date',
        ]);

        $data['date']       = $data['date'] ?? now();
        $data['created_by'] = Auth::user()->username;
        $data['is_active']  = true;

        Pengumuman::create($data);
        return back()->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'date'      => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $pengumuman->update($data);
        return back()->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function toggleActive(Pengumuman $pengumuman)
    {
        $pengumuman->update(['is_active' => !$pengumuman->is_active]);
        return back()->with('success', 'Status pengumuman diperbarui.');
    }
}
