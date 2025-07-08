@extends('layouting.guest.master')
@section('title', 'Tambah Data Barang')
@section('content')
<div class="page-header">
    <div class="title">
        <h4>Tambah Barang</h4>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('barang') }}">Barang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
</div>

<div class="card-box mb-30">
    <div class="pd-20">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <!-- Nama Barang -->
                <div class="form-group col-12 col-md-6">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                    @error('nama_barang')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
                </div>
                <!-- Harga Jual -->
                <div class="form-group col-12 col-md-6">
                    <label for="harga_jual_barang">Harga Jual Barang</label>
                    <input type="number" class="form-control" id="harga_jual_barang" name="harga_jual_barang" value="{{ old('harga_jual_barang') }}" required>
                    @error('harga_jual_barang')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
                </div>

                <!-- Harga Modal -->
                <div class="form-group col-12 col-md-6">
                    <label for="harga_beli_barang">Harga Beli Barang</label>
                    <input type="number" class="form-control" id="harga_beli_barang" name="harga_beli_barang" value="{{ old('harga_beli_barang') }}" required>
                    @error('harga_beli_barang')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
                </div>

                <!-- Supplier -->
                <div class="form-group col-12 col-md-6">
                    <label for="id_supplier">Supplier</label>
                    <select class="form-control" id="id_supplier" name="id_supplier" required >
                        <option value="{{ old('id_supplier')=='-- Pilih Supplier --' ? 'selected' : '' }}">-- Pilih Supplier --</option>
                        @foreach ($pupuk as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('barang') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-success ml-2">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
