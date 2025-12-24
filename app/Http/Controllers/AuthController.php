<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek status "Ingat Saya" (Remember Me)
        // name="remember" diambil dari input checkbox di view login
        $remember = $request->boolean('remember');

        // 3. Proses Login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // CATATAN: Pengecekan role dihapus karena kolom 'role' tidak ada di database Anda.
            // Jika nanti Anda menambahkan kolom role, Anda bisa uncomment kode di bawah ini:
            /*
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            */

            // Redirect default ke dashboard
            return redirect()->intended('dashboard');
        }

        // 4. Jika login gagal, kembalikan ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
