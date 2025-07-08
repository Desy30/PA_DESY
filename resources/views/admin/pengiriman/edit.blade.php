@extends('layouting.guest.master')
@section('title', 'Edit Pengiriman')


@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Edit Pemasukan</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pemasukan') }}">Pemasukan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pengiriman.detail.update', $pengiriman->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="form-group">
                        <label for="BON">BON</label>
                        <input type="file" class="form-control" id="BON" name="bon" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class ="form-group">
                        <label for="total">Jumlah Uang</label>
                        <input type="number" class="form-control" id="total" name="total"
                            value="{{ $pengiriman->total }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
