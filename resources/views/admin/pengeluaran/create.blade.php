@extends('layouting.guest.master')
@section('title', 'Tambah Pengeluaran')


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
                        <option value="">-- Pilih Kategori --</option>
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
                                <input type="date" class="form-control" id="tanggal_sawit" name="tanggal_sawit" value="{{ old('tanggal_sawit') }}">
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

                        <!-- Bruto & Tara -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bruto">Bruto (kg)</label>
                                <input type="number" class="form-control" id="bruto" name="bruto" value="{{ old('bruto', 0) }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tara">Tara (kg)</label>
                                <input type="number" class="form-control" id="tara" name="tara" value="{{ old('tara', 0) }}">
                            </div>
                        </div>

                        <!-- Netto full width -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="netto">Netto</label>
                                <input type="number" class="form-control" id="netto" name="netto" value="{{ old('netto', 0) }}" disabled>
                            </div>
                        </div>

                        <!-- Jenis Potongan & Potongan in one row -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jenis_potongan">Jenis Potongan</label>
                                <select class="form-control" id="jenis_potongan" name="jenis_potongan">
                                    <option value="persentase" {{ old('jenis_potongan') == 'persen' ? 'selected' : '' }}>Persentase (%)</option>
                                    <option value="fix" {{ old('jenis_potongan') == 'fix' ? 'selected' : '' }}>Fix (kg)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="potongan_sawit">Potongan</label>
                                <input type="text" class="form-control" id="potongan_sawit" name="potongan_sawit" value="{{ old('potongan_sawit', 0) }}">
                            </div>
                        </div>

                        <!-- Jumlah Potongan full width -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jumlah_potongan">Jumlah Potongan (KG)</label>
                                <input type="number" class="form-control" id="jumlah_potongan" name="jumlah_potongan" value="{{ old('jumlah_potongan', 0) }}" disabled>
                            </div>
                        </div>

                        <!-- Harga per Kg -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="harga_per_kg">Harga per Kg (Rp)</label>
                                <input type="number" class="form-control" id="harga_per_kg" name="harga_per_kg" value="{{ old('harga_per_kg', 0) }}">
                            </div>
                        </div>

                        <!-- Berat Bersih & Total Harga -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="berat_bersih">Berat Bersih (kg)</label>
                                <input type="number" class="form-control" id="berat_bersih" name="berat_bersih" value="{{ old('berat_bersih', 0) }}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="total_harga_sawit">Total Transaksi (Rp)</label>
                                <input type="number" class="form-control" id="total_harga_sawit" name="total_harga_sawit" value="{{ old('total_harga_sawit', 0) }}" disabled>
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="metode_pembayaran_sawit">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran_sawit" name="metode_pembayaran_sawit">
                                    <option value="cash" {{ old('metode_pembayaran_sawit') == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="transfer" {{ old('metode_pembayaran_sawit') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Upload Bukti -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="bukti_transaksi_sawit">Upload Bukti Transaksi</label>
                                <input type="file" class="form-control" id="bukti_transaksi_sawit" name="bukti_transaksi_sawit" accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>
                </div>



                {{-- Kendaraan --}}

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
                                <label for="metode_pembayaran_kendaraan">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran_kendaraan"
                                    name="metode_pembayaran_kendaraan">
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="cash"
                                        {{ old('metode_pembayaran_kendaraan') == 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="transfer"
                                        {{ old('metode_pembayaran_kendaraan') == 'transfer' ? 'selected' : '' }}>Transfer
                                    </option>
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
                        <div class="col-md-12 mb-3">
                            <label for="tanggal_gaji">Tanggal Gaji</label>
                            <input type="date" class="form-control" id="tanggal_gaji" name="tanggal_gaji"
                                value="{{ old('tanggal_gaji') }}">
                        </div>



                        <!-- Nama Karyawan -->
                        <div class="col-md-6 mb-3">
                            <label for="id_karyawan">Pilih Karyawan</label>
                            <select id="id_karyawan" class="form-control" name="id_karyawan">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}" data-gaji="{{ $karyawan->gaji }}">
                                        {{ $karyawan->nama_karyawan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gaji">Gaji</label>
                                <input type="text" class="form-control" id="gaji" name="gaji"
                                    placeholder="Masukkan atau ubah gaji" readonly>
                                    {{-- readonly->agar kasir hanya bisa lihat hasil inputan dari pemilik --}}
                            </div>
                        </div>

                        <!-- Tunjangan -->
                        <div class="col-md-6 mb-3">
                            <label for="tunjangan">Tunjangan</label>
                            <input type="number" class="form-control" id="tunjangan" name="tunjangan"
                                value="{{ old('tunjangan') }}">
                        </div>

                        <!-- Potongan -->
                        <div class="col-md-6 mb-3">
                            <label for="potongan_gaji">Potongan</label>
                            <input type="number" class="form-control" id="potongan_gaji" name="potongan_gaji"
                                value="{{ old('potongan_gaji') }}">
                        </div>

                        <!-- Total Gaji -->
                        <div class="col-md-6 mb-3">
                            <label for="total_gaji">Total Gaji</label>
                            <input type="number" class="form-control" id="total_gaji" name="total_gaji"
                                value="{{ old('total_gaji') }}">
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-md-6 mb-3">
                            <label for="metode_pembayaran_gaji">Metode Pembayaran</label>
                            <select class="form-control" id="metode_pembayaran_gaji" name="metode_pembayaran_gaji">
                                <option value="">-- Pilih Metode --</option>
                                <option value="cash" {{ old('metode_pembayaran_gaji') == 'cash' ? 'selected' : '' }}>
                                    Cash
                                </option>
                                <option value="transfer"
                                    {{ old('metode_pembayaran_gaji') == 'transfer' ? 'selected' : '' }}>
                                    Transfer</option>
                            </select>
                        </div>

                        <!-- Upload Bukti -->
                        <div class="col-md-12 mb-3">
                            <label for="bukti_transaksi_gaji">Bukti Transaksi</label>
                            <input type="file" class="form-control" id="bukti_transaksi_gaji"
                                name="bukti_transaksi_gaji" accept="image/*,application/pdf">
                        </div>
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
                                    name="bukti_transaksi_default" accept="image/*,application/pdf">

                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class ="form-group">
                                <label for="metode_pembayaran_default">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran_default" name="metode_pembayaran_default">
                                    <option value="cash" {{ old('metode_pembayaran_default') == 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="transfer"
                                        {{ old('metode_pembayaran_default') == 'transfer' ? 'selected' : '' }}>
                                        Transfer</option>
                                </select>
                            </div>
                        </div>
                        <!-- Jumlah (Input Number) -->
                        <div class="col-12">
                        <div class="form-group">
                            <label for="total_default">Jumlah (Rp)</label>
                            <input type="number" class="form-control" id="total_default" name="total_default"
                                value="{{ old('total_default') }}">
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Save dan Print -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pengeluaran') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success ml-2" id="btn-save">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleForm() {
            var sumberPengeluaran = $("#sumber_pengeluaran").val();
            var sumberPengeluaran = sumberPengeluaran.split('.')[0]

            $("#pembelian_sawit").hide();
            $("#kendaraan_operasional").hide();
            $("#pengeluaran_gaji").hide();
            $("#default").hide();

            $("#btn-save").text('Simpan');
            if (sumberPengeluaran.startsWith("pembelian_sawit")) {
                $("#pembelian_sawit").show();
                $("#btn-save").text('Simpan + Cetak');

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


        $(document).ready(function() {
            var inputBruto = $('#bruto');
            var inputTara = $('#tara');
            var inputNetto = $('#netto');
            var inputJenisPotongan = $("#jenis_potongan")
            var inputPotongan = $("#potongan_sawit")
            var inputJumlahPotongan = $("#jumlah_potongan")
            var inputBeratBersih = $("#berat_bersih")
            var inputHargaPerKilo = $("#harga_per_kg")
            var inputHargaTotalSawit = $("#total_harga_sawit")

            function hitungSeluruh() {
                var valBruto = parseInt(inputBruto.val());
                var valTara = parseInt(inputTara.val());
                var netto = valBruto - valTara;
                inputNetto.val(netto);

                var intValPotongan = parseInt(inputPotongan.val())
                var valJenisPotongan = inputJenisPotongan.val()

                var jumlahAkhirPotongan = 0

                if (valJenisPotongan == 'persentase') {
                    jumlahAkhirPotongan = netto - (netto * intValPotongan / 100)
                } else {
                    jumlahAkhirPotongan = netto - intValPotongan
                }

                var nilaiTotalPotongan = Math.round(netto - jumlahAkhirPotongan)
                inputJumlahPotongan.val(nilaiTotalPotongan)

                var nilaiBeratBersih = Math.round(netto - nilaiTotalPotongan)
                inputBeratBersih.val(nilaiBeratBersih)

                var valHargaPerKilo = parseInt(inputHargaPerKilo.val())
                var nilaiHargaTotalSawit = nilaiBeratBersih * valHargaPerKilo

                inputHargaTotalSawit.val(nilaiHargaTotalSawit)
            }

            inputBruto.on('input', function() {
                hitungSeluruh();
            })

            inputTara.on('input', function() {
                hitungSeluruh();
            })


            inputJenisPotongan.change(function() {
                hitungSeluruh();
            })

            inputPotongan.on('input', function() {
                hitungSeluruh();
            })

            inputHargaPerKilo.on('input', function() {
                hitungSeluruh();
            })
        })
        $(document).ready(function() {
            // Ambil elemen input
            const inputGaji = document.getElementById('gaji');
            const inputTunjangan = document.getElementById('tunjangan');
            const inputPotonganGaji = document.getElementById('potongan_gaji');
            const inputTotal = document.getElementById('total_gaji');

            // Fungsi untuk menghitung total gaji
            function hitungTotalGaji() {
                const gaji = parseFloat(inputGaji.value) || 0;
                const tunjangan = parseFloat(inputTunjangan.value) || 0;
                const potongan = parseFloat(inputPotonganGaji.value) || 0;

                const total = gaji + tunjangan - potongan;
                inputTotal.value = total;
            }

            // Pasang listener untuk perubahan input
            [inputGaji, inputTunjangan, inputPotonganGaji].forEach(input => {
                input.addEventListener('input', hitungTotalGaji);
            });

            // Saat karyawan dipilih, isi gaji otomatis
            $('#id_karyawan').on('change', function() {
                const selected = this.options[this.selectedIndex];
                const gaji = selected.getAttribute('data-gaji');

                if (gaji) {
                    inputGaji.value = gaji;
                } else {
                    inputGaji.value = '';
                }

                hitungTotalGaji(); // hitung ulang setelah gaji terisi
            });
        });
    </script>
@endpush
