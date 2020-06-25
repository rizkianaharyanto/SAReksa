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
    Route::get('/jurnals/cetak_pdf', 'PembelianJurnalsController@cetak_pdf');
    Route::get('/showhutang/{id}', 'Pembelian\HutangsController@showpembayaran');
    

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
            'barang'          => "Stock\ItemResourceController",
            'satuan-unit'     => "Stock\UnitsResourceController",
            'gudang'          => "Stock\WarehouseController",
            'pemasok'         => "Stock\SuppliersResourceController",
            'pajak'           => "Stock\TaxResourceController",
            'coa-master'      => "Stock\COAMasterController",
            'coa-type'        => "Stock\COATypeController",
            
        ]);
    });
    Route::post('/stock-opname/posting/{id}', 'Stock\StockOpnameController@posting');
    Route::resources([
            'transfer-stock'    => 'StockTransferController',
            'stock-opname'      => 'StockOpnameController',
            'penyesuaian-stock' => 'StockAdjustmentController',
            'pembelian'         => 'ItemPurchaseTransactionController',
        ]);
        
    Route::get('/token', function () {
        return csrf_token();
    });
});


Route::prefix('kepegawaian')->group(function () {
    Route::get('/', 'Kepegawaian\DashboardController@index');

    //PPH
    Route::get('/admin/pph/tambah','Kepegawaian\PphController@tambah');
    Route::post('/admin/pph/store','Kepegawaian\PphController@store');
    Route::get('/admin/pph/hapus/{pph}','Kepegawaian\PphController@destroy');
    Route::get('/admin/pph/{pph}','Kepegawaian\PphController@show');
    Route::put('/admin/pph/{pph}','Kepegawaian\PphController@update');

    //PTKP
    Route::get('/admin/ptkp/tambah','Kepegawaian\PtkpController@tambah');
    Route::post('/admin/ptkp/store','Kepegawaian\PtkpController@store');
    Route::get('/admin/ptkp/hapus/{ptkp}','Kepegawaian\PtkpController@destroy');
    Route::get('/admin/ptkp/{ptkp}','Kepegawaian\PtkpController@show');
    Route::put('/admin/ptkp/{ptkp}','Kepegawaian\PtkpController@update');

    //AKUN
    Route::get('/admin/akun/tambah','Kepegawaian\AkunController@tambah');
    Route::post('/admin/akun/store','Kepegawaian\AkunController@store');
    Route::get('/admin/akun/hapus/{akun}','Kepegawaian\AkunController@destroy');
    Route::get('/admin/akun/{akun}','Kepegawaian\AkunController@show');
    Route::put('/admin/akun/{akun}','Kepegawaian\AkunController@update');

    //User pengguna
    Route::get('/pengguna/tambah','Kepegawaian\UserController@tambah');
    Route::post('/pengguna/store','Kepegawaian\UserController@store');
    Route::get('/pengguna/hapus/{id}','Kepegawaian\UserController@destroy');
    Route::get('/pengguna/{id}','Kepegawaian\UserController@show');
    Route::put('/pengguna/{id}','Kepegawaian\UserController@update');

    //User pengguna
    Route::get('/jabatan/promosi/tambah','Kepegawaian\PromosiController@tambah');
    Route::post('/jabatan/promosi/store','Kepegawaian\PromosiController@store');
    Route::get('/jabatan/promosi/hapus/{id}','Kepegawaian\PromosiController@destroy');
    Route::get('/jabatan/promosi/{id}','Kepegawaian\PromosiController@show');
    Route::put('/jabatan/promosi/{id}','Kepegawaian\PromosiController@update');


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