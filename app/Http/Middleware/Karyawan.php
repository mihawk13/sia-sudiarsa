<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Karyawan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->level == 'Karyawan') {
            return $next($request);
        }

        return redirect('dashboard');
    }
}
