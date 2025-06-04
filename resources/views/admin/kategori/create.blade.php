@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Tambah Kategori</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kategori') }}">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <!-- Menampilkan pesan error atau success jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <!-- Input Jenis Kategori -->
                <div class="form-group">
                    <label for="jenis_kategori">Pilih Jenis Kategori</label>
                    <select class="form-control" name="jenis_kategori" id="jenis_kategori" required>
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>

                <!-- Input Nama Kategori -->
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        placeholder="Nama kategori.." required>
                </div>

                <!-- Input Jenis Pengiriman -->
                <div class="form-group" id="containerIsPengiriman">
                    <label for="is_pengiriman">Apakah memiliki status Pengiriman?</label>
                    <select class="form-control" name="is_pengiriman" id="is_pengiriman">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>


                <!-- Input Deskripsi Kategori -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi kategori.." required></textarea>
                </div>

                <!-- Tombol Simpan dan Batal -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('kategori') }}" class="btn btn-danger ml-2">Batal</a>
                    <button type="submit" class="btn btn-dark ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#jenis_kategori').on('change', function() {
                var jenisKategori = $(this).val();


                if (jenisKategori === 'pemasukan') {
                    $('#containerIsPengiriman').val('0');
                    $("#containerIsPengiriman").show();
                } else {
                    $("#containerIsPengiriman").hide();
                }
            });
        });
    </script>
@endpush
