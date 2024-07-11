<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OnlyGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     /*
        Handle : method yang dipanggil sebelum ke controller dan bisa mengembalikan response.
        Clousure : meneruskan ke controller
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna belum login, arahkan ke halaman login
        if (!$request->session()->exists('user')) {
            return to_route('login');

        }
        // Jika pengguna sudah login, lanjutkan ke halaman yang diminta
        return $next($request);
    }
}
