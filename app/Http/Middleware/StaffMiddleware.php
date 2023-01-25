<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() === false) {
            return redirect('/login');

        }
        else{
            if (auth()->user()->role === 'Staff' || auth()->user()->role === 'Admin' || auth()->user()->role === 'Manager'){
                return $next($request);
            }
            else{
                abort(403);
            }

            // else{
            //     // Alert::error('Gagal Login', 'Username atau Password Salah');
            //     // return back();
            //     abort(403);
            // }
        }

        // return $next($request);
    }
}
