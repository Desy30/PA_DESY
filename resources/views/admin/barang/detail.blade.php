@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Detail Barang</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('barang') }}">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <h5>Nama Barang: {{ $barang->nama_barang }}</h5>
            <p><strong>Jenis Barang:</strong> {{ $barang->jenis_barang }}</p>
            <p><strong>Harga Jual:</strong> {{ $barang->harga_jual_barang }}</p>
            <p><strong>Harga Beli:</strong> {{ $barang->harga_beli_barang }}</p>
            <p><strong>Stock Barang:</strong> {{ $barang->stock_barang }}</p>
            <p><strong>Keterangan:</strong> {{ $barang->keterangan_barang }}</p>
            <p><strong>Tanggal Barang:</strong> {{ $barang->tanggal_barang }}</p>
            <p><strong>Supplier:</strong> {{ $barang->supplier->nama_supplier }}</p>
            <!-- Assuming 'supplier' is a relationship -->
            <!-- Tombol Kembali ke Index -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('barang') }}" class="btn btn-dark">Kembali</a>
            </div>
        </div>
    </div>
@endsection
