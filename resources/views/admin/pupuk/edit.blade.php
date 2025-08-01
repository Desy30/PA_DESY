@extends('layouting.guest.master')
@section('title', 'Edit Supplier')


@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit Data Supplier</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pupuk') }}">Supplier</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <!-- Form untuk Edit Data Supplier -->
            <form action="{{ route('pupuk.update', $pupuk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menggunakan method PUT untuk update -->

                <!-- Nama Supplier -->
                <div class="form-group">
                    <label for="nama_supplier">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="Masukkan nama supplier.." required value="{{ old('nama_supplier', $pupuk->nama_supplier) }}">
                    @error('nama_supplier') <!-- Menampilkan pesan error jika ada -->
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat Supplier -->
                <div class="form-group">
                    <label for="alamat_supplier">Alamat Supplier</label>
                    <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" placeholder="Masukkan alamat supplier.." required value="{{ old('alamat_supplier', $pupuk->alamat_supplier) }}">
                    @error('alamat_supplier')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Telepon Supplier -->
                <div class="form-group">
                    <label for="nomor_telepon_supplier">Nomor Telepon Supplier</label>
                    <input type="text" class="form-control" id="nomor_telepon_supplier" name="nomor_telepon_supplier" placeholder="Masukkan nomor telepon supplier.." required value="{{ old('nomor_telepon_supplier', $pupuk->nomor_telepon_supplier) }}">
                    @error('nomor_telepon_supplier')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Rekening Supplier -->
                <div class="form-group">
                    <label for="nomor_rekening_supplier">Nomor Rekening Supplier</label>
                    <input type="text" class="form-control" id="nomor_rekening_supplier" name="nomor_rekening_supplier" placeholder="Masukkan nomor rekening supplier.." required value="{{ old('nomor_rekening_supplier', $pupuk->nomor_rekening_supplier) }}">
                    @error('nomor_rekening_supplier')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan supplier.." required value="{{ old('keterangan', $pupuk->keterangan) }}">
                    @error('keterangan')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('pupuk') }}" class="btn btn-danger ml-2">Batal</a>
                    <button type="submit" class="btn btn-success ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
