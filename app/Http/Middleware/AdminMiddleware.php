<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                // Cek apakah pengguna sudah terautentikasi dan apakah mereka adalah admin
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);  // Lanjutkan ke permintaan berikutnya jika admin
        }

        return redirect('home');  // Redirect jika bukan admin
    }
}
