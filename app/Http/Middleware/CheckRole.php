<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;


use Closure;

class CheckRole
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
        if(in_array($request->user()->role,$roles)){
            return $next($request);
        }
        return redirect('/penjualan');
    }
}
