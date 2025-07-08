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

        $kategori = $request->kategori;
        $files = collect(); // kumpulan dokumen

        // Ambil dari tabel transaksi
        if (!$kategori || $kategori === 'transaksi') {
            $transaksi = \App\Models\TransaksiModel::whereNotNull('bukti_transaksi')->get()->map(function ($item) {
                return (object)[
                    'kategori' => 'Transaksi',
                    'bukti_transaksi' => $item->bukti_transaksi,
                ];
            });
            $files = $files->merge($transaksi);
        }

        // Ambil dari tabel sawit
        if (!$kategori || $kategori === 'sawit') {
            $sawit = \App\Models\TransaksiSawitModel::whereNotNull('surat_pengantar', 'BON')->get()->map(function ($item) {
                return (object)[
                    'kategori' => 'Sawit',
                    'surat_pengantar' => $item->surat_pengantar,
                    'BON' => $item->BON,
                ];
            });
            $files = $files->merge($sawit);
        }

        return view('admin.dokumentasi.index', [
            'files' => $files,
            'kategori_terpilih' => $kategori,
        ]);
    }




}
