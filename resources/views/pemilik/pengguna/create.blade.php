@extends('layouting.guest.master')

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
            <form method="POST" action="{{ route('pengguna') }}">
                @csrf

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="masukkan nama ..." value="{{ old('nama') }}">
                </div>

                <!-- Role -->
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="kasir">kasir</option>
                        <!-- You can add more roles here -->
                    </select>
                </div>

                <!-- Kata Sandi -->
                <div class="form-group">
                    <label for="kata_sandi">Kata Sandi</label>
                    <input type="password" class="form-control" id="kata_sandi" name="kata_sandi" placeholder="..." value="{{ old('kata_sandi') }}">
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="form-group">
                    <label for="konfirmasi_kata_sandi">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" id="konfirmasi_kata_sandi" name="konfirmasi_kata_sandi" placeholder="..." value="{{ old('konfirmasi_kata_sandi') }}">
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
