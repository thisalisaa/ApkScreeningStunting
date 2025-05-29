<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Faktor;

class DataFaktorController extends Controller
{

   public function index(Request $request)
{
    $query = Faktor::query();

    if ($request->has('search') && !empty($request->search)) {
        $query->where('kode_faktor', 'like', '%' . $request->search . '%')
        ->orWhere('nama_faktor', 'like', '%' . $request->search . '%');
    }

    $perPage = $request->input('show', 5); 

    $faktor = $query->orderBy('id', 'asc')->paginate($perPage)->withQueryString();

    return view('pages.Admin.DataFaktor.index', compact('faktor'));
}



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_faktor' => 'required|unique:faktors,kode_faktor|max:5',
            'nama_faktor' => 'required|unique:faktors,nama_faktor',
            'range_usia'  => 'required|array',

        ], [
            'kode_faktor.required' => 'Kode faktor harus diisi',
            'kode_faktor.unique' => 'Kode faktor sudah terdaftar dalam sistem',
            'kode_faktor.max' => 'Kode faktor maksimal 5 karakter',
            'nama_faktor.required' => 'Nama faktor harus diisi',
            'nama_faktor.unique' => 'Nama faktor sudah terdaftar dalam sistem',
        ]);

        if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }


        Faktor::create([
            'kode_faktor' => $request->kode_faktor,
            'nama_faktor' => $request->nama_faktor,
            'range_usia'  => $request->range_usia,

        ]);

        return response()->json(['message' => 'Faktor berhasil ditambahkan!']);
    }


    public function update(Request $request, string $id)
    {
        $faktor = Faktor::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_faktor' => 'required|max:10|unique:faktors,kode_faktor,' . $id,
            'nama_faktor' => 'required|unique:faktors,nama_faktor,' . $id,
        ], [
            'kode_faktor.required' => 'Kode faktor harus diisi',
            'kode_faktor.unique' => 'Kode faktor sudah terdaftar dalam sistem',
            'kode_faktor.max' => 'Kode faktor maksimal 5 karakter',
            'nama_faktor.required' => 'Nama faktor harus diisi',
            'nama_faktor.unique' => 'Nama faktor sudah terdaftar dalam sistem',
        ]);

        if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

        $faktor->update([
            'kode_faktor' => $request->kode_faktor,
            'nama_faktor' => $request->nama_faktor,
        ]);

        return redirect()->back()->with('success', 'Faktor berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $faktor = Faktor::findOrFail($id);
        $faktor->delete();

        return redirect()->back()->with('success', 'Faktor berhasil dihapus!');
    }
}
