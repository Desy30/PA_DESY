<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiSawitModel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalPemasukan = TransaksiModel::whereHas('kategori', function ($query) {
            $query->where('jenis_kategori', 'pemasukan');
        })->sum('total');

        // Total Pengeluaran
        $totalPengeluaran = TransaksiModel::whereHas('kategori', function ($query) {
            $query->where('jenis_kategori', 'pengeluaran');
        })->sum('total');

        // Total Ton dari relasi transaksiSawit
        $totalBeratPemasukan = TransaksiSawitModel::whereHas('transaksi.kategori', function ($query) {
            $query->where('jenis_kategori', 'pemasukan');
        })->sum('berat_bersih');

        // Total berat bersih pengeluaran
        $totalBeratPengeluaran = TransaksiSawitModel::whereHas('transaksi.kategori', function ($query) {
            $query->where('jenis_kategori', 'pengeluaran');
        })->sum('berat_bersih');

        // Selisih berat
        $selisihBeratTon = $totalBeratPemasukan - $totalBeratPengeluaran;

        // Pemasukan Bulanan
        if ($request->pemasukan === 'month') {
            $pemasukan = TransaksiModel::selectRaw('MONTH(tanggal) as bulan, SUM(total) as total')
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
        } else {
            $pemasukan = TransaksiModel::selectRaw('YEAR(tanggal) as tahun, SUM(total) as total')
                ->whereHas('kategori', function ($query) {
                    $query->where('jenis_kategori', 'pemasukan');
                })
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->tahun => $item->total];
                });
        }

        if ($request->pengeluaran === 'month') {
            $pengeluaran = TransaksiModel::selectRaw('MONTH(tanggal) as bulan, SUM(total) as total')
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
        } else {
            $pengeluaran = TransaksiModel::selectRaw('YEAR(tanggal) as tahun, SUM(total) as total')
                ->whereHas('kategori', function ($query) {
                    $query->where('jenis_kategori', 'pengeluaran');
                })
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->tahun => $item->total];
                });
        }


        if ($request->has('transaksi') && in_array($request->transaksi, ['pemasukan', 'pengeluaran'])) {
            $transaksiTerbaru = TransaksiModel::with('kategori')
                ->whereHas('kategori', function ($query) use ($request) {
                    $query->where('jenis_kategori', $request->transaksi);
                })
                ->latest()
                ->take(3)
                ->get();
        } else {
            $transaksiTerbaru = TransaksiModel::with('kategori')->latest()->take(3)->get();
        }

        return view('admin.dashboard.index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'selisihBeratTon',
            'pemasukan',
            'pengeluaran',
            'transaksiTerbaru'
        ));
    }
}
