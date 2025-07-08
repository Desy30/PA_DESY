@extends('layouting.guest.master')
@section('title', 'Detail PKS')

@section('content')
<div class="page-header">
    <div class="title">
        <h4>Detail PKS</h4>
    </div>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pks') }}">PKS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4 mb-3">Informasi PKS</h4>

        <table class="table table-bordered">
            <tr>
                <th>Nama PKS</th>
                <td>{{ $pks->nama_pks }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $pks->alamat_pks }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $pks->nomor_telepon_pks }}</td>
            </tr>
        </table>

        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('pks') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
