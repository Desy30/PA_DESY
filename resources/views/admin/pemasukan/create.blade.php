@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Pemasukan</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pemasukan') }}">Pemasukan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">

            <form method="POST" action="{{ route('pemasukan.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Sumber Pemasukan (Dropdown) -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="sumber_pemasukan">Sumber Pemasukan</label>
                    <select class="form-control" id="sumber_pemasukan" name="sumber_pemasukan">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $item)
                            <option value="{{ $item->tipe_form . '.' . $item->id }}"
                                {{ old('sumber_pemasukan') == $item->tipe_form ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Bagian Penjualan Sawit -->
                <div id="penjualan_sawit" style="display: none;">
                    <div class="row">
                        <!-- Kolom kiri: Tanggal & Pembayaran -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal_sawit"
                                    value="{{ old('tanggal') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="metode_pembayaran">Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                    <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>
                                        Transfer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Berat Bersih & Pilih PKS -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="berat_bersih">Berat Bersih (kg)</label>
                                <input type="number" class="form-control" id="berat_bersih" name="berat_bersih"
                                    placeholder="Jumlah sawit yang diantar" value="{{ old('berat_bersih') }}">
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="id_pks">PKS</label>
                            <select class="form-control" id="id_pks" name="id_pks">
                                <option value="" {{ old('id_pks') == '' ? 'selected' : '' }}>-- Pilih PKS --</option>
                                @foreach ($pks as $dataPks)
                                    <option value="{{ $dataPks->id }}"
                                        {{ old('id_pks') == $dataPks->id ? 'selected' : '' }}>
                                        {{ $dataPks->nama_pks }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Surat Pengantar & BON -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_pengantar">Surat Pengantar</label>
                                <input type="file" class="form-control" id="surat_pengantar" name="surat_pengantar"
                                    value="{{ old('surat_pengantar') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="BON">BON</label>
                                <input type="file" class="form-control" id="BON" name="bon"
                                    value="{{ old('BON') }}">
                            </div>
                        </div>
                        <!-- Jumlah Uang -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="total">Jumlah Uang</label>
                                <input type="number" class="form-control" id="total" name="total_sawit"
                                    placeholder="Jumlah uang" value="{{ old('total') }}">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Bagian Penjualan Pupuk -->
                <div id="penjualan_pupuk" style="display:none;">
                    <div class="form-group">
                        <label for="id_petani">Pilih Petani</label>
                        <select class="form-control" id="id_petani" name="id_petani">
                            <option value="">-- Pilih Petani --</option>
                            @foreach ($petanis as $petani)
                                <option value="{{ $petani->id }}"
                                    {{ old('id_petani') == $petani->id ? 'selected' : '' }}>
                                    {{ $petani->nama_petani }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_pupuk">Tanggal Penjualan</label>
                        <input type="date" class="form-control" id="tanggal_pupuk" name="tanggal_pupuk"
                            value="{{ old('tanggal_pupuk') }}">
                    </div>

                    <!-- Input utama dalam row -->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="id_barang">Jenis Pupuk</label>
                                <select class="form-control" id="id_barang" name="id_barang">
                                    <option value="">-- Pilih Jenis Pupuk --</option>
                                    @foreach ($barangs as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('id_barang') == $item->nama_barang ? 'selected' : '' }}>
                                            {{ $item->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_pupuk">Jumlah Pupuk (kg/sak)</label>
                                <input type="number" class="form-control" id="jumlah_pupuk" name="jumlah_pupuk"
                                    placeholder="Jumlah pupuk yang dijual" value="{{ old('jumlah_pupuk') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="harga_perunit">Harga per Unit</label>
                                <input type="number" class="form-control" id="harga_perunit" name="harga_perunit"
                                    placeholder="Harga per satuan pupuk" value="{{ old('harga_perunit') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="total_pupuk">Total Harga</label>
                                <input type="number" class="form-control" id="total_pupuk" name="total_pupuk"
                                    placeholder="Total uang penjualan" value="{{ old('total_pupuk') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                            <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash
                            </option>
                            <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>
                                Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bukti_transaksi_pupuk">Bukti Transaksi</label>
                        <input type="file" class="form-control" id="bukti_transaksi_pupuk"
                            name="bukti_transaksi_pupuk" accept="image/*,application/pdf">
                    </div>
                </div>


                <!-- Bagian Sewa Timbangan -->
                <div id="sewa_timbangan" style="display: none;">
                    <div class="row">
                        <!-- Input Nama -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ old('nama') }}" placeholder="Masukkan Nama">
                            </div>
                        </div>

                        <!-- Input Tanggal Penimbangan -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tanggal_timbangan">Tanggal Penimbangan</label>
                                <input type="date" class="form-control" id="tanggal_timbangan"
                                    name="tanggal_timbangan" value="{{ old('tanggal_timbangan') }}"
                                    placeholder="Masukkan Tanggal">
                            </div>
                        </div>
                    </div>
                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                            <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash
                            </option>
                            <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>
                                Transfer</option>
                        </select>
                    </div>
                    <!-- Total Biaya -->
                    <div class="form-group">
                        <label for="total_timbangan">Total Biaya</label>
                        <input type="number" class="form-control" id="total_timbangan" name="total_timbangan"
                            value="{{ old('total_timbangan') }}" placeholder="Masukkan Total Biaya">
                    </div>
                    <!-- Bukti Pembayaran -->
                    <div class="form-group">
                        <label for="bukti_transaksi_timbangan">Bukti Pembayaran</label>
                        <input type="file" class="form-control-file" id="bukti_transaksi_timbangan"
                            name="bukti_transaksi_timbangan" accept="image/*,application/pdf">
                    </div>


                </div>

                {{-- Default --}}
                <div id="default" style="display: none;">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tanggal_default">Tanggal </label>
                                <input type="date" class="form-control" id="tanggal_default" name="tanggal_default"
                                    value="{{ old('tanggal_default') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan"
                                    value="{{ old('keterangan') }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bukti_transaksi_default">Bukti Transaksi</label>
                                <input type="file" class="form-control" id="bukti_transaksi_default"
                                    name="bukti_transaksi_default" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class ="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                    <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="transfer"
                                        {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>
                                        Transfer</option>
                                </select>
                            </div>
                        </div>
                        <!-- Jumlah (Input Number) -->
                        <div class="form-group">
                            <label for="total_default">Jumlah (Rp)</label>
                            <input type="number" class="form-control" id="total_default" name="total_default"
                                value="{{ old('total_default') }}">
                        </div>
                    </div>
                </div>
                <!-- Tombol Batal dan Simpan -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pemasukan') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Fungsi untuk menangani perubahan pada sumber pemasukan
        $("#sumber_pemasukan").change(function() {
            var sumberPemasukan = $(this).val();

            var sumberPemasukan = sumberPemasukan.split('.')[0]

            // Sembunyikan semua bagian form terlebih dahulu
            $("#penjualan_sawit").hide();
            $("#penjualan_pupuk").hide();
            $("#sewa_timbangan").hide();
            $("#default").hide();

            // Sesuaikan tampilan berdasarkan sumber pemasukan yang dipilih
            if (sumberPemasukan === "penjualan_sawit") {
                $("#penjualan_sawit").show();
            } else if (sumberPemasukan === "penjualan_pupuk") {
                $("#penjualan_pupuk").show();
            } else if (sumberPemasukan === "sewa_timbangan") {
                $("#sewa_timbangan").show();
            } else if (sumberPemasukan === "default") {
                $("#default").show();
            }
        });

        // Jalankan fungsi saat halaman pertama kali dimuat
        $(document).ready(function() {
            var sumberPemasukan = $("#sumber_pemasukan").val();
            var sumberPemasukan = sumberPemasukan.split('.')[0]

            if (sumberPemasukan === "penjualan_sawit") {
                $("#penjualan_sawit").show();
            } else if (sumberPemasukan === "penjualan_pupuk") {
                $("#penjualan_pupuk").show();
            } else if (sumberPemasukan === "sewa_timbangan") {
                $("#sewa_timbangan").show();
            } else if (sumberPemasukan === "default") {
                $("#default").show();
            }
        });
    </script>
@endpush
