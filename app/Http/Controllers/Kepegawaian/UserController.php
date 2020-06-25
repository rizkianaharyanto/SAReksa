<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Kepegawaian\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $users = User::all();
        $request->session()->put('page','pengguna');
        $request->session()->put('title','Pengguna');
        return view('kepegawaian.pengguna',compact('users'));
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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'userable_id' => 'required|string',
            'userable_type' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        $new = Crypt::encryptString($request->password);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'userable_id' => $request->userable_id,
            'userable_type' => $request->userable_type,
            'password' => $new,

        ]);
        return redirect('kepegawaian/pengguna')->with('status','Pengguna berhasil ditambahkan');
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
    	$user = User::find($id);
    	$user->delete();
 
        return redirect('kepegawaian/pengguna')->with('status','Pengguna berhasil dihapus');
    }

    public function tambah()
    {
        return view('kepegawaian.pengguna.tambah');
    }
}
