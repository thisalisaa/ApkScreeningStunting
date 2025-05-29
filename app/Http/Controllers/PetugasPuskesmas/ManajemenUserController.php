<?php

namespace App\Http\Controllers\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajemenUserController extends Controller
{
    public function index()
    {
        return view('pages.PetugasPuskesmas.ManajemenUser.index');
    }
    public function create()
    {
        return view('pages.PetugasPuskesmas.ManajemenUser.create');
    }
}
