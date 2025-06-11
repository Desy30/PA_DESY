@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Tambah Pengguna</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengguna') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Pengguna</li>
            </ol>
        </nav>
    </div>

    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Petani</h4>
                <a href="{{ route('pengguna.create') }}" class="btn btn-sm btn-primary">Tambah Pengguna</a>
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Status </th>
                        <th class="datatable-nosort">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td class="table-plus">{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <ul>
                                    @forelse ($user->getRoleNames() as $name)
                                        <li class="text-capitalize">{{ $name }}</li>
                                    @empty
                                    -
                                    @endforelse
                                </ul>
                            </td>
                            <td>Aktif</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('pengguna.edit', $user->id) }}">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin hapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
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
