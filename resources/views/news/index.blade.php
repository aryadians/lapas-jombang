@extends('layouts.main')

@section('content')

{{-- Breadcrumb --}}
<section class="bg-gray-50 py-6">
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Berita</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-blue-900 via-slate-900 to-blue-900 text-white min-h-[350px] flex items-center justify-center overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/70 via-blue-900/80 to-blue-900/95"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/20 to-purple-900/20"></div>
    </div>

    {{-- Floating Elements --}}
    <div class="absolute top-20 left-10 w-20 h-20 bg-blue-500/10 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-yellow-500/10 rounded-full blur-xl animate-pulse" style="animation-delay: 1s;"></div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-sm font-semibold mb-6">
            <i class="fas fa-newspaper mr-2"></i>
            Berita & Informasi
        </div>
        <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">
            Berita <span class="bg-gradient-to-r from-yellow-400 to-yellow-600 bg-clip-text text-transparent animate-text-shimmer">Terbaru</span>
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed mb-8">
            Tetap update dengan informasi terkini, kegiatan, dan berita penting dari Lembaga Pemasyarakatan Kelas 2B Jombang.
        </p>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('news.public.index') }}" class="flex flex-col sm:flex-row gap-4 justify-center items-center max-w-2xl mx-auto">
            <div class="relative w-full sm:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="w-full sm:w-80 pl-12 pr-4 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent form-focus-glow">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-200"></i>
            </div>
            <div class="relative w-full sm:w-auto">
                <select name="category" class="w-full sm:w-48 px-6 py-3 pr-10 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full text-slate-900 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent appearance-none form-focus-glow">
                    <option value="">Semua Kategori</option>
                    <option value="kegiatan" {{ request('category') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="pengumuman" {{ request('category') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="berita" {{ request('category') == 'berita' ? 'selected' : '' }}>Berita</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <i class="fas fa-chevron-down text-slate-900"></i>
                </div>
            </div>
            <button type="submit" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-slate-900 font-semibold rounded-full transition-colors">
                <i class="fas fa-search mr-2"></i>Cari
            </button>
        </form>
    </div>
</section>

{{-- News Grid Section --}}
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-6 max-w-7xl">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-4">
                Semua Berita
            </h2>
            <div class="h-1 w-24 bg-gradient-to-r from-blue-500 to-yellow-500 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan informasi terbaru tentang program pembinaan, kegiatan positif, dan berita penting lainnya.
            </p>
        </div>

        {{-- News Count --}}
        <div class="flex justify-between items-center mb-8">
            <p class="text-gray-600">
                Menampilkan <span class="font-semibold text-blue-600">{{ $allNews->count() }}</span> dari <span class="font-semibold text-blue-600">{{ $allNews->total() }}</span> berita
            </p>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <i class="fas fa-calendar-alt"></i>
                <span>Diperbarui terakhir: {{ now()->translatedFormat('d F Y') }}</span>
            </div>
        </div>

        {{-- News Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($allNews as $item)
            <article class="transition-all duration-1000 bg-white rounded-2xl overflow-hidden group border border-gray-100 hover:border-blue-300 card-hover-scale flex flex-col h-full card-3d" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="relative h-56 overflow-hidden flex-shrink-0">
                    @if(is_array($item->image) && count($item->image) > 0)
                    <img src="{{ $item->image[0] }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent group-hover:from-black/50 transition-all duration-300"></div>
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center group-hover:from-slate-200 group-hover:to-slate-300 transition-colors duration-300">
                        <div class="text-center">
                            <i class="fas fa-image text-5xl text-slate-300 mb-2 group-hover:text-slate-400 transition-colors"></i>
                            <p class="text-sm text-slate-400 group-hover:text-slate-500 transition-colors">Tidak ada gambar</p>
                        </div>
                    </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm text-slate-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg group-hover:shadow-xl transition-all duration-300 border border-white/50">
                        {{ $item->created_at->translatedFormat('d M Y') }}
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-600/95 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full group-hover:bg-blue-700 transition-colors duration-300 border border-blue-400/50">
                            Berita
                        </span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-800 mb-3 group-hover:text-blue-700 transition-colors duration-300 line-clamp-2 leading-tight">
                        {{ $item->title }}
                    </h3>
                    <p class="text-slate-600 text-sm mb-4 line-clamp-3 leading-relaxed flex-grow">
                        {{ Str::limit(strip_tags($item->content), 120) }}
                    </p>
                    <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                        <a href="{{ route('news.public.show', $item->slug) }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 group-hover:text-blue-700 transition-all duration-300 gap-1">
                            <span>Baca Selengkapnya</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                        <div class="flex items-center text-xs text-slate-400 group-hover:text-slate-500 transition-colors duration-300">
                            <i class="fas fa-clock mr-1"></i>
                            <span>{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full">
                <div class="text-center py-24 bg-gradient-to-br from-slate-50 to-slate-100 rounded-3xl border-2 border-dashed border-slate-300 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="max-w-md mx-auto">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg border border-slate-200">
                            <i class="fas fa-newspaper text-4xl text-slate-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-700 mb-2">Belum Ada Berita</h3>
                        <p class="text-slate-600 mb-8">Informasi terbaru akan segera dipublikasikan di sini.</p>
                        <a href="/" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-full transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl gap-2">
                            <i class="fas fa-home"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($allNews->hasPages())
        <div class="flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
                {{ $allNews->appends(request()->query())->links() }}
            </div>
        </div>
        @endif

        {{-- Back to Home --}}
        <div class="text-center mt-16">
            <a href="/" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                <i class="fas fa-home mr-3"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection
