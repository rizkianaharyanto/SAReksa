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
        return view('dashboard');
    });
    
    Route::get('/ambilgudang', 'GudangsController@ambil');
    Route::get('/ambilbarang', 'BarangsController@ambil');
    Route::post('/savebarang', 'PermintaansController@savebarang');
    
    Route::resources([
        'pemasoks' => 'PemasoksController',
        'pengirims' => 'PengirimsController',
        'jurnals' => 'JurnalsController',
        'pemesanans' => 'PemesanansController',
        'penerimaans' => 'PenerimaansController',
        'permintaans' => 'PermintaansController',
        'fakturs' => 'FaktursController',
        'returs' => 'RetursController',
        'hutangs' => 'HutangsController',
        'pembayarans' => 'PembayaransController',
    ]);
});
