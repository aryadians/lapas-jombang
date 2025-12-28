@extends('layouts.main')

@section('content')

<section class="relative bg-slate-900 text-white min-h-[600px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Kantor_Wilayah_Kementerian_Hukum_dan_HAM_Republik_Indonesia_Jawa_Tengah.jpg/1200px-Kantor_Wilayah_Kementerian_Hukum_dan_HAM_Republik_Indonesia_Jawa_Tengah.jpg"
            alt="Background Lapas"
            class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 to-slate-900/90"></div>
    </div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="mb-6 flex justify-center">
            <img src="{{ asset('img/logo.png') }}"
                alt="Logo Lapas"
                class="h-24 md:h-32 w-auto drop-shadow-2xl animate-fade-in-down"
                onerror="this.style.display='none'" loading="lazy">
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-tight">
            Lapas Kelas 2B <span class="text-yellow-500">Jombang</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto font-light">
            Mewujudkan pelayanan pemasyarakatan yang PASTI (Profesional, Akuntabel, Sinergi, Transparan, dan Inovatif).
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('kunjungan.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                <i class="fa-solid fa-user-plus"></i> Daftar Kunjungan
            </a>
            <a href="#berita" class="bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                <i class="fa-solid fa-newspaper"></i> Berita Terbaru
            </a>
            <a href="{{ url('/#profil') }}" class="border-2 border-white hover:bg-white hover:text-slate-900 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                <i class="fa-solid fa-building-columns"></i> Profil Kami
            </a>
            <a href="{{ route('faq.index') }}" class="border-2 border-white hover:bg-white hover:text-slate-900 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                <i class="fa-solid fa-circle-info"></i> Lainnya
            </a>
        </div>
    </div>
</section>

<section id="profil" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-slate-800 mb-2">Tentang Kami</h2>
            <div class="h-1 w-20 bg-yellow-500 mx-auto mb-8"></div>
            <p class="text-gray-600 leading-relaxed text-lg mb-12">
                Lembaga Pemasyarakatan Kelas 2B Jombang berkomitmen tinggi dalam memberikan pembinaan kepribadian dan kemandirian kepada Warga Binaan Pemasyarakatan (WBP). Kami bertekad menciptakan lingkungan yang aman, tertib, dan manusiawi sebagai bekal mereka kembali ke masyarakat.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <div class="bg-blue-50 p-6 rounded-xl shadow-md border border-blue-100 flex flex-col items-center justify-center transform hover:-translate-y-1 transition duration-300">
                    <i class="fa-solid fa-users-line text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-4xl font-extrabold text-blue-800">450+</h3>
                    <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Warga Binaan</p>
                </div>
                <div class="bg-emerald-50 p-6 rounded-xl shadow-md border border-emerald-100 flex flex-col items-center justify-center transform hover:-translate-y-1 transition duration-300">
                    <i class="fa-solid fa-handshake-angle text-4xl text-emerald-600 mb-4"></i>
                    <h3 class="text-4xl font-extrabold text-emerald-800">12+</h3>
                    <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide">Program Pembinaan</p>
                </div>
                <div class="bg-yellow-50 p-6 rounded-xl shadow-md border border-yellow-100 flex flex-col items-center justify-center transform hover:-translate-y-1 transition duration-300">
                    <i class="fa-solid fa-star text-4xl text-yellow-600 mb-4"></i>
                    <h3 class="text-4xl font-extrabold text-yellow-800">95%</h3>
                    <p class="text-sm font-semibold text-yellow-600 uppercase tracking-wide">Tingkat Keberhasilan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-100">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-slate-800 mb-2">Mengapa Memilih Kami?</h2>
        <div class="h-1 w-20 bg-blue-500 mx-auto mb-12"></div>
        <p class="text-gray-600 leading-relaxed text-lg max-w-4xl mx-auto mb-12">
            Kami berkomitmen penuh untuk menyediakan layanan pemasyarakatan yang transparan, profesional, dan berorientasi pada kemanusiaan. Keamanan, pembinaan, dan reintegrasi sosial adalah prioritas utama kami.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 transform hover:-translate-y-2 transition duration-300 group">
                <div class="w-16 h-16 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full mx-auto mb-6 group-hover:bg-blue-600 group-hover:text-white transition">
                    <i class="fa-solid fa-shield-halved text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Keamanan Terjamin</h3>
                <p class="text-gray-600 text-sm">Sistem keamanan berlapis untuk menjaga ketertiban dan kenyamanan bagi semua pihak.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 transform hover:-translate-y-2 transition duration-300 group">
                <div class="w-16 h-16 flex items-center justify-center bg-emerald-100 text-emerald-600 rounded-full mx-auto mb-6 group-hover:bg-emerald-600 group-hover:text-white transition">
                    <i class="fa-solid fa-book-open-reader text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Pembinaan Holistik</h3>
                <p class="text-gray-600 text-sm">Program pembinaan kepribadian dan kemandirian yang komprehensif untuk WBP.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 transform hover:-translate-y-2 transition duration-300 group">
                <div class="w-16 h-16 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-full mx-auto mb-6 group-hover:bg-yellow-600 group-hover:text-white transition">
                    <i class="fa-solid fa-users-gear text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Pelayanan Profesional</h3>
                <p class="text-gray-600 text-sm">Petugas yang terlatih dan berintegritas siap memberikan pelayanan terbaik.</p>
            </div>
        </div>
    </div>
</section>

<section id="berita" class="py-20 bg-slate-50 border-t border-gray-200">
    <div class="container mx-auto px-6">

        <div class="flex flex-col md:flex-row gap-12">

            <div class="md:w-2/3">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-800 border-l-4 border-yellow-500 pl-4">Berita Terkini</h2>
                    <a href="{{ route('news.public.index') }}" class="text-blue-700 font-semibold hover:underline text-sm">Lihat Semua &rarr;</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($news as $item)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group border border-gray-100">
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
                            <div class="absolute top-0 right-0 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-3 group-hover:text-blue-700 transition line-clamp-2">
                                {{ $item->title }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($item->content, 100) }}
                            </p>
                            <a href="{{ route('news.public.show', $item->slug) }}" class="inline-block text-sm font-bold text-yellow-600 hover:text-yellow-700">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-10 bg-white rounded-xl border border-dashed border-gray-300">
                        <p class="text-gray-500">Belum ada berita yang diterbitkan.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="md:w-1/3">
                <div class="bg-slate-900 rounded-xl shadow-lg p-6 text-white sticky top-10">
                    <div class="flex items-center mb-6 pb-4 border-b border-slate-700">
                        <span class="text-2xl mr-2">📢</span>
                        <h3 class="text-xl font-bold text-yellow-500">Papan Pengumuman</h3>
                    </div>

                    <ul class="space-y-6">
                        @forelse($announcements as $info)
                        <li class="group">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-center bg-slate-800 rounded p-2 mr-3 border border-slate-700 group-hover:border-yellow-500 transition">
                                    <span class="block text-xl font-bold text-white">{{ $info->date->format('d') }}</span>
                                    <span class="block text-xs uppercase text-gray-400">{{ $info->date->format('M') }}</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-200 group-hover:text-yellow-400 transition leading-snug">
                                        {{ $info->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                        {{ Str::limit($info->content, 60) }}
                                    </p>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="text-center text-gray-500 text-sm italic py-4">
                            Tidak ada pengumuman aktif.
                        </li>
                        @endforelse
                    </ul>

                    <div class="mt-8 pt-4 border-t border-slate-700 text-center">
                        <a href="{{ route('announcements.public.index') }}" class="text-sm text-gray-400 hover:text-white transition">Lihat Arsip Pengumuman</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection