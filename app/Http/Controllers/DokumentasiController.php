<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use App\Models\TransaksiSawitModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class DokumentasiController extends Controller
{

    public function index(Request $request)
    {
        $transaksi = TransaksiModel::with(['kategori', 'transaksiSawit'])->orderBy('tanggal', 'desc')->get();

        $dokumentasi = [];

        foreach ($transaksi as $item) {
            $kategori = strtolower($item->kategori->tipe_form ?? '');

            $row = [
                'kategori' => $item->kategori->nama_kategori ?? '-',
                'total' => $item->total ?? '-',
                'tanggal' => $item->tanggal ?? '-',
                'bon' => null,
                'bukti_transaksi' => null,
                'surat_pengantar' => null,
            ];

            // bon berdasarkan kategori
            if ($kategori === 'penjualan_sawit') {
                $row['bon'] = $item->transaksiSawit?->bon;

                $row['surat_pengantar'] = $item->transaksiSawit?->surat_pengantar;
            }

            $row['bukti_transaksi'] = $item->bukti_transaksi;

            $dokumentasi[] = $row;
        }


        return view('admin.dokumentasi.index', compact('dokumentasi'));
    }
}
