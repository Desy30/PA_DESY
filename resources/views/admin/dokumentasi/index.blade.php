@extends('layouting.guest.master')
@section('title', 'Dokumentasi')

@section('content')
    <div class="page-header mb-3">
        <div class="title">
            <h4>📄 Dokumentasi Surat</h4>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card-box mb-20 pd-20">
        <form action="{{ route('dokumentasi') }}" method="GET">
            <div class="form-group">
                <label for="jenis_surat">Filter Jenis Surat</label>
                <select name="jenis_surat" id="jenis_surat" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Semua Jenis --</option>
                    <option value="Surat Masuk" {{ request('jenis_surat') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk
                    </option>
                    <option value="Surat Keluar" {{ request('jenis_surat') == 'Surat Keluar' ? 'selected' : '' }}>Surat
                        Keluar</option>
                </select>
            </div>
        </form>

    </div>

    <!-- Tabel Gambar -->
    <div class="pb-20">
        @if ($files->count())
            <div class="row">
                @foreach ($files as $file)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/dokumen/' . $file->image) }}" class="card-img-top"
                                style="height:200px; object-fit:cover;" alt="dokumen">
                            <div class="card-body">
                                <p class="card-text"><strong>Kategori:</strong> {{ $file->kategori }}</p>
                                <a href="{{ asset('storage/dokumen/' . $file->image) }}" class="btn btn-sm btn-primary"
                                    download>Download</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada dokumentasi ditemukan.</p>
        @endif

    </div>
@endsection
