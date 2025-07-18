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
    public function exportPdf(Request $r)
    {
        $q = TransaksiModel::with('kategori')
            ->when(
                $r->filled('tanggal_awal') && $r->filled('tanggal_akhir'),
                fn($q) => $q->whereBetween('tanggal', [$r->tanggal_awal, $r->tanggal_akhir])
            )
            ->when(
                $r->filled('jenis'),
                fn($q) => $q->whereHas('kategori', fn($q) => $q->where('jenis_kategori', $r->jenis))
            )
            ->when(
                $r->filled('kategori_id'),
                fn($q) => $q->where('id_kategori', $r->kategori_id)
            )
            ->get();

        return Pdf::loadView('admin.laporan.pdf', [
            'transaksis'    => $q,
            'tanggal_awal'  => $r->tanggal_awal,
            'tanggal_akhir' => $r->tanggal_akhir,
            'jenis'         => $r->jenis,
            'kategori_id'   => $r->kategori_id,
        ])->stream('laporan-keuangan.pdf');
    }
}
