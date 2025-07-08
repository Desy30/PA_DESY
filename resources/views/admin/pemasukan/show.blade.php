@extends('layouting.guest.master')
@section('title', 'Detail Pemasukan')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Detail Pemasukan</h4>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Sumber Pemasukan</strong> : Penjualan Sawit</p>
                    <p><strong>Tanggal</strong> : 12 Desember 2024</p>
                    <p><strong>Jumlah</strong> : 100 Ton</p>
                    <p><strong>Berat Bersih</strong> : 95 Ton</p>
                    <p><strong>Pilih PKS</strong> : Data PKS</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Surat Pengantar</strong> : <a href="#">Download</a></p>
                    <p><strong>BON</strong> : <a href="#">Download</a></p>
                    <p><strong>Pembayaran</strong> : Cash</p>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('pemasukan') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
