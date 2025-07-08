@extends('layouting.guest.master')

@section('title', 'Kategori')
@section('content')
<div class="page-header">
    <div class="title">
        <h4>Kategori</h4>
    </div>
</div>

<!-- Filter Form -->
<div class="card-box mb-30 pd-20">
    @if (session('success'))
        <div class="mt-2 alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('kategori') }}" method="GET">
        <div class="row">
            <!-- Filter Jenis Kategori -->
            <div class="col-md-5 mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="jenis_kategori" id="kategori">
                            <option value="">-- Semua Jenis --</option>
                            <option value="pemasukan" {{ request('jenis_kategori') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ request('jenis_kategori') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Input Pencarian -->
            <div class="col-md-5 mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="search_kategori">Cari Kategori</label>
                        <input type="text" class="form-control" name="search_kategori" id="search_kategori" placeholder="Cari kategori..." value="{{ request('search_kategori') }}">
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="col-md-2 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-warning w-100">Proses</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Table Display -->
<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="text-blue h4">Daftar Kategori</h4>
            <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
        </div>
    </div>
    <div class="pb-20">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jenis Kategori</th>
                    <th>Deskripsi</th>
                    <th class="datatable-nosort">Menu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategories as $index => $kategori)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->jenis_kategori }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="{{ route('kategori.edit', $kategori->id) }}">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('kategori.show', $kategori->id) }}">
                                        <i class="dw dw-eye"></i> Detail
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            <i class="dw dw-delete-3"></i> Delete
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
