<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimKerjaController extends Controller
{
    public function index()
    {
        $tim = TimKerja::orderBy('sort_order')->get();
        return view('admin.tim-kerja.index', compact('tim'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'phone'      => 'nullable|string|max:30',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('tim-kerja', 'public');
        }
        unset($data['photo']);

        $data['sort_order'] = $request->integer('sort_order', TimKerja::max('sort_order') + 1);
        TimKerja::create($data);

        return back()->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function update(Request $request, TimKerja $timKerja)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'phone'      => 'nullable|string|max:30',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            if ($timKerja->photo_path) {
                Storage::disk('public')->delete($timKerja->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('tim-kerja', 'public');
        }
        unset($data['photo']);

        $timKerja->update($data);
        return back()->with('success', 'Data anggota tim berhasil diperbarui.');
    }

    public function destroy(TimKerja $timKerja)
    {
        if ($timKerja->photo_path) {
            Storage::disk('public')->delete($timKerja->photo_path);
        }
        $timKerja->delete();
        return back()->with('success', 'Anggota tim berhasil dihapus.');
    }
}
