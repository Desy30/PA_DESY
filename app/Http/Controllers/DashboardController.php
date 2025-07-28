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
        // Total Pemasukan dari tabel Transaksi
        //whereHas digunakan untuk memfilter data berdasarkan relasi kategori yang bertipe pemasukan
        //join ke tabel kategori berdasarkan relasi di TransaksiModel
        $totalPemasukan = TransaksiModel::whereHas('kategori', function ($query) {
            $query->where('jenis_kategori', 'pemasukan'); //ambil hanya transaksi yang kategori pemasukan
        })->sum('total'); // Total Pemasukan dari relasi transaksiSawit

        // Total Pengeluaran
        $totalPengeluaran = TransaksiModel::whereHas('kategori', function ($query) {
            $query->where('jenis_kategori', 'pengeluaran'); //ambil hanya transaksi yang kategori pengeluaran
        })->sum('total'); // Total Pemasukan dari relasi transaksiSawit

        // Total Ton dari relasi transaksiSawit

        $totalBeratPemasukan = TransaksiSawitModel::whereHas('transaksi.kategori', function ($query) {
            $query->where('jenis_kategori', 'pemasukan');
        })->sum('berat_bersih');

        // Total berat bersih pengeluaran
        $totalBeratPengeluaran = TransaksiSawitModel::whereHas('transaksi.kategori', function ($query) {
            $query->where('jenis_kategori', 'pengeluaran');
        })->sum('berat_bersih');

        // Selisih berat ->untuk menentukan nilai pada card total ton di dashboard
        $selisihBeratTon = $totalBeratPemasukan - $totalBeratPengeluaran;

        // Pemasukan Bulanan
        //filter untuk menampilkan data pemasukan di garfik berdasarkan bulan
        //mengambil data dari tebel transaksi, dan memilih kategori pemasukan lalu menghitung totalnya
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
            //ini untuktahun
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
        //sama dengan pemasukkan
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

        //ini menampilkan riwayat transaksi baru diinput
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
        // Mengirimkan data ke view
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
