@extends('layouting.guest.master')

@section('content')
<div class="page-header">
    <div class="title">
        <h4>Edit Data Barang</h4>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('barang') }}">Barang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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

        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Untuk method PUT saat update -->

            <!-- Nama Barang -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required value="{{ old('nama_barang', $barang->nama_barang) }}">
            </div>
            <!-- Harga Jual -->
            <div class="form-group">
                <label for="harga_jual_barang">Harga Jual Barang</label>
                <input type="number" class="form-control" id="harga_jual_barang" name="harga_jual_barang" required value="{{ old('harga_jual_barang', $barang->harga_jual_barang) }}">
            </div>

            <!-- Harga Modal -->
            <div class="form-group">
                <label for="harga_beli_barang">Harga Beli Barang</label>
                <input type="number" class="form-control" id="harga_beli_barang" name="harga_beli_barang" required value="{{ old('harga_beli_barang', $barang->harga_beli_barang) }}">
            </div>

            <!-- Supplier -->
            <div class="form-group">
                <label for="id_supplier">Supplier</label>
                <select class="form-control" id="id_supplier" name="id_supplier" >
                    <option value="">-- Pilih Supplier --</option>
                    @foreach ($pupuk as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $barang->id_supplier ? 'selected' : '' }}>
                            {{ $supplier->nama_supplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('barang') }}" class="btn btn-danger ml-2">Batal</a>
                <button type="submit" class="btn btn-success ml-2">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
