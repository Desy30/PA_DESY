@extends('layouting.guest.master')
@section('title', 'Tambah Pengguna')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Tambah Pengguna</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengguna') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <form method="POST" action="{{ route('pengguna.store') }}">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Masukkan nama...">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- Nama -->
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                name="username" value="{{ old('username') }}" placeholder="Masukkan nama..." aria-describedby="usernameHelp">
                            <div id="usernameHelp" class="form-text">
                                Username akan menjadi password secara default
                            </div>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pengguna') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-dark ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
