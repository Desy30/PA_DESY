<?php

namespace App\Http\Controllers;

use App\Models\PetaniModel;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiGajiModel;
use App\Models\TransaksiSawitModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\TransaksiKendaraanOperasionalModel;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = TransaksiModel::with('kategori')
            ->whereHas('kategori', function ($query) {
                $query->where('jenis_kategori', 'pengeluaran');
            })
            ->get();

        return view('admin.pengeluaran.index', compact('pengeluarans'));
    }

    public function create()
    {
        $petanis = PetaniModel::all();
        $karyawans = KaryawanModel::all();
        $kategoris = KategoriModel::where('jenis_kategori', 'pengeluaran')->get();
        return view('admin.pengeluaran.create', compact('kategoris', 'petanis', 'karyawans'));
    }
    public function store(Request $request)
    {
        $sumberPengeluaran = $request->input('sumber_pengeluaran');

        // Misal value = "pembelian_sawit.3" → ['pembelian_sawit', '3']
        $sumberArr = explode('.', $sumberPengeluaran);

        $tipePengeluaran = $sumberArr[0];
        $id_kategori = $sumberArr[1] ?? null;

        $request->merge(['id_kategori' => $id_kategori]);

        switch ($tipePengeluaran) {
            case 'pembelian_sawit':
                return $this->storePembelianSawit($request);
            case 'kendaraan_operasional':
                return $this->storeKendaraanOperasional($request);
            case 'pengeluaran_gaji':
                return $this->storeGaji($request);
            default:
                return $this->storeDefault($request);
        }
    }
    private function storePembelianSawit($request)
    {
        try {
            $request->validate([
                'id_petani' => 'required',
                'tanggal_sawit' => 'required',
                'total_sawit' => 'required',
                'metode_pembayaran' => 'required',
                'bukti_transaksi_sawit' => 'required',
                'bruto' => 'required',
                'potongan' => 'required',
                'berat_bersih' => 'required',
                'harga' => 'required',
                'netto' => 'required',
            ], [
                'id_petani.required' => 'Petani harus diisi.',
                'tanggal_sawit.required' => 'Tanggal harus diisi.',
                'total_sawit.required' => 'Total harus diisi.',
                'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_sawit.required' => 'Bukti transaksi harus diisi.',
                'bruto.required' => 'Bruto harus diisi.',
                'potongan.required' => 'Potongan harus diisi.',
                'berat_bersih.required' => 'Berat bersih harus diisi.',
                'harga.required' => 'Harga harus diisi.',
                'netto.required' => 'Netto harus diisi.',
            ]);

            //transaksi
            $transaksi = TransaksiModel::create([
                'id_petani' => $request->id_petani,
                'tanggal' => $request->tanggal_sawit,
                'total' => $request->total_sawit,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_transaksi' => $request->bukti_transaksi_sawit,
                'id_kategori' => $request->id_kategori

            ]);
            $bukti_transaksi_sawit = $request->file('namaFileSawit');

            $fileSawit = $request->file('bukti_transaksi_sawit');
            $namaFileSawit = 'bukti_sawit_' . time() . '.' . $fileSawit->getClientOriginalExtension();
            Storage::putFileAs('public/bukti_sawit', $fileSawit, $namaFileSawit);

            //TransaksiSawit
            TransaksiSawitModel::create([
                'bruto' => $request->bruto,
                'potongan' => $request->potongan,
                'berat_bersih' => $request->berat_bersih,
                'harga' => $request->harga,
                'netto' => $request->netto,
                'id_transaksi' => $transaksi->id
            ]);

            return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }
    private function storeKendaraanOperasional($request)
    {
        try {
            $request->validate([
                'tanggal_kendaraan' => 'required',
                'total_kendaraan' => 'required',
                'metode_pembayaran' => 'required',
                'bukti_transaksi_kendaraan' => 'required',
                'keterangan_kendaraan' => 'required',
                'jenis_kendaraan' => 'required',
                'jenis_pengeluaran' => 'required',
            ], [
                'tanggal_kendaraan.required' => 'Tanggal harus diisi.',
                'total_kendaraan.required' => 'Total harus diisi.',
                'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_kendaraan.required' => 'Bukti transaksi harus diisi.',
                'keterangan_kendaraan.required' => 'Keterangan harus diisi.',
                'jenis_kendaraan.required' => 'Jenis kendaraan harus diisi.',
                'jenis_pengeluaran.required' => 'Jenis pengeluaran harus diisi.',
            ]);
            //transaksi
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_kendaraan,
                'total' => $request->total_kendaraan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_transaksi' => $request->bukti_transaksi_kendaraan,
                'keterangan' => $request->keterangan_kendaraan,
                $request->id_kategori
            ]);
            $bukti_transaksi_kendaraan = $request->file('bukti_transaksi_kendaraan');

            $namaFileBuktiKendaraan = 'bukti_transaksi_kendaraan-' . time() . '.' . $bukti_transaksi_kendaraan->getClientOriginalExtension();

            if ($transaksi) {
                storage::putFile('bukti_transaksi', $bukti_transaksi_kendaraan, $namaFileBuktiKendaraan);
            }
            //TransaksiKendaraan
            TransaksiKendaraanOperasionalModel::create([
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'id_transaksi' => $transaksi->id
            ]);

            return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }
    private function storeGaji($request)
    {
        try {
            $request->validate([
                'tanggal_gaji' => 'required',
                'metode_pembayaran' => 'required',
                'bukti_transaksi_gaji' => 'required',
                'id_karyawan' => 'required',
                'total_gaji' => 'required',
                'periode' => 'required',
                'tunjangan' => 'required',
                'potongan' => 'required',
            ], [
                'tanggal_gaji.required' => 'Tanggal harus diisi.',
                'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_gaji.required' => 'Bukti transaksi harus diisi.',
                'id_karyawan.required' => 'Karyawan harus diisi.',
                'total_gaji.required' => 'Total gaji harus diisi.',
                'periode.required' => 'Periode harus diisi.',
                'tunjangan.required' => 'Tunjangan harus diisi.',
                'potongan.required' => 'Potongan harus diisi.',
            ]);
            //transaksi
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_gaji,
                'total' => $request->total_gaji,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_transaksi' => $request->bukti_transaksi_gaji,
                $request->id_kategori,

            ]);

            $bukti = $request->file('bukti_transaksi_gaji');
            $namaFile = 'bukti-gaji-' . time() . '.' . $bukti->getClientOriginalExtension();
            Storage::putFileAs('bukti_transaksi', $bukti, $namaFile);

            //TransaksiGaji
            TransaksiGajiModel::create([
                'id_karyawan' => $request->id_karyawan,
                'periode' => $request->periode,
                'tunjangan' => $request->tunjangan,
                'potongan' => $request->potongan,
                'id_transaksi' => $transaksi->id
            ]);

            return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }
    private function storeDefault($request)
    {
        try {
            request()->validate([
                'tanggal_default' => 'required',
                'total_default' => 'required',
                'metode_pembayaran' => 'required',
                'bukti_transaksi_default' => 'required',
                'keterangan_default' => 'required',

            ], [
                'tanggal_default.required' => 'Tanggal harus diisi.',
                'total_default.required' => 'Total harus diisi.',
                'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_default.required' => 'Bukti transaksi harus diisi.',
                'keterangan_default.required' => 'Keterangan harus diisi.',

            ]);
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_default,
                'total' => $request->total_default,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_transaksi' => $request->bukti_transaksi_default,
                'keterangan' => $request->keterangan_default,
                $request->id_kategori

            ]);
            return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }
    public function edit($id)
    {
        return view('admin.pengeluaran.edit');
    }

    public function detail($id)
    {
        return view('admin.pengeluaran.detail');
    }
}
