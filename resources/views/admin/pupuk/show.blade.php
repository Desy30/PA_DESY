@extends('layouting.guest.master')
@section('title', 'Detail Supplier')

@section('content')
<div class="page-header">
    <div class="title">
        <h4>Detail Supplier</h4>
    </div>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pupuk') }}">Supplier</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4 mb-3">Informasi Supplier</h4>

        <table class="table table-bordered">
            <tr>
                <th>Nama Supplier</th>
                <td>{{ $pupuk->nama_supplier }}</td>
            </tr>
            <tr>
                <th>Alamat Supplier</th>
                <td>{{ $pupuk->alamat_supplier }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $pupuk->nomor_telepon_supplier }}</td>
            </tr>
            <tr>
                <th>Nomor Rekening</th>
                <td>{{ $pupuk->nomor_rekening_supplier }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{{ $pupuk->keterangan }}</td>
            </tr>
        </table>

        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('pupuk') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
