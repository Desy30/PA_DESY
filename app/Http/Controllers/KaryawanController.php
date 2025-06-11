<?php

namespace App\Http\Controllers;

use App\Models\KaryawanModel;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = KaryawanModel::all();
        return view('pemilik.karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = KaryawanModel::all();
        return view('pemilik.karyawan.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'jabatan_karyawan' => 'required|string|max:100',
            'gaji' => 'required|numeric',
        ]);

        KaryawanModel::create([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan_karyawan' => $request->jabatan_karyawan,
            'gaji' => $request->gaji,
        ]);

        return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $karyawan = KaryawanModel::findOrFail($id);
        return view('pemilik.karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'jabatan_karyawan' => 'required|string|max:100',
            'gaji' => 'required|numeric',
        ]);

        $karyawan = KaryawanModel::findOrFail($id);
        $karyawan->update([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan_karyawan' => $request->jabatan_karyawan,
            'gaji' => $request->gaji,
        ]);

        return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = KaryawanModel::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil dihapus.');

    }
}
