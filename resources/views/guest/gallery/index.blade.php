@extends('layouts.main')

@section('content')

{{-- CSS KHUSUS --}}
<style>
    /* Animasi Teks Gradient Bergerak */
    .text-gradient-moving {
        background: linear-gradient(to right, #fbbf24 20%, #f59e0b 30%, #fbbf24 70%, #f59e0b 80%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        background-size: 200% auto;
        animation: textShine 4s linear infinite;
    }
    @keyframes textShine { to { background-position: 200% center; } }

    /* 3D Perspective */
    .perspective-header { perspective: 1000px; }
    .content-3d-tilt { transform-style: preserve-3d; transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1); }
    .perspective-header:hover .content-3d-tilt { transform: rotateX(2deg) rotateY(-2deg) scale(1.02); }
</style>

{{-- HERO SECTION --}}
<section class="relative pt-32 pb-20 bg-slate-900 overflow-hidden perspective-header">
    {{-- Background --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        <div class="absolute top-10 left-10 w-72 h-72 bg-blue-500/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-yellow-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
    </div>

    {{-- Content --}}
    <div class="container mx-auto px-6 relative z-10 text-center content-3d-tilt">
        <div class="transform translate-z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-4 animate-fade-in-down shadow-[0_0_15px_rgba(59,130,246,0.5)]">
                ✨ KARYA WARGA BINAAN
            </span>
        </div>

        <h1 class="text-4xl md:text-6xl font-black text-white mb-6 animate-fade-in-up drop-shadow-2xl">
            Galeri 
            <span class="text-gradient-moving font-extrabold relative inline-block">
                Bimker
                <span class="absolute inset-0 bg-yellow-500/20 blur-xl -z-10"></span>
            </span> 
            Lapas
        </h1>

        <p class="text-lg text-slate-300 max-w-2xl mx-auto mb-10 leading-relaxed animate-fade-in-up transform translate-z-20" style="animation-delay: 0.1s">
            Setiap produk adalah bukti kreativitas tanpa batas di balik jeruji. Dukung kemandirian mereka dengan membeli produk berkualitas asli buatan Lapas Kelas 2B Jombang.
        </p>

        {{-- MARKETPLACE BUTTONS --}}
        <div class="flex flex-wrap justify-center gap-4 animate-fade-in-up transform translate-z-30" style="animation-delay: 0.2s">
            
            {{-- Shopee --}}
            <a href="{{ $links['shopee'] ?? '#' }}" target="_blank" class="group relative px-8 py-3 bg-white text-slate-900 rounded-xl font-bold hover:bg-orange-50 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-orange-500/40 flex items-center gap-3 overflow-hidden ring-2 ring-transparent hover:ring-orange-400">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Shopee.svg" alt="Shopee" class="h-6 w-auto drop-shadow-sm">
                <span class="group-hover:text-orange-600 transition-colors">Official Shopee</span>
                <i class="fas fa-external-link-alt text-xs ml-1 text-slate-400 group-hover:text-orange-500"></i>
            </a>
            
            {{-- Tokopedia (FIXED ICON: Menggunakan SVG Inline) --}}
            <a href="{{ $links['tokopedia'] ?? '#' }}" target="_blank" class="group relative px-8 py-3 bg-white text-slate-900 rounded-xl font-bold hover:bg-green-50 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-green-500/40 flex items-center gap-3 overflow-hidden ring-2 ring-transparent hover:ring-green-400">
                {{-- SVG Tokopedia Hijau Original --}}
                <svg class="h-6 w-auto drop-shadow-sm" viewBox="0 0 156 142" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M129.5 45.9C128.7 44.5 127.6 43.3 126.3 42.4L103.4 27.2C103.4 27.2 103.4 27.2 103.3 27.2C101.9 26.2 100.1 26.3 98.8 27.4C97.5 28.5 97.1 30.4 97.9 31.9L107.1 49.3C99.2 45.3 90.3 43 80.9 43C70.6 43 60.9 45.8 52.6 50.6L63.2 31.9C64 30.4 63.6 28.5 62.3 27.4C61 26.3 59.2 26.2 57.8 27.2L34.8 42.4C33.5 43.3 32.4 44.5 31.6 45.9C26.1 55.4 22.9 66.4 22.9 78.1C22.9 113.3 51.4 141.8 86.6 141.8C121.8 141.8 150.3 113.3 150.3 78.1C150.3 65.7 146.7 54.1 140.5 44.2C138.2 40.2 134.4 40.2 134.4 40.2C132.3 41.8 130.6 43.8 129.5 45.9Z" fill="#00AA5B"/>
                    <path d="M49.6001 77.1C49.6001 73.1 52.8001 69.9 56.8001 69.9C60.8001 69.9 64.0001 73.1 64.0001 77.1C64.0001 81.1 60.8001 84.3 56.8001 84.3C52.9001 84.3 49.6001 81.1 49.6001 77.1Z" fill="white"/>
                    <path d="M96.1001 77.1C96.1001 73.1 99.3001 69.9 103.3 69.9C107.3 69.9 110.5 73.1 110.5 77.1C110.5 81.1 107.3 84.3 103.3 84.3C99.4001 84.3 96.1001 81.1 96.1001 77.1Z" fill="white"/>
                </svg>
                
                <span class="group-hover:text-green-600 transition-colors">Official Tokopedia</span>
                <i class="fas fa-external-link-alt text-xs ml-1 text-slate-400 group-hover:text-green-500"></i>
            </a>
        </div>
    </div>
</section>

{{-- PRODUCT GRID --}}
<section class="py-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @foreach($products as $index => $product)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden group card-3d card-hover-scale relative animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                
                {{-- Image Container --}}
                <div class="relative h-64 overflow-hidden bg-slate-200">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    {{-- Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur text-slate-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $product['category'] }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6 relative">
                    <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition-colors line-clamp-1">
                        {{ $product['name'] }}
                    </h3>
                    <p class="text-sm text-slate-500 mb-4 line-clamp-2 min-h-[2.5rem]">
                        {{ $product['description'] }}
                    </p>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-2">
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase">Harga Mulai</p>
                            <p class="text-lg font-black text-yellow-600">{{ $product['price'] }}</p>
                        </div>
                        
                        {{-- Dropdown Beli --}}
                        <div x-data="{ openBuy: false }" class="relative">
                            <button @click="openBuy = !openBuy" @click.outside="openBuy = false" class="bg-slate-900 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors shadow-lg hover:shadow-blue-500/30 transform active:scale-95">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>

                            <div x-show="openBuy" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 class="absolute bottom-full right-0 mb-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 p-2 z-20"
                                 style="display: none;">
                                <p class="text-xs text-slate-400 font-bold px-2 py-1 mb-1">Beli via:</p>
                                <a href="{{ $links['shopee'] }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-orange-50 text-slate-700 text-sm font-medium transition-colors">
                                    <span class="text-orange-500"><i class="fa-solid fa-bag-shopping"></i></span> Shopee
                                </a>
                                <a href="{{ $links['tokopedia'] }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-50 text-slate-700 text-sm font-medium transition-colors">
                                    <span class="text-green-500"><i class="fa-solid fa-store"></i></span> Tokopedia
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- SECTION BARU: LIHAT LEBIH BANYAK --}}
<section class="py-16 bg-blue-50 border-t border-slate-200">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-3">
            Ingin melihat lebih banyak barang?
        </h2>
        <p class="text-slate-600 mb-8 max-w-2xl mx-auto">
            Kunjungi toko online resmi kami untuk melihat koleksi lengkap hasil karya warga binaan yang terus diperbarui.
        </p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ $links['shopee'] ?? '#' }}" target="_blank" class="flex items-center gap-2 px-6 py-3 bg-white border border-orange-200 text-orange-600 rounded-full font-bold hover:bg-orange-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-orange-500/30">
                <i class="fa-solid fa-bag-shopping"></i> Kunjungi Shopee
            </a>
            <a href="{{ $links['tokopedia'] ?? '#' }}" target="_blank" class="flex items-center gap-2 px-6 py-3 bg-white border border-green-200 text-green-600 rounded-full font-bold hover:bg-green-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-green-500/30">
                <i class="fa-solid fa-store"></i> Kunjungi Tokopedia
            </a>
        </div>
    </div>
</section>

{{-- CUSTOM ORDER CTA --}}
<section class="py-20 bg-white border-t border-slate-200">
    <div class="container mx-auto px-6">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-center card-3d transform transition-transform hover:-translate-y-2">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-yellow-400/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 animate-pulse" style="animation-delay: 1.5s"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center p-3 bg-white/10 rounded-full mb-6 text-yellow-300">
                    <i class="fa-solid fa-wand-magic-sparkles text-2xl"></i>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">Ingin Pesan Custom?</h2>
                <p class="text-blue-100 text-lg mb-8">
                    Kami melayani pemesanan souvenir kantor, plakat, seragam, atau kerajinan tangan custom lainnya untuk kebutuhan instansi maupun pribadi.
                </p>
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold py-4 px-8 rounded-full shadow-lg hover:shadow-white/20 hover:scale-105 transition-all duration-300">
                    <i class="fab fa-whatsapp text-2xl text-green-500"></i>
                    <span>Hubungi Admin Bimker</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection