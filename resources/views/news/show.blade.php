@extends('layouts.main')

@section('content')

{{-- Read Progress Bar --}}
<div class="fixed top-0 left-0 z-50 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-600"
    x-data="{ progressBar: 0 }"
    x-init="window.addEventListener('scroll', () => {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        progressBar = (winScroll / height) * 100;
    })">
    <div class="h-full bg-gradient-to-r from-blue-600 to-purple-700 transition-all duration-100 ease-out" :style="`width: ${progressBar}%`"></div>
</div>

{{-- Breadcrumb --}}
<section class="bg-gray-50 py-4">
    <div class="container mx-auto px-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
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
                        <a href="{{ route('news.public.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($news->title, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white min-h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ (is_array($news->image) && count($news->image) > 0) ? $news->image[0] : asset('img/default-news-background.jpg') }}"
            alt="Background News"
            class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/70 via-slate-900/80 to-slate-900/95"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/20 to-purple-900/20"></div>
    </div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-sm font-medium text-white mb-6">
            <i class="fas fa-newspaper mr-2"></i>
            Berita Terbaru
        </div>
        <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight leading-tight">
            {{ $news->title }}
        </h1>
        <div class="flex items-center justify-center space-x-6 text-gray-300">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span>{{ $news->created_at->translatedFormat('l, d F Y') }}</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-clock mr-2"></i>
                <span>{{ $news->created_at->translatedFormat('H:i') }} WIB</span>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-5xl">
        {{-- Social Sharing Buttons --}}
        <div class="flex justify-center gap-4 mb-12">
            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.public.show', $news->slug)) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-full transition-all transform hover:-translate-y-1 hover:shadow-lg" aria-label="Share on WhatsApp">
                <i class="fab fa-whatsapp text-xl"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.public.show', $news->slug)) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full transition-all transform hover:-translate-y-1 hover:shadow-lg" aria-label="Share on Facebook">
                <i class="fab fa-facebook-f text-xl"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.public.show', $news->slug)) }}&text={{ urlencode($news->title) }}" target="_blank" class="bg-sky-500 hover:bg-sky-600 text-white p-4 rounded-full transition-all transform hover:-translate-y-1 hover:shadow-lg" aria-label="Share on Twitter">
                <i class="fab fa-twitter text-xl"></i>
            </a>
            <button onclick="navigator.share({title: '{{ $news->title }}', url: '{{ route('news.public.show', $news->slug) }}'})" class="bg-gray-600 hover:bg-gray-700 text-white p-4 rounded-full transition-all transform hover:-translate-y-1 hover:shadow-lg" aria-label="Share">
                <i class="fas fa-share-alt text-xl"></i>
            </button>
        </div>

        {{-- Main Content --}}
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
            @if(is_array($news->image) && count($news->image) > 0)
                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min(count($news->image), 3) }} gap-4 p-8 bg-gray-50">
                        @foreach($news->image as $img)
                            <div class="relative group overflow-hidden rounded-xl shadow-lg">
                                <img src="{{ $img }}" alt="{{ $news->title }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="p-8 md:p-12">
                <div class="prose prose-xl prose-slate max-w-none prose-headings:text-slate-800 prose-p:text-gray-700 prose-p:leading-relaxed prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline prose-strong:text-slate-900 prose-blockquote:border-l-blue-500 prose-blockquote:text-slate-700 prose-li:text-gray-700">
                    {!! $news->content !!}
                </div>
            </div>
        </article>

        {{-- Related News or Navigation --}}
        <div class="mt-16 text-center">
            <div class="inline-flex items-center space-x-4">
                <a href="{{ route('news.public.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <svg class="-ml-2 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                    </svg>
                    Lihat Semua Berita
                </a>
                <button onclick="window.history.back()" class="inline-flex items-center px-6 py-4 border-2 border-gray-300 text-gray-700 font-semibold rounded-full hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </button>
            </div>
        </div>
    </div>
</section>

{{-- Back to Top Button --}}
<button x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 300) ? true : false"
    x-show="showButton" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200"
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    class="fixed bottom-8 right-8 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white p-4 rounded-full shadow-2xl transition-all duration-300 z-40 focus:outline-none focus:ring-4 focus:ring-blue-300 hover:scale-110"
    aria-label="Back to top">
    <i class="fa-solid fa-arrow-up text-lg"></i>
</button>

@endsection