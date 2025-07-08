@extends('layouting.guest.master')
@section('title', 'Edit Pemasukan')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit Pemasukan</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pemasukan') }}">Pemasukan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <form>
                <!-- Sumber Pemasukan (Dropdown) -->
                <div class="form-group">
                    <label for="sumber_pemasukan">Sumber Pemasukan</label>
                    <select class="form-control" id="sumber_pemasukan" name="sumber_pemasukan">
                        <option value="penjualan_sawit">Penjualan Sawit</option>
                        <option value="penjualan_pupuk">Penjualan Pupuk</option>
                        <option value="sewa_timbangan">Sewa Timbangan</option>
                    </select>
                </div>

                <!-- Tanggal (Input Date) -->
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>

                <!-- Jumlah (Input Number) -->
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah uang">
                </div>

                <!-- Berat Bersih -->
                <div class="form-group">
                    <label for="berat_bersih">Berat Bersih</label>
                    <input type="number" class="form-control" id="berat_bersih" name="berat_bersih" placeholder="Jumlah sawit yang diantar">
                </div>

                <!-- Pilih PKS (Dropdown) -->
                <div class="form-group">
                    <label for="pks">Pilih PKS</label>
                    <select class="form-control" id="pks" name="pks">
                        <option value="data_pks">Data PKS</option>
                    </select>
                </div>

                <!-- Surat Pengantar (File Upload) -->
                <div class="form-group">
                    <label for="surat_pengantar">Surat Pengantar</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="surat_pengantar" name="surat_pengantar">
                        <label class="custom-file-label" for="surat_pengantar">Choose file</label>
                    </div>
                </div>

                <!-- BON (File Upload) -->
                <div class="form-group">
                    <label for="bon">BON</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="bon" name="bon">
                        <label class="custom-file-label" for="bon">Choose file</label>
                    </div>
                </div>

                <!-- Pembayaran (Dropdown) -->
                <div class="form-group">
                    <label for="metode_pembayaran">Pembayaran</label>
                    <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>

                <!-- Tombol Update dan Tutup -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pemasukan') }}" class="btn btn-gray ml-2">Tutup</a>
                    <button type="submit" class="btn btn-warning ml-2">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
