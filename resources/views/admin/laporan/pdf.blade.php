<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h4 { text-align: center; margin-bottom: 5px; }
        h5 { margin-top: 20px; font-size: 14px; }
        p { font-size: 12px; margin: 4px 0; }
        .info { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; page-break-inside: avoid; }
        th, td { border: 1px solid #444; padding: 6px 8px; }
        th { background-color: #0d6efd; color: #fff; }
        tr:nth-child(even) td { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .section { margin-top: 20px; }
        .total-row th, .total-row td { font-weight: bold; background-color: #e9ecef; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <h2><center>PERON AM BINTANG</center></h2>
        <h3><center>LAPORAN KEUANGAN</center></h3>
    </div>
    <div class="info">
        <p>Periode: {{ $tanggal_awal ?? '-' }} s/d {{ $tanggal_akhir ?? '-' }}</p>
        <p>Jenis: {{ $jenis ? ucfirst($jenis) : 'Semua' }}
        @if($kategori_id)
            — Kategori: {{ App\Models\KategoriModel::find($kategori_id)->nama_kategori }}
        @endif
        </p>
    </div>

    @php
        $jenisFilter = $jenis ?? null;
    @endphp

    @if(!$jenisFilter || $jenisFilter == 'pemasukan')
    <div class="section">
        @php
            $totalP = 0;
            $noP = 1;
        @endphp
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width:5%">No</th>
                    <th style="width:20%">Tanggal</th>
                    <th style="width:55%">Kategori</th>
                    <th class="text-end" style="width:20%">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis->where('kategori.jenis_kategori','pemasukan') as $trx)
                    @php
                        $totalP += $trx->total;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $noP++ }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $trx->kategori->nama_kategori }}</td>
                        <td class="text-end">Rp{{ number_format($trx->total,0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-center">Total Pemasukan</td>
                    <td class="text-end">Rp{{ number_format($totalP,0,',','.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endif

    @if(!$jenisFilter || $jenisFilter == 'pengeluaran')
    <div class="section {{ $jenisFilter == 'pemasukan' ? 'page-break' : '' }}">
        @php
            $totalK = 0;
            $noK = 1;
        @endphp
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width:5%">No</th>
                    <th style="width:20%">Tanggal</th>
                    <th style="width:55%">Kategori</th>
                    <th class="text-end" style="width:20%">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis->where('kategori.jenis_kategori','pengeluaran') as $trx)
                    @php
                        $totalK += $trx->total;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $noK++ }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $trx->kategori->nama_kategori }}</td>
                        <td class="text-end">Rp{{ number_format($trx->total,0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-center">Total Pengeluaran</td>
                    <td class="text-end">Rp{{ number_format($totalK,0,',','.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endif
</body>
</html>
