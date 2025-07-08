@extends('layouting.guest.master')

@section('title', 'Barang')
@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Data Barang</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('barang') }}">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>

    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Daftar Barang</h4>
                <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            {{-- Tambah --}}
            @if (session('success'))
                <div class="mt-2 alert alert-success">
                    {{ session('success') }} tambah
                </div>
            @endif
        </div>

        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>Nama Barang</th>
                        <th>Harga Jual </th>
                        <th>Harga Beli</th>
                        <th>Supplier</th>
                        <th class="datatable-nosort">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $index => $item)
                        <!-- Looping data barang -->
                        <tr>
                            <td class="table-plus">{{ $index + 1 }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->harga_jual_barang }}</td>
                            <td>{{ $item->harga_beli_barang }}</td>
                            <td>{{ $item->supplier->nama_supplier ?? '-' }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('barang.edit', $item->id) }}">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('barang.show', $item->id) }}">
                                            <i class="dw dw-eye"></i> Detail
                                        </a>
                                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="dw dw-delete-3"></i> Hapus
                                            </button>
                                        </form>
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
