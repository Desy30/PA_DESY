@extends('layouting.guest.master')
@section('title', 'Detail Pemasukan')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4 fw-bold">Detail Pemasukan</h4>

    {{-- Cek kategori berdasarkan nama_kategori --}}
    @php
        $kategori = strtolower($pemasukan->kategori->nama_kategori ?? '');
    @endphp

@if ($kategori === 'penjualan sawit')
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="text-primary fw-bold">Penjualan Sawit</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $pemasukan->tanggal ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Berat Bersih</th>
                    <td>{{ $pemasukan->transaksiSawit->berat_bersih ?? '-' }} kg</td>
                </tr>
                <tr>
                    <th>PKS</th>
                    <td>{{ $pemasukan->pks->nama_pks ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ $pemasukan->metode_pembayaran ?? '-' }}</td>
                </tr>
            </table>

            <p class="fw-bold">Surat Pengantar</p>
            @if (!empty($pemasukan->transaksiSawit->surat_pengantar))
                <img src="{{ asset('storage/surat-pengantar/' . $pemasukan->transaksiSawit->surat_pengantar) }}" width="200" class="img-thumbnail mb-2">
            @else
                <p class="text-muted">Tidak ada file</p>
            @endif
        </div>
    </div>
    @elseif ($kategori === 'penjualan pupuk')
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="text-primary fw-bold">Penjualan Pupuk</h5>
                <table class="table table-bordered">
                    <tr><th>Tanggal</th><td>{{ $pemasukan->tanggal }}</td></tr>
                    <tr><th>Petani</th><td>{{ $pemasukan->petani->nama_petani ?? '-' }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $pemasukan->petani->alamat_petani ?? '-' }}</td></tr>
                    <tr><th>No. Telepon</th><td>{{ $pemasukan->petani->nomor_telepon_petani ?? '-' }}</td></tr>
                    <tr><th>No. Rekening</th><td>{{ $pemasukan->petani->nomor_rekening_petani ?? '-' }}</td></tr>
                    <tr><th>Jenis Pupuk</th><td>{{ $pemasukan->barang->nama_barang ?? '-' }}</td></tr>
                    <tr><th>Jumlah</th><td>{{ $pemasukan->transaksiPupuk->jumlah_pupuk ?? '-' }} sak</td></tr>
                    <tr><th>Harga per Unit</th><td>Rp {{ number_format($pemasukan->transaksiPupuk->harga_perunit ?? 0) }}</td></tr>
                    <tr><th>Total</th><td>Rp {{ number_format($pemasukan->total ?? 0) }}</td></tr>
                </table>
                <p class="fw-bold">Bukti Transaksi</p>
                @if ($pemasukan->bukti_transaksi)
                    <img src="{{ asset('storage/bukti_transaksi_pupuk/' . $pemasukan->bukti_transaksi) }}" width="200" class="img-thumbnail mb-2">
                @else
                    <p class="text-muted">Tidak ada file</p>
                @endif
            </div>
        </div>

    @elseif ($kategori === 'sewa timbangan')
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="text-primary fw-bold">Sewa Timbangan</h5>
                <table class="table table-bordered">
                    <tr><th>Nama</th><td>{{ $pemasukan->transaksiTimbangan->nama ?? '-' }}</td></tr>
                    <tr><th>Tanggal Penimbangan</th><td>{{ $pemasukan->tanggal }}</td></tr>
                    <tr><th>Total Biaya</th><td>Rp {{ number_format($pemasukan->total ?? 0) }}</td></tr>
                </table>
                <p class="fw-bold">Bukti Transaksi</p>
                @if ($pemasukan->bukti_transaksi)
                    <img src="{{ asset('storage/bukti_transaksi_timbangan/' . $pemasukan->bukti_transaksi) }}" width="200" class="img-thumbnail mb-2">
                @else
                    <p class="text-muted">Tidak ada file</p>
                @endif
            </div>
        </div>

    @else
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="text-primary fw-bold">Pemasukan Umum</h5>
                <table class="table table-bordered">
                    <tr><th>Tanggal</th><td>{{ $pemasukan->tanggal }}</td></tr>

                    <tr><th>Jumlah</th><td>Rp {{ number_format($pemasukan->total ?? 0) }}</td></tr>
                </table>
                <p class="fw-bold">Bukti Transaksi</p>
                @if ($pemasukan->bukti_transaksi)
                    <img src="{{ asset('storage/bukti_transaksi_default/' . $pemasukan->bukti_transaksi) }}" width="200" class="img-thumbnail mb-2">
                @else
                    <p class="text-muted">Tidak ada file</p>
                @endif
            </div>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('pemasukan') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection
