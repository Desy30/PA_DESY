@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit Petani</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('petani') }}">Petani</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <!-- Edit Form -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <form action="{{ route('petani.update', $petani->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menambahkan PUT method override -->

                <!-- Nama Petani -->
                <div class="form-group">
                    <label for="nama_petani">Nama Petani</label>
                    <input type="text" class="form-control" id="nama_petani" name="nama_petani"
                        value="{{ old('nama_petani', $petani->nama_petani) }}" required>
                    @error('nama_petani')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanda Tangan Petani -->
                <div class="form-group">
                    <label for="tanda_tangan_petani">Tanda Tangan Petani</label>
                    <input type="file" class="form-control" id="tanda_tangan_petani" name="tanda_tangan_petani">
                    @error('tanda_tangan_petani')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Telepon Petani -->
                <div class="form-group">
                    <label for="nomor_telepon_petani">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon_petani" name="nomor_telepon_petani"
                        value="{{ old('nomor_telepon_petani', $petani->nomor_telepon_petani) }}" required>
                    @error('nomor_telepon_petani')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat Petani -->
                <div class="form-group">
                    <label for="alamat_petani">Alamat</label>
                    <textarea class="form-control" id="alamat_petani" name="alamat_petani" required>{{ old('alamat_petani', $petani->alamat_petani) }}</textarea>
                    @error('alamat_petani')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Rekening Petani -->
                <div class="form-group">
                    <label for="nomor_rekening_petani">Nomor Rekening</label>
                    <input type="text" class="form-control" id="nomor_rekening_petani" name="nomor_rekening_petani"
                        value="{{ old('nomor_rekening_petani', $petani->nomor_rekening_petani) }}" required>
                    @error('nomor_rekening_petani')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('petani') }}" class="btn btn-danger ml-2">Batal</a>
                    <button type="submit" class="btn btn-dark ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
