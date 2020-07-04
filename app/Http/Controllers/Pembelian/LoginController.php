<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Stock\AuthService;

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
