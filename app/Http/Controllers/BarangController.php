<?php

namespace App\Http\Controllers;

use App\Models\SupplierPupukModel;
use Exception;
use App\Models\Barang;
use App\Models\BarangModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        // Mengambil semua data barang
        $barangs = BarangModel::all();

        // Mengirimkan data barang ke view
        return view('admin.barang.index', compact('barangs'));
    }

    // Menampilkan detail barang
    public function detail($id)
    {
        // Mencari data barang berdasarkan ID
        $barang = BarangModel::findOrFail($id);

        // Menampilkan halaman detail dan mengirimkan data barang
        return view('admin.barang.detail', compact('barang'));
    }

    public function create()
    {
        // Mengambil data supplier dan kategori untuk dropdown
        $pupuk = SupplierPupukModel::all();   // Ambil semua kategori

        // Kirim keduanya ke view
        return view('admin.barang.create', compact('pupuk',));
    }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama_barang' => 'required',
                'harga_jual_barang' => 'required|numeric',
                'harga_beli_barang' => 'required|numeric',
                'id_supplier' => 'nullable|exists:supplier_pupuk,id', // Validasi ID Supplier
            ]);

            // Menyimpan data barang ke database
            BarangModel::create([
                'nama_barang' => $request->nama_barang,
                'harga_jual_barang' => $request->harga_jual_barang,
                'harga_beli_barang' => $request->harga_beli_barang,
                'id_supplier' => $request->id_supplier ?? null,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('barang')->with('success', 'Data barang berhasil disimpan!');
        } catch (Exception $e) {
            // Menangani error dan menampilkan pesan
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        // Mencari data barang berdasarkan ID
        $barang = BarangModel::findOrFail($id);

        // Mengambil data supplier untuk dropdown
        $pupuk = SupplierPupukModel::all(); // Ambil semua data supplier

        // Menampilkan halaman edit dan mengirimkan data barang serta supplier
        return view('admin.barang.edit', compact('barang', 'pupuk'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_jual_barang' => 'required|numeric',
            'harga_beli_barang' => 'required|numeric',
            'id_supplier' => 'sometimes|exists:supplier_pupuk,id',
        ]);

        // Mencari data barang berdasarkan ID
        $barang = BarangModel::findOrFail($id);

        // Memperbarui data barang
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga_jual_barang' => $request->harga_jual_barang,
            'harga_beli_barang' => $request->harga_beli_barang,
            'id_supplier' => $request->id_supplier ?? null,
        ]);

        return redirect()->route('barang')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Mencari data barang berdasarkan ID
        $barang = BarangModel::findOrFail($id);

        // Menghapus data barang
        $barang->delete();

        return redirect()->route('barang')->with('success', 'Data barang berhasil dihapus!');
    }
}
