@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Laporan Pemasukan/Pengeluaran</h4>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card-box mb-30 pd-20">
        <form action="#" method="GET">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal</label>
                        <input type="date" class="form-control" name="tanggal_awal" required>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tanggal_akhir" required>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="Masuk">Masuk</option>
                            <option value="Keluar">Keluar</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-success">Proses</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Display -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Daftar Laporan</h4>
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Sumber</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Dummy -->
                    <tr>
                        <td>1</td>
                        <td>12-12-24</td>
                        <td>Penjualan sawit</td>
                        <td>100 ton</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>12-12-24</td>
                        <td>Penjualan sawit</td>
                        <td>200 ton</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>12-12-24</td>
                        <td>Penjualan sawit</td>
                        <td>250 ton</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>12-12-24</td>
                        <td>Penjualan sawit</td>
                        <td>150 ton</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
