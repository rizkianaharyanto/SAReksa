<div class="side">
    <!-- include('sidebar.bar') -->
    <div id="nav" class="nav">
        <!-- <div class="item" onclick="collapseNav()">
                <i class="fas fa-pizza-slice"></i>
            </div> -->

        <div class="item">
            <i onclick="collapseNav()" class="fas fa-th-large"></i>
            <span>
                <a href="/pembelian/">Dashboard</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-database"></i>
            <span>
                <a class="dropdown-toggle" data-toggle="collapse" href="#drop" role="button" aria-expanded="false">
                    Manajemen Data
                </a>
                <ul class="collapse list-unstyled" id="drop">
                        <li class="pt-2">
                            <a href="/pembelian/pemasoks">Data Pemasok</a>
                        </li>
                        <li class="pt-2">
                            <a href="/pembelian/pengirims">Data Pengirim</a>
                        </li>
                        <li class="pt-2">
                            <a href="/pembelian/barangs">Data Barang</a>
                        </li>
                        <li class="pt-2">
                            <a href="/pembelian/gudangs">Data Gudang</a>
                        </li>
                        <li class="pt-2">
                            <a href="/pembelian/akuns">Data Akun</a>
                        </li>
                        <li class="pt-2">
                            <a href="/pembelian/pajaks">Data Pajak</a>
                        </li>
                </ul>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-envelope-open-text"></i>
            <span>
                <a href="/pembelian/permintaans">Permintaan Penawaran Harga</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-boxes"></i>
            <span>
                <a href="/pembelian/pemesanans">Pemesanan</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-shipping-fast"></i>
            <span>
                <a href="/pembelian/penerimaans">Penerimaan Barang</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-clipboard-check"></i>
            <span>
                <a href="/pembelian/fakturs">Faktur</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-exchange-alt"></i>
            <span>
                <a href="/pembelian/returs">Retur Pembelian</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-file-invoice-dollar"></i>
            <span>
                <a href="/pembelian/hutangs">Hutang</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-hand-holding-usd"></i>
            <span>
                <a href="/pembelian/pembayarans">Pembayaran Hutang</a>
            </span>
        </div>
        <div class="item">
            <i onclick="collapseNav()" class="fas fa-file-alt"></i>
            <span>
                <a href="/pembelian/jurnals">Jurnal</a>
            </span>
        </div>
    </div>
</div>

<script>
    // document.getElementById('nav').classList.remove('collapsed');
    const collapseNav = () => {
        document.getElementById('nav').classList.toggle('collapsed');
        // document.getElementById('isi').classList.add('collapsed');
    }
</script>