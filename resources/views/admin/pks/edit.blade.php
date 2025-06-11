@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit PKS</h4>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <form action="{{ route('pks.update', $pks->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Untuk mengubah method menjadi PUT -->

                <!-- Nama PKS -->
                <div class="form-group">
                    <label for="nama_pks">Nama PKS</label>
                    <input type="text" class="form-control" id="nama_pks" name="nama_pks" value="{{ old('nama_pks', $pks->nama_pks) }}" required>
                </div>

                <!-- Nomor Telepon PKS -->
                <div class="form-group">
                    <label for="nomor_telepon_pks">Nomor Telepon PKS</label>
                    <input type="text" class="form-control" id="nomor_telepon_pks" name="nomor_telepon_pks" value="{{ old('nomor_telepon_pks', $pks->nomor_telepon_pks) }}" required>
                </div>

                <!-- Alamat PKS -->
                <div class="form-group">
                    <label for="alamat_pks">Alamat PKS</label>
                    <input type="text" class="form-control" id="alamat_pks" name="alamat_pks" value="{{ old('alamat_pks', $pks->alamat_pks) }}" required>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pks') }}" class="btn btn-danger ml-2">Batal</a>
                    <button type="submit" class="btn btn-dark ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
