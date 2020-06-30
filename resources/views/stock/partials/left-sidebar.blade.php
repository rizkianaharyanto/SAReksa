<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="/stok"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-2" aria-controls="submenu-2"><i
                                class="fa fa-fw fa-rocket"></i>Manajemen Data</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('satuan-unit.index')}}">Satuan Unit <span
                                            class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('kategori-barang.index')}}">Kategori Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/stok/Management-Data/pemasok">Pemasok</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('gudang.index')}}">Gudang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('barang.index')}}">Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pajak</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-divider">
                        Transaksi
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('stock-opname.index')}}"><i class="fas fa-fw fa-file"></i> Stok Opname
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-fw fa-file"></i> Transfer Stok
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-fw fa-file"></i> Penyesuaian Stok
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-fw fa-file"></i> Stok Masuk
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-fw fa-file"></i> Stok Keluar
                        </a>

                    </li>
                    <li class="nav-divider">
                        Laporan
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>