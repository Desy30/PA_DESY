<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Pemasukan
        $totalPemasukan = TransaksiModel::whereHas('kategori', function ($query) {
            $query->where('jenis_kategori', 'pemasukan');
        })->sum('total');

        // Total Pengeluaran
        $totalPengeluaran = TransaksiModel::whereHas('kategori', function ($query) {
            $query->where('jenis_kategori', 'pengeluaran');
        })->sum('total');

        // Total Ton dari relasi transaksiSawit
        $totalTon = TransaksiModel::with('transaksiSawit')
            ->get()
            ->sum(function ($trx) {
                return $trx->transaksiSawit->total_berat ?? 0;
            });

        // Pemasukan Bulanan
        $pemasukanBulanan = TransaksiModel::selectRaw('MONTH(tanggal) as bulan, SUM(total) as total')
            ->whereHas('kategori', function ($query) {
                $query->where('jenis_kategori', 'pemasukan');
            })
            ->whereYear('tanggal', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->mapWithKeys(function ($item) {
                $namaBulan = Carbon::create()->month($item->bulan)->translatedFormat('F');
                return [$namaBulan => $item->total];
            });

        // Pengeluaran Bulanan
        $pengeluaranBulanan = TransaksiModel::selectRaw('MONTH(tanggal) as bulan, SUM(total) as total')
            ->whereHas('kategori', function ($query) {
                $query->where('jenis_kategori', 'pengeluaran');
            })
            ->whereYear('tanggal', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->mapWithKeys(function ($item) {
                $namaBulan = Carbon::create()->month($item->bulan)->translatedFormat('F');
                return [$namaBulan => $item->total];
            });

        // Transaksi Terbaru
        $transaksiTerbaru = TransaksiModel::with('kategori')->latest()->take(3)->get();

        return view('admin.dashboard.index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'totalTon',
            'pemasukanBulanan',
            'pengeluaranBulanan',
            'transaksiTerbaru'
        ));
}
}
