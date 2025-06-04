<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SupplierPupukModel;

class PupukController extends Controller
{ // Menampilkan data pupuk
    public function index()
    {
        $pupuk = SupplierPupukModel::all(); // Ambil semua data pupuk
        return view('admin.pupuk.index', compact('pupuk'));
    }

    // Menampilkan form untuk menambah pupuk
    public function create()
    {
        return view('admin.pupuk.create'); // Menampilkan form untuk menambah data pupuk
    }

    // Menyimpan data pupuk ke database
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama_supplier' => 'required|string|max:255',
                'nomor_telepon_supplier' => 'required|string|max:15',
                'alamat_supplier' => 'required|string|max:255',
                'nomor_rekening_supplier' => 'required|string|max:20',
                'keterangan'=>'required|string|max:255',
            ]);

            // Menyimpan data supplier ke database
            SupplierPupukModel::create([
                'nama_supplier' => $request->nama_supplier,
                'nomor_telepon_supplier' => $request->nomor_telepon_supplier,
                'alamat_supplier' => $request->alamat_supplier,
                'nomor_rekening_supplier' => $request->nomor_rekening_supplier,
                'keterangan' => $request->keterangan,
            ]);

            // Redirect ke halaman daftar dengan pesan sukses
            return redirect()->route('pupuk')->with('success', 'Data supplier pupuk berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }


    // Menampilkan form untuk mengedit pupuk
    public function edit($id)
    {
        $pupuk = SupplierPupukModel::findOrFail($id); // Mencari data supplier berdasarkan id
        return view('admin.pupuk.edit', compact('pupuk')); // Menampilkan form edit data supplier
    }

    // Memperbarui data pupuk
    public function update(Request $request, $id)
    {
        // Validasi input update
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'nomor_telepon_supplier' => 'required|string|max:15',
            'alamat_supplier' => 'required|string|max:255',
            'nomor_rekening_supplier' => 'required|string|max:20',
        ]);

        try {
            // Mencari data supplier berdasarkan id
            $pupuk = SupplierPupukModel::findOrFail($id);

            // Update data supplier
            $pupuk->nama_supplier = $request->nama_supplier;
            $pupuk->nomor_telepon_supplier = $request->nomor_telepon_supplier;
            $pupuk->alamat_supplier = $request->alamat_supplier;
            $pupuk->nomor_rekening_supplier = $request->nomor_rekening_supplier;

            // Menyimpan perubahan data supplier
            $pupuk->save();  // Menggunakan save() untuk menyimpan perubahan

            // Redirect ke halaman daftar dengan pesan sukses
            return redirect()->route('pupuk')->with('success', 'Data supplier pupuk berhasil diperbarui!');
        } catch (Exception $e) {
            // Menangani error jika terjadi masalah
            return redirect()->back()->with('error', 'Data gagal diperbarui!')->withInput();
        }
    }

    // Menghapus data pupuk
    public function destroy($id)
    {
        try {
            // Mencari data supplier berdasarkan id
            $supplier = SupplierPupukModel::findOrFail($id);

            // Menghapus data supplier
            $supplier->delete();

            // Redirect ke halaman daftar dengan pesan sukses
            return redirect()->route('pupuk')->with('success', 'Data supplier pupuk berhasil dihapus!');
        } catch (Exception $e) {
            // Jika terjadi error, kembalikan pesan error
            return redirect()->route('pupuk')->with('error', 'Data supplier gagal dihapus!');
        }
    }
}
