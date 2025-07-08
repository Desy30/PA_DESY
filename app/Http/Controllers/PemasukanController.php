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
use Illuminate\Validation\Validator;
use App\Models\TransaksiTimbanganModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PemasukanController extends Controller
{
    public function index()
    {
        // Ambil data pemasukan dengan relasi kategori yang jenis_kategorinya adalah 'pemasukan'
        $pemasukans = TransaksiModel::with('kategori')->get();
        // Kirim data pemasukans ke view
        return view('admin.pemasukan.index', compact('pemasukans'));
    }


    public function create()
    {
        $pks = PksModel::all();
        $petanis = PetaniModel::all(); // ambil semua data petani
        $barangs = BarangModel::all();
        $kategoris = KategoriModel::where('jenis_kategori', 'pemasukan')->get();
        return view('admin.pemasukan.create', compact('petanis', 'kategoris', 'pks', 'barangs'));
    }
    public function store(Request $request)
    {
        $sumberPemasukkan = $request->input('sumber_pemasukan');

        $sumberPemasukkanArray = explode('.', $sumberPemasukkan);

        $sumberPemasukkan = $sumberPemasukkanArray[0];
        $id_kategori = $sumberPemasukkanArray[1];

        $request->merge([
            'id_kategori' => $id_kategori
        ]);

        switch ($sumberPemasukkan) {
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
        try {
            $request->validate([
                'tanggal_sawit' => 'required',
                'berat_bersih' => 'required',
                'id_pks' => 'required',
                'sumber_pemasukan' => 'required',
                'surat_pengantar' => 'required',
                'metode_pembayaran' => 'required',
            ], [
                'tanggal_sawit.required' => 'Tanggal harus diisi.',
                'berat_bersih.required' => 'Berat bersih harus diisi.',
                'id_pks.required' => 'ID PKS harus diisi.',
                'sumber_pemasukan.required' => 'Sumber pemasukan harus diisi.',
                'surat_pengantar.required' => 'Surat pengantar harus diisi.',
                'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
            ]);

            // Transaksi
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_sawit,
                'id_pks' => $request->id_pks,
                'sumber_pemasukan' => $request->sumber_pemasukan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total' => 0,
                'id_kategori' => $request->id_kategori,
                'status_pengiriman' => 'dikirim'
            ]);

            $suratPengantar = $request->file('surat_pengantar');

            $namaFileSuratPengantar = 'surat-pengantar-' . time() . '.' . $suratPengantar->getClientOriginalExtension();
            // Sawit show
            $transaksiSawit = TransaksiSawitModel::create([
                'berat_bersih' => $request->berat_bersih,
                'surat_pengantar' => $namaFileSuratPengantar,
                'status_pengiriman' => $request->status_pengiriman,
                'id_transaksi' => $transaksi->id
            ]);

            if ($transaksiSawit) {
                Storage::putFileAs('surat-pengantar', $suratPengantar, $namaFileSuratPengantar);
            }


            return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }

    private function storePemasukanPupuk($request)
    {
        try {
            request()->validate([
                'tanggal_pupuk' => 'required',
                'id_petani' => 'required',
                'id_barang' => 'required',
                'jumlah_pupuk' => 'required',
                'harga_perunit' => 'required',
                'total_pupuk' => 'required',
                'metode_pembayaran' => 'required',
                'bukti_transaksi_pupuk' => 'required',
            ], [
                'tanggal_pupuk.required' => 'Tanggal harus diisi.',
                'id_petani.required' => 'ID Petani harus diisi.',
                'id_barang.required' => 'ID Barang harus diisi.',
                'jumlah_pupuk.required' => 'Jumlah pupuk harus diisi.',
                'harga_perunit.required' => 'Harga per unit harus diisi.',
                'total_pupuk.required' => 'Total harus diisi.',
                'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_pupuk.required' => 'Bukti transaksi harus diisi.',
                'status.required' => 'Status harus diisi.',

            ]);

            //transaksi
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_pupuk,
                'id_petani' => $request->id_petani,
                'id_barang' => $request->id_barang,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total' => $request->total_pupuk,
                'bukti_transaksi' => $request->bukti_transaksi_pupuk,
                'status' => 'proses',
                'id_kategori' => $request->id_kategori
            ]);
            $bukti_transaksi_pupuk = $request->file('bukti_transaksi_pupuk');

            $namaFileBuktiTransaksiPupuk = 'bukti_transaksi_pupuk-' . time() . '.' . $bukti_transaksi_pupuk->getClientOriginalExtension();

            //TransaksiPupuk
            TransaksiPupukModel::create([
                'jumlah_pupuk' => $request->jumlah_pupuk,
                'harga_perunit' => $request->harga_perunit,
                'id_transaksi' => $transaksi->id
            ]);
            if ($transaksi) {
                Storage::putFileAs('bukti_transaksi_pupuk', $bukti_transaksi_pupuk, $namaFileBuktiTransaksiPupuk);
            }

            return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }
    private function storeSewaTimbangan($request)
    {
        try {
            request()->validate([
                'nama' => 'required',
                'tanggal_timbangan' => 'required',
                'total_timbangan' => 'required',
                'metode_pembayaran' => 'required',
                'bukti_transaksi_timbangan' => 'required',
            ], [
                'nama.required' => 'Nama harus diisi.',
                'tanggal_timbangan.required' => 'Tanggal harus diisi.',
                'total_timbangan.required' => 'Total harus diisi.',
                'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_timbangan.required' => 'Bukti transaksi harus diisi.',
            ]);
            // transaksi
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_timbangan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total' => $request->total_timbangan,
                'bukti_transaksi' => $request->bukti_transaksi_timbangan,
                'id_kategori' => $request->id_kategori
            ]);
            $bukti_transaksi_timbangan = $request->file('bukti_transaksi_timbangan');

            $namaFileBuktiTransaksiTimbangan = 'bukti_transaksi_timbangan-' . time() . '.' . $bukti_transaksi_timbangan->getClientOriginalExtension();
            if ($transaksi) {
                Storage::putFileAs('bukti_transaksi_timbangan', $bukti_transaksi_timbangan, $namaFileBuktiTransaksiTimbangan);
            }
            // transaksi timbangan
            TransaksiTimbanganModel::create([
                'id_transaksi' => $transaksi->id,
                'nama' => $request->nama
            ]);
            if ($transaksi) {
                Storage::putFileAs('bukti_transaksi_timbangan', $bukti_transaksi_timbangan, $namaFileBuktiTransaksiTimbangan);
            }

            return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }
    private function storeDefault($request)
    {
        try {
            request()->validate([
                'tanggal_default' => 'required',
                'keterangan' => 'required',
                'bukti_transaksi_default' => 'required',
                'total_default' => 'required',
                'metode_pembayaran' => 'required',
            ], [
                'tanggal_default.required' => 'tanggal harus diisi',
                'keterangan.required' => 'keterangan harus diisi',
                'bukti_transaksi_default.required' => 'bukti transaksi harus diisi',
                'total_default.required' => 'total harus diisi',
                'metode_pembayaran.required' => 'metode pembayaran harus diisi',
            ]);

            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_default,
                'keterangan' => $request->keterangan,
                'bukti_transaksi' => $request->bukti_transaksi_default,
                'total' => $request->total_default,
                'metode_pembayaran' => $request->metode_pembayaran,
                'id_kategori' => $request->id_kategori
            ]);
            $bukti_transaksi_default = $request->file('bukti_transaksi_default');
            $namaFileBuktiTransaksiDefault = 'bukti_transaksi_default-' . time() . '.' . $bukti_transaksi_default->getClientOriginalExtension();
            if ($transaksi) {
                Storage::putFileAs('bukti_transaksi_default', $bukti_transaksi_default, $namaFileBuktiTransaksiDefault);
            }

            return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan!');
        } catch (ValidationException $th) {
            return redirect()->back()->withErrors($th->validator)->withInput();
        }
    }
    public function edit($id)
    {
        return view('admin.pemasukan.edit');
    }

    public function show($id)
    {
        return view('admin.pemasukan.show');
    }
}
