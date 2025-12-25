<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login DAN rolenya sesuai
        // 2. Jika tidak, redirect ke halaman utama atau tampilkan error 403 (Forbidden)
        if (! $request->user() || $request->user()->role !== $role) {
            // Untuk API bisa kembalikan response json, untuk web abort(403) lebih cocok
            abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
        }

        return $next($request);
    }
}
