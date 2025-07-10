@extends('layouting.guest.master')
@section('title', 'Detail Pengeluaran')

@section('content')
    <div class="container-fluid py-4">
        <h4 class="mb-4 fw-bold">Detail Pengeluaran</h4>

        @php
            $kategori = strtolower($pengeluaran->kategori->tipe_form ?? '');
        @endphp

        {{-- Pembelian Sawit --}}
        @if ($kategori === 'pembelian_sawit')
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="text-primary fw-bold">Pembelian Sawit</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $pengeluaran->tanggal ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Petani</th>
                            <td>{{ $pengeluaran->petani->nama_petani ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Bruto</th>
                            <td>{{ $pengeluaran->transaksiSawit->bruto ?? '-' }} kg</td>
                        </tr>
                        <tr>
                            <th>Tara</th>
                            <td>{{ $pengeluaran->transaksiSawit->tara ?? '-' }} kg</td>
                        </tr>
                        <tr>
                            <th>Netto</th>
                            <td>{{ $pengeluaran->transaksiSawit->netto ?? '-' }} kg</td>
                        </tr>
                        <tr>
                            <th>Berat Bersih</th>
                            <td>{{ $pengeluaran->transaksiSawit->berat_bersih ?? '-' }} kg</td>
                        </tr>
                        <tr>
                            <th>Harga per Kg</th>
                            <td>Rp {{ number_format($pengeluaran->transaksiSawit->harga ?? 0) }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp {{ number_format($pengeluaran->total ?? 0) }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ $pengeluaran->metode_pembayaran ?? '-' }}</td>
                        </tr>
                    </table>
                    <p class="fw-bold">Bukti Transaksi</p>
                    @if ($pengeluaran->bukti_transaksi)
                        <img src="{{ asset('storage/bukti_sawit/' . $pengeluaran->bukti_transaksi) }}" width="200"
                            class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">Tidak ada file</p>
                    @endif
                </div>
            </div>

            {{-- Pengeluaran Gaji --}}
        @elseif ($kategori === 'pengeluaran_gaji')
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="text-primary fw-bold">Pengeluaran Gaji</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $pengeluaran->tanggal ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Karyawan</th>
                            <td>{{ $pengeluaran->transaksiGaji->karyawan->nama_karyawan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Periode</th>
                            <td>{{ $pengeluaran->transaksiGaji->periode ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tunjangan</th>
                            <td>Rp {{ number_format($pengeluaran->transaksiGaji->tunjangan ?? 0) }}</td>
                        </tr>
                        <tr>
                            <th>Potongan</th>
                            <td>Rp {{ number_format($pengeluaran->transaksiGaji->potongan_gaji ?? 0) }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp {{ number_format($pengeluaran->total ?? 0) }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ $pengeluaran->metode_pembayaran ?? '-' }}</td>
                        </tr>
                    </table>
                    <p class="fw-bold">Bukti Transaksi</p>
                    @if ($pengeluaran->bukti_transaksi)
                        <img src="{{ asset('storage/bukti_transaksi/' . $pengeluaran->bukti_transaksi) }}" width="200"
                            class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">Tidak ada file</p>
                    @endif
                </div>
            </div>

            {{-- Kendaraan Operasional --}}
        @elseif ($kategori === 'kendaraan_operasional')
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="text-primary fw-bold">Kendaraan Operasional</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $pengeluaran->tanggal ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kendaraan</th>
                            <td>{{ $pengeluaran->transaksiKendaraanOperasional->jenis_kendaraan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Pengeluaran</th>
                            <td>{{ $pengeluaran->transaksiKendaraanOperasional->jenis_pengeluaran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $pengeluaran->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp {{ number_format($pengeluaran->total ?? 0) }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ $pengeluaran->metode_pembayaran ?? '-' }}</td>
                        </tr>
                    </table>
                    <p class="fw-bold">Bukti Transaksi</p>
                    @if ($pengeluaran->bukti_transaksi)
                        <img src="{{ asset('storage/bukti_transaksi_kendaraan/' . $pengeluaran->bukti_transaksi) }}"
                            width="200" class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">Tidak ada file</p>
                    @endif
                </div>
            </div>

            {{-- Default --}}
        @else
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="text-primary fw-bold">Pengeluaran Lainnya</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $pengeluaran->tanggal ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $pengeluaran->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp {{ number_format($pengeluaran->total ?? 0) }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ $pengeluaran->metode_pembayaran ?? '-' }}</td>
                        </tr>
                    </table>
                    <p class="fw-bold">Bukti Transaksi</p>
                    @if ($pengeluaran->bukti_transaksi)
                        <img src="{{ asset('storage/bukti_transaksi_default/' . $pengeluaran->bukti_transaksi) }}"
                            width="200" class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">Tidak ada file</p>
                    @endif
                </div>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('pengeluaran') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </div>
@endsection
