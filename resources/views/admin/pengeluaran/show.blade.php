@extends('layouting.guest.master')
@section('title', 'Detail Pengeluaran')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Detail Data Pembelian Sawit</h4>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Tanggal</strong> : 12 Desember 2024</p>
                    <p><strong>Petani</strong> : Andi Syaputra</p>
                    <p><strong>Bruto</strong> : 4000</p>
                    <p><strong>Tara</strong> : 2000</p>
                    <p><strong>Netto</strong> : 2000</p>
                    <p><strong>Potongan</strong> : 200</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Berat Bersih</strong> : 1800</p>
                    <p><strong>Harga</strong> : 3000</p>
                    <p><strong>Pembayaran</strong> : Cash</p>
                    <p><strong>Jumlah</strong> : Rp 5.400.000</p>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('pengeluaran') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
