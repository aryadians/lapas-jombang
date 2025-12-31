<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

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

            // Cek role setelah login berhasil
            $userRole = Auth::user()->role;

            if (in_array($userRole, ['super_admin', 'admin_humas', 'admin_registrasi', 'admin_umum', 'admin'])) {
                // Jika admin, redirect ke dashboard admin
                return redirect()->intended(route('dashboard'));
            } elseif ($userRole) {
                // Jika user biasa, redirect ke halaman utama
                return redirect()->intended('/');
            } else {
                // Jika role tidak valid, logout dan beri pesan error
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak memiliki akses yang valid. Hubungi administrator.',
                ]);
            }
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

