<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\News;
use App\Models\Announcement;
use App\Models\User; // <--- PENTING: Agar User::count() berfungsi
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat mendaftarkan route untuk aplikasi.
| Route '/' untuk pengunjung publik.
| Route '/dashboard' dan lainnya untuk admin yang sudah login.
|
*/

// =========================================================================
// 1. HALAMAN DEPAN (PUBLIK - PENGUNJUNG)
// =========================================================================
Route::get('/', function () {
    // A. AMBIL BERITA
    // Syarat: Status harus 'published'
    // Urutkan: Terbaru
    // Jumlah: Ambil 4 berita
    $news = News::where('status', 'published')
        ->latest()
        ->take(4)
        ->get();

    // B. AMBIL PENGUMUMAN
    // Syarat: Status harus 'published' (Pastikan kolom status sudah ada di tabel announcements)
    // Urutkan: Berdasarkan tanggal kegiatan (date)
    // Jumlah: Ambil 5 pengumuman
    $announcements = Announcement::where('status', 'published')
        ->orderBy('date', 'desc')
        ->take(5)
        ->get();

    // Kirim data ke view 'welcome.blade.php'
    return view('welcome', compact('news', 'announcements'));
});


// =========================================================================
// 2. HALAMAN ADMIN (WAJIB LOGIN)
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {

    // A. DASHBOARD ADMIN
    Route::get('/dashboard', function () {
        // 1. Hitung Total Data (Semua data, termasuk Draft)
        $totalNews = News::count();
        $totalAnnouncements = Announcement::count();
        $totalUsers = User::count();

        // 2. Ambil 5 Berita Terakhir (Untuk tabel aktivitas di dashboard)
        // Kita ambil semua status (Draft & Published) agar admin bisa melihat kerjaannya
        $latestNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalNews', 'totalAnnouncements', 'totalUsers', 'latestNews'));
    })->name('dashboard');


    // B. CRUD BERITA (Create, Read, Update, Delete)
    Route::resource('news', NewsController::class);

    // C. CRUD PENGUMUMAN
    Route::resource('announcements', AnnouncementController::class);

    // D. PENGATURAN PROFIL ADMIN (Bawaan Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/kunjungan/daftar', function () {
    return view('kunjungan.create');
})->name('kunjungan.create');
Route::get('/kunjungan/daftar', function () {
    return view('guest.kunjungan.create');
})->name('kunjungan.create');



// =========================================================================
// 3. AUTHENTICATION ROUTES (Login, Logout, Reset Password)
// =========================================================================
require __DIR__ . '/auth.php';
