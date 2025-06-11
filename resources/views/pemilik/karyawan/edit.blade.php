@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit Karyawan</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('karyawan') }}">Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Untuk spoofing method PUT --}}

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama_karyawan">Nama</label>
                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                        value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}" required>
                </div>

                <!-- Jabatan -->
                <div class="form-group">
                    <label for="jabatan_karyawan">Jabatan</label>
                    <select class="form-control" id="jabatan_karyawan" name="jabatan_karyawan">
                        <option value="Supir" {{ $karyawan->jabatan_karyawan == 'Supir' ? 'selected' : '' }}>Supir</option>
                        <option value="Kasir" {{ $karyawan->jabatan_karyawan == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="Pemuat" {{ $karyawan->jabatan_karyawan == 'Pemuat' ? 'selected' : '' }}>Pemuat
                        </option>
                        <option value="Pembantu" {{ $karyawan->jabatan_karyawan == 'Pembantu' ? 'selected' : '' }}>Pembantu
                        </option>
                    </select>
                </div>

                {{-- gaji --}}
                <div class="mb-3">
                    <label for="gaji" class="form-label">Gaji </label>
                    <input type="number" name="gaji" id="gaji" class="form-control"
                        value="{{ old('gaji', $karyawan->gaji) }}" placeholder="Masukkan gaji karyawan">
                    @error('gaji')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('karyawan') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-dark ml-2">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
