<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::orderByDesc('created_at')->get();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $path = $request->file('image')->store('gallery', 'public');
        Gallery::create(['title' => $request->title, 'image_path' => $path]);

        return back()->with('success', 'Foto berhasil ditambahkan.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = ['title' => $request->title];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image_path);
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);
        return back()->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
