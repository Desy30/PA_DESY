<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pemilik.pengguna.index', compact('users'));
    }

    public function create()
    {
        return view('pemilik.pengguna.create');
    }
}
