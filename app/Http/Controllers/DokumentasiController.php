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
        $transaksi = TransaksiModel::with('kategori', 'transaksiSawit')->get();

        $dokumentasi = [];

        foreach ($transaksi as $item) {
            $kategori = strtolower($item->kategori->nama_kategori ?? '');

            $row = [
                'kategori' => $item->kategori->nama_kategori ?? '-',
                'total' => $item->total ?? '-',
                'tanggal' => $item->tanggal ?? '-',
                'BON' => null,
                'bukti_transaksi' => null,
                'surat_pengantar' => null,
            ];

            // BON berdasarkan kategori
            if ($kategori === 'pupuk') {
                $row['BON'] = $item->BON ? 'storage/BON/' . $item->BON : null;
            } elseif ($kategori === 'penjualan sawit') {
                $row['BON'] = $item->transaksiSawit->BON ?? null
                    ? 'storage/BON/' . $item->transaksiSawit->BON
                    : null;
            }

            // Selalu panggil bukti_transaksi jika ada
            $row['bukti_transaksi'] = $item->bukti_transaksi ? 'storage/bukti_transaksi/' . $item->bukti_transaksi : null;

            // Tambahkan surat pengantar
            $row['surat_pengantar'] = $item->surat_pengantar ? 'storage/surat_pengantar/' . $item->surat_pengantar : null;

            $dokumentasi[] = $row;
        }

        return view('admin.dokumentasi.index', compact('dokumentasi'));
    }


}
