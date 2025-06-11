@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Detail Petani</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('petani') }}">Petani</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <h5>Nama Petani: {{ $petani->nama_petani }}</h5>
            <p><strong>Alamat:</strong> {{ $petani->alamat_petani }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $petani->nomor_telepon_petani }}</p>
            <p><strong>Nomor Rekening:</strong> {{ $petani->nomor_rekening_petani }}</p>

            <p><strong>Tanda Tangan:</strong></p>
            @if ($petani->tanda_tangan_petani)
                <img src="{{ asset('storage/' . $petani->tanda_tangan_petani) }}" alt="Tanda Tangan Petani"
                    style="max-width: 300px;">
            @else
                @if ($petani->tanda_tangan_petani)
                    <img src="{{ asset('storage/' . $petani->tanda_tangan_petani) }}" alt="Tanda Tangan Petani"
                        style="max-width: 300px;">

                    <!-- Tombol Download -->
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $petani->tanda_tangan_petani) }}"
                            download="{{ $petani->nama_petani }}-tanda-tangan.png" class="btn btn-success">
                            Download Tanda Tangan
                        </a>
                    </div>
                @else
                    <p>Tanda tangan belum tersedia.</p>
                @endif
            @endif

            <div class="mt-3">
                <a href="{{ route('petani') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('petani.edit', $petani->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
