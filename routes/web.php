<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\AuthController; // <--- TAMBAHKAN INI (PENTING)
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\Admin\KunjunganController as AdminKunjunganController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Models\News;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. HALAMAN DEPAN (PUBLIK - PENGUNJUNG)
// =========================================================================
Route::get('/', function () {
    // A. AMBIL BERITA
    $news = News::where('status', 'published')->latest()->take(4)->get();

    // B. AMBIL PENGUMUMAN
    $announcements = Announcement::where('status', 'published')->orderBy('date', 'desc')->take(5)->get();

    return view('welcome', compact('news', 'announcements'));
});


// =========================================================================
// 2. HALAMAN PENDAFTARAN KUNJUNGAN (GUEST)
// =========================================================================
Route::get('/kunjungan/daftar', [KunjunganController::class, 'create'])->name('kunjungan.create');
Route::post('/kunjungan/daftar', [KunjunganController::class, 'store'])->name('kunjungan.store');


// =========================================================================
// 3. AUTHENTICATION ROUTES (CUSTOM)
// =========================================================================
// Kita pakai AuthController custom agar logika cek role dimatikan sementara
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Note: Jika butuh fitur Lupa Password, uncomment baris bawah ini (tapi pakai controller bawaan Breeze)
// require __DIR__ . '/auth.php'; 


// =========================================================================
// 4. HALAMAN ADMIN (WAJIB LOGIN)
// =========================================================================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    // A. DASHBOARD ADMIN
    Route::get('/dashboard', function () {
        $totalNews = News::count();
        $totalAnnouncements = Announcement::count();
        $totalUsers = User::count();
        $latestNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalNews', 'totalAnnouncements', 'totalUsers', 'latestNews'));
    })->name('dashboard');

    // B. CRUD BERITA
    Route::resource('news', NewsController::class);

    // C. CRUD PENGUMUMAN
    Route::resource('announcements', AnnouncementController::class);

    // D. CRUD KUNJUNGAN
    Route::get('kunjungan', [AdminKunjunganController::class, 'index'])->name('admin.kunjungan.index');
    Route::patch('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'update'])->name('admin.kunjungan.update');
    Route::delete('kunjungan/{kunjungan}', [AdminKunjunganController::class, 'destroy'])->name('admin.kunjungan.destroy');

    // E. CRUD PENGGUNA
    Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show'])->names('admin.users');

    // F. PROFIL ADMIN
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
