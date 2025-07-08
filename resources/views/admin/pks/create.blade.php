@extends('layouting.guest.master')
@section('title', 'Tambah PKS')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Tambah PKS</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pks') }}">PKS</a></li>
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
                <form action="{{ route('pks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_pks">Nama PKS</label>
                        <input type="text" class="form-control" id="nama_pks" placeholder="Masukkan nama pks.." name="nama_pks"  required>
                        @error('nama_pks')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_pks">Alamat</label>
                        <input type="text" class="form-control" id="alamat_pks" placeholder="Masukkan alamat pks.." name="alamat_pks" required>
                        @error('alamat_pks')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_telepon_pks">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="nomor_telepon-_pks" placeholder="Masukkan nomor HP pks.." name="nomor_telepon_pks" required>
                        @error('nomor_telepon_pks')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pks') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-success ml-2">Simpan</button>
                    </div>
                </form>
        </div>
    </div>
@endsection
