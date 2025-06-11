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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->username),
        ]);

        $user->assignRole('kasir');

        return redirect()->route('pengguna')->with('success', 'Pengguna berhasil ditambahkan');
    }
}
