<?php

namespace App\Http\Controllers\PetugasPosyandu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Posyandu;

class DashboardPetugasPosyanduController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $idPosyandu = $user->id_posyandu;
        $posyandu = Posyandu::find($idPosyandu);

        return view('pages.PetugasPosyandu.Dashboard.index', compact('posyandu'));
    }
}
