<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Validation\Rules\Enum;

class KategoriController extends Controller
{

    // Menampilkan semua kategori
    public function index(Request $request)
    {
        $query = KategoriModel::query();

        // Filter berdasarkan jenis_kategori
        if ($request->has('jenis_kategori') && $request->jenis_kategori != '') {
            $query->where('jenis_kategori', $request->jenis_kategori);
        }

        // Filter berdasarkan nama kategori
        if ($request->has('search_kategori') && $request->search_kategori != '') {
            $query->where('nama_kategori', 'like', '%' . $request->search_kategori . '%');
        }

        $kategories = $query->get();

        return view('admin.kategori.index', compact('kategories'));
    }


    public function getByJenis(Request $request)
    {
        $jenis = $request->input('jenis');
        $kategories = KategoriModel::where('jenis_kategori', $jenis)->get();
        return response()->json($kategories);
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('admin.kategori.create'); // Menampilkan view form create kategori
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'jenis_kategori' => 'required|in:pemasukan,pengeluaran',
            'nama_kategori' => 'required|string|max:255',
            'is_pengiriman' => 'sometimes|nullable',
            'deskripsi' => 'required|string',
        ]);

        $tag_id = strtolower($request->name_kategori);

        // Simpan kategori ke database
        KategoriModel::create([
            'jenis_kategori' => $request->jenis_kategori,
            'nama_kategori' => $request->nama_kategori,
            'is_pengiriman' => $request->is_pengiriman ?? false,
            'deskripsi' => $request->deskripsi,
            'tag_id' => $tag_id
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        // Mencari data kategori berdasarkan UUID
        $kategori = KategoriModel::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori')); // Menampilkan view form edit kategori
    }

    //show
    public function show($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        return view('admin.kategori.show', compact('kategori'));
    }



    // Memperbarui kategori
    public function update(Request $request, $id)
    {
        // Validasi input, batasi jenis_kategori hanya boleh 'Masuk' atau 'Keluar'
        $validated = $request->validate([
            'nama_kategori' => 'required',
            'jenis_kategori' => 'required|in:pemasukan,pengeluaran',
            'deskripsi' => 'nullable',
            'is_pengiriman' => 'nullable|boolean',
        ]);

        $kategori = KategoriModel::findOrFail($id);

        // Simpan data ke model
        $kategori->nama_kategori = $validated['nama_kategori'];
        $kategori->jenis_kategori = $validated['jenis_kategori'];
        $kategori->deskripsi = $validated['deskripsi'] ?? null;
        $kategori->is_pengiriman = $validated['is_pengiriman'] ?? false;
        $kategori->save();

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui');
    }


    // Menghapus kategori
    public function destroy($id)
    {
        try {

            $kategori = KategoriModel::findOrFail($id);
            $kategori->delete();
            return redirect()->route('kategori')->with('success', 'Data kategori berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('kategori')->with('error', 'Data kategori gagal dihapus!');
        }
    }
}
