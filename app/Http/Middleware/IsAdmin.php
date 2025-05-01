<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna login dan memiliki peran 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Jika admin, lanjutkan ke rute berikutnya
        }

        // Jika bukan admin, redirect ke halaman dashboard user
        return redirect('/dashboard')->with('error', 'You do not have admin access');
    }
}
