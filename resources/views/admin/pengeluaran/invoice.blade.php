<!DOCTYPE html>
<html>
<head>
    <title>Bon Sawit</title>
    <style>
        @page {
            size: 58mm 180mm;
            margin: 0;
        }

        body {
            font-family: 'Courier New', monospace;
            font-size: 8px;
            line-height: 1.2;
            margin: 0;
            padding: 2mm;
            color: #000;
            width: 54mm;
        }

        .center { text-align: center; }
        .bold { font-weight: bold; }
        .line {
            border-top: 1px dashed #000;
            margin: 2mm 0;
        }

        .header {
            margin-bottom: 3mm;
        }

        .company-name {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 1mm;
        }

        .company-info {
            font-size: 7px;
            line-height: 1.2;
        }

        .info-row, .weight-row {
            display: flex;
            justify-content: space-between;
            font-size: 7px;
            margin-bottom: 1mm;
        }

        .total-section {
            background: #f0f0f0;
            padding: 1mm;
            margin: 2mm 0;
            text-align: center;
        }

        .total-amount {
            font-size: 9px;
            font-weight: bold;
        }

        .footer {
            margin-top: 2mm;
            font-size: 7px;
        }

        .thank-you {
            font-weight: bold;
            margin-bottom: 1mm;
        }

        /* TTD Section Styles */
        .tanda_terima {
        font-size: 8px;
        margin-top: 0.5mm;
        width: 100%;
    }

    .tanda_terima table {
        width: 100%;
        text-align: center;
    }

    .tanda_terima td {
        padding-top: 1mm;
        text-decoration: underline;
    }

    .ttd-label {
        font-weight: bold;
        margin-bottom: 2mm;
    }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header center">
        <div class="company-name">RAM SAWIT BINTANG</div>
        <div class="company-info">
            Jln. Lintas Duri-Pekanbaru No.48<br>
            NO HP 0813-6520-0370
        </div>
    </div>

    <div class="line"></div>

    <!-- Info Transaksi -->
    <div class="info-row">
        <span class="bold">Tanggal:</span>
        <span>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}</span>
    </div>
    <div class="info-row">
        <span class="bold">Petani:</span>
        <span>{{ optional($transaksi->petani)->nama_petani ?? '-' }}</span>
    </div>
    <div class="info-row">
        <span class="bold">No. Bon:</span>
        <span>#{{ str_pad($transaksi->id ?? '1', 3, '0', STR_PAD_LEFT) }}</span>
    </div>

    <div class="line"></div>

    <!-- Detail Berat -->
    <div class="weight-row">
        <span>Bruto:</span>
        <span>{{ number_format(optional($transaksi->transaksiSawit)->bruto ?? 0, 0, ',', '.') }} kg</span>
    </div>
    <div class="weight-row">
        <span>Tara:</span>
        <span>{{ number_format(optional($transaksi->transaksiSawit)->tara ?? 0, 0, ',', '.') }} kg</span>
    </div>
    <div class="weight-row">
        <span>Netto:</span>
        <span>{{ number_format(optional($transaksi->transaksiSawit)->netto ?? 0, 0, ',', '.') }} kg</span>
    </div>
    <div class="weight-row">
        <span>Potongan:</span>
        <span>{{ number_format(optional($transaksi->transaksiSawit)->potongan ?? 0, 0, ',', '.') }} kg</span>
    </div>
    <div class="weight-row bold" style="border-top: 1px solid #ccc; padding-top: 1mm;">
        <span>Berat Bersih:</span>
        <span>{{ number_format(optional($transaksi->transaksiSawit)->berat_bersih ?? 0, 0, ',', '.') }} kg</span>
    </div>

    <div class="line"></div>

    <!-- Harga -->
    <div class="weight-row">
        <span>Harga/kg:</span>
        <span>Rp {{ number_format(optional($transaksi->transaksiSawit)->harga ?? 0, 0, ',', '.') }}</span>
    </div>

    <!-- Total -->
    <div class="total-section">
        <div class="total-amount">
            TOTAL: Rp {{ number_format($transaksi->total ?? 0, 0, ',', '.') }}
        </div>
    </div>

    <div class="line"></div>

    <!-- Tanda Terima -->
    <div class="tanda_terima">
        <div class="ttd-title center bold">TANDA TERIMA</div>
        <table>
            <tr>
                <td><div class="ttd-label">Petani</div></td>
                <td><div class="ttd-label">Pemilik</div></td>
                <td><div class="ttd-label">Supir</div></td>
            </tr>
            <tr>
                <td>(...................)</td>
                <td>(...................)</td>
                <td>(...................)</td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div  class="line"></div>
    <div class="footer center">
        <div class="thank-you">--- TERIMA KASIH ---</div>
    </div>
</body>
</html>
