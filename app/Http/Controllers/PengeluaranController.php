<?php

namespace App\Http\Controllers;

use App\Models\PetaniModel;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiGajiModel;
use App\Models\TransaksiSawitModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\TransaksiKendaraanOperasionalModel;
use Barryvdh\DomPDF\Facade\Pdf;

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
                'bruto' => 'required',
                'tara' => 'required',
                'jenis_potongan' => 'required',
                'harga_per_kg' => 'required',
                'metode_pembayaran_sawit' => 'required',
                'bukti_transaksi_sawit' => 'required',

            ], [
                'id_petani.required' => 'Petani harus diisi.',
                'tanggal_sawit.required' => 'Tanggal harus diisi.',
                'bruto.required' => 'Bruto harus diisi.',
                'tara.required' => 'Tara harus diisi.',
                'jenis_potongan.required' => 'Jenis potongan harus diisi.',
                'harga_per_kg.required' => 'Harga per kg harus diisi.',
                'metode_pembayaran_sawit.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_sawit.required' => 'Bukti transaksi harus diisi.',
            ]);

            // Ambil nilai dari request
            $bruto = (int) $request->input('bruto');
            $tara = (int) $request->input('tara');
            $jenisPotongan = $request->input('jenis_potongan');
            $potongan = (int) $request->input('potongan_sawit');
            $hargaPerKg = (int) $request->input('harga_per_kg');

            // 1. Hitung Netto
            $netto = $bruto - $tara;

            // 2. Hitung Jumlah Potongan
            if ($jenisPotongan === 'persentase') {
                $jumlahAkhirPotongan = $netto - ($netto * $potongan / 100);
            } else {
                $jumlahAkhirPotongan = $netto - $potongan;
            }

            // 3. Bulatkan nilai potongan
            $jumlahPotongan = round($netto - $jumlahAkhirPotongan);

            // 4. Hitung Berat Bersih
            $beratBersih = round($netto - $jumlahPotongan);

            // 5. Hitung Harga Total
            $hargaTotal = $beratBersih * $hargaPerKg;


            $bukti_transaksi_sawit = $request->file('namaFileSawit');

            $fileSawit = $request->file('bukti_transaksi_sawit');
            $namaFileSawit = 'bukti_sawit_' . time() . '.' . $fileSawit->getClientOriginalExtension();
            Storage::putFileAs('bukti-transaksi', $fileSawit, $namaFileSawit);
            //transaksi
            $transaksi = TransaksiModel::create([
                'id_petani' => $request->id_petani,
                'tanggal' => $request->tanggal_sawit,
                'total' => $hargaTotal,
                'metode_pembayaran' => $request->metode_pembayaran_sawit,
                'bukti_transaksi' => $namaFileSawit,
                'id_kategori' => $request->id_kategori

            ]);

            //TransaksiSawit
            TransaksiSawitModel::create([
                'bruto' => $request->bruto,
                'tara' => $request->tara,
                'netto' => $netto,
                'potongan' => $potongan,
                'jumlah_potongan' => $jumlahPotongan,
                'berat_bersih' => $beratBersih,
                'harga' => $request->harga_per_kg,
                'id_transaksi' => $transaksi->id
            ]);

            return redirect()->route('pengeluaran.invoice', $transaksi->id)->with('success', 'Data pengeluaran berhasil disimpan!');
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
                'metode_pembayaran_kendaraan' => 'required',
                'bukti_transaksi_kendaraan' => 'required',
                'keterangan_kendaraan' => 'required',
                'jenis_kendaraan' => 'required',
                'jenis_pengeluaran' => 'required',
            ], [
                'tanggal_kendaraan.required' => 'Tanggal harus diisi.',
                'total_kendaraan.required' => 'Total harus diisi.',
                'metode_pembayaran_kendaraan.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_kendaraan.required' => 'Bukti transaksi harus diisi.',
                'keterangan_kendaraan.required' => 'Keterangan harus diisi.',
                'jenis_kendaraan.required' => 'Jenis kendaraan harus diisi.',
                'jenis_pengeluaran.required' => 'Jenis pengeluaran harus diisi.',
            ]);
            // Validasi file bukti transaksi

            $bukti_transaksi_kendaraan = $request->file('bukti_transaksi_kendaraan');
            $namaFileBuktiTransaksiKendaraan = 'bukti-transaksi_kendaraan-' . time() . '.' . $bukti_transaksi_kendaraan->getClientOriginalExtension();

            // Simpan ke folder storage/app/public/bukti_transaksi_kendaraan/
            Storage::putFileAs('bukti-transaksi', $bukti_transaksi_kendaraan, $namaFileBuktiTransaksiKendaraan);

            //transaksi
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_kendaraan,
                'total' => $request->total_kendaraan,
                'metode_pembayaran' => $request->metode_pembayaran_kendaraan,
                'bukti_transaksi' => $namaFileBuktiTransaksiKendaraan,
                'keterangan' => $request->keterangan_kendaraan,
                'id_kategori' => $request->id_kategori
            ]);


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
                'metode_pembayaran_gaji' => 'required',
                'bukti_transaksi_gaji' => 'required',
                'id_karyawan' => 'required',
                'total_gaji' => 'required',
                'periode' => 'required',
                'tunjangan' => 'required',
                'potongan_gaji' => 'required',
            ], [
                'tanggal_gaji.required' => 'Tanggal harus diisi.',
                'metode_pembayaran_gaji.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_gaji.required' => 'Bukti transaksi harus diisi.',
                'id_karyawan.required' => 'Karyawan harus diisi.',
                'total_gaji.required' => 'Total gaji harus diisi.',
                'periode.required' => 'Periode harus diisi.',
                'tunjangan.required' => 'Tunjangan harus diisi.',
                'potongan_gaji.required' => 'Potongan harus diisi.',
            ]);

            $bukti_transaksi_gaji = $request->file('bukti_transaksi_gaji');
            $namaFileBuktiTransaksiGaji = 'bukti-gaji-' . time() . '.' . $bukti_transaksi_gaji->getClientOriginalExtension();
            Storage::putFileAs('bukti-transaksi', $bukti_transaksi_gaji, $namaFileBuktiTransaksiGaji);
            //transaksi
            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_gaji,
                'total' => $request->total_gaji,
                'metode_pembayaran' => $request->metode_pembayaran_gaji,
                'bukti_transaksi' => $namaFileBuktiTransaksiGaji,
                'id_kategori' => $request->id_kategori

            ]);

            //TransaksiGaji
            TransaksiGajiModel::create([
                'id_karyawan' => $request->id_karyawan,
                'periode' => $request->periode,
                'tunjangan' => $request->tunjangan,
                'potongan_gaji' => $request->potongan_gaji,
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
                'metode_pembayaran_default' => 'required',
                'bukti_transaksi_default' => 'required',
                'keterangan_default' => 'required',

            ], [
                'tanggal_default.required' => 'Tanggal harus diisi.',
                'total_default.required' => 'Total harus diisi.',
                'metode_pembayaran_default.required' => 'Metode pembayaran harus diisi.',
                'bukti_transaksi_default.required' => 'Bukti transaksi harus diisi.',
                'keterangan_default.required' => 'Keterangan harus diisi.',

            ]);

            $bukti_transaksi_default = $request->file('bukti_transaksi_default');
            $namaFileBuktiTransaksiDefault = 'bukti_transaksi_default-' . time() . '.' . $bukti_transaksi_default->getClientOriginalExtension();
            Storage::putFileAs('bukti-transaksi', $bukti_transaksi_default, $namaFileBuktiTransaksiDefault);

            $transaksi = TransaksiModel::create([
                'tanggal' => $request->tanggal_default,
                'total' => $request->total_default,
                'metode_pembayaran' => $request->metode_pembayaran_default,
                'bukti_transaksi' => $namaFileBuktiTransaksiDefault,
                'keterangan' => $request->keterangan_default,
                'id_kategori' => $request->id_kategori

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

    public function show($id)
    {
        $pengeluaran = TransaksiModel::with('kategori')->findOrFail($id);
        return view('admin.pengeluaran.show', compact('pengeluaran'));
    }

    public function cetakInvoice($id)
    {
        $transaksi = TransaksiModel::with(['kategori', 'transaksiSawit', 'petani'])->findOrFail($id);

        return Pdf::loadView('admin.pengeluaran.invoice', compact('transaksi'))
            ->setPaper([0, 0, 164.4, 400], 'portrait') // 58mm x 141mm (ukuran bon kecil)
            ->setOptions([
                'margin-top' => 0,
                'margin-right' => 0,
                'margin-bottom' => 0,
                'margin-left' => 0,
                'dpi' => 203,
                'enable-smart-shrinking' => false
            ])
            ->stream('bon-sawit.pdf');
    }
}
