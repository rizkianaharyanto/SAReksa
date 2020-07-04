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
                        <a class="nav-link active" id="link-dashboard" href="/stok"><i
                                class="fa fa-fw fa-user-circle"></i>Dashboard</a>

                    </li>
                    @if(auth()->user()->role->role_name == 'Admin Gudang')

                    <li class="nav-item">
                        <a class="nav-link" id="link-manajemen-data" href="#" data-toggle="collapse"
                            aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i
                                class="fa fa-fw fa-rocket"></i>Manajemen Data</a>

                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" id="link-satuan-unit"
                                        href="{{route('satuan-unit.index')}}">Satuan Unit <span
                                            class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="link-kategori-barang"
                                        href="{{ route('kategori-barang.index')}}">Kategori Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="link-pemasok"
                                        href="/stok/Management-Data/pemasok">Pemasok</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="link-gudang" href="{{ route('gudang.index')}}">Gudang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="link-barang" href="{{ route('barang.index')}}">Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('pajak.index')}}">Pajak</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(auth()->user()->role->role_name == 'Operator Gudang')
                    <li class="nav-divider">
                        Transaksi
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="link-stok-opname" href="{{route('stock-opname.index')}}"><i
                                class="fas fa-fw fa-file"></i> Stok Opname
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="link-transfer-stock" href="{{route('transfer-stock.index')}}"><i
                                class="fas fa-fw fa-file"></i>
                            Transfer Stok
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="link-penyesuaian-stok" href="{{route('penyesuaian-stock.index')}}"><i
                                class="fas fa-fw fa-file"></i> Penyesuaian Stok
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
                    @endif
                    @if(auth()->user()->role->role_name == 'Admin Gudang' && auth()->user()->role->role_name == 'Direksi
                    Perusahaan')

                    <li class="nav-divider">
                        Laporan
                    </li>
                    @endif

                </ul>
            </div>
        </nav>
    </div>
</div>