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
<div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
            <h3 class="text-xl font-extrabold text-slate-800 mb-1">Pantauan Kuota Hari Ini</h3>
            <p class="text-sm text-slate-500 mb-6">{{ \Carbon\Carbon::today()->translatedFormat('l, d F Y') }}</p>
            
            @if ($isMonday)
                <div class="space-y-5">
                    <div>
                        @php $persentasePagi = ($kuotaPagi > 0) ? (($pendaftarPagi / $kuotaPagi) * 100) : 0; @endphp
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-base font-bold text-slate-700 flex items-center gap-2.5"><i class="fa-solid fa-sun text-yellow-500"></i>Sesi Pagi</span>
                            <span class="text-sm font-bold text-slate-800">{{ $pendaftarPagi }} / <span class="text-slate-500">{{ $kuotaPagi }}</span></span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5"><div class="bg-yellow-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $persentasePagi }}%"></div></div>
                    </div>
                    <div>
                        @php $persentaseSiang = ($kuotaSiang > 0) ? (($pendaftarSiang / $kuotaSiang) * 100) : 0; @endphp
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-base font-bold text-slate-700 flex items-center gap-2.5"><i class="fa-solid fa-cloud-sun text-orange-500"></i>Sesi Siang</span>
                            <span class="text-sm font-bold text-slate-800">{{ $pendaftarSiang }} / <span class="text-slate-500">{{ $kuotaSiang }}</span></span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5"><div class="bg-orange-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $persentaseSiang }}%"></div></div>
                    </div>
                </div>
            @elseif ($isVisitingDay)
                 <div>
                    @php $persentaseBiasa = ($kuotaBiasa > 0) ? (($pendaftarBiasa / $kuotaBiasa) * 100) : 0; @endphp
                    <div class="flex justify-between items-center mb-1.5">
                        <span class="text-base font-bold text-slate-700 flex items-center gap-2.5"><i class="fa-solid fa-calendar-day text-blue-500"></i>Total Pendaftar</span>
                        <span class="text-sm font-bold text-slate-800">{{ $pendaftarBiasa }} / <span class="text-slate-500">{{ $kuotaBiasa }}</span></span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2.5"><div class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $persentaseBiasa }}%"></div></div>
                </div>
            @else
                <div class="bg-blue-50 text-blue-800 font-semibold text-center p-4 rounded-lg border border-blue-200 w-full">Layanan Kunjungan Tidak Tersedia Hari Ini</div>
            @endif
        </div>

{{-- 2. STATISTIK CARDS --}}
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-5 mb-8">
    {{-- Card Kunjungan Pending --}}
    <div class="bg-gradient-to-br from-yellow-400 to-orange-500 text-white p-5 rounded-2xl shadow-lg hover:shadow-yellow-500/30 transition-all duration-300 transform hover:-translate-y-1.5">
        <p class="text-sm font-bold opacity-80 mb-2">Menunggu Persetujuan</p>
        <div class="flex justify-between items-center">
            <h3 class="text-4xl font-black">{{ $totalPendingKunjungans }}</h3>
            <i class="fa-solid fa-hourglass-half text-4xl opacity-30"></i>
        </div>
    </div>
    {{-- Card Disetujui Hari Ini --}}
    <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white p-5 rounded-2xl shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-1.5">
        <p class="text-sm font-bold opacity-80 mb-2">Disetujui Hari Ini</p>
        <div class="flex justify-between items-center">
            <h3 class="text-4xl font-black">{{ $totalApprovedToday }}</h3>
            <i class="fa-solid fa-calendar-check text-4xl opacity-30"></i>
        </div>
    </div>
    {{-- Card Ditolak --}}
    <div class="bg-gradient-to-br from-red-500 to-rose-600 text-white p-5 rounded-2xl shadow-lg hover:shadow-red-500/30 transition-all duration-300 transform hover:-translate-y-1.5">
        <p class="text-sm font-bold opacity-80 mb-2">Ditolak Total</p>
        <div class="flex justify-between items-center">
            <h3 class="text-4xl font-black">{{ $totalRejectedKunjungans }}</h3>
            <i class="fa-solid fa-ban text-4xl opacity-30"></i>
        </div>
    </div>
    {{-- Card Total Kunjungan --}}
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-5 rounded-2xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1.5">
        <p class="text-sm font-bold opacity-80 mb-2">Total Pendaftar</p>
        <div class="flex justify-between items-center">
            <h3 class="text-4xl font-black">{{ $totalKunjungans }}</h3>
            <i class="fa-solid fa-users text-4xl opacity-30"></i>
        </div>
    </div>
    {{-- Card Total Berita --}}
    <div class="bg-gradient-to-br from-purple-500 to-violet-600 text-white p-5 rounded-2xl shadow-lg hover:shadow-purple-500/30 transition-all duration-300 transform hover:-translate-y-1.5">
        <p class="text-sm font-bold opacity-80 mb-2">Total Berita</p>
        <div class="flex justify-between items-center">
            <h3 class="text-4xl font-black">{{ $totalNews }}</h3>
            <i class="fa-solid fa-newspaper text-4xl opacity-30"></i>
        </div>
    </div>
    {{-- Card Total Pengumuman --}}
    <div class="bg-gradient-to-br from-sky-500 to-cyan-600 text-white p-5 rounded-2xl shadow-lg hover:shadow-sky-500/30 transition-all duration-300 transform hover:-translate-y-1.5">
        <p class="text-sm font-bold opacity-80 mb-2">Total Pengumuman</p>
        <div class="flex justify-between items-center">
            <h3 class="text-4xl font-black">{{ $totalAnnouncements }}</h3>
            <i class="fa-solid fa-bullhorn text-4xl opacity-30"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-8">
    {{-- Main Content Column --}}
    <div class="lg:col-span-3 space-y-8">
        {{-- CHART KUNJUNGAN --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
            <h3 class="text-xl font-extrabold text-slate-800 mb-6">Kunjungan Disetujui (7 Hari Terakhir)</h3>
            <div class="h-64"><canvas id="visitsChart"></canvas></div>
        </div>

        {{-- TABEL KUNJUNGAN PENDING --}}
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50">
                <h3 class="text-xl font-extrabold text-slate-800 flex items-center gap-2"><i class="fa-solid fa-hourglass-half text-slate-400"></i>5 Pendaftar Kunjungan Terbaru</h3>
                <a href="{{ route('admin.kunjungan.index', ['status' => 'pending']) }}" class="text-sm font-bold bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300 transition inline-flex items-center gap-2">
                    Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-100 text-slate-600 uppercase font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-3">Pemohon</th>
                            <th class="px-6 py-3">Tujuan (WBP)</th>
                            <th class="px-6 py-3">Tanggal Kunjungan</th>
                            <th class="px-6 py-3 text-right">Diajukan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pendingKunjungans as $item)
                        <tr class="hover:bg-blue-50/50 transition duration-150">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-800 block">{{ $item->nama_pengunjung }}</span>
                                <span class="text-xs text-gray-500">NIK: {{ $item->nik_pengunjung }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-700">{{ $item->nama_wbp }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4 text-right text-slate-500 text-xs">{{ $item->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-check-double text-5xl text-green-500 mb-3"></i>
                                    <p class="font-medium text-lg">Tidak ada pendaftar baru.</p>
                                    <p class="text-sm mt-1">Semua permintaan kunjungan sudah diproses.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Sidebar Column --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- AKSES CEPAT --}}
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
            <h3 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2"><i class="fa-solid fa-bolt text-yellow-500"></i>Akses Cepat</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('news.create') }}" class="text-center p-4 rounded-xl hover:shadow-lg transition group cursor-pointer bg-slate-50 hover:bg-white border-2 border-transparent hover:border-blue-500">
                    <i class="fa-solid fa-pen-nib text-3xl text-blue-500 mb-2 transition-transform group-hover:scale-110"></i>
                    <span class="block font-bold text-slate-800 group-hover:text-blue-600">Tulis Berita</span>
                </a>
                <a href="{{ route('announcements.create') }}" class="text-center p-4 rounded-xl hover:shadow-lg transition group cursor-pointer bg-slate-50 hover:bg-white border-2 border-transparent hover:border-yellow-500">
                    <i class="fa-solid fa-bullhorn text-3xl text-yellow-500 mb-2 transition-transform group-hover:scale-110"></i>
                    <span class="block font-bold text-slate-800 group-hover:text-yellow-600">Buat Pengumuman</span>
                </a>
                <a href="{{ route('admin.kunjungan.index') }}" class="text-center p-4 rounded-xl hover:shadow-lg transition group cursor-pointer bg-slate-50 hover:bg-white border-2 border-transparent hover:border-green-500">
                    <i class="fa-solid fa-users text-3xl text-green-500 mb-2 transition-transform group-hover:scale-110"></i>
                    <span class="block font-bold text-slate-800 group-hover:text-green-600">Kelola Kunjungan</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="text-center p-4 rounded-xl hover:shadow-lg transition group cursor-pointer bg-slate-50 hover:bg-white border-2 border-transparent hover:border-slate-500">
                    <i class="fa-solid fa-user-gear text-3xl text-slate-500 mb-2 transition-transform group-hover:scale-110"></i>
                    <span class="block font-bold text-slate-800 group-hover:text-slate-600">Profil Saya</span>
                </a>
            </div>
        </div>

        {{-- CHART STATUS KUNJUNGAN --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
            <h3 class="text-xl font-extrabold text-slate-800 mb-6">Publikasi Konten</h3>
            <div class="h-64 flex justify-center"><canvas id="publicationsChart"></canvas></div>
        </div>
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

        const publicationsCtx = document.getElementById('publicationsChart');
        if (publicationsCtx) {
            new Chart(publicationsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Berita', 'Pengumuman'],
                    datasets: [{
                        label: 'Jumlah Publikasi',
                        data: [@json($totalNews), @json($totalAnnouncements)],
                        backgroundColor: [
                            'rgba(147, 51, 234, 0.7)', // Purple for News
                            'rgba(99, 102, 241, 0.7)',  // Indigo for Announcements
                        ],
                        borderColor: [
                            'rgba(147, 51, 234, 1)',
                            'rgba(99, 102, 241, 1)',
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
                            position: 'right',
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

    // Real-time updates
    function updateDashboardStats() {
        fetch('{{ route("dashboard.stats") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update counts
            document.getElementById('pending-count').textContent = data.totalPendingKunjungans;
            document.getElementById('approved-today-count').textContent = data.totalApprovedToday;
            document.getElementById('rejected-count').textContent = data.totalRejectedKunjungans;
            document.getElementById('total-kunjungan-count').textContent = data.totalKunjungans;
            document.getElementById('total-news-count').textContent = data.totalNews;
            document.getElementById('total-announcements-count').textContent = data.totalAnnouncements;

            // Update quota if available
            if (data.pendaftarPagi !== null) {
                document.getElementById('pagi-count').textContent = data.pendaftarPagi;
                const pagiPercent = data.kuotaPagi > 0 ? ((data.pendaftarPagi / data.kuotaPagi) * 100).toFixed(1) : 0;
                document.getElementById('pagi-percent').textContent = pagiPercent + '%';
                document.getElementById('pagi-bar').style.width = pagiPercent + '%';
            }
            if (data.pendaftarSiang !== null) {
                document.getElementById('siang-count').textContent = data.pendaftarSiang;
                const siangPercent = data.kuotaSiang > 0 ? ((data.pendaftarSiang / data.kuotaSiang) * 100).toFixed(1) : 0;
                document.getElementById('siang-percent').textContent = siangPercent + '%';
                document.getElementById('siang-bar').style.width = siangPercent + '%';
            }
            if (data.pendaftarBiasa !== null) {
                document.getElementById('biasa-count').textContent = data.pendaftarBiasa;
                const biasaPercent = data.kuotaBiasa > 0 ? ((data.pendaftarBiasa / data.kuotaBiasa) * 100).toFixed(1) : 0;
                document.getElementById('biasa-percent').textContent = biasaPercent + '%';
                document.getElementById('biasa-bar').style.width = biasaPercent + '%';
            }
        })
        .catch(error => console.error('Error updating dashboard:', error));
    }

    // Update every 30 seconds
    setInterval(updateDashboardStats, 30000);
</script>
@endsection