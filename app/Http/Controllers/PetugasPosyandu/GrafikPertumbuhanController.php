<?php

namespace App\Http\Controllers\PetugasPosyandu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Balita;
use App\Models\StandarBeratBadan;
use App\Models\StandarTinggiBadan;
use App\Models\DataPengukuran;


class GrafikPertumbuhanController extends Controller
{
    public function index()
    {
        $id_posyandu = Auth::user()->id_posyandu;
        $balitas = Balita::where('id_posyandu', $id_posyandu)->get();

        return view('pages.PetugasPosyandu.GrafikPertumbuhan.index', compact('balitas'));

    }

    public function showGrafikTinggiBadan($id_balita)
    {
        $user = Auth::user();

        $balita = Balita::where('id', $id_balita)
            ->where('id_posyandu', $user->id_posyandu)
            ->firstOrFail();

        $standar = StandarTinggiBadan::where('jenis_kelamin', $balita->jenis_kelamin)
            ->orderBy('usia')
            ->get(['usia', 'SD3', 'SD2', 'SD0', 'SD2neg', 'SD3neg']);

        $pengukuran = DataPengukuran::where('id_balita', $balita->id)
            ->orderBy('usia_bulan')
            ->get(['usia_bulan', 'tinggi_badan']);
    
        

        return view('pages.PetugasPosyandu.GrafikPertumbuhan.grafik-tb', compact('balita', 'standar', 'pengukuran'));
        }


    public function showGrafikBeratBadan($id_balita)
    {
        $user = Auth::user();

        $balita = Balita::where('id', $id_balita)
            ->where('id_posyandu', $user->id_posyandu)
            ->firstOrFail();

        $standar = StandarBeratBadan::where('jenis_kelamin', $balita->jenis_kelamin)
            ->orderBy('usia')
            ->get(['usia', 'SD3', 'SD2', 'SD0', 'SD2neg', 'SD3neg']);

        $pengukuran = DataPengukuran::where('id_balita', $balita->id)
            ->orderBy('usia_bulan')
            ->get(['usia_bulan', 'berat_badan']);
        

        return view('pages.PetugasPosyandu.GrafikPertumbuhan.grafik-bb', compact('balita', 'standar', 'pengukuran'));
        }
}

