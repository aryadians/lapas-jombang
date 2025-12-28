@extends('layouts.main')

@section('content')
<section class="relative bg-slate-900 text-white min-h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Kantor_Wilayah_Kementerian_Hukum_dan_HAM_Republik_Indonesia_Jawa_Tengah.jpg/1200px-Kantor_Wilayah_Kementerian_Hukum_dan_HAM_Republik_Indonesia_Jawa_Tengah.jpg"
            alt="Background Lapas"
            class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 to-slate-900/90"></div>
    </div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-tight">
            Berita Terbaru
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto font-light">
            Informasi terkini seputar Lapas Kelas IIB Jombang.
        </p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($allNews as $item)
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group border border-gray-100 transform hover:-translate-y-1">
                <div class="relative h-48 overflow-hidden">
                    @if($item->image)
                    <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" loading="lazy">
                    @else
                    <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-0 right-0 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg opacity-90 group-hover:opacity-100 transition">
                        {{ $item->created_at->translatedFormat('d M Y') }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-3 group-hover:text-blue-700 transition line-clamp-2">
                        {{ $item->title }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($item->content), 100) }}
                    </p>
                    <a href="{{ route('news.public.show', $item->slug) }}" class="inline-block text-sm font-bold text-blue-600 hover:text-blue-700 transition">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10 bg-slate-50 rounded-xl border border-dashed border-gray-300">
                <p class="text-gray-500">Belum ada berita yang diterbitkan.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            {{ $allNews->links() }}
        </div>
    </div>
</section>
@endsection