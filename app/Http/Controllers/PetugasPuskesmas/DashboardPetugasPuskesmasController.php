<?php

namespace App\Http\Controllers\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPetugasPuskesmasController extends Controller
{
    public function index()
    {
        return view('pages.PetugasPuskesmas.Dashboard.index');
    }
}
