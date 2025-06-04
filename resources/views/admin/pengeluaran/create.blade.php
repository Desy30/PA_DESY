@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Pengeluaran</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengeluaran') }}">Pengeluaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <form method="POST" action="{{ route('pengeluaran.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Sumber Pengeluaran (Dropdown) -->
                <div class="form-group">
                    <label for="sumber_pengeluaran">Sumber Pengeluaran</label>
                    <select class="form-control" id="sumber_pengeluaran" name="sumber_pengeluaran">
                        @foreach ($kategoris as $item)
                            <option value="{{ $item->tipe_form }}.{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- PEMBELIAN SAWIT --}}
                <div id="pembelian_sawit" style="display: none;">
                    <div class="row">
                        <!-- Tanggal & Petani -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tanggal_sawit">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_sawit" name="tanggal_sawit"
                                    value="{{ old('tanggal_sawit') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="id_petani">Pilih Petani</label>
                                <select class="form-control" id="id_petani" name="id_petani">
                                    <option value="">-- Pilih Petani --</option>
                                    @foreach ($petanis as $petani)
                                        <option value="{{ $petani->id }}">{{ $petani->nama_petani }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Bruto & Potongan -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bruto">Bruto (kg)</label>
                                <input type="number" class="form-control" id="bruto" name="bruto"
                                    value="{{ old('bruto') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="potongan">Potongan (kg)</label>
                                <input type="number" class="form-control" id="potongan" name="potongan"
                                    value="{{ old('potongan') }}">
                            </div>
                        </div>

                        <!-- Berat Bersih & Harga -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="berat_bersih">Berat Bersih (kg)</label>
                                <input type="number" class="form-control" id="berat_bersih" name="berat_bersih"
                                    value="{{ old('berat_bersih') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga per Kg (Rp)</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    value="{{ old('harga') }}">
                            </div>
                        </div>

                        <!-- Netto & Total -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="netto">Netto (Rp)</label>
                                <input type="number" class="form-control" id="netto" name="netto"
                                    value="{{ old('netto') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="total_sawit">Total Transaksi (Rp)</label>
                                <input type="number" class="form-control" id="total_sawit" name="total_sawit"
                                    value="{{ old('total_sawit') }}">
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                    <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="transfer"
                                        {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Upload Bukti -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bukti_transaksi_sawit">Upload Bukti Transaksi</label>
                                <input type="file" class="form-control" id="bukti_transaksi_sawit"
                                    name="bukti_transaksi_sawit" accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>
                </div>



                <div id="kendaraan_operasional" style="display: none;">
                    <div class="row">
                        <!-- Tanggal -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tanggal_kendaraan">Tanggal Kendaraan</label>
                                <input type="date" class="form-control" id="tanggal_kendaraan"
                                    name="tanggal_kendaraan" value="{{ old('tanggal_kendaraan') }}">
                            </div>
                        </div>

                        <!-- Jenis Kendaraan -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <select class="form-control" id="jenis_kendaraan" name="jenis_kendaraan">
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil
                                    </option>
                                    <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor
                                    </option>
                                    <option value="truk" {{ old('jenis_kendaraan') == 'truk' ? 'selected' : '' }}>Truk
                                    </option>
                                    <option value="lainnya" {{ old('jenis_kendaraan') == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <!-- Jenis Pengeluaran -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                                <select class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran">
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="bahan_bakar"
                                        {{ old('jenis_pengeluaran') == 'bahan_bakar' ? 'selected' : '' }}>Bahan Bakar
                                    </option>
                                    <option value="servis" {{ old('jenis_pengeluaran') == 'servis' ? 'selected' : '' }}>
                                        Servis / Perawatan</option>
                                    <option value="ganti_oli"
                                        {{ old('jenis_pengeluaran') == 'ganti_oli' ? 'selected' : '' }}>Ganti Oli</option>
                                    <option value="ganti_ban"
                                        {{ old('jenis_pengeluaran') == 'ganti_ban' ? 'selected' : '' }}>Ganti Ban</option>
                                    <option value="pajak_asuransi"
                                        {{ old('jenis_pengeluaran') == 'pajak_asuransi' ? 'selected' : '' }}>Pajak /
                                        Asuransi</option>
                                    <option value="lainnya" {{ old('jenis_pengeluaran') == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="transfer"
                                        {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Upload Bukti Transaksi -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bukti_transaksi_kendaraan">Upload Bukti Transaksi</label>
                                <input type="file" class="form-control" id="bukti_transaksi_kendaraan"
                                    name="bukti_transaksi_kendaraan" accept="image/*,application/pdf">
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="keterangan_kendaraan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan_kendaraan"
                                    name="keterangan_kendaraan" placeholder="Masukkan keterangan"
                                    value="{{ old('keterangan_kendaraan') }}">
                            </div>
                        </div>

                        <!-- Total Biaya Kendaraan -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="total_kendaraan">Total Pengeluaran Kendaraan (Rp)</label>
                                <input type="number" class="form-control" id="total_kendaraan" name="total_kendaraan"
                                    placeholder="Jumlah pengeluaran kendaraan" value="{{ old('total_kendaraan') }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- GAJI --}}

                <div id="pengeluaran_gaji" style="display: none;">
                    <div class="row">
                        <!-- Tanggal Gaji -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_gaji">Tanggal Gaji</label>
                            <input type="date" class="form-control" id="tanggal_gaji" name="tanggal_gaji" value="{{ old('tanggal_gaji') }}">
                        </div>

                        <!-- Periode -->
                        <div class="col-md-6 mb-3">
                            <label for="periode">Periode</label>
                            <input type="month" class="form-control" id="periode" name="periode" value="{{ old('periode') }}">
                        </div>

                        <!-- Nama Karyawan -->
                        <div class="col-md-6 mb-3">
                            <label for="id_karyawan">Pilih Karyawan</label>
                            <select class="form-control" id="id_karyawan" name="id_karyawan">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($karyawans as $item)
                                    <option value="{{ $item->id }}" {{ old('id_karyawan') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_karyawan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tunjangan -->
                        <div class="col-md-6 mb-3">
                            <label for="tunjangan">Tunjangan</label>
                            <input type="number" class="form-control" id="tunjangan" name="tunjangan" value="{{ old('tunjangan') }}">
                        </div>

                        <!-- Potongan -->
                        <div class="col-md-6 mb-3">
                            <label for="potongan">Potongan</label>
                            <input type="number" class="form-control" id="potongan" name="potongan" value="{{ old('potongan') }}">
                        </div>

                        <!-- Total Gaji -->
                        <div class="col-md-6 mb-3">
                            <label for="total_gaji">Total Gaji</label>
                            <input type="number" class="form-control" id="total_gaji" name="total_gaji" value="{{ old('total_gaji') }}">
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-md-6 mb-3">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                <option value="">-- Pilih Metode --</option>
                                <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                            </select>
                        </div>

                        <!-- Upload Bukti -->
                        <div class="col-md-12 mb-3">
                            <label for="bukti_transaksi_gaji">Bukti Transaksi</label>
                            <input type="file" class="form-control" id="bukti_transaksi_gaji" name="bukti_transaksi_gaji" accept="image/*,application/pdf">
                        </div>
                    </div>
                </div>



                {{-- Default --}}
                <div id="default" style="display: none;">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="keterangan_default">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan_default"
                                    name="keterangan_default" placeholder="Masukkan keterangan"
                                    value="{{ old('keterangan_default') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bukti_transaksi_default">Bukti Transaksi</label>
                                <input type="file" class="form-control" id="bukti_transaksi_default"
                                    name="bukti_transaksi_default" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Save dan Print -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pengeluaran') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success ml-2">Simpan</button>
                    <button type="button" class="btn btn-secondary ml-2" id="btn-print">Print Transaksi</button>
                </div>

                <script>
                    document.getElementById('btn-print').addEventListener('click', function() {
                        // Contoh sederhana: print halaman saat ini
                        window.print();

                        // Kalau ingin print bagian tertentu atau membuka halaman print baru,
                        // sesuaikan script di sini sesuai kebutuhan.
                    });
                </script>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleForm() {
            var sumberPengeluaran = $("#sumber_pengeluaran").val();
            $("#pembelian_sawit").hide();
            $("#kendaraan_operasional").hide();
            $("#pengeluaran_gaji").hide();
            $("#default").hide();

            if (sumberPengeluaran.startsWith("pembelian_sawit")) {
                $("#pembelian_sawit").show();
            } else if (sumberPengeluaran.startsWith("kendaraan_operasional")) {
                $("#kendaraan_operasional").show();
            } else if (sumberPengeluaran.startsWith("pengeluaran_gaji")) {
                $("#pengeluaran_gaji").show();
            } else if (sumberPengeluaran.startsWith("default")) {
                $("#default").show();
            }
        }

        $(document).ready(function() {
            var oldSumber = $("#old_sumber_pengeluaran").val();
            if (oldSumber) {
                $("#sumber_pengeluaran").val(oldSumber);
            }
            toggleForm();
            $("#sumber_pengeluaran").change(toggleForm);
        });
    </script>
@endpush
