<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $scrollingText = Setting::get('scrolling_text');
        return view('admin.settings.index', compact('scrollingText'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'scrolling_text' => 'required|string|max:1000',
        ]);
        Setting::set('scrolling_text', $request->scrolling_text);
        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
