@extends('layouts.main')

@section('content')
<section class="relative bg-gradient-to-br from-emerald-900 via-slate-900 to-emerald-900 text-white min-h-[350px] flex items-center justify-center overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/70 via-emerald-900/80 to-emerald-900/95"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/20 to-blue-900/20"></div>
    </div>

    {{-- Floating Elements --}}
    <div class="absolute top-20 left-10 w-20 h-20 bg-emerald-500/10 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-yellow-500/10 rounded-full blur-xl animate-pulse" style="animation-delay: 1s;"></div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-sm font-semibold mb-6">
            <i class="fas fa-bullhorn mr-2"></i>
            Informasi Penting
        </div>
        <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">
            Papan <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 bg-clip-text text-transparent">Pengumuman</span>
        </h1>
        <p class="text-xl text-emerald-100 max-w-3xl mx-auto leading-relaxed">
            Informasi penting, jadwal kegiatan, dan pengumuman resmi dari Lembaga Pemasyarakatan Kelas 2B Jombang.
        </p>
    </div>
</section>

<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-6 max-w-5xl">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-emerald-100 text-emerald-800 text-sm font-semibold mb-6">
                📋 Daftar Pengumuman
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Informasi Terbaru
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Tetap update dengan informasi penting dan pengumuman resmi dari lembaga kami.
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-1">
            @forelse($allAnnouncements as $announcement)
            <div x-data="inView" x-init="init()" :class="{'opacity-0 translate-y-6': !inView}"
                 class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden transform hover:-translate-y-2"
                 style="transition-delay: {{ $loop->index * 0.1 }}s;">

                {{-- Date Badge --}}
                <div class="absolute top-6 right-6 z-10">
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white px-4 py-2 rounded-xl shadow-lg">
                        <div class="text-center">
                            <span class="block text-lg font-bold">{{ $announcement->date->format('d') }}</span>
                            <span class="block text-xs font-semibold uppercase tracking-wide">{{ $announcement->date->format('M') }}</span>
                            <span class="block text-xs opacity-90">{{ $announcement->date->format('Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="text-2xl">📢</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors duration-300 leading-tight">
                                {{ $announcement->title }}
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed line-clamp-3">
                                {{ $announcement->content }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    Dipublikasikan: {{ $announcement->created_at->translatedFormat('d F Y') }}
                                </div>
                                <div class="text-emerald-600 font-semibold text-sm group-hover:translate-x-1 transition-transform duration-300">
                                    Baca selengkapnya →
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hover Effect Border --}}
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500/20 to-yellow-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border-2 border-dashed border-gray-300">
                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl">📭</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Pengumuman</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Saat ini belum ada pengumuman yang diterbitkan. Silakan kembali lagi nanti untuk informasi terbaru.
                    </p>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-16 flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
                {{ $allAnnouncements->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
