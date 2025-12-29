@extends('layouts.main')

@section('content')

{{-- Read Progress Bar --}}
<div class="fixed top-0 left-0 z-50 w-full h-1 bg-gradient-to-r from-emerald-500 to-yellow-600"
    x-data="{ progressBar: 0 }"
    x-init="window.addEventListener('scroll', () => {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        progressBar = (winScroll / height) * 100;
    })">
    <div class="h-full bg-gradient-to-r from-emerald-600 to-yellow-700 transition-all duration-100 ease-out" :style="`width: ${progressBar}%`"></div>
</div>

{{-- Breadcrumb --}}
<section class="bg-gray-50 py-4">
    <div class="container mx-auto px-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-emerald-600">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2A1 1 0 0 0 1 10h2v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0 1-1v-1h2v1a1 1 0 0 0 1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-8h2a1 1 0 0 0 .707-1.707Z"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('announcements.public.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-emerald-600 md:ml-2">Pengumuman</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($announcement->title, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="relative bg-gradient-to-br from-emerald-900 via-slate-900 to-emerald-900 text-white min-h-[400px] flex items-center justify-center overflow-hidden">
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
            Pengumuman Resmi
        </div>
        <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">
            {{ $announcement->title }}
        </h1>
        <div class="flex items-center justify-center space-x-6 text-sm text-emerald-100">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span>{{ $announcement->date->translatedFormat('l, d F Y') }}</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-clock mr-2"></i>
                <span>Dipublikasikan {{ $announcement->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</section>

{{-- Article Content --}}
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
            {{-- Article Header --}}
            <div class="p-8 border-b border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl">📢</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $announcement->title }}</h2>
                            <p class="text-sm text-gray-500">Pengumuman Resmi • {{ $announcement->date->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                            <i class="fas fa-bullhorn mr-1"></i>
                            Pengumuman
                        </span>
                    </div>
                </div>
            </div>

            {{-- Article Body --}}
            <div class="p-8">
                <div class="prose prose-slate max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-p:leading-relaxed prose-strong:text-gray-900 prose-ul:text-gray-700 prose-ol:text-gray-700">
                    {!! $announcement->content !!}
                </div>
            </div>

            {{-- Article Footer --}}
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>Informasi ini bersifat resmi dan mengikat</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-share-alt mr-2"></i>
                        <span>Bagikan pengumuman ini</span>
                    </div>
                </div>
            </div>
        </article>

        {{-- Back to Announcements --}}
        <div class="text-center mt-12">
            <a href="{{ route('announcements.public.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                <i class="fas fa-arrow-left mr-3"></i>
                Kembali ke Pengumuman
            </a>
        </div>
    </div>
</section>

@endsection