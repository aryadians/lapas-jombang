@extends('layouts.admin')

@section('content')

{{-- 1. HERO SECTION & JAM REALTIME --}}
<div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 rounded-3xl p-6 md:p-8 mb-10 text-white shadow-2xl overflow-hidden border border-slate-700">
    {{-- Background Accents --}}
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-yellow-500 opacity-10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 rounded-full bg-blue-500 opacity-10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <span class="bg-blue-500/20 text-blue-200 text-xs font-bold px-3 py-1 rounded-full border border-blue-500/30 mb-2 inline-block">
                Dashboard Admin
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 tracking-tight">
                Halo, {{ Auth::user()->name }}! 👋
            </h1>
            <p class="text-slate-300 text-sm md:text-base max-w-lg">
                Selamat datang kembali di panel kontrol Sistem Informasi Lapas Kelas 2B Jombang.
            </p>
        </div>

        {{-- Jam Realtime --}}
        <div class="text-center md:text-right bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-sm">
            <p id="realtime-clock" class="text-2xl md:text-4xl font-mono font-bold text-yellow-400 tracking-wider drop-shadow-md">
                {{ now()->format('H:i:s') }}
            </p>
            <p id="realtime-date" class="text-xs font-semibold text-slate-300 uppercase tracking-widest mt-1">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>
</div>

{{-- Script Jam Realtime --}}
<script>
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        }).replace(/\./g, ':');
        const dateString = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('realtime-clock').textContent = timeString;
        document.getElementById('realtime-date').textContent = dateString;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

{{-- KUOTA HARI INI --}}
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 mb-10">
    <div class="flex justify-between items-baseline mb-4">
        <h3 class="text-xl font-extrabold text-slate-800">Pantauan Kuota Kunjungan Hari Ini</h3>
        <p class="text-sm text-slate-500">{{ \Carbon\Carbon::today()->translatedFormat('l, d F Y') }}</p>
    </div>
    
    @if ($isMonday)
        <div class="space-y-6">
            {{-- Kuota Sesi Pagi --}}
            <div>
                @php
                    $persentasePagi = ($kuotaPagi > 0) ? ($pendaftarPagi / $kuotaPagi) * 100 : 0;
                    $colorPagi = 'from-emerald-400 to-emerald-600';
                    if ($persentasePagi > 70) $colorPagi = 'from-yellow-400 to-yellow-600';
                    if ($persentasePagi >= 100) $colorPagi = 'from-red-400 to-red-600';
                @endphp
                <div class="flex justify-between items-center mb-2">
                    <span class="text-base font-bold text-slate-700 flex items-center gap-2"><i class="fa-solid fa-sun text-yellow-500"></i> Sesi Pagi: {{ $pendaftarPagi }} / {{ $kuotaPagi }}</span>
                    <span class="text-sm font-semibold text-slate-600">{{ number_format($persentasePagi, 1) }}%</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-gradient-to-r {{ $colorPagi }} h-3 rounded-full transition-all duration-500" style="width: {{ $persentasePagi }}%"></div>
                </div>
            </div>
            {{-- Kuota Sesi Siang --}}
            <div>
                @php
                    $persentaseSiang = ($kuotaSiang > 0) ? ($pendaftarSiang / $kuotaSiang) * 100 : 0;
                    $colorSiang = 'from-emerald-400 to-emerald-600';
                    if ($persentaseSiang > 70) $colorSiang = 'from-yellow-400 to-yellow-600';
                    if ($persentaseSiang >= 100) $colorSiang = 'from-red-400 to-red-600';
                @endphp
                <div class="flex justify-between items-center mb-2">
                    <span class="text-base font-bold text-slate-700 flex items-center gap-2"><i class="fa-solid fa-cloud-sun text-orange-500"></i> Sesi Siang: {{ $pendaftarSiang }} / {{ $kuotaSiang }}</span>
                    <span class="text-sm font-semibold text-slate-600">{{ number_format($persentaseSiang, 1) }}%</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-gradient-to-r {{ $colorSiang }} h-3 rounded-full transition-all duration-500" style="width: {{ $persentaseSiang }}%"></div>
                </div>
            </div>
        </div>
    @elseif ($isVisitingDay)
        <div>
            @php
                $persentaseBiasa = ($kuotaBiasa > 0) ? ($pendaftarBiasa / $kuotaBiasa) * 100 : 0;
                $colorBiasa = 'from-blue-400 to-blue-600';
                if ($persentaseBiasa > 70) $colorBiasa = 'from-yellow-400 to-yellow-600';
                if ($persentaseBiasa >= 100) $colorBiasa = 'from-red-400 to-red-600';
            @endphp
            <div class="flex justify-between items-center mb-2">
                <span class="text-base font-bold text-slate-700 flex items-center gap-2"><i class="fa-solid fa-calendar-day text-blue-500"></i> Total Pendaftar: {{ $pendaftarBiasa }} / {{ $kuotaBiasa }}</span>
                <span class="text-sm font-semibold text-slate-600">{{ number_format($persentaseBiasa, 1) }}%</span>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-3">
                <div class="bg-gradient-to-r {{ $colorBiasa }} h-3 rounded-full transition-all duration-500" style="width: {{ $persentaseBiasa }}%"></div>
            </div>
        </div>
    @else
        <div class="bg-blue-50 text-blue-800 font-bold text-center p-4 rounded-lg border border-blue-200 w-full">
            Layanan Kunjungan Tidak Tersedia Hari Ini
        </div>
    @endif
</div>

{{-- 2. STATISTIK CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    {{-- Card Kunjungan Pending --}}
    <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 transform hover:-translate-y-2 transition duration-300 group cursor-pointer">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-slate-500 text-sm font-semibold uppercase tracking-wider mb-1">Menunggu Persetujuan</p>
                <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalPendingKunjungans }}</h3>
            </div>
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full group-hover:bg-yellow-500 group-hover:text-white transition-all duration-300">
                <i class="fa-regular fa-hourglass-half text-2xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-50">
            <a href="{{ route('admin.kunjungan.index', ['status' => 'pending']) }}" class="text-sm font-bold text-yellow-600 hover:text-yellow-800 flex items-center gap-2">
                Lihat Detail <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

    {{-- Card Disetujui Hari Ini --}}
    <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 transform hover:-translate-y-2 transition duration-300 group cursor-pointer">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-slate-500 text-sm font-semibold uppercase tracking-wider mb-1">Disetujui Hari Ini</p>
                <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalApprovedToday }}</h3>
            </div>
            <div class="p-3 bg-green-100 text-green-600 rounded-full group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                <i class="fa-regular fa-calendar-check text-2xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-50">
            <a href="{{ route('admin.kunjungan.index', ['status' => 'approved']) }}" class="text-sm font-bold text-green-600 hover:text-green-800 flex items-center gap-2">
                Lihat Detail <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

    {{-- Card Ditolak --}}
    <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 transform hover:-translate-y-2 transition duration-300 group cursor-pointer">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-slate-500 text-sm font-semibold uppercase tracking-wider mb-1">Total Ditolak</p>
                <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalRejectedKunjungans }}</h3>
            </div>
            <div class="p-3 bg-red-100 text-red-600 rounded-full group-hover:bg-red-500 group-hover:text-white transition-all duration-300">
                <i class="fa-regular fa-calendar-xmark text-2xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-50">
            <a href="{{ route('admin.kunjungan.index', ['status' => 'rejected']) }}" class="text-sm font-bold text-red-600 hover:text-red-800 flex items-center gap-2">
                Lihat Detail <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
    
    {{-- Card Total Pendaftar --}}
    <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 transform hover:-translate-y-2 transition duration-300 group cursor-pointer">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-slate-500 text-sm font-semibold uppercase tracking-wider mb-1">Total Kunjungan</p>
                <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalKunjungans }}</h3>
            </div>
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-users text-2xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-50">
            <a href="{{ route('admin.kunjungan.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center gap-2">
                Kelola Kunjungan <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>

{{-- CHART KUNJUNGAN --}}
<div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 mb-10">
    <h3 class="text-xl font-extrabold text-slate-800 mb-6">Grafik Kunjungan Disetujui (7 Hari Terakhir)</h3>
    <div class="h-80">
        <canvas id="visitsChart"></canvas>
    </div>
</div>

{{-- CHART STATUS KUNJUNGAN --}}
<div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 mb-10">
    <h3 class="text-xl font-extrabold text-slate-800 mb-6">Grafik Status Kunjungan</h3>
    <div class="h-80 flex justify-center">
        <canvas id="kunjunganStatusChart" class="max-w-md"></canvas>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">

    {{-- 3. TABEL BERITA TERBARU --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/70">
            <h3 class="text-xl font-extrabold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-slate-400"></i> Publikasi Terbaru
            </h3>
            <a href="{{ route('news.create') }}" class="text-sm font-bold bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition shadow-lg shadow-slate-300/50 inline-flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tulis Baru
            </a>
        </div>

        <div class="overflow-x-auto flex-grow">
            <table class="w-full text-base text-left">
                <thead class="bg-slate-100 text-slate-600 uppercase text-sm font-bold tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Judul Artikel</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($latestNews as $item)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition duration-150">
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            {{ Str::limit($item->title, 50) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($item->status == 'published')
                            <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 text-xs uppercase font-bold px-2.5 py-1 rounded-full border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Tayang
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-600 text-xs uppercase font-bold px-2.5 py-1 rounded-full border border-slate-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Draft
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-slate-500 text-sm">
                            {{ $item->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <div class="bg-slate-50 p-4 rounded-full mb-3">
                                    <i class="fa-regular fa-folder-open text-4xl"></i>
                                </div>
                                <p class="font-medium text-lg">Belum ada berita yang ditambahkan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 4. AKSES CEPAT (Quick Actions) --}}
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 h-fit">
        <h3 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-bolt text-yellow-500"></i> Akses Cepat
        </h3>
        <div class="space-y-4">
            {{-- Tombol Tulis Berita --}}
            <a href="{{ route('news.create') }}" class="flex items-center p-4 border border-slate-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 hover:shadow-lg transition group cursor-pointer">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-pen-nib text-xl"></i>
                </div>
                <div>
                    <span class="block text-lg font-extrabold text-slate-800 group-hover:text-blue-700">Tulis Berita</span>
                    <span class="text-sm text-slate-500">Publikasi kegiatan terbaru</span>
                </div>
            </a>

            {{-- Tombol Buat Pengumuman --}}
            <a href="{{ route('announcements.create') }}" class="flex items-center p-4 border border-slate-200 rounded-xl hover:border-yellow-500 hover:bg-yellow-50 hover:shadow-lg transition group cursor-pointer">
                <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-4 group-hover:bg-yellow-500 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-bullhorn text-xl"></i>
                </div>
                <div>
                    <span class="block text-lg font-extrabold text-slate-800 group-hover:text-yellow-700">Buat Pengumuman</span>
                    <span class="text-sm text-slate-500">Info penting layanan</span>
                </div>
            </a>

            {{-- Tombol Profil --}}
            <a href="{{ route('profile.edit') }}" class="flex items-center p-4 border border-slate-200 rounded-xl hover:border-slate-500 hover:bg-slate-50 hover:shadow-lg transition group cursor-pointer">
                <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center mr-4 group-hover:bg-slate-800 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-user-gear text-xl"></i>
                </div>
                <div>
                    <span class="block text-lg font-extrabold text-slate-800">Profil Saya</span>
                    <span class="text-sm text-slate-500">Edit akun & password</span>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- 5. TABEL KUNJUNGAN PENDING --}}
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden flex flex-col">
    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/70">
        <h3 class="text-xl font-extrabold text-slate-800 flex items-center gap-2">
            <i class="fa-solid fa-hourglass-half text-slate-400"></i> Permintaan Kunjungan Menunggu Persetujuan
        </h3>
        <a href="{{ route('admin.kunjungan.index') }}" class="text-sm font-bold bg-slate-100 text-slate-600 px-4 py-2 rounded-lg hover:bg-slate-200 transition inline-flex items-center gap-2">
            Kelola Semua <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="overflow-x-auto flex-grow">
        <table class="w-full text-base text-left">
            <thead class="bg-slate-100 text-slate-600 uppercase text-sm font-bold tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4">Nama Pemohon</th>
                    <th class="px-6 py-4">Tujuan (WBP)</th>
                    <th class="px-6 py-4 text-right">Tanggal Diajukan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pendingKunjungans as $item)
                <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition duration-150">
                    <td class="px-6 py-4">
                        <span class="font-semibold text-slate-800 block">{{ $item->nama_pengunjung }}</span>
                        <span class="text-sm text-gray-500">NIK: {{ $item->nik_pengunjung }}</span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-800">
                        {{ $item->nama_wbp }}
                    </td>
                    <td class="px-6 py-4 text-right text-slate-500 text-sm">
                        {{ $item->created_at->diffForHumans() }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <div class="bg-slate-50 p-4 rounded-full mb-3">
                                <i class="fa-solid fa-check-double text-4xl text-green-500"></i>
                            </div>
                            <p class="font-medium text-lg">Tidak ada kunjungan yang menunggu persetujuan.</p>
                            <p class="text-sm mt-1">Semua pendaftaran sudah diproses.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- WIDGET AKSESIBILITAS --}}
{{-- Ini akan memunculkan tombol kursi roda di pojok kiri bawah Dashboard Admin --}}
<x-aksesibilitas />

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('visitsChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: @json($chartData),
                        backgroundColor: 'rgba(30, 64, 175, 0.5)',
                        borderColor: 'rgba(30, 64, 175, 1)',
                        borderWidth: 2,
                        borderRadius: 5,
                        hoverBackgroundColor: 'rgba(30, 64, 175, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                // Force integer steps only
                                callback: function(value) {if (value % 1 === 0) {return value;}}
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.parsed.y + ' Kunjungan';
                                }
                            }
                        }
                    }
                }
            });
        }

        const kunjunganStatusCtx = document.getElementById('kunjunganStatusChart');
        if (kunjunganStatusCtx) {
            new Chart(kunjunganStatusCtx, {
                type: 'doughnut', // Changed to doughnut
                data: {
                    labels: @json($chartKunjunganStatusLabels),
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: @json($chartKunjunganStatusData),
                        backgroundColor: [
                            'rgba(251, 191, 36, 0.7)', // Yellow for Pending
                            'rgba(16, 185, 129, 0.7)', // Green for Approved
                            'rgba(239, 68, 68, 0.7)',  // Red for Rejected
                        ],
                        borderColor: [
                            'rgba(251, 191, 36, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(239, 68, 68, 1)',
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right', // Position legend to the right
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((acc, current) => acc + current, 0);
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(2) + '%' : '0.00%';
                                    return ` ${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection