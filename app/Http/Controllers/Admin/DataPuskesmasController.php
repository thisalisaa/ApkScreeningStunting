<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPuskesmasController extends Controller
{
    public function index()
    {
        return view('pages.Admin.DataPuskesmas.index');
    }
}
