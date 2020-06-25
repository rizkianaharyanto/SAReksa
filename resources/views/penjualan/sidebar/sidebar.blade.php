<div class="sidebar" data-color="black" data-active-color="danger">
    <div class="logo">
        <a href="" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img alt='icon' class='icon'  src="/img/penjualan/avatar.png">
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
                    <i class="">
                        <img alt='icon' width='25px' class='icon' src="/img/penjualan/dashboard.png" style="filter:invert(100%)">
                    </i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="">                        <img alt='icon' width='25px' class='icon' src="/img/penjualan/storage (2).png" style="filter:invert(100%)">
</i>
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
                        <li class="{{ $elementActive == 'sales' ? 'active' : '' }}">
                            <a href="/penjualan/penjuals">
                                <span class="sidebar-mini-icon">{{ __('SL') }}</span>
                                <span class="sidebar-normal">{{ __(' Sales ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'barang' ? 'active' : '' }}">
                            <a href="/penjualan/barangs">
                                <span class="sidebar-mini-icon">{{ __('BR') }}</span>
                                <span class="sidebar-normal">{{ __(' Barang ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'gudang' ? 'active' : '' }}">
                            <a href="/penjualan/gudangs">
                                <span class="sidebar-mini-icon">{{ __('GD') }}</span>
                                <span class="sidebar-normal">{{ __(' Gudang ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'akun' ? 'active' : '' }}">
                            <a href="/penjualan/akuns">
                                <span class="sidebar-mini-icon">{{ __('AK') }}</span>
                                <span class="sidebar-normal">{{ __(' Akun ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'pajak' ? 'active' : '' }}">
                            <a href="/penjualan/pajaks">
                                <span class="sidebar-mini-icon">{{ __('PJ') }}</span>
                                <span class="sidebar-normal">{{ __(' Pajak ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'penawaran' ? 'active' : '' }}">
                <a href="/penjualan/penawarans">
                    <i class="">
                    <img alt='icon' width='25px' class='icon' src="/img/penjualan/penawaran.png" style="filter:invert(100%)">
                    </i>
                    <p>{{ __('Penawaran') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'pemesanan' ? 'active' : '' }}">
                <a href="/penjualan/pemesanans">
                    <i class="">
                    <img alt='icon' width='25px' class='icon' src="/img/penjualan/order.png" style="filter:invert(100%)">

                    </i>
                    <p>{{ __('Pemesanan') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'pengiriman' ? 'active' : '' }}">
                <a href="/penjualan/pengirimans">
                    <i class="">
                        <img alt='icon' width='25px' class='icon' src="/img/penjualan/pengiriman.png" style="filter:invert(100%)">

                    </i>
                    <p>{{ __('Pengiriman') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'faktur' ? 'active' : '' }}">
                <a href="/penjualan/fakturs">
                    <i class="">
                    <img alt='icon' width='25px' class='icon' src="/img/penjualan/faktur.png" style="filter:invert(100%)">
                    </i>
                    <p>{{ __('Faktur') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'retur' ? 'active' : '' }}">
                <a href="/penjualan/returs">
                    <i class="">
                    <img alt='icon' width='25px' class='icon' src="/img/penjualan/retur.png" style="filter:invert(100%)">
                    </i>
                    <p>{{ __('Retur Penjualan') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'piutang' ? 'active' : '' }}">
                <a href="/penjualan/piutangs">
                    <i class="">
                    <img alt='icon' width='25px' class='icon' src="/img/penjualan/piutang.png" style="filter:invert(100%)">
                    </i>
                    <p>{{ __('Piutang') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'pembayaran' ? 'active' : '' }}">
                <a href="/penjualan/pembayarans">
                    <i class="">
                    <img alt='icon' width='25px' class='icon' src="/img/penjualan/pembayaran (2).png" style="filter:invert(100%)">

                    </i>
                    <p>{{ __('Pembayaran Piutang') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'jurnal' ? 'active' : '' }}">
                <a href="/penjualan/jurnals">
                    <i class="">
                    <img alt='icon' width='25px' class='icon' src="/img/penjualan/jurnal.png" style="filter:invert(100%)">
                    </i>
                    <p>{{ __('Jurnal') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>