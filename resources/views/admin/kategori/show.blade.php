@extends('layouting.guest.master')
@section('title', 'Detail Kategori')

@section('content')
<div class="page-header">
    <div class="title">
        <h4>Detail Kategori</h4>
    </div>
</div>

<div class="card-box mb-30">
    <div class="pd-20">
        <table class="table table-bordered">
            <tr>
                <th>Nama Kategori</th>
                <td>{{ $kategori->nama_kategori }}</td>
            </tr>
            <tr>
                <th>Jenis</th>
                <td>{{ $kategori->jenis_kategori }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $kategori->deskripsi }}</td>
            </tr>
            <tr>
                <th>Pengiriman</th>
                <td>{{ $kategori->is_pengiriman ? 'Ya' : 'Tidak' }}</td>
            </tr>
        </table>
        <a href="{{ route('kategori') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
