<?php

namespace App\Http\Controllers\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanScreeningController extends Controller
{
    public function index()
    {
        return view('pages.PetugasPuskesmas.LaporanScreening.index');
    }
    public function show()
    {
        return view('pages.PetugasPuskesmas.LaporanScreening.show');
    }

    public function detail()
    {
        return view('pages.PetugasPuskesmas.LaporanScreening.detail');
    }
}
