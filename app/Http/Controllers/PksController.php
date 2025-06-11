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
            'tanda_tangan_pks' => 'required|image|max:2048', // Validasi untuk gambar
        ]);

        // Mengolah file gambar tanda tangan
        $filename = time() . '-' . $request->file('tanda_tangan_pks')->getClientOriginalName();
        $path = $request->file('tanda_tangan_pks')->storeAs('pks', $filename, 'public');

        // Menyimpan data PKS ke database
        PksModel::create([
            'nama_pks' => $request->nama_pks,
            'nomor_telepon_pks' => $request->nomor_telepon_pks,
            'alamat_pks' => $request->alamat_pks,
            'tanda_tangan_pks' => $path,  // Simpan path file gambar
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
            'tanda_tangan_pks' => 'sometimes|image|max:2048',  // Validasi untuk gambar jika ada file yang diupload
        ]);

        // Menemukan data PKS berdasarkan ID
        $pks = PksModel::findOrFail($id);

        // Memperbarui data PKS
        $pks->update([
            'nama_pks' => $request->nama_pks,
            'nomor_telepon_pks' => $request->nomor_telepon_pks,
            'alamat_pks' => $request->alamat_pks,
        ]);

        // Memperbarui tanda tangan jika ada file baru
        if ($request->hasFile('tanda_tangan_pks')) {
            // Menghapus gambar lama jika ada
            if (Storage::disk('public')->exists($pks->tanda_tangan_pks)) {
                Storage::disk('public')->delete($pks->tanda_tangan_pks);
            }

            // Mengolah file gambar tanda tangan yang baru
            $filename = time() . '-' . $request->file('tanda_tangan_pks')->getClientOriginalName();
            $path = $request->file('tanda_tangan_pks')->storeAs('pks', $filename, 'public');

            // Memperbarui path gambar tanda tangan di database
            $pks->update([
                'tanda_tangan_pks' => $path,
            ]);
        }

        return redirect()->route('pks')->with('success', 'Data PKS berhasil diperbarui!');
    }

    // Menghapus data PKS
    public function destroy($id)
    {
        try {
            // Menemukan data PKS berdasarkan ID
            $pks = PksModel::findOrFail($id);

            // Menghapus gambar tanda tangan jika ada
            if (Storage::disk('public')->exists($pks->tanda_tangan_pks)) {
                Storage::disk('public')->delete($pks->tanda_tangan_pks);
            }

            // Menghapus data PKS
            $pks->delete();

            return redirect()->route('pks')->with('success', 'Data PKS berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('pks')->with('error', 'Data PKS gagal dihapus!');
        }
    }
}
