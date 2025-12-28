@extends('layouts.main')

@section('content')

{{-- Read Progress Bar --}}
<div class="fixed top-0 left-0 z-50 w-full h-1 bg-blue-200"
    x-data="{ progressBar: 0 }"
    x-init="window.addEventListener('scroll', () => {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        progressBar = (winScroll / height) * 100;
    })">
    <div class="h-full bg-blue-600 transition-all duration-100 ease-out" :style="`width: ${progressBar}%`"></div>
</div>

<section class="relative bg-slate-900 text-white min-h-[300px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ $news->image ?? 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Kantor_Wilayah_Kementerian_Hukum_dan_HAM_Republik_Indonesia_Jawa_Tengah.jpg/1200px-Kantor_Wilayah_Kementerian_Hukum_dan_HAM_Republik_Indonesia_Jawa_Tengah.jpg' }}"
            alt="Background News"
            class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 to-slate-900/90"></div>
    </div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-tight">
            {{ $news->title }}
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto font-light">
            Dipublikasikan pada {{ $news->created_at->translatedFormat('d F Y') }}
        </p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        {{-- Social Sharing Buttons --}}
        <div class="flex justify-center gap-4 mb-8">
            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.public.show', $news->slug)) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full transition transform hover:-translate-y-1" aria-label="Share on WhatsApp">
                <i class="fab fa-whatsapp text-xl"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.public.show', $news->slug)) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition transform hover:-translate-y-1" aria-label="Share on Facebook">
                <i class="fab fa-facebook-f text-xl"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.public.show', $news->slug)) }}&text={{ urlencode($news->title) }}" target="_blank" class="bg-blue-400 hover:bg-blue-500 text-white p-3 rounded-full transition transform hover:-translate-y-1" aria-label="Share on Twitter">
                <i class="fab fa-twitter text-xl"></i>
            </a>
        </div>

        <div class="prose prose-lg max-w-none">
            @if($news->image)
            <img src="{{ $news->image }}" alt="{{ $news->title }}" class="w-full rounded-lg shadow-lg mb-8" loading="lazy">
            @endif
            
            {!! $news->content !!}
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200 text-center">
            <a href="{{ route('news.public.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</section>

{{-- Back to Top Button --}}
<button x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 300) ? true : false"
    x-show="showButton" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200"
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 z-40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    aria-label="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>
@endsection