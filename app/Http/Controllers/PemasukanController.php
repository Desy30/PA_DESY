<?php

namespace App\Http\Controllers;

use App\Models\PksModel;
use App\Models\BarangModel;
use App\Models\PetaniModel;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiPupukModel;
use App\Models\TransaksiSawitModel;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use App\Models\TransaksiTimbanganModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukans = TransaksiModel::with('kategori')
            ->whereHas('kategori', function ($query) {
                $query->where('jenis_kategori', 'pemasukan');
            })
            ->get();
        return view('admin.pemasukan.index', compact('pemasukans'));
    }

    public function create()
    {
        $pks = PksModel::all();
        $petanis = PetaniModel::all();
        $barangs = BarangModel::all();
        $kategoris = KategoriModel::where('jenis_kategori', 'pemasukan')->get();
        return view('admin.pemasukan.create', compact('petanis', 'kategoris', 'pks', 'barangs'));
    }

    public function store(Request $request)
    {
        $sumberPemasukkanArray = explode('.', $request->input('sumber_pemasukan'));
        $request->merge(['id_kategori' => $sumberPemasukkanArray[1]]);

        switch ($sumberPemasukkanArray[0]) {
            case 'penjualan_sawit':
                return $this->storePemasukanSawit($request);
            case 'penjualan_pupuk':
                return $this->storePemasukanPupuk($request);
            case 'sewa_timbangan':
                return $this->storeSewaTimbangan($request);
            default:
                return $this->storeDefault($request);
        }
    }

    private function storePemasukanSawit($request)
    {
        $request->validate([
            'tanggal_sawit' => 'required',
            'berat_bersih' => 'required',
            'id_pks' => 'required',
            'sumber_pemasukan' => 'required',
            'surat_pengantar' => 'required|file',
            'metode_pembayaran' => 'required',
        ]);

        $file = $request->file('surat_pengantar');
        $filename = 'surat-pengantar-' . time() . '.' . $file->getClientOriginalExtension();

        $transaksi = TransaksiModel::create([
            'tanggal' => $request->tanggal_sawit,
            'id_pks' => $request->id_pks,
            'sumber_pemasukan' => $request->sumber_pemasukan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total' => 0,
            'id_kategori' => $request->id_kategori,
            'status_pengiriman' => 'dikirim'
        ]);

        TransaksiSawitModel::create([
            'berat_bersih' => $request->berat_bersih,
            'surat_pengantar' => $filename,
            'status_pengiriman' => $request->status_pengiriman,
            'id_transaksi' => $transaksi->id
        ]);

        Storage::disk('public')->putFileAs('surat-pengantar', $file, $filename);

        return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
    }

    private function storePemasukanPupuk($request)
    {
        $request->validate([
            'tanggal_pupuk' => 'required',
            'id_petani' => 'required',
            'id_barang' => 'required',
            'jumlah_pupuk' => 'required',
            'harga_perunit' => 'required',
            'total_pupuk' => 'required',
            'metode_pembayaran' => 'required',
            'bukti_transaksi_pupuk' => 'required|file',
        ]);

        $file = $request->file('bukti_transaksi_pupuk');
        $filename = 'bukti_transaksi_pupuk-' . time() . '.' . $file->getClientOriginalExtension();

        $transaksi = TransaksiModel::create([
            'tanggal' => $request->tanggal_pupuk,
            'id_petani' => $request->id_petani,
            'id_barang' => $request->id_barang,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total' => $request->total_pupuk,
            'bukti_transaksi' => $filename,
            'status' => 'proses',
            'id_kategori' => $request->id_kategori
        ]);

        TransaksiPupukModel::create([
            'jumlah_pupuk' => $request->jumlah_pupuk,
            'harga_perunit' => $request->harga_perunit,
            'id_transaksi' => $transaksi->id
        ]);

        Storage::disk('public')->putFileAs('bukti_transaksi_pupuk', $file, $filename);

        return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
    }

    private function storeSewaTimbangan($request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_timbangan' => 'required',
            'total_timbangan' => 'required',
            'metode_pembayaran' => 'required',
            'bukti_transaksi_timbangan' => 'required|file',
        ]);

        $file = $request->file('bukti_transaksi_timbangan');
        $filename = 'bukti_transaksi_timbangan-' . time() . '.' . $file->getClientOriginalExtension();

        $transaksi = TransaksiModel::create([
            'tanggal' => $request->tanggal_timbangan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total' => $request->total_timbangan,
            'bukti_transaksi' => $filename,
            'id_kategori' => $request->id_kategori
        ]);

        TransaksiTimbanganModel::create([
            'id_transaksi' => $transaksi->id,
            'nama' => $request->nama
        ]);

        Storage::disk('public')->putFileAs('bukti_transaksi_timbangan', $file, $filename);

        return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
    }

    private function storeDefault($request)
    {
        $request->validate([
            'tanggal_default' => 'required',
            'keterangan' => 'required',
            'bukti_transaksi_default' => 'required|file',
            'total_default' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        $file = $request->file('bukti_transaksi_default');
        $filename = 'bukti_transaksi_default-' . time() . '.' . $file->getClientOriginalExtension();

        $transaksi = TransaksiModel::create([
            'tanggal' => $request->tanggal_default,
            'keterangan' => $request->keterangan,
            'bukti_transaksi' => $filename,
            'total' => $request->total_default,
            'metode_pembayaran' => $request->metode_pembayaran,
            'id_kategori' => $request->id_kategori
        ]);

        Storage::disk('public')->putFileAs('bukti_transaksi_default', $file, $filename);

        return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
    }

    public function show($id)
    {
        $pemasukan = TransaksiModel::with('kategori')->findOrFail($id);
        return view('admin.pemasukan.show', compact('pemasukan'));
    }
}
