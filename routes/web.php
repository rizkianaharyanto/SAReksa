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

    Route::get('/ambilgudang', 'Pembelian\GudangsController@ambil');
    Route::get('/ambilbarang', 'Pembelian\BarangsController@ambil');
    Route::post('/savebarang', 'Pembelian\PermintaansController@savebarang');
    Route::get('/showhutang/{id}', 'Pembelian\HutangsController@showpembayaran');

    //posting
    Route::get('/postingpnm/{idnya}', 'Pembelian\PenerimaansController@posting');
    Route::get('/ubahpsn/{idnya}', 'Pembelian\PenerimaansController@ubahpsn');
    Route::get('/postingfak/{idnya}', 'Pembelian\FaktursController@posting');
    Route::get('/ubahpsnfak/{idnya}', 'Pembelian\FaktursController@ubahpsn');
    Route::get('/postingret/{idnya}', 'Pembelian\RetursController@posting');
    Route::get('/postingpem/{idnya}', 'Pembelian\PembayaransController@posting');

    //show laporan
    Route::get('/permintaans/laporan', 'Pembelian\PermintaansController@laporan');
    Route::get('/permintaans/laporanfilter', 'Pembelian\PermintaansController@laporanfilter');
    Route::get('/pemesanans/laporan', 'Pembelian\PemesanansController@laporan');
    Route::get('/pemesanans/laporanfilter', 'Pembelian\PemesanansController@laporanfilter');
    Route::get('/penerimaans/laporan', 'Pembelian\PenerimaansController@laporan');
    Route::get('/penerimaans/laporanfilter', 'Pembelian\PenerimaansController@laporanfilter');
    Route::get('/fakturs/laporan', 'Pembelian\FaktursController@laporan');
    Route::get('/fakturs/laporanfilter', 'Pembelian\FaktursController@laporanfilter');
    Route::get('/returs/laporan', 'Pembelian\RetursController@laporan');
    Route::get('/returs/laporanfilter', 'Pembelian\RetursController@laporanfilter');
    Route::get('/pembayarans/laporan', 'Pembelian\PembayaransController@laporan');
    Route::get('/pembayarans/laporanfilter', 'Pembelian\PembayaransController@laporanfilter');
    Route::get('/hutangs/laporan', 'Pembelian\HutangsController@laporan');
    Route::get('/hutangs/laporanfilter', 'Pembelian\HutangsController@laporanfilter');
    
    //cetak laporan
    Route::get('/permintaans/laporanpdf', 'Pembelian\PermintaansController@cetaklaporan');
    Route::get('/pemesanans/laporanpdf', 'Pembelian\PemesanansController@cetaklaporan');
    Route::get('/penerimaans/laporanpdf', 'Pembelian\PenerimaansController@cetaklaporan');
    Route::get('/fakturs/laporanpdf', 'Pembelian\FaktursController@cetaklaporan');
    Route::get('/returs/laporanpdf', 'Pembelian\RetursController@cetaklaporan');
    Route::get('/pembayarans/laporanpdf', 'Pembelian\PembayaransController@cetaklaporan');
    Route::get('/hutangs/laporanpdf', 'Pembelian\HutangsController@cetaklaporan');
    
    //show details
    Route::get('/permintaanshow/{id}', 'Pembelian\PermintaansController@show2');
    Route::get('/pemesananshow/{id}', 'Pembelian\PemesanansController@show2');
    Route::get('/penerimaanshow/{id}', 'Pembelian\PenerimaansController@show2');
    Route::get('/fakturshow/{id}', 'Pembelian\FaktursController@show2');
    Route::get('/returshow/{id}', 'Pembelian\RetursController@show2');
    Route::get('/pembayaranshow/{id}', 'Pembelian\PembayaransController@show2');
    Route::get('/hutangshow/{id}', 'Pembelian\HutangsController@show2');
    
    //cetak pdf
    Route::get('/jurnals/filter', 'Pembelian\JurnalsController@filter');
    Route::get('/jurnals/cetak_pdf', 'Pembelian\JurnalsController@cetak_pdf');
    Route::get('/permintaans/cetak_pdf', 'Pembelian\PermintaansController@cetak_pdf');
    Route::get('/pemesanans/cetak_pdf', 'Pembelian\PemesanansController@cetak_pdf');
    Route::get('/penerimaans/cetak_pdf', 'Pembelian\PenerimaansController@cetak_pdf');
    Route::get('/fakturs/cetak_pdf', 'Pembelian\FaktursController@cetak_pdf');
    Route::get('/returs/cetak_pdf', 'Pembelian\RetursController@cetak_pdf');
    Route::get('/pembayarans/cetak_pdf', 'Pembelian\PembayaransController@cetak_pdf');
    Route::get('/hutangs/cetak_pdf', 'Pembelian\HutangsController@cetak_pdf');
    
    //stok masuk
    Route::get('/stokmasuk', 'Pembelian\PenerimaansController@stokmasuk');
    Route::get('/stokmasuk/{id}', 'Pembelian\PenerimaansController@stokmasukdetail');


    // Route::get('/barangs', )
    Route::resources([
        'pemasoks' => 'Pembelian\PemasoksController',
        'pengirims' => 'Pembelian\PengirimsController',
        'jurnals' => 'Pembelian\JurnalsController',
        'pemesanans' => 'Pembelian\PemesanansController',
        'penerimaans' => 'Pembelian\PenerimaansController',
        'permintaans' => 'Pembelian\PermintaansController',
        'fakturs' => 'Pembelian\FaktursController',
        'returs' => 'Pembelian\RetursController',
        'hutangs' => 'Pembelian\HutangsController',
        'pembayarans' => 'Pembelian\PembayaransController',
    ]);
});

Route::prefix('stok')->group(function () {
    Route::get('/', 'Stock\DashboardController@index')->middleware('auth.stock');
    Route::get('/login', 'Stock\LoginController@index');

    Route::prefix('auth')->group(function () {
        Route::post('/login', 'Stock\LoginController@login');
        Route::get('/logout', 'Stock\LoginController@logout');
    });

    Route::get('/getstocksbywarehouse/{warehouseId}', 'Stock\ItemResourceController@getStocksByWarehouse');
    Route::get('/barangs', 'Stock\ItemResourceController@indexpembelian');
    Route::get('/gudangs', 'Stock\WarehouseController@indexpembelian');
    Route::get('/pajaks', 'Stock\TaxResourceController@indexpembelian');

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
        Route::get('/kartu-stock', ['as' => 'kartu-stock','uses' => 'Stock\KartuStockController@index']);
        Route::get('/kartu-stock/filter', 'Stock\KartuStockController@filter');
        Route::get('/kartu-stock/export', 'Stock\KartuStockController@export');
        
        //Daftar Produk
        Route::get('/produk', ['as' => 'produk','uses' => 'Stock\KartuStockController@index']);
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

    //User pengguna
    Route::get('/pengguna/tambah', 'Kepegawaian\UserController@tambah');
    Route::post('/pengguna/store', 'Kepegawaian\UserController@store');
    Route::get('/pengguna/hapus/{id}', 'Kepegawaian\UserController@destroy');
    Route::get('/pengguna/{id}', 'Kepegawaian\UserController@show');
    Route::put('/pengguna/{id}', 'Kepegawaian\UserController@update');

    //User pengguna
    Route::get('/jabatan/promosi/tambah', 'Kepegawaian\PromosiController@tambah');
    Route::post('/jabatan/promosi/store', 'Kepegawaian\PromosiController@store');
    Route::get('/jabatan/promosi/hapus/{id}', 'Kepegawaian\PromosiController@destroy');
    Route::get('/jabatan/promosi/{id}', 'Kepegawaian\PromosiController@show');
    Route::put('/jabatan/promosi/{id}', 'Kepegawaian\PromosiController@update');

    Route::get('pegawai/tambah', 'Kepegawaian\PegawaiController@tambah');
    Route::post('pegawai/add', 'Kepegawaian\PegawaiController@add');

    Route::post('jabatan/add', 'Kepegawaian\JabatanController@add');

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
    Route::get('/fakturdetails/{id}', 'Penjualan\FaktursController@detail')->middleware(['auth','checkRole:penjualan,retur,piutang']);
    Route::any('/fakturs/cetak_pdf', 'Penjualan\FaktursController@cetak_pdf')->middleware(['auth','checkRole:penjualan,retur,piutang']);
    Route::get('/returdetails/{id}', 'Penjualan\RetursController@detail')->middleware(['auth','checkRole:retur,piutang']);
    Route::any('/returs/cetak_pdf', 'Penjualan\RetursController@cetak_pdf')->middleware(['auth','checkRole:retur,piutang']);
    
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
