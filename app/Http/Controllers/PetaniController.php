<?php

namespace App\Http\Controllers;

use App\Models\PetaniModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;

class PetaniController extends Controller
{
    public function index()
    {
        // Mengambil data petani dengan relasi
        $petani = PetaniModel::get();
        return view('admin.petani.index', compact('petani'));
    }

    public function create()
    {
        return view('admin.petani.create');
    }

    public function store(Request $request)
    {
        //tambah
        try {
            // Validasi input
            $request->validate([
                'nama_petani' => 'required',
                'nomor_telepon_petani' => 'required',
                'alamat_petani' => 'required',
                'nomor_rekening_petani' => 'required',
            ]);

            // Menyimpan data petani ke database
            PetaniModel::create([
                'nama_petani' => $request->nama_petani,
                'nomor_telepon_petani' => $request->nomor_telepon_petani,
                'alamat_petani' => $request->alamat_petani,
                'nomor_rekening_petani' => $request->nomor_rekening_petani,
            ]);
            // tambah
            return redirect()->route('petani')->with('success', 'Data berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {

        // Mencari data petani berdasarkan UUID
        $petani = PetaniModel::findOrFail($id);
        return view('admin.petani.edit', compact('petani'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_petani' => 'required',
            'nomor_telepon_petani' => 'required',
            'alamat_petani' => 'required',
            'nomor_rekening_petani' => 'required',
        ]);

        // Mengambil data petani berdasarkan UUID
        $petani = PetaniModel::findOrFail($id);

        // Memperbarui data petani
        $petani->update([
            'nama_petani' => $request->nama_petani,
            'nomor_telepon_petani' => $request->nomor_telepon_petani,
            'alamat_petani' => $request->alamat_petani,
            'nomor_rekening_petani' => $request->nomor_rekening_petani,
        ]);



        return redirect()->route('petani')->with('success', 'Data petani berhasil diperbarui!');
    }
    public function show($id)
    {
        $petani = PetaniModel::findOrFail($id);
        return view('admin.petani.show', compact('petani'));
    }

    public function destroy($id)
    {
        try {
            // Mencari data petani berdasarkan ID
            $petani = PetaniModel::findOrFail($id);

            // Menghapus data petani
            $petani->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('petani')->with('success', 'Data petani berhasil dihapus!');
        } catch (Exception $e) {
            // Jika terjadi error, kembalikan pesan error
            return redirect()->route('petani')->with('error', 'Data petani gagal dihapus!');
        }
    }
}
