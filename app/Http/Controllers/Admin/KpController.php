<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{KpData, KpRequirement, KpJadwal};
use Illuminate\Http\Request;

class KpController extends Controller
{
    // ── KP Data ───────────────────────────────────────────────
    public function index(Request $request)
    {
        $month    = $request->get('month', now()->format('Y-m'));
        $kpData   = KpData::where('month', $month)->orderBy('name')->get();
        $months   = KpData::distinct()->orderByDesc('month')->pluck('month');
        $requirements = KpRequirement::orderBy('sort_order')->get();
        $jadwal   = KpJadwal::orderBy('sort_order')->get();

        return view('admin.kp.index', compact('kpData', 'months', 'month', 'requirements', 'jadwal'));
    }

    public function storeData(Request $request)
    {
        $data = $request->validate([
            'month'          => 'required|date_format:Y-m',
            'name'           => 'required|string|max:255',
            'nip'            => 'required|string|max:30',
            'old_rank'       => 'required|string|max:20',
            'new_rank'       => 'required|string|max:20',
            'tanggal_usulan' => 'nullable|date',
            'drive_url'      => 'nullable|url|max:500',
        ]);
        KpData::create($data);
        return back()->with('success', 'Data KP berhasil ditambahkan.');
    }

    public function updateData(Request $request, KpData $kpData)
    {
        $data = $request->validate([
            'month'          => 'required|date_format:Y-m',
            'name'           => 'required|string|max:255',
            'nip'            => 'required|string|max:30',
            'old_rank'       => 'required|string|max:20',
            'new_rank'       => 'required|string|max:20',
            'tanggal_usulan' => 'nullable|date',
            'drive_url'      => 'nullable|url|max:500',
        ]);
        $kpData->update($data);
        return back()->with('success', 'Data KP berhasil diperbarui.');
    }

    public function destroyData(KpData $kpData)
    {
        $kpData->delete();
        return back()->with('success', 'Data KP berhasil dihapus.');
    }

    // ── KP Requirements ───────────────────────────────────────
    /**
     * Replace all requirements at once from a textarea (one line = one item).
     * This mirrors the original app's primary admin workflow for this list.
     */
    public function bulkReplaceRequirements(Request $request)
    {
        $data = $request->validate([
            'lines' => 'required|string',
        ]);

        $lines = collect(explode("\n", $data['lines']))
            ->map(fn($l) => trim($l))
            ->filter()
            ->values();

        if ($lines->isEmpty()) {
            return back()->with('error', 'Isi persyaratan tidak boleh kosong.');
        }

        KpRequirement::truncate();
        $lines->each(function ($text, $i) {
            KpRequirement::create([
                'text'       => $text,
                'note'       => null,
                'sub_items'  => [],
                'sort_order' => $i + 1,
            ]);
        });

        return back()->with('success', "{$lines->count()} persyaratan berhasil disimpan.");
    }

    public function storeRequirement(Request $request)
    {
        $data = $request->validate([
            'text'      => 'required|string|max:500',
            'note'      => 'nullable|string|max:500',
            'sub_items' => 'nullable|array',
            'sub_items.*' => 'string|max:300',
        ]);
        $data['sub_items'] = $data['sub_items'] ?? [];
        $data['sort_order'] = KpRequirement::max('sort_order') + 1;
        KpRequirement::create($data);
        return back()->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function updateRequirement(Request $request, KpRequirement $requirement)
    {
        $data = $request->validate([
            'text'        => 'required|string|max:500',
            'note'        => 'nullable|string|max:500',
            'sub_items'   => 'nullable|array',
            'sub_items.*' => 'string|max:300',
        ]);
        $data['sub_items'] = $data['sub_items'] ?? [];
        $requirement->update($data);
        return back()->with('success', 'Persyaratan berhasil diperbarui.');
    }

    public function destroyRequirement(KpRequirement $requirement)
    {
        $requirement->delete();
        return back()->with('success', 'Persyaratan berhasil dihapus.');
    }

    // ── KP Jadwal ─────────────────────────────────────────────
    public function storeJadwal(Request $request)
    {
        $data = $request->validate([
            'periode'    => 'required|string|max:100',
            'tanggal'    => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:500',
            'pdf_url'    => 'nullable|url|max:500',
        ]);
        $data['sort_order'] = KpJadwal::max('sort_order') + 1;
        KpJadwal::create($data);
        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updateJadwal(Request $request, KpJadwal $jadwal)
    {
        $data = $request->validate([
            'periode'    => 'required|string|max:100',
            'tanggal'    => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:500',
            'pdf_url'    => 'nullable|url|max:500',
        ]);
        $jadwal->update($data);
        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroyJadwal(KpJadwal $jadwal)
    {
        $jadwal->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
