<?php

namespace App\Http\Controllers\PetugasKesehatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HasilScreeningController extends Controller
{
    public function index()
    {
        return view('pages.PetugasKesehatan.HasilScreening.index');
    }
}
