@extends('layouting.guest.master')

@section('title', 'Pengiriman')
@section('content')
    <div class="card-box mb-30">
        <div class="pd-20 d-flex justify-content-between align-items-center">
            <h4 class="text-blue h4">Data Pengiriman</h4>
        </div>

        {{-- FILTER STATUS PENGIRIMAN --}}
        <div class="px-3 mb-3">
            <form method="GET" class="form-inline">
                <label for="status_pengiriman" class="mr-2">Filter Status:</label>
                <select name="status_pengiriman" id="status_pengiriman" class="form-control w-auto mr-2"
                    onchange="this.form.submit()">
                    <option value="Semua" {{ request('status_pengiriman') == 'Semua' ? 'selected' : '' }}>Semua</option>
                    <option value="Menunggu" {{ request('status_pengiriman') == 'Menunggu' ? 'selected' : '' }}>Menunggu
                    </option>
                    <option value="Terkirim" {{ request('status_pengiriman') == 'Terkirim' ? 'selected' : '' }}>Terkirim
                    </option>
                    <option value="Selesai" {{ request('status_pengiriman') == 'Selesai' ? 'selected' : '' }}>Selesai
                    </option>
                </select>
            </form>
        </div>

        <div class="pb-20">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Status Pengiriman</th>
                        @role('kasir')
                        <th>Aksi</th>
                      @endrole
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->tanggal }}</td>
                            <td>{{ $t->kategori->nama_kategori ?? '-' }}</td>
                            <td>
                                @php
                                    $badgeClass = match ($t->status_pengiriman) {
                                        'Menunggu' => 'badge-danger',
                                        'Terkirim' => 'badge-warning',
                                        'Selesai' => 'badge-success',
                                        default => 'badge-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ $t->status_pengiriman }}
                                </span>
                            </td>
                            <td>
                                @role('kasir')
                                @hasallroles('pemilik')
                                    @if ($t->status_pengiriman == 'Menunggu')
                                        🔴 Menunggu
                                    @elseif ($t->status_pengiriman == 'Terkirim')
                                        🟡 Terkirim
                                    @else
                                        🟢 Selesai
                                    @endif
                                @else
                                    <form action="{{ route('pengiriman.update', $t->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="input-group">
                                            <select name="status_pengiriman" class="custom-select form-control"
                                                onchange="this.form.submit()">
                                                <option disabled selected>Ubah Status</option>
                                                <option value="Menunggu"
                                                    {{ $t->status_pengiriman == 'Menunggu' ? 'selected' : '' }}>🔴 Menunggu
                                                </option>
                                                <option value="Terkirim"
                                                    {{ $t->status_pengiriman == 'Terkirim' ? 'selected' : '' }}>🟡 Terkirim
                                                </option>
                                                <option value="Selesai"
                                                    {{ $t->status_pengiriman == 'Selesai' ? 'selected' : '' }}>🟢 Selesai
                                                </option>
                                            </select>
                                        </div>
                                    </form>

                                @endhasanyrole
                                @endrole
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data pengiriman untuk status tersebut.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
