@extends('layouting.guest.master')

@section('content')

@section('content')
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Form Tambah Pengiriman</h4>
    </div>
    <div class="pd-20">
        <form action="{{ route('pengiriman.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Transaksi</label>
                <select name="transaksi_id" class="form-control">
                    <option value="">-- Pilih Transaksi --</option>
                    @foreach ($transaksi as $t)
                        <option value="{{ $t->id }}">{{ $t->kode }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Menunggu">Menunggu</option>
                    <option value="Dikirim">Dikirim</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fa fa-save mr-1"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
