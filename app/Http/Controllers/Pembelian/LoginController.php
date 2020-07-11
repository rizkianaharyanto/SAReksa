<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Pembelian\Faktur;
use App\Pembelian\Hutang;
use App\Pembelian\Pemasok;
use App\Pembelian\Pemesanan;
use App\Pembelian\Penerimaan;
use App\Pembelian\Pengirim;
use App\Pembelian\Permintaan;
use App\Pembelian\Retur;
use Illuminate\Http\Request;
use App\Services\Stock\AuthService;
use App\Stock\Barang;
use App\Stock\Gudang;

class LoginController extends Controller
{
    private $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function index()
    {
        return view('pembelian.login');
    }

    public function dashboard()
    {
        $pemasoks = Pemasok::count();
        $pengirims = Pengirim::count();
        $barangs = Barang::count();
        $gudangs = Gudang::count();
        $hutangs= 0;
        foreach (Hutang::all() as $hutang) {
            $hutangs += $hutang->sisa;
        }
        return view('pembelian.dashboard', [
            'pemasoks' => $pemasoks,
            'barangs' => $barangs,
            'gudangs' => $gudangs,
            'hutangs' => $hutangs,
            'pengirims' => $pengirims
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $isLoggedIn = $this->service->login($request);
        if (!$isLoggedIn) {
            return redirect('/pembelian/login')->with('message', 'Username atau password anda salah');
        }

        return redirect('/pembelian');
    }

    public function logout(Request $request)
    {
        $this->service->logout();

        return redirect('pembelian/login');
    }
}
