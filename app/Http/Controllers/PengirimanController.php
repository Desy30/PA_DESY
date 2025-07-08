<?php

namespace App\Http\Controllers;

use App\Models\PksModel;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use App\Models\TransaksiSawitModel;
use Illuminate\Support\Facades\Storage;

class PengirimanController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiModel::with('kategori')
            ->whereHas('kategori', function ($q) {
                $q->where('jenis_kategori', 'pemasukan');
            });

        if ($request->filled('status_pengiriman') && $request->status_pengiriman !== 'Semua') {
            $query->where('status_pengiriman', $request->status_pengiriman);
        }

        $transaksis = $query->latest()->get();

        return view('admin.pengiriman.index', compact('transaksis'));
    }
    public function edit($id)
    {
        $pengiriman = TransaksiModel::findOrFail($id);
        return view('admin.pengiriman.edit', compact('pengiriman'));
    }

    public function updateDetail(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'bon' => 'required|file',
            'total' => 'required'
        ]);

        $file = $request->file('bon');
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/BON', $file, $fileName);

        $transaksi = TransaksiModel::findOrFail($id);
        $transaksi->update([
            'total' => $request->total,
            'BON' => $fileName,
            'status_pengiriman' => 'Selesai'
        ]);

        return redirect()->route('pengiriman')->with('success', 'Status pengiriman diperbarui.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pengiriman' => 'required|in:Menunggu,Terkirim,Selesai',
        ]);

        if (strtolower($request->status_pengiriman) === 'selesai') {
            return redirect()->route('pengiriman.edit', $id);
        }

        $transaksi = TransaksiModel::findOrFail($id);
        $transaksi->update(['status_pengiriman' => $request->status_pengiriman]);

        return redirect()->route('pengiriman')->with('success', 'Status pengiriman diperbarui.');
    }
}
