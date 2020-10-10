<?php

namespace App\Http\Controllers\Penjualan;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan\Penawaran;
use App\Penjualan\Pemesanan;
use App\Penjualan\Pelanggan;
use App\Penjualan\Pengiriman;
use App\Penjualan\Penjual;
use App\Penjualan\Jurnal;
use App\Penjualan\Faktur;
use App\Penjualan\Retur;
use App\Penjualan\Piutang;
use App\Penjualan\Pembayaran;
use App\User;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Role;
use Carbon\Carbon;

use PDF;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $lfaktur = Faktur::where('status', 'lunas')->count();
        $dfaktur = Faktur::where('status', 'dibayar sebagian')->count();
        $pfaktur = Faktur::where('status', 'piutang')->count();
        $fpiutang = $dfaktur + $pfaktur;

        $time = Carbon::now('WIB')->format('Y-m-d H:i:s');
        // dd($time);
        return view('penjualan.dashboard', [
            'pdalam' => Pengiriman::where('status', 'dalam pengiriman')->count(),
            'prterkirim' => Pengiriman::where('status', 'terkirim')->count(),
            'pposting' => Pengiriman::where('status', 'sudah posting')->count(),
            'prselesai' => Pengiriman::where('status', 'selesai')->count(),
            'pbaru' => Pemesanan::where('status', 'baru')->count(),
            'pterkirims' => Pemesanan::where('status', 'terkirim sebagian')->count(),
            'pterkirim' => Pemesanan::where('status', 'terkirim')->count(),
            'pselesai' => Pemesanan::where('status', 'selesai')->count(),
            'pbelum' => Piutang::where('status', 'piutang')->count(),
            'psudah' => Piutang::where('status', 'lunas')->count(),
            'rbelum' => Retur::where('status_posting', 'belum posting')->count(),
            'rsudah' => Retur::where('status_posting', 'sudah posting')->count(),
            'flunas' => $lfaktur,
            'fpiutang' => $fpiutang,
            'time' => $time,
            'gudang' => Gudang::count(),
            'barang' => Barang::count(),
            'pelanggan' => Pelanggan::count(),
            'penjual' => Penjual::count(),
            'pendapatan' => Jurnal::where('akun_id', '6')->sum('debit'),
            // 'akuns'=> Akun::all()
        ]);
    }

    public function login(Request $request)
    {
        if ($request->session()->has('login')) {
            return redirect('/');
        } else {
            return view('penjualan.login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/penjualan/login');
    }

    public function daftar(Request $request)
    {
        $roles = Role::where('departemen', 'penjualan')->get();
        if ($request->session()->has('login')) {
            return redirect('/');
        } else {
            return view('penjualan.register', compact('roles'));
        }
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('message', 'Login gagal, email dan password tidak cocok');
        }
        // dd('login ok');
        return redirect('/penjualan');
    }

    public function postdaftar(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:pnj_users',
            'role_id' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = User::create([
            'name' => $request->nama,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        auth()->loginUsingId($user->id);
        return redirect()->route('home');
        // dd('daftar ok');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
