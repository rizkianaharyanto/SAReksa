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
});

Route::prefix('pembelian')->group(function () {
    Route::get('/', function () {
        return view('pembelian.dashboard');
    });

    Route::get('/ambilgudang', 'Pembelian\GudangsController@ambil');
    Route::get('/ambilbarang', 'Pembelian\BarangsController@ambil');
    Route::post('/savebarang', 'Pembelian\PermintaansController@savebarang');
    Route::get('/showhutang/{id}', 'Pembelian\HutangsController@showpembayaran');

    //posting
    Route::get('/postingpnm/{idnya}', 'Pembelian\PenerimaansController@posting');
    Route::get('/ubahpsn/{idnya}', 'Pembelian\PenerimaansController@ubahpsn');

    //show details page
    Route::get('/permintaanshow/{id}', 'Pembelian\PermintaansController@show2');
    Route::get('/pemesananshow/{id}', 'Pembelian\PemesanansController@show2');
    Route::get('/penerimaanshow/{id}', 'Pembelian\PenerimaansController@show2');
    Route::get('/fakturshow/{id}', 'Pembelian\FaktursController@show2');
    Route::get('/returshow/{id}', 'Pembelian\RetursController@show2');

    //cetak pdf
    Route::get('/jurnals/cetak_pdf', 'Pembelian\JurnalsController@cetak_pdf');
    Route::get('/permintaans/cetak_pdf', 'Pembelian\PermintaansController@cetak_pdf');
    Route::get('/pemesanans/cetak_pdf', 'Pembelian\PemesanansController@cetak_pdf');
    Route::get('/penerimaans/cetak_pdf', 'Pembelian\PenerimaansController@cetak_pdf');
    Route::get('/fakturs/cetak_pdf', 'Pembelian\FaktursController@cetak_pdf');
    Route::get('/returs/cetak_pdf', 'Pembelian\RetursController@cetak_pdf');

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
    Route::get('/', function () {
        return view('stock.dashboard');
    });

    Route::get('/barangs', 'Stock\ItemResourceController@indexpembelian');
    Route::get('/gudangs', 'Stock\WarehouseController@indexpembelian');
    Route::get('/pajaks', 'Stock\TaxResourceController@indexpembelian');

    Route::get('/ello', "Stock\ItemResourceController@test");

    Route::get('/config', 'Stock\ConfigController@index');
    Route::get('/config/getrolepermissions/{id}', 'Stock\ConfigController@getRolePermissions');

    Route::post('/updatepermissions', 'Stock\ConfigController@updatePermissions');
    Route::post('/rolebaru', 'Stock\ConfigController@addRole');

    Route::prefix('/Management-Data')->group(function () {
        Route::resources([
            'kategori-barang' => "Stock\ItemCategoryController",
            'barang' => "Stock\ItemResourceController",
            'satuan-unit' => "Stock\UnitsResourceController",
            'gudang' => "Stock\WarehouseController",
            'pemasok' => "Stock\SuppliersResourceController",
            'pajak' => "Stock\TaxResourceController",
            'coa-master' => "Stock\COAMasterController",
            'coa-type' => "Stock\COATypeController",
        ]);
    });
    Route::post('/stock-opname/posting/{id}', 'Stock\StockOpnameController@posting');
    Route::resources([
            'transfer-stock' => 'StockTransferController',
            'stock-opname' => 'StockOpnameController',
            'penyesuaian-stock' => 'StockAdjustmentController',
            'pembelian' => 'ItemPurchaseTransactionController',
        ]);

    Route::get('/token', function () {
        return csrf_token();
    });
});

Route::prefix('kepegawaian')->group(function () {
    Route::get('/', function () {
        return view('kepegawaian.dashboard');
    });

    // Route::get('/barangs', )
    Route::resources([
        'admin' => 'Kepegawaian\AdminController',
        'jabatan' => 'Kepegawaian\JabatanController',
        'laporan' => 'Kepegawaian\LaporanController',
        'pegawai' => 'Kepegawaian\PegawaiController',
        'penggajian' => 'Kepegawaian\PenggajianController',
        'pengguna' => 'Kepegawaian\PenggunaController',
    ]);
});
