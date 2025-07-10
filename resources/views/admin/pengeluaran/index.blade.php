@extends('layouting.guest.master')


@section('title', 'Pengeluaran')
@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Pengeluaran</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengeluaran') }}">Pengeluaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>

    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Pengeluaran</h4>
                @hasanyrole('kasir')
                    <a href="{{ route('pengeluaran.create') }}" class="btn btn-sm btn-primary">Tambah Pengeluaran</a>
                @endhasanyrole
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th> 📅 Tanggal</th>
                        <th> 📤 Sumber</th>
                        <th> 💵 Jumlah</th>
                        <th> ⋯  Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengeluarans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>
                                <span class="badge badge-warning text-capitalize">
                                    {{ $item->kategori->nama_kategori ?? 'Tidak Diketahui' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-danger">
                                    Rp {{ number_format($item->total, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="dw dw-more"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('pengeluaran.show', $item->id) }}">
                                            <i class="dw dw-eye"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
