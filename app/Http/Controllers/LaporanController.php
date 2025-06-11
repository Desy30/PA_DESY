<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Data Dummy
        $laporan = [
            (object)[
                'tanggal' => '2024-12-12',
                'sumber' => 'Penjualan Sawit',
                'jumlah' => 100,
                'kategori' => 'Masuk'
            ],
            (object)[
                'tanggal' => '2024-12-13',
                'sumber' => 'Pembelian Pupuk',
                'jumlah' => 200,
                'kategori' => 'Keluar'
            ],
            (object)[
                'tanggal' => '2024-12-14',
                'sumber' => 'Gaji',
                'jumlah' => 5000000,
                'kategori' => 'Keluar'
            ],
            (object)[
                'tanggal' => '2024-12-15',
                'sumber' => 'Penjualan Sawit',
                'jumlah' => 150,
                'kategori' => 'Masuk'
            ]
        ];

        return view('admin.laporan.index', compact('laporan'));
    }

}
