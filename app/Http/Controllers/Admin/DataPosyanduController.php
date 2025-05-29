<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posyandu;
use App\Models\Puskesmas;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Http\Request;

class DataPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posyandus = Posyandu::with('puskesmas', 'kecamatan', 'desa')->get();
        
        return view('pages.Admin.DataPosyandu.index', compact('posyandus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $puskesmas = Puskesmas::all();
        $kecamatans = District::all();
        $desas = Village::all();


        return view('pages.Admin.DataPosyandu.create', compact('puskesmas', 'kecamatans', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'id_puskesmas' => 'required|exists:puskesmas,id',
            'id_kecamatan' => 'required|exists:indonesia_districts,id',
            'id_desa' => 'required|exists:indonesia_villages,id',
            'alamat' => 'required|string|max:255',
        ]);

        Posyandu::create([
            'nama_posyandu' => $request->nama_posyandu,
            'id_puskesmas' => $request->id_puskesmas,
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.data-posyandu')->with('success', 'Posyandu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posyandu = Posyandu::with('puskesmas', 'kecamatan', 'desa')->findOrFail($id);

        return view('pages.Admin.DataPosyandu.show', compact('posyandu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posyandu = Posyandu::findOrFail($id);

        $puskesmas = Puskesmas::all();
        $kecamatans = District::all();
        $desas = Village::all();

        return view('pages.Admin.DataPosyandu.edit', compact('posyandu', 'puskesmas', 'kecamatans', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'id_puskesmas' => 'required|exists:puskesmas,id',
            'id_kecamatan' => 'required|exists:indonesia_districts,id',
            'id_desa' => 'required|exists:indonesia_villages,id',
            'alamat' => 'required|string|max:255',
        ]);

        $posyandu = Posyandu::findOrFail($id);

        $posyandu->update([
            'nama_posyandu' => $request->nama_posyandu,
            'id_puskesmas' => $request->id_puskesmas,
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Posyandu berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posyandu = Posyandu::findOrFail($id);

        $posyandu->delete();

        return redirect()->route('posyandu.index')->with('success', 'Posyandu berhasil dihapus!');
    }

    public function getDesa($id_kecamatan)
{
    $district = District::find($id_kecamatan);
    $desa = Village::where('district_code', $district->code)->get(['id', 'name']);
    return response()->json($desa);
}
}
