@extends('layouting.guest.master')
@section('title', 'Edit Kategori')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit Kategori</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kategori') }}">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <!-- Edit Form -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_kategori">Nama</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                    @error('nama_kategori')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_kategori">Jenis Kategori</label>
                    <select class="form-control" id="jenis_kategori" name="jenis_kategori" required>
                        <option value="pemasukan" @selected(old('jenis_kategori', $kategori->jenis_kategori) == 'pemasukan')>Pemasukan</option>
                        <option value="pengeluaran" @selected(old('jenis_kategori', $kategori->jenis_kategori) == 'pengeluaran')>Pengeluaran</option>
                    </select>
                    @error('jenis_kategori')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $kategori->deskripsi) }}" required>
                    @error('deskripsi')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Update dan Kembali -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('kategori') }}" class="btn btn-danger ml-2">Kembali</a>
                    <button type="submit" class="btn btn-warning ml-2">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
