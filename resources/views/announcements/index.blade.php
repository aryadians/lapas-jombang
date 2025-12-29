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
            Papan <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 bg-clip-text text-transparent animate-text-shimmer">Pengumuman</span>
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
            <div class="group relative bg-white rounded-2xl overflow-hidden transition-all duration-700 border border-slate-200 hover:border-emerald-400 card-hover-scale flex flex-col card-3d" style="box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);">

                {{-- Date Badge --}}
                <div class="absolute top-6 right-6 z-10">
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-4 py-3 rounded-2xl shadow-lg group-hover:scale-110 transition-all duration-300 border border-emerald-400/50 group-hover:animate-float-up">
                        <div class="text-center">
                            <span class="block text-2xl font-bold">{{ $announcement->date->format('d') }}</span>
                            <span class="block text-xs font-semibold uppercase tracking-widest">{{ $announcement->date->format('M') }}</span>
                            <span class="block text-xs opacity-90">{{ $announcement->date->format('Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Priority Indicator --}}
                @if($loop->first)
                <div class="absolute top-6 left-6 z-10">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg animate-pulse border border-red-400/50 inline-flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle"></i>
                        PRIORITAS
                    </div>
                </div>
                @endif

                {{-- Content --}}
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex items-start space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform duration-300 border border-yellow-300/50 group-hover:animate-float-up">
                                <span class="text-2xl">📢</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-2 flex-wrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 gap-1">
                                    <i class="fas fa-bullhorn text-sm"></i>
                                    Pengumuman
                                </span>
                                <span class="text-xs text-slate-500 font-medium">
                                    {{ $announcement->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-emerald-700 transition-colors duration-300 leading-snug">
                                {{ $announcement->title }}
                            </h3>
                        </div>
                    </div>
                    
                    <p class="text-slate-600 mb-4 leading-relaxed line-clamp-3 flex-grow">
                        {{ Str::limit(strip_tags($announcement->content), 200) }}
                    </p>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                        <div class="flex items-center text-sm text-slate-500 group-hover:text-slate-600 transition-colors">
                            <i class="far fa-calendar-alt mr-2"></i>
                            {{ $announcement->created_at->translatedFormat('d F Y') }}
                        </div>
                        <a href="{{ route('announcements.public.show', $announcement) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-all btn-hover-lift shadow-lg group-hover:shadow-emerald-500/25 duration-300 gap-2">
                            <i class="fas fa-eye text-sm"></i>
                            <span class="text-sm">Baca</span>
                        </a>
                    </div>
                </div>

                {{-- Hover Effect Border --}}
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500/10 to-yellow-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center py-24 bg-gradient-to-br from-slate-50 to-slate-100 rounded-3xl border-2 border-dashed border-slate-300">
                    <div class="max-w-md mx-auto">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg border border-slate-200">
                            <span class="text-4xl">📭</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-700 mb-2">Belum Ada Pengumuman</h3>
                        <p class="text-slate-600">
                            Saat ini belum ada pengumuman yang diterbitkan. Silakan kembali lagi nanti untuk informasi terbaru.
                        </p>
                    </div>
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
