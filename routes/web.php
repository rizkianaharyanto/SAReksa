<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('base');

Route::prefix('pembelian')->group(function () {
    Route::get('/', 'Pembelian\LoginController@dashboard')->middleware('auth.pembelian');

    Route::get('/login', 'Pembelian\LoginController@index');

    Route::prefix('auth')->group(function () {
        Route::post('/login', 'Pembelian\LoginController@login');
        Route::get('/logout', 'Pembelian\LoginController@logout');
    });

    Route::get('/ambilgudang', 'Pembelian\GudangsController@ambil')->middleware('auth.pembelian');
    Route::get('/ambilbarang', 'Pembelian\BarangsController@ambil')->middleware('auth.pembelian');
    Route::post('/savebarang', 'Pembelian\PermintaansController@savebarang')->middleware('auth.pembelian');
    Route::get('/showhutang/{id}', 'Pembelian\HutangsController@showpembayaran')->middleware('auth.pembelian');

    Route::get('/stokmasuk', 'Pembelian\PenerimaansController@stokmasuk');
    Route::get('/stokmasuk/{id}', 'Pembelian\PenerimaansController@stokmasukdetail');

    Route::resource('/pemasoks', 'Pembelian\PemasoksController')->middleware('auth.pembelian');
    Route::resource('/pengirims', 'Pembelian\PengirimsController')->middleware('auth.pembelian');
    Route::resource('/fakturs', 'Pembelian\FaktursController')->middleware(['auth.pembelian', 'checkPembelian:Admin Pembelian,Admin Retur Pembelian,Admin Utang']);
    Route::get('/fakturshow/{id}', 'Pembelian\FaktursController@show2')->middleware(['auth.pembelian', 'checkPembelian:Admin Pembelian,Admin Retur Pembelian,Admin Utang']);
    Route::get('/faktur/cetak_pdf', 'Pembelian\FaktursController@cetak_pdf')->middleware(['auth.pembelian', 'checkPembelian:Admin Pembelian,Admin Retur Pembelian,Admin Utang']);

    Route::group(['middleware' => ['auth.pembelian', 'checkPembelian:Admin Pembelian']], function () {
        Route::resource('/pemesanans', 'Pembelian\PemesanansController');
        Route::resource('/penerimaans', 'Pembelian\PenerimaansController');
        Route::resource('/permintaans', 'Pembelian\PermintaansController');

        Route::get('/permintaanshow/{id}', 'Pembelian\PermintaansController@show2');
        Route::get('/pemesananshow/{id}', 'Pembelian\PemesanansController@show2');
        Route::get('/penerimaanshow/{id}', 'Pembelian\PenerimaansController@show2');

        Route::get('/permintaan/cetak_pdf', 'Pembelian\PermintaansController@cetak_pdf');
        Route::get('/pemesanan/cetak_pdf', 'Pembelian\PemesanansController@cetak_pdf');
        Route::get('/penerimaan/cetak_pdf', 'Pembelian\PenerimaansController@cetak_pdf');

        Route::get('/postingpnm/{idnya}', 'Pembelian\PenerimaansController@posting');
        Route::get('/ubahpsn/{idnya}', 'Pembelian\PenerimaansController@ubahpsn');
        Route::get('/postingfak/{idnya}', 'Pembelian\FaktursController@posting');
        Route::get('/ubahpsnfak/{idnya}', 'Pembelian\FaktursController@ubahpsn');
    });


    Route::group(['middleware' => ['auth.pembelian', 'checkPembelian:Admin Retur Pembelian']], function () {
        Route::resource('/returs', 'Pembelian\RetursController');

        Route::get('/returshow/{id}', 'Pembelian\RetursController@show2');

        Route::get('/retur/cetak_pdf', 'Pembelian\RetursController@cetak_pdf');

        Route::get('/postingret/{idnya}', 'Pembelian\RetursController@posting');
    });


    Route::group(['middleware' => ['auth.pembelian', 'checkPembelian:Admin Utang']], function () {
        Route::resource('/hutangs', 'Pembelian\HutangsController');
        Route::resource('/pembayarans', 'Pembelian\PembayaransController');

        Route::get('/hutang-bagi', function () {
            return view('pembelian.hutang.hutang-bagi');
        });
        Route::get('/hutangs-faktur', 'Pembelian\HutangsController@fakturindex');
        Route::post('/hutangs-filter', 'Pembelian\HutangsController@filter');

        Route::get('/pembayaranshow/{id}', 'Pembelian\PembayaransController@show2');
        Route::get('/hutangshow/{id}', 'Pembelian\HutangsController@show2');

        Route::get('/pembayaran/cetak_pdf', 'Pembelian\PembayaransController@cetak_pdf');
        Route::get('/hutang/cetak_pdf', 'Pembelian\HutangsController@cetak_pdf');

        Route::get('/postingpem/{idnya}', 'Pembelian\PembayaransController@posting');
    });


    Route::group(['middleware' => ['auth.pembelian', 'checkPembelian:Manager Pembelian']], function () {
        Route::resource('/jurnals', 'Pembelian\JurnalsController');

        Route::get('/jurnal/filter', 'Pembelian\JurnalsController@filter');
        Route::get('/jurnal/cetak_pdf', 'Pembelian\JurnalsController@cetak_pdf');
        //show laporan
        Route::get('/permintaan/laporan', 'Pembelian\PermintaansController@laporan');
        Route::get('/permintaan/laporanfilter', 'Pembelian\PermintaansController@laporanfilter');
        Route::get('/pemesanan/laporan', 'Pembelian\PemesanansController@laporan');
        Route::get('/pemesanan/laporanfilter', 'Pembelian\PemesanansController@laporanfilter');
        Route::get('/penerimaan/laporan', 'Pembelian\PenerimaansController@laporan');
        Route::get('/penerimaan/laporanfilter', 'Pembelian\PenerimaansController@laporanfilter');
        Route::get('/faktur/laporan', 'Pembelian\FaktursController@laporan');
        Route::get('/faktur/laporanfilter', 'Pembelian\FaktursController@laporanfilter');
        Route::get('/retur/laporan', 'Pembelian\RetursController@laporan');
        Route::get('/retur/laporanfilter', 'Pembelian\RetursController@laporanfilter');
        Route::get('/pembayaran/laporan', 'Pembelian\PembayaransController@laporan');
        Route::get('/pembayaran/laporanfilter', 'Pembelian\PembayaransController@laporanfilter');
        Route::get('/hutang/laporan', 'Pembelian\HutangsController@laporan');
        Route::get('/hutang/laporanfilter', 'Pembelian\HutangsController@laporanfilter');

        //cetak laporan
        Route::get('/permintaan/laporanpdf', 'Pembelian\PermintaansController@cetaklaporan');
        Route::get('/pemesanan/laporanpdf', 'Pembelian\PemesanansController@cetaklaporan');
        Route::get('/penerimaan/laporanpdf', 'Pembelian\PenerimaansController@cetaklaporan');
        Route::get('/faktur/laporanpdf', 'Pembelian\FaktursController@cetaklaporan');
        Route::get('/retur/laporanpdf', 'Pembelian\RetursController@cetaklaporan');
        Route::get('/pembayaran/laporanpdf', 'Pembelian\PembayaransController@cetaklaporan');
        Route::get('/hutang/laporanpdf', 'Pembelian\HutangsController@cetaklaporan');
    });
    // Route::resources([
    //     'pemasoks' => 'Pembelian\PemasoksController',
    //     'pengirims' => 'Pembelian\PengirimsController',
    //     'jurnals' => 'Pembelian\JurnalsController',
    //     'pemesanans' => 'Pembelian\PemesanansController',
    //     'penerimaans' => 'Pembelian\PenerimaansController',
    //     'permintaans' => 'Pembelian\PermintaansController',
    //     'fakturs' => 'Pembelian\FaktursController',
    //     'returs' => 'Pembelian\RetursController',
    //     'hutangs' => 'Pembelian\HutangsController',
    //     'pembayarans' => 'Pembelian\PembayaransController',
    // ]);
});

Route::prefix('stok')->group(function () {
    Route::get('/', 'Stock\DashboardController@index')->middleware('auth.stock');
    Route::get('/login', 'Stock\LoginController@index');

    Route::prefix('auth')->group(function () {
        Route::post('/login', 'Stock\LoginController@login');
        Route::get('/logout', 'Stock\LoginController@logout');
    });

    Route::get('/getstocksbywarehouse/{warehouseId}', 'Stock\ItemResourceController@getStocksByWarehouse');
    Route::get('/barangs', 'Stock\ItemResourceController@indexpembelian')->middleware('auth.pembelian');
    Route::get('/gudangs', 'Stock\WarehouseController@indexpembelian')->middleware('auth.pembelian');
    Route::get('/pajaks', 'Stock\TaxResourceController@indexpembelian')->middleware('auth.pembelian');

    Route::get('/config', 'Stock\ConfigController@index');
    Route::get('/config/getrolepermissions/{id}', 'Stock\ConfigController@getRolePermissions');

    Route::post('/updatepermissions', 'Stock\ConfigController@updatePermissions');
    Route::post('/rolebaru', 'Stock\ConfigController@addRole');
    Route::get('/upd/{itemId}', 'Stock\ItemStockController@updateStocks');
    Route::prefix('/Management-Data')->group(function () {
        Route::resources([
            'kategori-barang' => "Stock\ItemCategoryController",
            'barang' => "Stock\ItemResourceController",
            'satuan-unit' => "Stock\UnitsResourceController",
            'gudang' => "Stock\WarehouseController",
            'supplier' => "Stock\SuppliersResourceController",
            'pajak' => "Stock\TaxResourceController",
            'coa-master' => "Stock\COAMasterController",
            'coa-type' => "Stock\COATypeController",
        ]);
        Route::get('/pemasok', 'Pembelian\PemasoksController@indexbarang');
    });
    Route::get('/stock-opname/posting/{id}', 'Stock\StockOpnameController@posting');
    Route::get('/transfer-stock/posting/{id}', 'Stock\StockTransferController@posting');
    Route::get('/penyesuaian-stock/posting/{id}', 'Stock\StockAdjustmentController@posting');


    Route::resources([
        'transfer-stock' => 'Stock\StockTransferController',
        'stock-opname' => 'Stock\StockOpnameController',
        'penyesuaian-stock' => 'Stock\StockAdjustmentController',
        'pembelian' => 'Stock\ItemPurchaseTransactionController',
    ], ['middleware' => 'web']);
    Route::get('/stokbarang/{barangId}', 'Stock\ItemStockController@getStocksTotalById');
    Route::get('/stokbarangpergudang/{barangId}', 'Stock\ItemStockController@getStocksByGudang');

    Route::group(['prefix' => '/reports', 'as' => 'reports.'], function () {
        Route::get('/kartu-stock', ['as' => 'kartu-stock', 'uses' => 'Stock\KartuStockController@index']);
        Route::get('/kartu-stock/filter', 'Stock\KartuStockController@filter');
        Route::get('/kartu-stock/export', 'Stock\KartuStockController@export');

        Route::get('/laporan-penyesuaian', ['as' => 'laporan-penyesuaian', 'uses' => 'Stock\StockAdjustmentController@laporanindex']);
        Route::get('/laporan-penyesuaian/filter', 'Stock\StockAdjustmentController@laporanfilter');
        Route::get('/laporan-penyesuaian/export', 'Stock\StockAdjustmentController@laporanexport');

        Route::get('/laporan-stok-opname', ['as' => 'laporan-stok-opname', 'uses' => 'Stock\StockOpnameController@laporanindex']);
        Route::get('/laporan-stok-opname/filter', 'Stock\StockOpnameController@laporanfilter');
        Route::get('/laporan-stok-opname/export', 'Stock\StockOpnameController@laporanexport');

        Route::get('/laporan-transfer', ['as' => 'laporan-transfer', 'uses' => 'Stock\StockTransferController@laporanindex']);
        Route::get('/laporan-transfer/filter', 'Stock\StockTransferController@laporanfilter');
        Route::get('/laporan-transfer/export', 'Stock\StockTransferController@laporanexport');


        //Daftar Produk
        Route::get('/produk', ['as' => 'produk', 'uses' => 'Stock\KartuStockController@index']);
        Route::get('/produk/filter', 'Stock\KartuStockController@filter');
        Route::get('/produk/export', 'Stock\KartuStockController@export');
    });

    //DELETE AFTER
    Route::get('/token', function () {
        return csrf_token();
    });
});

Route::prefix('kepegawaian')->group(function () {
    Route::get('/', 'Kepegawaian\DashboardController@index');


    Route::get('/login','Kepegawaian\LoginController@index');
    Route::get('/logout','Kepegawaian\LoginController@logout');
    Route::post('/logincheck','Kepegawaian\LoginController@logincheck');

    //PPH
    Route::get('/admin/pph/tambah', 'Kepegawaian\PphController@tambah');
    Route::post('/admin/pph/store', 'Kepegawaian\PphController@store');
    Route::get('/admin/pph/hapus/{pph}', 'Kepegawaian\PphController@destroy');
    Route::get('/admin/pph/{pph}', 'Kepegawaian\PphController@show');
    Route::put('/admin/pph/{pph}', 'Kepegawaian\PphController@update');

    //PTKP
    Route::get('/admin/ptkp/tambah', 'Kepegawaian\PtkpController@tambah');
    Route::post('/admin/ptkp/store', 'Kepegawaian\PtkpController@store');
    Route::get('/admin/ptkp/hapus/{ptkp}', 'Kepegawaian\PtkpController@destroy');
    Route::get('/admin/ptkp/{ptkp}', 'Kepegawaian\PtkpController@show');
    Route::put('/admin/ptkp/{ptkp}', 'Kepegawaian\PtkpController@update');

    //AKUN
    Route::get('/admin/akun/tambah', 'Kepegawaian\AkunController@tambah');
    Route::post('/admin/akun/store', 'Kepegawaian\AkunController@store');
    Route::get('/admin/akun/hapus/{akun}', 'Kepegawaian\AkunController@destroy');
    Route::get('/admin/akun/{akun}', 'Kepegawaian\AkunController@show');
    Route::put('/admin/akun/{akun}', 'Kepegawaian\AkunController@update');

    //Tunjangan
    Route::get('/penggajian/tunjangan/tambah','Kepegawaian\TunjanganController@tambah');
    Route::post('/penggajian/tunjangan/store','Kepegawaian\TunjanganController@store');
    Route::get('/penggajian/tunjangan/hapus/{tunjangan}','Kepegawaian\TunjanganController@destroy');
    Route::get('/penggajian/tunjangan/{tunjangan}','Kepegawaian\TunjanganController@show');
    Route::put('/penggajian/tunjangan/{tunjangan}','Kepegawaian\TunjanganController@update');

    //Penggajian
    Route::get('/penggajian/terima/{penggajian}','Kepegawaian\PenggajianController@terima');
    Route::get('/penggajian/tolak/{penggajian}','Kepegawaian\PenggajianController@tolak');
    Route::get('/penggajian/ditolak','Kepegawaian\PenggajianController@ditolak');
    Route::get('/penggajian/tunjangan','Kepegawaian\PenggajianController@index');
    Route::get('/penggajian/tambah','Kepegawaian\PenggajianController@tambah');
    Route::post('/penggajian/store','Kepegawaian\PenggajianController@store');
    Route::get('/penggajian/hapus/{penggajian}','Kepegawaian\PenggajianController@destroy');
    Route::put('/penggajian/edit/{penggajian}','Kepegawaian\PenggajianController@update');
    Route::get('/penggajian/{penggajian}','Kepegawaian\PenggajianController@show');

    //User pengguna
    Route::get('/pengguna/tambah','Kepegawaian\UserController@tambah');
    Route::post('/pengguna/store','Kepegawaian\UserController@store');
    Route::put('/pengguna/reset/{id}','Kepegawaian\UserController@reset');
    Route::get('/pengguna/hapus/{id}','Kepegawaian\UserController@destroy');
    Route::get('/pengguna/{id}','Kepegawaian\UserController@show');
    Route::put('/pengguna/{id}','Kepegawaian\UserController@update');

    //User pengguna
    Route::get('/jabatan/promosi/tambah', 'Kepegawaian\PromosiController@tambah');
    Route::post('/jabatan/promosi/store', 'Kepegawaian\PromosiController@store');
    Route::get('/jabatan/promosi/hapus/{id}', 'Kepegawaian\PromosiController@destroy');
    Route::get('/jabatan/promosi/{id}', 'Kepegawaian\PromosiController@show');
    Route::put('/jabatan/promosi/{id}', 'Kepegawaian\PromosiController@update');

    Route::get('pegawai/tambah', 'Kepegawaian\PegawaiController@tambah');
    Route::post('pegawai/add', 'Kepegawaian\PegawaiController@add');
    Route::get('pegawai/hapus/{id}', 'Kepegawaian\PegawaiController@destroy');
    
    
    Route::post('jabatan/add', 'Kepegawaian\JabatanController@add');
    Route::get('jabatan/hapus/{id}', 'Kepegawaian\JabatanController@destroy');

    Route::post('/laporan/bulanan','Kepegawaian\LaporanController@bulanan');
    Route::get('/laporan/periode','Kepegawaian\LaporanController@bulanini');
    Route::get('/laporan/slip/{id}','Kepegawaian\LaporanController@slip');
    Route::get('/laporan/bulanan/{id}','Kepegawaian\LaporanController@satupegawai');
    Route::post('/laporan/pegawai','Kepegawaian\LaporanController@pegawai');

    // Route::get('/', )
    Route::resources([
        'admin/akun' => 'Kepegawaian\AkunController',
        'admin/pph' => 'Kepegawaian\PphController',
        'admin/ptkp' => 'Kepegawaian\PtkpController',
        'admin' => 'Kepegawaian\AdminController',
        'jabatan/promosi' => 'Kepegawaian\PromosiController',
        'jabatan' => 'Kepegawaian\JabatanController',
        'laporan' => 'Kepegawaian\LaporanController',
        'pegawai' => 'Kepegawaian\PegawaiController',
        'penggajian/tunjangan' => 'Kepegawaian\TunjanganController',
        'penggajian' => 'Kepegawaian\PenggajianController',
        'pengguna' => 'Kepegawaian\UserController',
    ]);
});

Route::prefix('penjualan')->group(function () {
    Route::get('/', 'Penjualan\LoginController@dashboard')->middleware('auth')->name('home');
    Route::get('/register', 'Penjualan\LoginController@daftar')->middleware('guest');
    Route::get('/login', 'Penjualan\LoginController@login')->middleware('guest')->name('login');
    Route::get('/logout', 'Penjualan\LoginController@logout')->middleware('auth');
    Route::post('/register', 'Penjualan\LoginController@postdaftar')->middleware('guest');

    Route::post('/login', 'Penjualan\LoginController@postlogin')->middleware('guest');

    Route::get('/barangs', 'Stock\ItemResourceController@indexpenjualan')->middleware('auth');
    Route::get('/gudangs', 'Stock\WarehouseController@indexpenjualan')->middleware('auth');
    Route::resource('/pelanggans', 'Penjualan\PelanggansController')->middleware('auth');
    Route::resource('/penjuals', 'Penjualan\PenjualsController')->middleware('auth');
    Route::resource('/fakturs', 'Penjualan\FaktursController')->middleware('auth');
    Route::resource('/returs', 'Penjualan\RetursController')->middleware('auth');
    Route::get('/fakturdetails/{id}', 'Penjualan\FaktursController@detail')->middleware(['auth', 'checkRole:penjualan,retur,piutang']);
    Route::any('/fakturs/cetak_pdf', 'Penjualan\FaktursController@cetak_pdf')->middleware(['auth', 'checkRole:penjualan,retur,piutang']);
    Route::get('/returdetails/{id}', 'Penjualan\RetursController@detail')->middleware(['auth', 'checkRole:retur,piutang']);
    Route::any('/returs/cetak_pdf', 'Penjualan\RetursController@cetak_pdf')->middleware(['auth', 'checkRole:retur,piutang']);

    //Admin Faktur
    Route::group(['middleware' => ['auth', 'checkRole:penjualan']], function () {
        Route::resource('/pemesanans', 'Penjualan\PemesanansController');
        Route::resource('/pengirimans', 'Penjualan\PengirimansController');
        Route::resource('/penawarans', 'Penjualan\PenawaransController');

        Route::any('/penawarans/cetak_pdf', 'Penjualan\PenawaransController@cetak_pdf');
        Route::any('/pemesanans/cetak_pdf', 'Penjualan\PemesanansController@cetak_pdf');
        Route::any('/pengirimans/cetak_pdf', 'Penjualan\PengirimansController@cetak_pdf');
        Route::get('/penawarandetails/{id}', 'Penjualan\PenawaransController@detail');
        Route::get('/pemesanandetails/{id}', 'Penjualan\PemesanansController@detail');
        Route::get('/pengirimandetails/{id}', 'Penjualan\PengirimansController@detail');
        Route::get('/pengirimans/{idnya}/posting', 'Penjualan\PengirimansController@posting');
        Route::get('/fakturs/{idnya}/posting', 'Penjualan\FaktursController@posting');
    });

    //Admin Retur
    Route::group(['middleware' => ['auth', 'checkRole:retur']], function () {
        Route::get('/returs/{idnya}/posting', 'Penjualan\RetursController@posting');
    });

    //Admin Piutang
    Route::group(['middleware' => ['auth', 'checkRole:piutang']], function () {
        Route::resource('/piutangs', 'Penjualan\PiutangsController');
        Route::get('/showpiutang/{id}', 'Penjualan\PiutangsController@showpembayaran');
        Route::resource('/pembayarans', 'Penjualan\PembayaransController');
        Route::get('/pembayarans/{idnya}/posting', 'Penjualan\PembayaransController@posting');
        Route::get('/pembayarandetails/{id}', 'Penjualan\PembayaransController@detail');
        Route::any('/pembayarans/cetak_pdf', 'Penjualan\PembayaransController@cetak_pdf');
    });

    //Dikersi Perusahaan
    Route::group(['middleware' => ['auth', 'checkRole:direksi']], function () {
        //show laporan
        Route::any('/laporans/penawaran', 'Penjualan\LaporansController@penawaran');
        Route::any('/laporans/pemesanan', 'Penjualan\LaporansController@pemesanan');
        Route::any('/laporans/pengiriman', 'Penjualan\LaporansController@pengiriman');
        Route::any('/laporans/faktur', 'Penjualan\LaporansController@faktur');
        Route::any('/laporans/retur', 'Penjualan\LaporansController@retur');
        Route::any('/laporans/piutang', 'Penjualan\LaporansController@piutang');
        Route::any('/laporans/pembayaran', 'Penjualan\LaporansController@pembayaran');
        Route::any('/jurnals/filter', 'Penjualan\JurnalsController@filter');

        //Data master
        //cetak laporan
        Route::any('/laporans/penawaranpdf', 'Penjualan\LaporansController@cetakpenawaran');
        Route::any('/laporans/pemesananpdf', 'Penjualan\LaporansController@cetakpemesanan');
        Route::any('/laporans/pengirimanpdf', 'Penjualan\LaporansController@cetakpengiriman');
        Route::any('/laporans/fakturpdf', 'Penjualan\LaporansController@cetakfaktur');
        Route::any('/laporans/returpdf', 'Penjualan\LaporansController@cetakretur');
        Route::any('/laporans/piutangpdf', 'Penjualan\LaporansController@cetakpiutang');
        Route::any('/laporans/pembayaranpdf', 'Penjualan\LaporansController@cetakpembayaran');
        Route::any('/laporans', 'Penjualan\LaporansController@index');
        Route::any('/jurnals', 'Penjualan\JurnalsController@index');
        Route::get('/jurnals/filterpdf', 'Penjualan\JurnalsController@cetak_filter');
        Route::get('/jurnals/cetak_pdf', 'Penjualan\JurnalsController@cetak_pdf');
    });

    //stok keluar
    Route::get('/stokkeluar', 'Penjualan\PengirimansController@stokkeluar');
    Route::get('/stokkeluar/{id}', 'Penjualan\PengirimansController@stokkeluardetail');
});
