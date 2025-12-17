@extends('layouts.admin')

@section('content')

    <div class="relative bg-gradient-to-r from-slate-900 to-blue-900 rounded-2xl p-8 mb-8 text-white shadow-xl overflow-hidden">
        <div class="relative z-10 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-slate-300">Berikut adalah ringkasan aktivitas di Lembaga Pemasyarakatan Kelas 2B Jombang.</p>
            </div>
            <div class="hidden md:block text-right">
                <p class="text-3xl font-mono font-bold text-yellow-500">{{ now()->format('H:i') }}</p>
                <p class="text-sm text-slate-300">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-yellow-500 opacity-10 transform skew-x-12 translate-x-12"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center hover:-translate-y-1 transition duration-300">
            <div class="p-4 bg-blue-50 text-blue-600 rounded-xl mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Berita</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $totalNews }}</h3>
                <a href="{{ route('news.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua &rarr;</a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center hover:-translate-y-1 transition duration-300">
            <div class="p-4 bg-yellow-50 text-yellow-600 rounded-xl mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Pengumuman</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $totalAnnouncements }}</h3>
                <a href="{{ route('announcements.index') }}" class="text-xs text-yellow-600 hover:underline">Lihat semua &rarr;</a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center hover:-translate-y-1 transition duration-300">
            <div class="p-4 bg-green-50 text-green-600 rounded-xl mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Petugas Admin</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ $totalUsers }}</h3>
                <span class="text-xs text-green-600">Akun Terdaftar</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Berita Terbaru</h3>
                <a href="{{ route('news.create') }}" class="text-sm bg-slate-900 text-white px-3 py-1.5 rounded-lg hover:bg-slate-700 transition">+ Tulis Baru</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Judul</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($latestNews as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ Str::limit($item->title, 40) }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status == 'published')
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold">Tayang</span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full font-bold">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-gray-500">
                                {{ $item->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">
                                Belum ada berita yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Akses Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('news.create') }}" class="block p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition group">
                    <div class="flex items-center">
                        <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-slate-700">Tulis Berita</span>
                            <span class="text-xs text-gray-500">Publikasikan kegiatan terbaru</span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('announcements.create') }}" class="block p-3 border border-gray-200 rounded-lg hover:bg-yellow-50 hover:border-yellow-200 transition group">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-3 group-hover:bg-yellow-500 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-slate-700">Buat Pengumuman</span>
                            <span class="text-xs text-gray-500">Informasi penting layanan</span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition group">
                    <div class="flex items-center">
                        <div class="bg-gray-100 text-gray-600 p-2 rounded-lg mr-3 group-hover:bg-gray-800 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-slate-700">Profil Saya</span>
                            <span class="text-xs text-gray-500">Edit akun & password</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection