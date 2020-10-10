<?php

namespace App\Http\Middleware;


use Closure;

class CheckRolePembelian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)
    {
        // dd($request->user()->role->role_name,$roles);
        if(in_array($request->user()->role->role_name,$roles)){
            return $next($request);
        }
        return redirect('/pembelian');
    }
}
