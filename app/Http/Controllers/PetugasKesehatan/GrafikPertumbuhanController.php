<?php

namespace App\Http\Controllers\PetugasKesehatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrafikPertumbuhanController extends Controller
{
    public function index()
    {
        return view('pages.PetugasKesehatan.GrafikPertumbuhan.index');
    }

    public function detail()
    {
        return view('pages.PetugasKesehatan.GrafikPertumbuhan.detail');

    }
}
