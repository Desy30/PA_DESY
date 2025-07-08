@extends('layouting.guest.master')
@section('title', 'Detail Petani')

@section('content')
<div class="page-header">
    <div class="title">
        <h4>Detail Petani</h4>
    </div>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('petani') }}">Petani</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-blue h4">Informasi Petani</h4>
            <div>
                <a href="{{ route('petani.edit', $petani->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="{{ route('petani') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Nama Petani</th>
                <td>{{ $petani->nama_petani }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $petani->alamat_petani }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $petani->nomor_telepon_petani }}</td>
            </tr>
            <tr>
                <th>Nomor Rekening</th>
                <td>{{ $petani->nomor_rekening_petani }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
