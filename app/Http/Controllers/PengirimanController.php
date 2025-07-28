<?php

namespace App\Http\Controllers;

use App\Models\PksModel;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use App\Models\TransaksiSawitModel;
use Illuminate\Support\Facades\Storage;

class PengirimanController extends Controller
{
//mengambil data pada tabel transaksi yang memiliki kategori pemasukan.
//relasi transaksiSawit digunakan untuk mengambil data dari tabel transaksiSawit.
    public function index(Request $request)
    {
        $query = TransaksiModel::with(['kategori', 'transaksiSawit'])
            ->whereHas('kategori', function ($q) {
                $q->where('jenis_kategori', 'pemasukan');
            })->whereHas('transaksiSawit');


        if ($request->filled('status_pengiriman') && $request->status_pengiriman !== 'Semua') {
            $query->where('status_pengiriman', $request->status_pengiriman);
        }

        $transaksis = $query->latest()->get();

        return view('admin.pengiriman.index', compact('transaksis'));
    }
    public function edit($id)
    {
        //menampilkan form edit berdasarkan id yang dipilih
        $pengiriman = TransaksiModel::findOrFail($id);
        return view('admin.pengiriman.edit', compact('pengiriman'));
    }

    public function updateShow(Request $request, $id)
    {
        //melakukan validasi sesuai inputan edit
        $request->validate([
            'bon' => 'required|file',
            'total' => 'required'
        ]);
        //simpan file bon storage
        $file = $request->file('bon');
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('bon', $file, $fileName);

        $transaksi = TransaksiModel::findOrFail($id);

        //update total dan status_pengiriman dan ubah status jadi selesai
        $transaksi->update([
            'total' => $request->total,
            'status_pengiriman' => 'Selesai'
        ]);

        $transaksiSawit = TransaksiSawitModel::where('id_transaksi', $transaksi->id)->first();

        $transaksiSawit->update([
            'bon' => $fileName
        ]);

        return redirect()->route('pengiriman')->with('success', 'Status pengiriman diperbarui.');
    }


    public function update(Request $request, $id)
    {
        //melakukan validasi sesuai inputan
        $request->validate([
            'status_pengiriman' => 'required|in:Menunggu,Terkirim,Selesai',
        ]);
        //jika selesai-> arahkan ke edit
        if (strtolower($request->status_pengiriman) === 'selesai') {
            return redirect()->route('pengiriman.edit', $id);
        }

        $transaksi = TransaksiModel::findOrFail($id);
        $transaksi->update(['status_pengiriman' => $request->status_pengiriman]);

        return redirect()->route('pengiriman')->with('success', 'Status pengiriman diperbarui.');
    }
}
