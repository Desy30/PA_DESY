@extends('layouting.guest.master')

@section('title', 'Dokumentasi Surat')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Dokumentasi Surat</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dokumentasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Daftar Dokumentasi Surat</h4>

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
                        <th class="table-plus">No</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Surat Pengantar</th>
                        <th>Bon</th>
                        <th>Bukti Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokumentasi as $index => $item)
                        <tr>
                            <td class="table-plus">{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}</td>
                            <td>{{ $item['kategori'] }}</td>

                            <td>
                                @if (!empty($item['surat_pengantar']))
                                    <a href="{{ asset('storage/surat-pengantar/' . $item['surat_pengantar']) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="dw dw-file"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>
                                @if (!empty($item['bon']))
                                    <a href="{{ asset('storage/bon/' . $item['bon']) }}" target="_blank"
                                        class="btn btn-sm btn-outline-success">
                                        <i class="dw dw-receipt"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>
                                @if (!empty($item['bukti_transaksi']))
                                    <a href="{{ asset('storage/bukti-transaksi/' . $item['bukti_transaksi']) }}" target="_blank"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="dw dw-checked"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
