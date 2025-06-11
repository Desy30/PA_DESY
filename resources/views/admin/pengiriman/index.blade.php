@extends('layouting.guest.master')

@section('content')

@section('content')
<div class="card-box mb-30">
    <div class="pd-20 d-flex justify-content-between align-items-center">
        <h4 class="text-blue h4">Data Pengiriman</h4>
        <a href="{{ route('pengiriman.create') }}" class="btn btn-primary">
            <i class="fa fa-plus mr-1"></i> Tambah Pengiriman
        </a>
    </div>
    <div class="pb-20">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->tanggal_pengiriman ? \Carbon\Carbon::parse($item->tanggal_pengiriman)->format('d-m-Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pengiriman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
