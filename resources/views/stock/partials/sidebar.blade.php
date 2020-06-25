<div class="sidebar">
    <h1>SMS System</h1>
    <div class="logo">
        LOGO
    </div>
    <ul>
        @role('super-admin')
        <a href="/">
            <li>Konfigurasi</li>
        </a>
        @endrole
        <a href="/">
            <li>Dashboard </li>
            <i class="menu-icon fas fa-home" title="Dasbor"></i>

        </a>
        <a href="#" onclick="toggleDropdown()">
            <li>Manajemen Data <i class="arrows fas fa-angle-left"></i>

            </li>
            <i class="menu-icon fas fa-layer-group" title="Manajemen Data"></i>


        </a>
        <ul class="dropdown-data">
            <a href="{{ route('satuan-unit.index')}}">
                <li> Data Satuan Unit </li>
            </a>
            <a href="{{ route('kategori-barang.index')}}">
                <li> Data Kategori Barang </li>
            </a>
            <a href="{{ route('pemasok.index')}}">
                <li> Data Pemasok </li>
            </a>
            <a href="{{ route('gudang.index')}}">
                <li>Data Gudang </li>
            </a>
            <a href="{{ route('barang.index')}}">
                <li> Data Barang </li>
            </a>
        </ul>
        <a href="#" onclick="togglePenyesuaian()">
            <li>Penyesuaian Stok <i class="arrows fas fa-angle-left"></i></li>
            <i class="menu-icon fas fa-box-open" title="Penyesuaian Stok"></i>

        </a>
        <ul class="dropdown-penyesuaian">
            <li>Stok Masuk</li>
            <li>Stok Keluar</li>

        </ul>
        <a href="{{ route('stock-opname.index')}}">
            <li>Stok Opname</li>
            <i class="menu-icon fas fa-sync" title="Stok Opname"></i>

        </a>
        <a href="#">
            <li>Transfer Stok</li>
            <i class="menu-icon fas fa-truck" title="Transfer Stok"></i>

        </a>
        <a href="#" onclick="toggleLaporan()">
            <li>Laporan <i class="arrows fas fa-angle-left"></i></li>
            <i class="menu-icon fas fa-chart-bar" title="Laporan"></i>

        </a>
        <ul class="dropdown-laporan">
            <li>Laporan Kartu Stock</li>
            <li>Laporan Kartu Stock</li>
            <li>Laporan Kartu Stock</li>
            <li>Laporan Kartu Stock</li>
            <li>Laporan Kartu Stock</li>
        </ul>

        <a href="#" id="logout">
            <li>Logout </li>
            <i class="menu-icon fas fa-sign-out-alt">
            </i>

        </a>
    </ul>
</div>