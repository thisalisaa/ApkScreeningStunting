<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataHimpunanFuzzy;
use App\Models\Faktor;

class DataHimpunanController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);

        $query = DataHimpunanFuzzy::with('faktor');

        if ($search) {
            $query->whereHas('faktor', function ($q) use ($search) {
                $q->where('nama_faktor', 'like', '%' . $search . '%');
            })->orWhere('nama_himpunan', 'like', '%' . $search . '%');
        }

        $dataHimpunan = $query->paginate($perPage);

        return view('pages.Admin.DataHimpunan.index', compact('dataHimpunan', 'search', 'perPage'));
    }

    public function create()
    {
        $faktors = Faktor::all();
        return view('pages.Admin.DataHimpunan.create', compact('faktors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faktor_resiko_id' => 'required|exists:faktors,id',
            'nama_himpunan' => 'required|string',
            'satuan' => 'nullable|string',
            'tipe_fungsi' => 'nullable|in:segitiga,trapesium',
            'tipe_input' => 'required|in:numerik,diskrit',
            'batas_bawah' => 'nullable|numeric',
            'batas_tengah1' => 'nullable|numeric',
            'batas_tengah2' => 'nullable|numeric',
            'batas_atas' => 'nullable|numeric',
        ]);


        DataHimpunanFuzzy::create([
            'id_faktor' => $validated['faktor_resiko_id'],
            'nama_himpunan' => $validated['nama_himpunan'],
            'satuan' => $validated['satuan'],
            'tipe_fungsi' => $validated['tipe_fungsi'],
            'tipe_input' => $validated['tipe_input'],
            'batas_bawah' => $validated['batas_bawah'],
            'batas_tengah1' => $validated['batas_tengah1'],
            'batas_tengah2' => $validated['batas_tengah2'],
            'batas_atas' => $validated['batas_atas'],
        ]);

        return redirect()->route('admin.data-himpunan')->with('success', 'Data berhasil disimpan.');
    }

    public function show($id)
    {
        $dataHimpunan = DataHimpunanFuzzy::with('faktor')->findOrFail($id);

        return view('pages.Admin.DataHimpunan.show', compact('dataHimpunan'));
    }



    public function edit(string $id)
    {
        $himpunan = DataHimpunanFuzzy::findOrFail($id);
        $faktors = Faktor::all();

        return view('pages.Admin.DataHimpunan.edit', compact('himpunan', 'faktors'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'faktor_resiko_id' => 'required',
            'nama_himpunan' => 'required',
            'tipe_fungsi' => 'nullable|in:segitiga,trapesium',
            'tipe_input' => 'required|in:numerik,diskrit',
            'batas_bawah' => 'nullable|numeric',
            'batas_tengah1' => 'nullable|numeric',
            'batas_tengah2' => 'nullable|numeric',
            'batas_atas' => 'nullable|numeric',
            'satuan' => 'nullable|string',
        ]);

        $himpunan = DataHimpunanFuzzy::findOrFail($id);

        $himpunan->update($request->all());

        return redirect()->route('admin.data-himpunan')->with('success', 'Data Himpunan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $himpunan = DataHimpunanFuzzy::findOrFail($id);
        $himpunan->delete();

        return redirect()->route('admin.data-himpunan')->with('success', 'Data himpunan berhasil dihapus.');
    }
}
