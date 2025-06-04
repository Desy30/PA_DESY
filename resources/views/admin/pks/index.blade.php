@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>PKS</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pks') }}">PKS</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>

    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Data PKS</h4>
                <a href="{{ route('pks.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
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
                        <th>Nama PKS</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th class="datatable-nosort">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pks as $index => $item)
                        <tr>
                            <td class="table-plus">{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pks }}</td>
                            <td>{{ $item->nomor_telepon_pks }}</td>
                            <td>{{ $item->alamat_pks }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('pks.edit', $item->id) }}">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <!-- Form delete for PKS -->
                                        <form action="{{ route('pks.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </button>
                                        </form>
                                        <a class="dropdown-item" href="#">
                                            <i class="dw dw-eye"></i> View
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
