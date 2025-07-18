@extends('layouting.guest.master')

@section('title', 'Laporan Keuangan')

@section('content')
    <div class="page-header mb-3">
        <div class="title">
            <h4>🧾 Laporan Keuangan</h4>
        </div>
    </div>

    {{-- Filter & Cetak PDF --}}
    <div class="card-box mb-30 pd-20">
        <form method="GET" action="{{ route('laporan') }}" class="mb-3">
            <div class="row g-3">
                <div class="col-2">
                    <label>Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                </div>
                <div class="col-2">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-3">
                    <label>Jenis</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="">Semua Jenis</option>
                        <option value="pemasukan" {{ request('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Kategori</label>
                    <select name="kategori_id" id="kategori" class="form-control">
                        <option value="">Pilih Jenis Terlebih Dahulu</option>
                        @if(request('jenis'))
                            @foreach($kategoris as $kat)
                                @if($kat->jenis_kategori == request('jenis'))
                                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-info w-100">
                        <i class="fa fa-filter me-1"></i> Tampilkan Laporan
                    </button>
                </div>
            </div>
        </form>

        <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="btn btn-success w-100">
            <i class="fa fa-print me-1"></i> Cetak Laporan (PDF)
        </a>
    </div>

    {{-- TABEL PEMASUKAN --}}
    <div class="card-box mb-30 pd-20">
        <h5 class="text-primary">📥 Pemasukan</h5>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th class="text-end">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $noP = 1;
                    $totalPemasukan = 0;
                @endphp
                @foreach ($transaksis as $trx)
                    @if (($trx->kategori->jenis_kategori ?? '') === 'pemasukan')
                        <tr>
                            <td>{{ $noP++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $trx->kategori->nama_kategori ?? '-' }}</td>
                            <td class="text-end">
                                @php $totalPemasukan += $trx->total; @endphp
                                Rp{{ number_format($trx->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                @if ($noP === 1)
                    <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Total Pemasukan</th>
                    <th class="text-end">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- TABEL PENGELUARAN --}}
    <div class="card-box mb-30 pd-20">
        <h5 class="text-danger">📤 Pengeluaran</h5>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th class="text-end">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $noK = 1;
                    $totalPengeluaran = 0;
                @endphp
                @foreach ($transaksis as $trx)
                    @if (($trx->kategori->jenis_kategori ?? '') === 'pengeluaran')
                        <tr>
                            <td>{{ $noK++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $trx->kategori->nama_kategori ?? '-' }}</td>
                            <td class="text-end">
                                @php $totalPengeluaran += $trx->total; @endphp
                                Rp{{ number_format($trx->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                @if ($noK === 1)
                    <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Total Pengeluaran</th>
                    <th class="text-end">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#jenis').on('change', function() {
            var jenis = $(this).val();
            if (jenis) {
                $.ajax({
                    url: '{{ route('kategori.get-by-jenis') }}',
                    type: 'GET',
                    data: { jenis: jenis },
                    success: function(data) {
                        $('#kategori')
                            .empty()
                            .append('<option value="">Pilih Kategori</option>');
                        $.each(data, function(key, value) {
                            $('#kategori').append(`<option value="${value.id}">${value.nama_kategori}</option>`);
                        });
                    }
                });
            } else {
                $('#kategori')
                    .empty()
                    .append('<option value="">Pilih Jenis Terlebih Dahulu</option>');
            }
        });
    </script>
@endpush
