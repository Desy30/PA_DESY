@extends('layouting.guest.master')

@section('title', 'Laporan')

@section('content')
    <div class="page-header mb-3">
        <div class="title">
            <h4> 🧾Laporan Keuangan</h4>
        </div>
    </div>

    {{-- Filter --}}
    <div class="card-box mb-30 pd-20">
        <form method="GET" action="{{ route('laporan') }}" class="mb-3">
            <div class="row">
                {{-- Tanggal Awal --}}
                <div class="col-3">
                    <label>Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                </div>
                {{-- Tanggal Akhir --}}
                <div class="col-3">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>
                {{-- Kategori --}}
                <div class="col-3">
                    <label>Jenis</label>
                    <select name="Jenis" id="jenis" class="form-control">
                        <option value="">Jenis</option>
                        <option value="pengeluaran">Pengeluaran</option>
                        <option value="pemasukan">Pemasukan</option>
                    </select>
                </div>

                <div class="col-3">
                    <label>Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Jenis Terlebih Dahulu</option>
                    </select>
                </div>

            </div>
            <div class="row mt-3">
                {{-- Terapkan Filter --}}
                <div class="col-6">
                    <button type="submit" class="btn btn-info w-100 me-2">
                        <i class="fa fa-filter me-1"></i> Terapkan Filter
                    </button>
                </div>
                {{-- Export PDF --}}
                <div class="col-6">
                    <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="btn btn-success w-100">
                        <i class="fa fa-file-pdf me-1"></i> Export PDF
                    </a>
                </div>
            </div>
        </form>

        {{-- Tabel Laporan --}}
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>📆 Tanggal</th>
                    <th>🗂️ Kategori</th>
                    <th>📥 Pemasukan</th>
                    <th>📤 Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPemasukan = 0;
                    $totalPengeluaran = 0;
                @endphp
                @foreach ($transaksis as $i => $trx)
                    @php
                        $jenis = $trx->kategori->jenis_kategori ?? '-';
                        $isPemasukan = $jenis === 'pemasukan';
                        $jumlah = $trx->total;
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $trx->kategori->nama_kategori ?? '-' }}</td>
                        <td class="text-right">
                            @if ($isPemasukan)
                                @php $totalPemasukan += $jumlah; @endphp
                                Rp{{ number_format($jumlah, 0, ',', '.') }}
                            @endif
                        </td>
                        <td class="text-right">
                            @if (!$isPemasukan)
                                @php $totalPengeluaran += $jumlah; @endphp
                                Rp{{ number_format($jumlah, 0, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Total</th>
                    <th class="text-right">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                    <th class="text-right">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-center">Saldo Akhir</th>
                    <th colspan="2" class="text-center">
                        Rp{{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
                    </th>
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
                    data: {
                        jenis: jenis
                    },
                    success: function(data) {
                        $('#kategori').empty();
                        $('#kategori').append('<option value="">Pilih Kategori</option>');
                        $.each(data, function(key, value) {
                            $('#kategori').append('<option value="' + value.id + '">' + value
                                .nama_kategori + '</option>');
                        });
                    }
                });
            } else {
                $('#kategori').empty();
                $('#kategori').append('<option value="">Pilih Jenis Terlebih Dahulu</option>');
            }
        });
    </script>
@endpush
