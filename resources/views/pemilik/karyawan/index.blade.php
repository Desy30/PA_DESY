@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Tambah Karyawan</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('karyawan') }}">Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Karyawan</li>
            </ol>
        </nav>
    </div>

    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-blue h4">Daftar Karyawan</h4>
                <a href="{{ route('karyawan.create') }}" class="btn btn-sm btn-primary">Tambah Karyawan</a>
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Gaji</th>
                        <th class="datatable-nosort">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawans as $index => $karyawan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->jabatan_karyawan }}</td>
                            <td>{{ $karyawan->gaji }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('karyawan.edit', $karyawan->id) }}">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data karyawan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
