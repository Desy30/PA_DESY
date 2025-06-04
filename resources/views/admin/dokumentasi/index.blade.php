@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Dokumentasi Surat</h4>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card-box mb-20 pd-20">
        <form action="#" method="GET">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <label>Tipe Surat</label>
                    <div class="d-flex">
                        <div class="custom-control custom-checkbox mb-5">
                            <input type="checkbox" class="custom-control-input" id="typeMasuk">
                            <label class="custom-control-label" for="typeMasuk">Masuk</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-5 ml-3">
                            <input type="checkbox" class="custom-control-input" id="typeKeluar">
                            <label class="custom-control-label" for="typeKeluar">Keluar</label>
                        </div>
                    </div>
                </div>
                <div class="ml-5">
                    <label>Jenis Surat</label>
                    <div class="d-flex">
                        <div class="custom-control custom-checkbox mb-5">
                            <input type="checkbox" class="custom-control-input" id="jenisSP">
                            <label class="custom-control-label" for="jenisSP">SP</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-5 ml-3">
                            <input type="checkbox" class="custom-control-input" id="jenisBon">
                            <label class="custom-control-label" for="jenisBon">Bon</label>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-6 col-lg-3">
                        <div class="form-group">
                            <label for="search_surat">Cari Surat</label>
                            <input type="text" class="form-control" name="search_surat" placeholder="Cari Surat..">
                        </div>
                    </div> --}}
                <div class="ml-5 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-warning">Proses</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Display -->
    <div class="pb-20">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">No</th>
                    <th>Tanggal</th>
                    <th>Sumber</th>
                    <th class="datatable-nosort">Menu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="table-plus">1</td>
                    <td>20 APRIL 2025</td>
                    <td>Penjualan Sawit</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="{{ route('petani.edit', 1) }}">
                                    <i class="dw dw-edit2"></i> Detail
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dw dw-delete-3"></i> Download
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
@endsection
