<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('pemilik.pengguna.index');
    }

    public function create()
    {
        return view('pemilik.pengguna.create');
    }
}
