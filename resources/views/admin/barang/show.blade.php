@extends('layouting.guest.master')
@section('title', 'Detail Barang')

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
        <div class="form-row">
            <!-- Nama Barang -->
            <div class="form-group col-12 col-md-6">
                <label>Nama Barang</label>
                <input type="text" class="form-control" value="{{ $barang->nama_barang }}" readonly>
            </div>

            <!-- Harga Jual -->
            <div class="form-group col-12 col-md-6">
                <label>Harga Jual Barang</label>
                <input type="text" class="form-control" value="{{ $barang->harga_jual_barang }}" readonly>
            </div>

            <!-- Harga Beli -->
            <div class="form-group col-12 col-md-6">
                <label>Harga Beli Barang</label>
                <input type="text" class="form-control" value="{{ $barang->harga_beli_barang }}" readonly>
            </div>

            <!-- Supplier -->
            <div class="form-group col-12 col-md-6">
                <label>Supplier</label>
                <input type="text" class="form-control" value="{{ $barang->supplier->nama_supplier }}" readonly>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('barang') }}" class="btn btn-dark">Kembali</a>
        </div>
    </div>
</div>
@endsection
