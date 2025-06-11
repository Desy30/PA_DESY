@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Tambah Petani Baru</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('petani') }}">Petani</a></li>
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
            <form action="{{ route('petani.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_petani">Nama Petani</label>
                    <input type="text" class="form-control" id="nama_petani" placeholder="Masukkan nama petani..."
                        name="nama_petani" required>
                        @error('nama_petani')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat_petani">Alamat</label>
                    <input type="text" class="form-control" id="alamat_petani" placeholder="Masukkan alamat petani..."
                        name="alamat_petani" required>
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="nomor_telepon"
                        placeholder="Masukkan nomor telepon petani..." name="nomor_telepon_petani" required>
                </div>
                <div class="form-group">
                    <label for="tanda_tangan_petani">Tanda Tangan</label>
                    <input type="file" class="form-control-file" id="tanda_tangan_petani" name="tanda_tangan_petani" required>
                </div>
                <div class="form-group">
                    <label for="nomor_rekening">Nomor Rekening</label>
                    <input type="text" class="form-control" id="nomor_rekening"
                        placeholder="Masukkan nomor rek petani..." name="nomor_rekening_petani" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('petani') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
