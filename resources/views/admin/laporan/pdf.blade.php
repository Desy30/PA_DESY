<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 20px;
        }

        h2, h4 {
            text-align: center;
            margin: 3px;
        }

        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th {
            background-color: #0d6efd; /* biru Bootstrap */
            color: white;
            padding: 6px;
            text-align: center;
            font-size: 10px;
        }

        td {
            border: 1px solid #999;
            padding: 6px;
            font-size: 10px;
        }

        tfoot th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .summary {
            text-align: center;
            font-weight: bold;
            background-color: #198754; /* hijau Bootstrap */
            color: white;
            padding: 8px;
            font-size: 11px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>PERON AM BINTANG</h2>
    <h4>Laporan Pemasukan dan Pengeluaran</h4>
    <div class="periode">
        Periode: {{ request('tanggal_awal') }} s/d {{ request('tanggal_akhir') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
            @endphp
            @foreach ($transaksis as $trx)
                @php
                    $jenis = $trx->kategori->jenis_kategori ?? '-';
                    $isPemasukan = $jenis === 'pemasukan';
                    $jumlah = $trx->total;
                @endphp
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/y') }}</td>
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
                <th colspan="3" class="text-center">TOTAL</th>
                <th class="text-right">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                <th class="text-right">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        Total: Rp{{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
    </div>
</body>
</html>
