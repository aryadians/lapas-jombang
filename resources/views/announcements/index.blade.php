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
            Papan Pengumuman
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto font-light">
            Informasi penting dan terbaru dari Lapas Kelas IIB Jombang.
        </p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="space-y-6">
            @forelse($allAnnouncements as $announcement)
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition flex items-start space-x-4 transform hover:-translate-y-1">
                <div class="flex-shrink-0 text-center bg-blue-500 rounded p-3 text-white">
                    <span class="block text-2xl font-bold">{{ $announcement->date->format('d') }}</span>
                    <span class="block text-xs uppercase">{{ $announcement->date->format('M') }}</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">{{ $announcement->title }}</h3>
                    <p class="text-gray-600 mb-2">{{ $announcement->content }}</p>
                    <p class="text-sm text-gray-500">Dipublikasikan: {{ $announcement->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10 bg-slate-50 rounded-xl border border-dashed border-gray-300">
                <p class="text-gray-500">Belum ada pengumuman yang diterbitkan.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            {{ $allAnnouncements->links() }}
        </div>
    </div>
</section>
@endsection