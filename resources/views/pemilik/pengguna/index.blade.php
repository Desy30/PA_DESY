@extends('layouting.guest.master')
@section('title', 'Pengguna')

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
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td class="table-plus">{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
