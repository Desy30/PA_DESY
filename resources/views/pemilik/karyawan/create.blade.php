@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Tambah Karyawan</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('karyawan') }}">Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card-box mb-30">
        <div class="pd-20">
            <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama_karyawan">Nama</label>
                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Masukkan nama ..." value="{{ old('nama_karyawan') }}">
                </div>

                <!-- Jabatan -->
                <div class="form-group">
                    <label for="jabatan_karyawan">Jabatan</label>
                    <select class="form-control" id="jabatan_karyawan" name="jabatan_karyawan">
                        <option value="Supir">Supir</option>
                        <option value="Kasir">Kasir</option>
                        <option value="Pemuat">Pemuat</option>
                        <option value="Pembantu">Pembantu</option>
                    </select>
                </div>
                {{-- gaji --}}
                <div class="mb-3">
                    <label for="gaji" class="form-label">Gaji </label>
                    <input type="number" name="gaji" id="gaji" class="form-control" value="{{ old('gaji') }}" placeholder="Masukkan gaji karyawan">
                    @error('gaji')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('karyawan') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-dark ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
