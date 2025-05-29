<?php

namespace App\Http\Controllers\PetugasPuskesmas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Posyandu;
use App\Models\Balita;



class DaftarBalitaController extends Controller
{
   public function index(Request $request)
{
    $id_puskesmas = Auth::user()->id_puskesmas;

    $search = $request->input('search'); // ambil input search
    $perPage = $request->input('per_page', 5);

    // Query dasar
    $query = Posyandu::with(['desa', 'balita'])
        ->withCount('balita')
        ->where('id_puskesmas', $id_puskesmas);

    // Jika ada search, filter nama posyandu dan nama desa
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nama_posyandu', 'like', "%{$search}%")
              ->orWhereHas('desa', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Ambil hasil paginate dengan query string otomatis
    $posyandus = $query->paginate($perPage)->appends($request->query());

    return view('pages.PetugasPuskesmas.DaftarBalita.index', compact('posyandus', 'search', 'perPage'));
}

    public function show($id)
{
    $id_puskesmas = Auth::user()->id_puskesmas;

    // Ambil posyandu yang sesuai dengan puskesmas user login
    $posyandu = Posyandu::with('balita')
        ->where('id', $id)
        ->where('id_puskesmas', $id_puskesmas)
        ->firstOrFail();

    return view('pages.PetugasPuskesmas.DaftarBalita.show', compact('posyandu'));
}
    public function detail(string $id)
{
    $user = Auth::user();

    // Ambil balita berdasarkan ID dengan pengecekan id_posyandu dan id_puskesmas
    $balita = Balita::with(['orangTua', 'dataKesehatan', 'posyandu'])
        ->where('id', $id)
        ->whereHas('posyandu', function ($query) use ($user) {
            $query->where('id_puskesmas', $user->id_puskesmas);
        })
        ->firstOrFail();

    return view('pages.PetugasPuskesmas.DaftarBalita.detail', compact('balita'));
}
}
