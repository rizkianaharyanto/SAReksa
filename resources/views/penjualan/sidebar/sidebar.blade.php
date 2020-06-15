<div class="sidebar" data-color="black" data-active-color="danger">
    <div class="logo">
        <a href="" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="">
            </div>
        </a>
        <a href="" class="simple-text logo-normal">
            {{ __('ADMIN PENJUALAN') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="/penjualan/">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src=""></i>
                    <p>
                            {{ __('Data Master') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'pelanggan' ? 'active' : '' }}">
                            <a href="/penjualan/pelanggans">
                                <span class="sidebar-mini-icon">{{ __('PL') }}</span>
                                <span class="sidebar-normal">{{ __(' Pelanggan ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'penjual' ? 'active' : '' }}">
                            <a href="/penjualan/penjuals">
                                <span class="sidebar-mini-icon">{{ __('PJ') }}</span>
                                <span class="sidebar-normal">{{ __(' Penjual ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'barang' ? 'active' : '' }}">
                            <a href="/stok/barangs">
                                <span class="sidebar-mini-icon">{{ __('B') }}</span>
                                <span class="sidebar-normal">{{ __(' Barang ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'gudang' ? 'active' : '' }}">
                            <a href="/stok/gudangs">
                                <span class="sidebar-mini-icon">{{ __('G') }}</span>
                                <span class="sidebar-normal">{{ __(' Gudang ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'akun' ? 'active' : '' }}">
                            <a href="/stok/akuns">
                                <span class="sidebar-mini-icon">{{ __('A') }}</span>
                                <span class="sidebar-normal">{{ __(' Akun ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'pajak' ? 'active' : '' }}">
                            <a href="/stok/pajaks">
                                <span class="sidebar-mini-icon">{{ __('P') }}</span>
                                <span class="sidebar-normal">{{ __(' Pajak ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'penawaran' ? 'active' : '' }}">
                <a href="/penjualan/penawarans">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Penawaran') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'pemesanan' ? 'active' : '' }}">
                <a href="/penjualan/pemesanans">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Pemesanan') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'pengiriman' ? 'active' : '' }}">
                <a href="/penjualan/pengirimans">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Pengiriman') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'faktur' ? 'active' : '' }}">
                <a href="/penjualan/fakturs">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Faktur') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'retur' ? 'active' : '' }}">
                <a href="/penjualan/returs">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Retur Penjualan') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'piutang' ? 'active' : '' }}">
                <a href="/penjualan/piutangs">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Piutang') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'pembayaran' ? 'active' : '' }}">
                <a href="/penjualan/pembayarans">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Pembayaran Piutang') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'jurnal' ? 'active' : '' }}">
                <a href="/penjualan/jurnals">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Jurnal') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>