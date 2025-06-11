@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit Pengeluaran</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengeluaran') }}">Pengeluaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <form>
                <!-- Tanggal Pengeluaran (Input Date) -->
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Pilih tanggal pengeluaran">
                </div>

                <!-- Jumlah Pengeluaran (Input Number) -->
                <div class="form-group">
                    <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                    <input type="number" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" placeholder="Jumlah uang">
                </div>

                <!-- Keterangan Pengeluaran -->
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan pengeluaran">
                </div>

                <!-- Bukti Transaksi (File Upload) -->
                <div class="form-group">
                    <label for="bukti_transaksi">Bukti Transaksi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="bukti_transaksi" name="bukti_transaksi">
                        <label class="custom-file-label" for="bukti_transaksi">Choose file</label>
                    </div>
                </div>

                <!-- Tombol Update dan Tutup -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pengeluaran') }}" class="btn btn-gray ml-2">Tutup</a>
                    <button type="submit" class="btn btn-warning ml-2">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
