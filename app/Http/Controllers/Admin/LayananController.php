<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    TugasBelajarPersyaratan, TugasBelajarDokumen,
    KarisKarsuPersyaratan, KarisKarsuDokumen,
    PerkawinanPertamaPersyaratan, PerkawinanPertamaDokumen,
    PensiunPersyaratan, PensiunDokumen,
};
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /** Map slug → [PersyaratanModel, DokumenModel, view-name] */
    private function resolveLayanan(string $type): array
    {
        return match ($type) {
            'tugas-belajar'      => [TugasBelajarPersyaratan::class, TugasBelajarDokumen::class, 'tugas-belajar'],
            'karis-karsu'        => [KarisKarsuPersyaratan::class,   KarisKarsuDokumen::class,   'karis-karsu'],
            'perkawinan-pertama' => [PerkawinanPertamaPersyaratan::class, PerkawinanPertamaDokumen::class, 'perkawinan-pertama'],
            'pensiun'            => [PensiunPersyaratan::class,       PensiunDokumen::class,       'pensiun'],
            default              => abort(404),
        };
    }

    public function index(string $type)
    {
        [$persModel, $dokModel, $view] = $this->resolveLayanan($type);
        $persyaratan = $persModel::orderBy('sort_order')->get();
        $dokumen     = $dokModel::orderBy('sort_order')->get();
        $titles = [
            'tugas-belajar'      => 'Tugas Belajar',
            'karis-karsu'        => 'Karis / Karsu',
            'perkawinan-pertama' => 'Perkawinan Pertama',
            'pensiun'            => 'Pensiun',
        ];
        $title = $titles[$type];
        return view('admin.layanan-crud', compact('persyaratan', 'dokumen', 'type', 'title'));
    }

    public function store(Request $request, string $type)
    {
        [$persModel, $dokModel] = $this->resolveLayanan($type);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'url'         => 'required|url|max:500',
            'kategori'    => 'required|in:persyaratan,dokumen',
        ]);

        $model = $data['kategori'] === 'persyaratan' ? $persModel : $dokModel;
        unset($data['kategori']);
        $data['sort_order'] = $model::max('sort_order') + 1;
        $model::create($data);

        return back()->with('success', 'Item berhasil ditambahkan.');
    }

    public function update(Request $request, string $type, int $id)
    {
        [$persModel, $dokModel] = $this->resolveLayanan($type);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'url'         => 'required|url|max:500',
            'kategori'    => 'required|in:persyaratan,dokumen',
        ]);

        $model  = $data['kategori'] === 'persyaratan' ? $persModel : $dokModel;
        $record = $model::findOrFail($id);
        unset($data['kategori']);
        $record->update($data);

        return back()->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(Request $request, string $type, int $id)
    {
        [$persModel, $dokModel] = $this->resolveLayanan($type);

        $kategori = $request->validate(['kategori' => 'required|in:persyaratan,dokumen'])['kategori'];
        $model    = $kategori === 'persyaratan' ? $persModel : $dokModel;
        $model::findOrFail($id)->delete();

        return back()->with('success', 'Item berhasil dihapus.');
    }
}
