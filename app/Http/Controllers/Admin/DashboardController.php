<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Kunjungan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Statistik Umum
        $totalNews = News::count();
        $totalAnnouncements = Announcement::count();
        $totalUsers = User::count();
        $latestNews = News::latest()->take(5)->get();
        
        // Data Kunjungan
        $totalPendingKunjungans = Kunjungan::where('status', 'pending')->count();
        $totalApprovedKunjungans = Kunjungan::where('status', 'approved')->count(); // Add this line
        $totalApprovedToday = Kunjungan::where('status', 'approved')->whereDate('updated_at', Carbon::today())->count();
        $totalRejectedKunjungans = Kunjungan::where('status', 'rejected')->count();
        $totalKunjungans = Kunjungan::count();
        $pendingKunjungans = Kunjungan::where('status', 'pending')->latest()->take(5)->get();

        // Data Kuota Harian untuk Tampilan Dashboard
        $today = Carbon::today();
        $isMonday = $today->isMonday();
        $isVisitingDay = $today->isTuesday() || $today->isWednesday() || $today->isThursday();
        
        $pendaftarPagi = $kuotaPagi = $pendaftarSiang = $kuotaSiang = $pendaftarBiasa = $kuotaBiasa = null;

        if ($isMonday) {
            $pendaftarPagi = Kunjungan::whereDate('tanggal_kunjungan', $today)->where('sesi', 'pagi')->where('status', 'approved')->count();
            $kuotaPagi = config('kunjungan.quota_senin_pagi');
            $pendaftarSiang = Kunjungan::whereDate('tanggal_kunjungan', $today)->where('sesi', 'siang')->where('status', 'approved')->count();
            $kuotaSiang = config('kunjungan.quota_senin_siang');
        } elseif ($isVisitingDay) {
            $pendaftarBiasa = Kunjungan::whereDate('tanggal_kunjungan', $today)->where('status', 'approved')->count();
            $kuotaBiasa = config('kunjungan.quota_hari_biasa');
        }

        // Data untuk Chart Kunjungan 7 Hari Terakhir
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->translatedFormat('D, j M'); // Format: Sen, 22 Des
            $chartData[] = Kunjungan::where('status', 'approved')
                                      ->whereDate('updated_at', $date)
                                      ->count();
        }

        // Data untuk Chart Kunjungan per Status
        $chartKunjunganStatusLabels = ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'];
        $chartKunjunganStatusData = [
            $totalPendingKunjungans,
            $totalApprovedKunjungans,
            $totalRejectedKunjungans,
        ];

        return view('admin.dashboard', compact(
            'totalNews', 
            'totalAnnouncements', 
            'totalUsers', 
            'latestNews',
            'totalPendingKunjungans',
            'totalApprovedKunjungans',
            'totalApprovedToday',
            'totalRejectedKunjungans',
            'totalKunjungans',
            'pendingKunjungans',
            'isMonday',
            'isVisitingDay',
            'pendaftarPagi',
            'kuotaPagi',
            'pendaftarSiang',
            'kuotaSiang',
            'pendaftarBiasa',
            'kuotaBiasa',
            'chartLabels',
            'chartData',
            'chartKunjunganStatusLabels',
            'chartKunjunganStatusData'
        ));
    }

    public function getStats()
    {
        // Real-time stats
        $totalPendingKunjungans = Kunjungan::where('status', 'pending')->count();
        $totalApprovedKunjungans = Kunjungan::where('status', 'approved')->count();
        $totalApprovedToday = Kunjungan::where('status', 'approved')->whereDate('updated_at', Carbon::today())->count();
        $totalRejectedKunjungans = Kunjungan::where('status', 'rejected')->count();
        $totalKunjungans = Kunjungan::count();
        $totalNews = News::count();
        $totalAnnouncements = Announcement::count();
        $totalUsers = User::count();

        // Quota data
        $today = Carbon::today();
        $isMonday = $today->isMonday();
        $isVisitingDay = $today->isTuesday() || $today->isWednesday() || $today->isThursday();
        
        $pendaftarPagi = $kuotaPagi = $pendaftarSiang = $kuotaSiang = $pendaftarBiasa = $kuotaBiasa = null;

        if ($isMonday) {
            $pendaftarPagi = Kunjungan::whereDate('tanggal_kunjungan', $today)->where('sesi', 'pagi')->where('status', 'approved')->count();
            $kuotaPagi = config('kunjungan.quota_senin_pagi');
            $pendaftarSiang = Kunjungan::whereDate('tanggal_kunjungan', $today)->where('sesi', 'siang')->where('status', 'approved')->count();
            $kuotaSiang = config('kunjungan.quota_senin_siang');
        } elseif ($isVisitingDay) {
            $pendaftarBiasa = Kunjungan::whereDate('tanggal_kunjungan', $today)->where('status', 'approved')->count();
            $kuotaBiasa = config('kunjungan.quota_hari_biasa');
        }

        return response()->json([
            'totalPendingKunjungans' => $totalPendingKunjungans,
            'totalApprovedKunjungans' => $totalApprovedKunjungans,
            'totalApprovedToday' => $totalApprovedToday,
            'totalRejectedKunjungans' => $totalRejectedKunjungans,
            'totalKunjungans' => $totalKunjungans,
            'totalNews' => $totalNews,
            'totalAnnouncements' => $totalAnnouncements,
            'totalUsers' => $totalUsers,
            'isMonday' => $isMonday,
            'isVisitingDay' => $isVisitingDay,
            'pendaftarPagi' => $pendaftarPagi,
            'kuotaPagi' => $kuotaPagi,
            'pendaftarSiang' => $pendaftarSiang,
            'kuotaSiang' => $kuotaSiang,
            'pendaftarBiasa' => $pendaftarBiasa,
            'kuotaBiasa' => $kuotaBiasa,
        ]);
    }
}
