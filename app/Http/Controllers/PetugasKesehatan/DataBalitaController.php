<?php

namespace App\Http\Controllers\PetugasKesehatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataBalitaController extends Controller
{
    public function index()
    {
        return view('pages.PetugasKesehatan.DataBalita.index');
    }

    public function create()
    {
        return view('pages.PetugasKesehatan.DataBalita.create');
    }

    public function detail()
    {
        return view('pages.PetugasKesehatan.DataBalita.detail');
    }
}
