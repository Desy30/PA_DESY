@extends('layouting.guest.master')
@section('title', 'Supplier Pupuk')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Supplier Pupuk</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pupuk') }}">Supplier Pupuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>

    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Data Supplier Pupuk</h4>
                <a href="{{ route('pupuk.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            {{-- success message --}}
            @if (session('success'))
                <div class="mt-2 alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>Nama Supplier</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th class="datatable-nosort">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pupuk as $index => $item)
                        <tr>
                            <td class="table-plus">{{ $index + 1 }}</td>
                            <td>{{ $item->nama_supplier }}</td>
                            <td>{{ $item->nomor_telepon_supplier }}</td>
                            <td>{{ $item->alamat_supplier }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('pupuk.edit', $item->id) }}">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <form action="{{ route('pupuk.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </button>
                                        </form>
                                        <a class="dropdown-item" href="{{ route('pupuk.show', $item->id) }}">
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
