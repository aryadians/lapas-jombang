@extends('layouts.admin')

@section('content')

{{-- 1. HERO SECTION & JAM REALTIME --}}
<div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 rounded-3xl p-8 mb-10 text-white shadow-2xl overflow-hidden border border-slate-700">
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
            <p id="realtime-clock" class="text-4xl font-mono font-bold text-yellow-400 tracking-wider drop-shadow-md">
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

{{-- 2. STATISTIK CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    {{-- Card Berita --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Berita</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $totalNews }}</h3>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition">
                <i class="fa-regular fa-newspaper text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-50">
            <a href="{{ route('news.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                Kelola Berita <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Card Pengumuman --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Pengumuman</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $totalAnnouncements }}</h3>
            </div>
            <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl group-hover:bg-yellow-500 group-hover:text-white transition">
                <i class="fa-solid fa-bullhorn text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-50">
            <a href="{{ route('announcements.index') }}" class="text-xs font-bold text-yellow-600 hover:text-yellow-800 flex items-center gap-1">
                Kelola Pengumuman <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Card Petugas --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Petugas Admin</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $totalUsers }}</h3>
            </div>
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition">
                <i class="fa-solid fa-users-gear text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-50">
            <span class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                <i class="fa-solid fa-circle-check"></i> Akun Aktif
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- 3. TABEL BERITA TERBARU --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-slate-400"></i> Publikasi Terbaru
            </h3>
            <a href="{{ route('news.create') }}" class="text-xs font-bold bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition shadow-lg shadow-slate-300/50">
                <i class="fa-solid fa-plus mr-1"></i> Tulis Baru
            </a>
        </div>

        <div class="overflow-x-auto flex-grow">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Judul Artikel</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($latestNews as $item)
                    <tr class="hover:bg-slate-50/80 transition duration-150">
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            {{ Str::limit($item->title, 50) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($item->status == 'published')
                            <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 text-[10px] uppercase font-bold px-2 py-1 rounded-full border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Tayang
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-600 text-[10px] uppercase font-bold px-2 py-1 rounded-full border border-slate-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Draft
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-slate-500 text-xs">
                            {{ $item->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <div class="bg-slate-50 p-4 rounded-full mb-3">
                                    <i class="fa-regular fa-folder-open text-3xl"></i>
                                </div>
                                <p class="font-medium">Belum ada berita yang ditambahkan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 4. AKSES CEPAT (Quick Actions) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 h-fit">
        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-bolt text-yellow-500"></i> Akses Cepat
        </h3>
        <div class="space-y-4">
            {{-- Tombol Tulis Berita --}}
            <a href="{{ route('news.create') }}" class="flex items-center p-4 border border-slate-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 hover:shadow-md transition group cursor-pointer">
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-600 group-hover:text-white transition">
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
                <div>
                    <span class="block font-bold text-slate-800 group-hover:text-blue-700">Tulis Berita</span>
                    <span class="text-xs text-slate-500">Publikasi kegiatan terbaru</span>
                </div>
            </a>

            {{-- Tombol Buat Pengumuman --}}
            <a href="{{ route('announcements.create') }}" class="flex items-center p-4 border border-slate-200 rounded-xl hover:border-yellow-500 hover:bg-yellow-50 hover:shadow-md transition group cursor-pointer">
                <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-4 group-hover:bg-yellow-500 group-hover:text-white transition">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div>
                    <span class="block font-bold text-slate-800 group-hover:text-yellow-700">Buat Pengumuman</span>
                    <span class="text-xs text-slate-500">Info penting layanan</span>
                </div>
            </a>

            {{-- Tombol Profil --}}
            <a href="{{ route('profile.edit') }}" class="flex items-center p-4 border border-slate-200 rounded-xl hover:border-slate-500 hover:bg-slate-50 hover:shadow-md transition group cursor-pointer">
                <div class="w-10 h-10 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center mr-4 group-hover:bg-slate-800 group-hover:text-white transition">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div>
                    <span class="block font-bold text-slate-800">Profil Saya</span>
                    <span class="text-xs text-slate-500">Edit akun & password</span>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- 5. WIDGET AKSESIBILITAS --}}
{{-- Ini akan memunculkan tombol kursi roda di pojok kiri bawah Dashboard Admin --}}
<x-aksesibilitas />

@endsection