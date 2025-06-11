<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('assets/guest/vendors/images/Peron.png') }}" alt="" class="light-logo" width="80"
                height="80">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('petani') }}" class="dropdown-toggle no-arrow">
                        <i class="micon dw dw-analytics-10" aria-hidden="true"></i>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>
                @hasanyrole('kasir')
                    <li>
                        <a href="{{ route('kategori') }}" class="dropdown-toggle no-arrow">
                            <i class="micon fa fa-tag" aria-hidden="true"></i>
                            <span class="mtext">Kelola Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('petani') }}" class="dropdown-toggle no-arrow">
                            <i class="micon fa fa-users" aria-hidden="true"></i>
                            <span class="mtext">Data Petani</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('barang') }}" class="dropdown-toggle no-arrow">
                            <i class="micon fa fa-archive" aria-hidden="true"></i>
                            <span class="mtext">Data Barang</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pks') }}" class="dropdown-toggle no-arrow">
                            <i class="micon fa fa-building" aria-hidden="true"></i>
                            <span class="mtext">Data PKS</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pupuk') }}" class="dropdown-toggle no-arrow">
                            <i class="micon fa fa-cogs" aria-hidden="true"></i>
                            <span class="mtext">Data Supplier Pupuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengiriman') }}" class="dropdown-toggle no-arrow">
                            <i class="micon fa fa-truck" aria-hidden="true"></i>
                            <span class="mtext">Pengiriman</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('dokumentasi') }}" class="dropdown-toggle no-arrow">
                            <i class="micon fa fa-folder-open" aria-hidden="true"></i>
                            <span class="mtext">Dokumentasi Surat</span>
                        </a>
                    </li>
                    @endhasanyrole

                @hasanyrole('pemilik')
                <li>
                    <a href="{{ route('karyawan') }}" class="dropdown-toggle no-arrow">
                        <i class="micon fa fa-user-plus" aria-hidden="true"></i>
                        <span class="mtext"> Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna') }}" class="dropdown-toggle no-arrow">
                        <i class="micon fa fa-user-plus" aria-hidden="true"></i>
                        <span class="mtext"> Pengguna</span>
                    </a>
                </li>

                @endhasanyrole

                <li>
                    <a href="{{ route('pemasukan') }}" class="dropdown-toggle no-arrow">
                        <i class="micon fa fa-arrow-right" aria-hidden="true"></i>
                        <span class="mtext">Pemasukkan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pengeluaran') }}" class="dropdown-toggle no-arrow">
                        <i class="micon fa fa-arrow-left" aria-hidden="true"></i>
                        <span class="mtext">Pengeluaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan') }}" class="dropdown-toggle no-arrow">
                        <i class="micon fa fa-file" aria-hidden="true"></i>
                        <span class="mtext">Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
