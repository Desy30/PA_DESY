<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiModel::with('kategori');

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        if ($request->filled('kategori_id')) {
            $query->where('id_kategori', $request->kategori_id);
        }

        if ($request->filled('jenis')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('jenis_kategori', $request->jenis);
            });
        }

        if ($request->filled('search')) {
            $query->where('bukti_transaksi', 'like', '%' . $request->search . '%');
        }

        $transaksis = $query->get();
        $kategoris = KategoriModel::all();

        return view('admin.laporan.index', compact('transaksis', 'kategoris'));
    }
    public function exportPdf(Request $request)
{
    // sama seperti fungsi index(), tapi hasilnya dilempar ke view untuk pdf
    $query = TransaksiModel::with('kategori');

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
    }

    if ($request->filled('kategori_id')) {
        $query->where('id_kategori', $request->kategori_id);
    }

    if ($request->filled('jenis')) {
        $query->whereHas('kategori', function ($q) use ($request) {
            $q->where('jenis_kategori', $request->jenis);
        });
    }

    if ($request->filled('search')) {
        $query->where('bukti_transaksi', 'like', '%' . $request->search . '%');
    }

    $transaksis = $query->get();

    $pdf = PDF::loadView('admin.laporan.pdf', compact('transaksis'));
    return $pdf->stream('laporan-keuangan.pdf');

}



}
