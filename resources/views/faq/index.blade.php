@extends('layouts.main')

@section('content')
<section class="relative bg-gradient-to-br from-blue-900 via-slate-900 to-blue-900 text-white min-h-[350px] flex items-center justify-center overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/70 via-blue-900/80 to-blue-900/95"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/20 to-cyan-900/20"></div>
    </div>

    {{-- Floating Elements --}}
    <div class="absolute top-20 left-10 w-20 h-20 bg-blue-500/10 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-cyan-500/10 rounded-full blur-xl animate-pulse" style="animation-delay: 1s;"></div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-sm font-semibold mb-6">
            <i class="fas fa-question-circle mr-2"></i>
            Bantuan & Dukungan
        </div>
        <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">
            Pertanyaan yang <span class="bg-gradient-to-r from-cyan-400 to-cyan-600 bg-clip-text text-transparent">Sering Diajukan</span>
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
            Temukan jawaban atas pertanyaan umum seputar layanan kunjungan dan informasi penting lainnya.
        </p>
    </div>
</section>

<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-6 max-w-4xl">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-6">
                ❓ FAQ
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pertanyaan Umum
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Kami telah mengumpulkan pertanyaan-pertanyaan yang sering diajukan untuk membantu Anda.
            </p>
        </div>

        <div class="space-y-4">
            {{-- FAQ Item 1 --}}
            <div x-data="{ open: false, ...inView() }" x-init="init()" :class="{'opacity-0 translate-y-6': !inView}"
                 class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden"
                 style="transition-delay: 0s;">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gray-50 transition-colors duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">🏛️</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">Apa itu Lapas Jombang?</span>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg ml-4">
                        <i class="fas text-white text-sm transition-transform duration-300" :class="open ? 'fa-minus rotate-180' : 'fa-plus'"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0" class="px-8 pb-6 text-gray-600 border-t border-gray-100">
                    <p class="pt-6 leading-relaxed">Lapas Jombang adalah lembaga pemasyarakatan Kelas IIB Jombang yang bertugas melaksanakan pembinaan terhadap narapidana dan tahanan sesuai dengan Undang-Undang Nomor 12 Tahun 1995 tentang Pemasyarakatan.</p>
                </div>
            </div>

            {{-- FAQ Item 2 --}}
            <div x-data="{ open: false, ...inView() }" x-init="init()" :class="{'opacity-0 translate-y-6': !inView}"
                 class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden"
                 style="transition-delay: 0.1s;">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gray-50 transition-colors duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">📝</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300">Bagaimana cara melakukan pendaftaran kunjungan?</span>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg ml-4">
                        <i class="fas text-white text-sm transition-transform duration-300" :class="open ? 'fa-minus rotate-180' : 'fa-plus'"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0" class="px-8 pb-6 text-gray-600 border-t border-gray-100">
                    <p class="pt-6 leading-relaxed">Pendaftaran kunjungan dapat dilakukan secara online melalui website ini pada menu "Pendaftaran Kunjungan". Ikuti langkah-langkah yang tertera pada formulir pendaftaran dengan mengisi data diri, data narapidana yang akan dikunjungi, dan memilih jadwal kunjungan yang tersedia.</p>
                </div>
            </div>

            {{-- FAQ Item 3 --}}
            <div x-data="{ open: false, ...inView() }" x-init="init()" :class="{'opacity-0 translate-y-6': !inView}"
                 class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden"
                 style="transition-delay: 0.2s;">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gray-50 transition-colors duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">📋</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900 group-hover:text-yellow-600 transition-colors duration-300">Apa saja persyaratan untuk kunjungan?</span>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg ml-4">
                        <i class="fas text-white text-sm transition-transform duration-300" :class="open ? 'fa-minus rotate-180' : 'fa-plus'"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0" class="px-8 pb-6 text-gray-600 border-t border-gray-100">
                    <p class="pt-6 leading-relaxed">Persyaratan kunjungan meliputi kartu identitas yang berlaku (KTP/SIM/Paspor), bukti hubungan keluarga dengan narapidana, dan mematuhi tata tertib kunjungan yang telah ditetapkan. Detail lebih lanjut akan ditampilkan saat pendaftaran online dan dapat berubah sewaktu-waktu.</p>
                </div>
            </div>

            {{-- FAQ Item 4 --}}
            <div x-data="{ open: false, ...inView() }" x-init="init()" :class="{'opacity-0 translate-y-6': !inView}"
                 class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden"
                 style="transition-delay: 0.3s;">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gray-50 transition-colors duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">👥</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">Apakah ada batasan jumlah pengunjung per narapidana?</span>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg ml-4">
                        <i class="fas text-white text-sm transition-transform duration-300" :class="open ? 'fa-minus rotate-180' : 'fa-plus'"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0" class="px-8 pb-6 text-gray-600 border-t border-gray-100">
                    <p class="pt-6 leading-relaxed">Ya, ada batasan jumlah pengunjung per narapidana untuk menjaga ketertiban dan keamanan. Batasan ini biasanya maksimal 3-5 orang per narapidana per jadwal kunjungan. Informasi detail mengenai batasan ini akan diberikan pada saat pendaftaran atau dapat dilihat di pengumuman resmi.</p>
                </div>
            </div>

            {{-- FAQ Item 5 --}}
            <div x-data="{ open: false, ...inView() }" x-init="init()" :class="{'opacity-0 translate-y-6': !inView}"
                 class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden"
                 style="transition-delay: 0.4s;">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gray-50 transition-colors duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">⏰</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900 group-hover:text-red-600 transition-colors duration-300">Bagaimana jika saya terlambat datang saat jadwal kunjungan?</span>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg ml-4">
                        <i class="fas text-white text-sm transition-transform duration-300" :class="open ? 'fa-minus rotate-180' : 'fa-plus'"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0" class="px-8 pb-6 text-gray-600 border-t border-gray-100">
                    <p class="pt-6 leading-relaxed">Pengunjung diharapkan datang tepat waktu sesuai jadwal yang telah ditentukan. Keterlambatan maksimal 15 menit masih dapat ditoleransi, namun keterlambatan lebih dari itu dapat mengakibatkan pembatalan kunjungan, tergantung pada kebijakan petugas dan ketersediaan waktu pada hari tersebut.</p>
                </div>
            </div>
        </div>

        {{-- Contact CTA --}}
        <div class="mt-16 text-center">
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-8 border border-blue-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Masih ada pertanyaan?</h3>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Jika pertanyaan Anda tidak terjawab di atas, jangan ragu untuk menghubungi kami melalui informasi kontak yang tersedia.
                </p>
                <a href="#contact" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-cyan-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
