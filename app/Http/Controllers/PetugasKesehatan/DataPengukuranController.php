<?php

namespace App\Http\Controllers\PetugasKesehatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPengukuranController extends Controller
{
    public function index()
    {
        return view('pages.PetugasKesehatan.DataPengukuran.index');
    }
    
}
