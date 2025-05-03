<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Periksa apakah user admin atau bukan
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard'); // Admin langsung masuk dashboard admin
            }
            return redirect()->route('dashboard'); // Pengguna biasa ke dashboard
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Menangani proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/'); // Kembali ke halaman utama setelah logout
    }
}
