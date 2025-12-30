@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    {{-- 1. HERO SECTION & JAM REALTIME --}}
    <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 rounded-2xl p-8 text-white shadow-2xl overflow-hidden border-2 border-slate-800">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-yellow-500 opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 rounded-full bg-blue-500 opacity-10 blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight">Halo, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-slate-300 mt-2 max-w-lg">Selamat datang di Panel Kontrol Sistem Informasi Lapas Jombang.</p>
            </div>
            <div class="text-center md:text-right bg-white/10 p-4 rounded-xl border border-white/20 backdrop-blur-sm min-w-[220px]">
                <p id="realtime-clock" class="text-4xl font-mono font-bold text-yellow-400">{{ now()->format('H:i:s') }}</p>
                <p id="realtime-date" class="text-xs font-semibold text-slate-300 uppercase tracking-widest mt-1">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
    </div>

    {{-- 2. STATISTIK CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @php
            $stats = [
                ['label' => 'Menunggu Persetujuan', 'value' => $totalPendingKunjungans, 'icon' => 'fa-hourglass-half', 'color' => 'yellow'],
                ['label' => 'Disetujui Hari Ini', 'value' => $totalApprovedToday, 'icon' => 'fa-calendar-check', 'color' => 'green'],
                ['label' => 'Total Pendaftar', 'value' => $totalKunjungans, 'icon' => 'fa-users', 'color' => 'blue'],
                ['label' => 'Total Berita', 'value' => $totalNews, 'icon' => 'fa-newspaper', 'color' => 'purple'],
            ];
            $colors = [
                'yellow' => 'from-yellow-400 to-orange-500 hover:shadow-yellow-500/40',
                'green' => 'from-green-500 to-emerald-600 hover:shadow-green-500/40',
                'blue' => 'from-blue-600 to-indigo-700 hover:shadow-blue-500/40',
                'purple' => 'from-purple-500 to-violet-600 hover:shadow-purple-500/40',
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="bg-gradient-to-br {{ $colors[$stat['color']] }} text-white p-6 rounded-2xl shadow-lg transition-all duration-300 transform hover:-translate-y-1.5 hover:shadow-2xl">
            <div class="flex justify-between items-start">
                <p class="text-sm font-bold opacity-80 uppercase tracking-wider">{{ $stat['label'] }}</p>
                <i class="fa-solid {{ $stat['icon'] }} text-2xl opacity-30"></i>
            </div>
            <h3 class="text-5xl font-black mt-2">{{ $stat['value'] }}</h3>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- CHART KUNJUNGAN --}}
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Statistik Kunjungan Disetujui (7 Hari Terakhir)</h3>
                <div class="h-72"><canvas id="visitsChart"></canvas></div>
            </div>

            {{-- KUOTA HARI INI --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                <h3 class="text-xl font-bold text-slate-800 mb-1">Pantauan Kuota Hari Ini</h3>
                <p class="text-sm text-slate-500 mb-6">{{ \Carbon\Carbon::today()->translatedFormat('l, d F Y') }}</p>
                @if ($isMonday || $isVisitingDay)
                <div class="grid grid-cols-1 {{ $isMonday ? 'md:grid-cols-2' : '' }} gap-6">
                    @if($isMonday)
                        @php $persentasePagi = ($kuotaPagi > 0) ? (($pendaftarPagi / $kuotaPagi) * 100) : 0; @endphp
                        <div class="space-y-2">
                            <div class="flex justify-between items-center"><span class="font-bold text-slate-700 flex items-center gap-2"><i class="fa-solid fa-sun text-yellow-500"></i>Sesi Pagi</span><span class="font-bold text-slate-800">{{ $pendaftarPagi }}/{{ $kuotaPagi }}</span></div>
                            <div class="w-full bg-slate-200 rounded-full h-3"><div class="bg-yellow-500 h-3 rounded-full" style="width: {{ $persentasePagi }}%"></div></div>
                        </div>
                        @php $persentaseSiang = ($kuotaSiang > 0) ? (($pendaftarSiang / $kuotaSiang) * 100) : 0; @endphp
                        <div class="space-y-2">
                            <div class="flex justify-between items-center"><span class="font-bold text-slate-700 flex items-center gap-2"><i class="fa-solid fa-cloud-sun text-orange-500"></i>Sesi Siang</span><span class="font-bold text-slate-800">{{ $pendaftarSiang }}/{{ $kuotaSiang }}</span></div>
                            <div class="w-full bg-slate-200 rounded-full h-3"><div class="bg-orange-500 h-3 rounded-full" style="width: {{ $persentaseSiang }}%"></div></div>
                        </div>
                    @else
                        @php $persentaseBiasa = ($kuotaBiasa > 0) ? (($pendaftarBiasa / $kuotaBiasa) * 100) : 0; @endphp
                         <div class="space-y-2">
                            <div class="flex justify-between items-center"><span class="font-bold text-slate-700">Total Hari Ini</span><span class="font-bold text-slate-800">{{ $pendaftarBiasa }}/{{ $kuotaBiasa }}</span></div>
                            <div class="w-full bg-slate-200 rounded-full h-3"><div class="bg-blue-500 h-3 rounded-full" style="width: {{ $persentaseBiasa }}%"></div></div>
                        </div>
                    @endif
                </div>
                @else
                <div class="bg-blue-50 text-blue-800 font-semibold text-center p-5 rounded-lg border border-blue-200">Layanan Kunjungan Tidak Tersedia Hari Ini</div>
                @endif
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-8">
            {{-- AKSES CEPAT --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Akses Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('news.create') }}" class="text-center p-4 rounded-xl bg-slate-50 hover:bg-white border-2 border-transparent hover:border-blue-500 hover:shadow-xl transition group">
                        <i class="fa-solid fa-pen-nib text-3xl text-blue-500 mb-2"></i><span class="block font-bold text-slate-800 group-hover:text-blue-600">Tulis Berita</span>
                    </a>
                    <a href="{{ route('announcements.create') }}" class="text-center p-4 rounded-xl bg-slate-50 hover:bg-white border-2 border-transparent hover:border-yellow-500 hover:shadow-xl transition group">
                        <i class="fa-solid fa-bullhorn text-3xl text-yellow-500 mb-2"></i><span class="block font-bold text-slate-800 group-hover:text-yellow-600">Umumkan</span>
                    </a>
                    <a href="{{ route('admin.kunjungan.verifikasi') }}" class="text-center p-4 rounded-xl bg-slate-50 hover:bg-white border-2 border-transparent hover:border-green-500 hover:shadow-xl transition group">
                        <i class="fa-solid fa-qrcode text-3xl text-green-500 mb-2"></i><span class="block font-bold text-slate-800 group-hover:text-green-600">Verifikasi QR</span>
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="text-center p-4 rounded-xl bg-slate-50 hover:bg-white border-2 border-transparent hover:border-purple-500 hover:shadow-xl transition group">
                        <i class="fa-solid fa-user-plus text-3xl text-purple-500 mb-2"></i><span class="block font-bold text-slate-800 group-hover:text-purple-600">Tambah User</span>
                    </a>
                </div>
            </div>

            {{-- AKTIVITAS TERBARU --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100">
                <div class="px-6 py-5 border-b border-slate-200">
                    <h3 class="text-xl font-bold text-slate-800">Aktivitas Terbaru</h3>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($pendingKunjungans as $item)
                    <div class="flex items-start gap-4 hover:bg-slate-50 p-2 rounded-lg">
                        <div class="bg-yellow-100 text-yellow-600 h-10 w-10 flex-shrink-0 flex items-center justify-center rounded-full"><i class="fa-solid fa-hourglass-half"></i></div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Pendaftar baru: <span class="font-bold">{{ $item->nama_pengunjung }}</span></p>
                            <p class="text-xs text-slate-500">{{ $item->created_at->diffForHumans() }} &bull; Untuk {{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d M Y') }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-slate-500 text-center py-4">Belum ada aktivitas pendaftaran baru.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('realtime-clock').textContent = now.toLocaleTimeString('id-ID', { hour12: false }).replace(/\./g, ':');
        document.getElementById('realtime-date').textContent = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    }
    setInterval(updateClock, 1000);

    document.addEventListener('DOMContentLoaded', () => {
        const visitsChartCtx = document.getElementById('visitsChart')?.getContext('2d');
        if (visitsChartCtx) {
            new Chart(visitsChartCtx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Kunjungan Disetujui',
                        data: @json($chartData),
                        backgroundColor: 'rgba(30, 64, 175, 0.8)',
                        borderColor: 'rgba(30, 64, 175, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        hoverBackgroundColor: 'rgba(30, 58, 138, 1)'
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                    plugins: { legend: { display: false } }
                }
            });
        }
    });
</script>
@endsection