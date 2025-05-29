<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAturan;
use App\Models\Faktor;

class DataAturanController extends Controller
{
    public function index()
    {
        $dataAturans = DataAturan::orderBy('id', 'desc')->paginate(10);
        $faktors = Faktor::pluck('nama_faktor', 'kode_faktor');
        return view('pages.Admin.DataAturan.index', compact('dataAturans', 'faktors'));
    }

    public function create()
    {
        $faktors = Faktor::with('himpunanFuzzy')->get();
        return view('pages.Admin.DataAturan.create', compact('faktors'));
    }

    public function store(Request $request)
    {
        $rules = [
            'kode_aturan' => 'required|unique:data_aturans,kode_aturan',
            'range_usia' => 'required|string',
            'keputusan' => 'required|string',
        ];

        $faktorCodes = Faktor::pluck('kode_faktor')->toArray();
        foreach ($faktorCodes as $code) {
            $rules[$code] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Simpan range_usia sebagai array JSON
        $rangeUsia = [$validated['range_usia']];

        $nilaiFaktor = [];
        foreach ($faktorCodes as $code) {
            $nilaiFaktor[$code] = $validated[$code];
        }

        DataAturan::create([
            'kode_aturan' => $validated['kode_aturan'],
            'range_usia' => json_encode($rangeUsia),
            'nilai_faktor' => json_encode($nilaiFaktor),
            'keputusan' => $validated['keputusan'],
        ]);

        return redirect()->route('admin.data-aturan')->with('success', 'Data aturan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dataAturan = DataAturan::findOrFail($id);
        $faktors = Faktor::with('himpunanFuzzy')->get();

        // Decode JSON ke array supaya bisa dipakai di form
        $nilaiFaktor = json_decode($dataAturan->nilai_faktor, true);
        $rangeUsia = json_decode($dataAturan->range_usia, true);

        return view('pages.Admin.DataAturan.edit', compact('dataAturan', 'faktors', 'nilaiFaktor', 'rangeUsia'));
    }

    public function update(Request $request, $id)
    {
        $dataAturan = DataAturan::findOrFail($id);

        $rules = [
            'kode_aturan' => 'required|unique:data_aturans,kode_aturan,' . $id,
            'range_usia' => 'required|string',
            'keputusan' => 'required|string',
        ];

        $faktorCodes = Faktor::pluck('kode_faktor')->toArray();
        foreach ($faktorCodes as $code) {
            $rules[$code] = 'required|string';
        }

        $validated = $request->validate($rules);

        $rangeUsia = [$validated['range_usia']];

        $nilaiFaktor = [];
        foreach ($faktorCodes as $code) {
            $nilaiFaktor[$code] = $validated[$code];
        }

        $dataAturan->update([
            'kode_aturan' => $validated['kode_aturan'],
            'range_usia' => json_encode($rangeUsia),
            'nilai_faktor' => json_encode($nilaiFaktor),
            'keputusan' => $validated['keputusan'],
        ]);

        return redirect()->route('admin.data-aturan')->with('success', 'Data aturan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dataAturan = DataAturan::findOrFail($id);
        $dataAturan->delete();

        return redirect()->route('admin.data-aturan')->with('success', 'Data aturan berhasil dihapus.');
    }
}
