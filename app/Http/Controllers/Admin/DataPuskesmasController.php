<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use App\Models\Puskesmas;


class DataPuskesmasController extends Controller
{
    public function index()
    {
        $kecamatans = District::all();
        $puskesmas = Puskesmas::with('kecamatan', 'desa')->get();

        return view('pages.Admin.DataPuskesmas.index', compact('puskesmas', 'kecamatans'));
    }

    public function create()
    {
$kecamatans = District::all();
        $puskesmas = Puskesmas::with('kecamatan', 'desa')->get();

        return view('pages.Admin.DataPuskesmas.create', compact('puskesmas', 'kecamatans')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'id_kecamatan' => 'required|exists:indonesia_districts,id',
            'id_desa' => 'required|exists:indonesia_villages,id',
        ]);

        Puskesmas::create([
            'nama_puskesmas' => $request->nama_puskesmas,
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
        ]);

        return redirect()->back()->with('success', 'Data Puskesmas berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'id_kecamatan' => 'required|exists:indonesia_districts,id',
            'id_desa' => 'required|exists:indonesia_villages,id',
        ]);

        $puskesmas = Puskesmas::findOrFail($id);
        $puskesmas->update([
            'nama_puskesmas' => $request->nama_puskesmas,
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
        ]);

        return redirect()->back()->with('success', 'Data Puskesmas berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $puskesmas = Puskesmas::findOrFail($id);
        $puskesmas->delete();

        return redirect()->back()->with('success', 'Data Puskesmas berhasil dihapus!');
    }

    public function getDesa($id_kecamatan)
{
    $district = District::find($id_kecamatan);
    if (!$district) {
        return response()->json([]);
    }

    $desa = Village::where('district_code', $district->code)->get(['id', 'name']);
    return response()->json($desa);
}

}
