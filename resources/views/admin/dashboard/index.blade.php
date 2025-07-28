@extends('layouting.guest.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid py-4">

        <div class="page-header mb-3">
            <div class="title">
                <h4>Dashboard</h4>
            </div>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-success p-3 rounded-circle">
                            <i class="bi bi-cash-stack fs-4 text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Pemasukan</small>
                            <h5 class="mb-0">Rp {{ number_format($totalPemasukan) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-danger p-3 rounded-circle">
                            <i class="bi bi-wallet2 fs-4 text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Pengeluaran</small>
                            <h5 class="mb-0">Rp {{ number_format($totalPengeluaran) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-info p-3 rounded-circle">
                            <i class="bi bi-globe-asia-australia fs-4 text-white"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Ton</small>
                            <h5 class="mb-0">{{ number_format($selisihBeratTon, 2) }} ton</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik --}}
        <form action="" method="GET" id="filter-form">
            <div class="row g-4">
                <!-- PEMASUKAN -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="pd-20 d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Pemasukan</h6>
                            <select name="pemasukan" class="form-control" id="filter-pemasukan" style="width: 150px;">
                                <option value="year" {{ request('pemasukan') == 'year' ? 'selected' : '' }}>Tahunan</option>
                                <option value="month" {{ request('pemasukan') == 'month' ? 'selected' : '' }}>Bulanan</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <canvas id="pemasukanChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- PENGELUARAN -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="pd-20 d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Pengeluaran</h6>
                            <select name="pengeluaran" class="form-control" id="filter-pengeluaran" style="width: 150px;">
                                <option value="year" {{ request('pengeluaran') == 'year' ? 'selected' : '' }}>Tahunan</option>
                                <option value="month" {{ request('pengeluaran') == 'month' ? 'selected' : '' }}>Bulanan
                                </option>
                            </select>
                        </div>
                        <div class="card-body">
                            <canvas id="pengeluaranChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Terbaru --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Riwayat Transaksi Terbaru</h6>
                        <form action="" method="GET" id="form-transaksi">
                            <select name="transaksi" class="form-control" id="transaksi" style="width: 150px;"
                                onchange="document.getElementById('form-transaksi').submit()">
                                <option value="all" {{ request('transaksi') == 'all' ? 'selected' : '' }}>
                                    Semua</option>
                                <option value="pemasukan" {{ request('transaksi') == 'pemasukan' ? 'selected' : '' }}>
                                    Pemasukan</option>
                                <option value="pengeluaran" {{ request('transaksi') == 'pengeluaran' ? 'selected' : '' }}>
                                    Pengeluaran</option>
                            </select>
                        </form>

                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksiTerbaru as $i => $trx)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ ucfirst($trx->kategori->nama_kategori) }}</td>
                                        <td>Rp {{ number_format($trx->total) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // getElementById berfungsi mengambil elemen dengan id (..)
        //.addEventListener[] dalah fungsi saat isi dropdown
        document.getElementById('filter-pemasukan').addEventListener('change', function () {
            document.getElementById('filter-form').submit();//submit otomatis
        });

        document.getElementById('filter-pengeluaran').addEventListener('change', function () {
            document.getElementById('filter-form').submit();
        });
    </script>
    <script>
        // membuat grafik baru, datanya jika labels sumbu x isinya bulan atau tahun
        //jika data sumbu y isinya nilai total
        new Chart(document.getElementById('pemasukanChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($pemasukan->keys()) !!},
                datasets: [{
                    label: 'Pemasukan',
                    data: {!! json_encode($pemasukan->values()) !!},
                    backgroundColor: 'rgba(0, 200, 100, 0.6)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Pengeluaran Chart
        new Chart(document.getElementById('pengeluaranChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($pengeluaran->keys()) !!},
                datasets: [{
                    label: 'Pengeluaran',
                    data: {!! json_encode($pengeluaran->values()) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
@endsection
