@extends('layouting.guest.master')
@section('title', 'Petani')

@section('content')
<div class="page-header">
<div class="title">
    <h4>Petani</h4>
</div>
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('petani') }}">Petani</a></li>
        <li class="breadcrumb-item active" aria-current="page">List</li>
    </ol>
</nav>
</div>

<!-- Simple Datatable start -->
<div class="card-box mb-30">
<div class="pd-20">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="text-blue h4">Petani</h4>
        <a href="{{ route('petani.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
    </div>
    {{-- tambah --}}
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
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th class="datatable-nosort">Menu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petani as $index => $item)
                <tr>
                    <td class="table-plus">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_petani }}</td>
                    <td> {{ $item->alamat_petani }}</td>
                    <td>{{ $item->nomor_telepon_petani }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="{{ route('petani.edit', $item->id) }}">
                                    <i class="dw dw-edit2"></i> Edit
                                </a>
                                <!-- Form delete untuk petani -->
                                <form action="{{ route('petani.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="dw dw-delete-3"></i> Delete
                                    </button>
                                </form>
                                <a class="dropdown-item" href="{{ route('petani.show', $item->id) }}">
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
