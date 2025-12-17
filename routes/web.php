<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\News;
use App\Models\Announcement;
use App\Models\User; // <--- BARIS INI YANG SEBELUMNYA KURANG
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN DEPAN (PUBLIK) ---
Route::get('/', function () {
    // AMBIL BERITA: Hanya yang statusnya 'published', ambil 3 terbaru
    $news = News::where('status', 'published')
                ->latest()
                ->take(3)
                ->get();

    // AMBIL PENGUMUMAN: Ambil 5 terbaru
    // Saya tambahkan filter 'published' juga agar konsisten (jika kolom status ada)
    $announcements = Announcement::where('status', 'published') 
                                 ->orderBy('date', 'desc')
                                 ->take(5)
                                 ->get();
    
    return view('welcome', compact('news', 'announcements'));
});


// --- 2. HALAMAN ADMIN (WAJIB LOGIN) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // DASHBOARD: Mengirim data statistik ke view
    Route::get('/dashboard', function () {
        // 1. Hitung Total Data
        $totalNews = News::count();
        $totalAnnouncements = Announcement::count();
        $totalUsers = User::count(); // <--- Ini sekarang aman karena User sudah di-import di atas

        // 2. Ambil 5 Berita Terbaru untuk Tabel "Aktivitas Terbaru"
        $latestNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalNews', 'totalAnnouncements', 'totalUsers', 'latestNews'));
    })->name('dashboard');
    

    // CRUD Berita
    Route::resource('news', NewsController::class);

    // CRUD Pengumuman
    Route::resource('announcements', AnnouncementController::class);

    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- 3. AUTHENTICATION ---
require __DIR__.'/auth.php';