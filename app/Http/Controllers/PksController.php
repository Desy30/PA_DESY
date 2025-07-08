<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\PksModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PksController extends Controller
{ // Menampilkan daftar PKS
    public function index()
    {
        $pks = PksModel::all();  // Mengambil data dari database
        return view('admin.pks.index', compact('pks'));
    }

    // Menampilkan form untuk menambah PKS baru
    public function create()
    {
        return view('admin.pks.create');
    }

    // Menyimpan data PKS ke dalam database
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_pks' => 'required',
            'nomor_telepon_pks' => 'required',
            'alamat_pks' => 'required',
        ]);


        // Menyimpan data PKS ke database
        PksModel::create([
            'nama_pks' => $request->nama_pks,
            'nomor_telepon_pks' => $request->nomor_telepon_pks,
            'alamat_pks' => $request->alamat_pks,
        ]);

        return redirect()->route('pks')->with('success', 'Data PKS berhasil disimpan!');
    }

    // Menampilkan form untuk mengedit data PKS
    public function edit($id)
    {
        $pks = PksModel::findOrFail($id);  // Menemukan data berdasarkan ID
        return view('admin.pks.edit', compact('pks'));
    }

    // Memperbarui data PKS
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_pks' => 'required',
            'nomor_telepon_pks' => 'required',
            'alamat_pks' => 'required',
        ]);

        // Menemukan data PKS berdasarkan ID
        $pks = PksModel::findOrFail($id);

        // Memperbarui data PKS
        $pks->update([
            'nama_pks' => $request->nama_pks,
            'nomor_telepon_pks' => $request->nomor_telepon_pks,
            'alamat_pks' => $request->alamat_pks,
        ]);

        return redirect()->route('pks')->with('success', 'Data PKS berhasil diperbarui!');
    }
    //show data pks
    public function show($id)
    {
        $pks = PksModel::findOrFail($id);
        return view('admin.pks.show', compact('pks'));
    }

    // Menghapus data PKS
    public function destroy($id)
    {
        try {
            // Menemukan data PKS berdasarkan ID
            $pks = PksModel::findOrFail($id);

            // Menghapus data PKS
            $pks->delete();

            return redirect()->route('pks')->with('success', 'Data PKS berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('pks')->with('error', 'Data PKS gagal dihapus!');
        }
    }
}
