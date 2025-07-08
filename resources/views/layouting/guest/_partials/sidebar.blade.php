<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('assets/guest/images/logo.png') }}" alt="Logo" class="light-logo" style="width: 150%; max-width: 230px; height: auto; margin-left: 7px; display: block;">

        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow">
                        <i class="micon dw dw-analytics-10" aria-hidden="true"></i>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>
                @hasanyrole('kasir')
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="micon fa fa-database" aria-hidden="true"></i>
                            <span class="mtext">Master Data</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('kategori') }}">Kelola Kategori</a></li>
                            <li><a href="{{ route('petani') }}">Data Petani</a></li>
                            <li><a href="{{ route('barang') }}">Data Barang</a></li>
                            <li><a href="{{ route('pks') }}">Data PKS</a></li>
                            <li><a href="{{ route('pupuk') }}">Data Supplier Pupuk</a></li>
                        </ul>
                    </li>
                @endhasanyrole

                <li>
                    <a href="{{ route('pengiriman') }}"
                        class="dropdown-toggle no-arrow {{ isRouteActive('pengiriman') }}">
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
                @hasanyrole('pemilik')
                    <li>
                        <a href="{{ route('karyawan') }}"
                            class="dropdown-toggle no-arrow {{ isRouteActive('karyawan') }}">
                            <i class="micon fa fa-user-plus" aria-hidden="true"></i>
                            <span class="mtext"> Karyawan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengguna') }}"
                            class="dropdown-toggle no-arrow {{ isRouteActive('pengguna') }}">
                            <i class="micon fa fa-user-plus" aria-hidden="true"></i>
                            <span class="mtext"> Pengguna</span>
                        </a>
                    </li>
                @endhasanyrole

                <li>
                    <a href="{{ route('pemasukan') }}"
                        class="dropdown-toggle no-arrow {{ isRouteActive('pemasukan') }}">
                        <i class="micon fa fa-arrow-right" aria-hidden="true"></i>
                        <span class="mtext">Pemasukkan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pengeluaran') }}"
                        class="dropdown-toggle no-arrow {{ isRouteActive('pengeluaran') }}">
                        <i class="micon fa fa-arrow-left" aria-hidden="true"></i>
                        <span class="mtext">Pengeluaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan') }}" class="dropdown-toggle no-arrow {{ isRouteActive('laporan') }}">
                        <i class="micon fa fa-file" aria-hidden="true"></i>
                        <span class="mtext">Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
