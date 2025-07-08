@extends('layouting.guest.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">

    <h4 class="mb-4 fw-bold">Dashboard</h4>

    {{-- Ringkasan Data --}}
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
                        <h5 class="mb-0">{{ number_format($totalTon, 2) }} ton</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold">Pemasukan</h6>
                    <canvas id="pemasukanChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold">Pengeluaran</h6>
                    <canvas id="pengeluaranChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Terbaru --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Terbaru</h6>
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
                                <td>{{ ucfirst($trx->jenis) }}</td>
                                <td>Rp {{ number_format($trx->nominal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex gap-2 mt-2">
                        <span class="badge bg-success">Pemasukan</span>
                        <span class="badge bg-danger">Pengeluaran</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pemasukan Chart
    new Chart(document.getElementById('pemasukanChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($pemasukanBulanan->keys()) !!},
            datasets: [{
                label: 'Pemasukan',
                data: {!! json_encode($pemasukanBulanan->values()) !!},
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
            labels: {!! json_encode($pengeluaranBulanan->keys()) !!},
            datasets: [{
                label: 'Pengeluaran',
                data: {!! json_encode($pengeluaranBulanan->values()) !!},
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
