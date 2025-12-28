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
            Pertanyaan yang Sering Diajukan
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto font-light">
            Temukan jawaban atas pertanyaan umum seputar layanan kami.
        </p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="space-y-4">
            {{-- FAQ Item 1 --}}
            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg shadow-sm bg-white">
                <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                    <span class="text-xl font-semibold text-slate-800">Apa itu Lapas Jombang?</span>
                    <i class="fa-solid" :class="open ? 'fa-minus text-yellow-500' : 'fa-plus text-blue-500'"></i>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0" class="px-6 pb-4 text-gray-600 border-t border-gray-100 origin-top">
                    <p class="pt-4">Lapas Jombang adalah lembaga pemasyarakatan Kelas IIB Jombang yang bertugas melaksanakan pembinaan terhadap narapidana dan tahanan.</p>
                </div>
            </div>

            {{-- FAQ Item 2 --}}
            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg shadow-sm bg-white">
                <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                    <span class="text-xl font-semibold text-slate-800">Bagaimana cara melakukan pendaftaran kunjungan?</span>
                    <i class="fa-solid" :class="open ? 'fa-minus text-yellow-500' : 'fa-plus text-blue-500'"></i>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0" class="px-6 pb-4 text-gray-600 border-t border-gray-100 origin-top">
                    <p class="pt-4">Pendaftaran kunjungan dapat dilakukan secara online melalui website ini pada menu "Pendaftaran Kunjungan". Ikuti langkah-langkah yang tertera pada formulir pendaftaran.</p>
                </div>
            </div>

            {{-- FAQ Item 3 --}}
            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg shadow-sm bg-white">
                <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                    <span class="text-xl font-semibold text-slate-800">Apa saja persyaratan untuk kunjungan?</span>
                    <i class="fa-solid" :class="open ? 'fa-minus text-yellow-500' : 'fa-plus text-blue-500'"></i>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0" class="px-6 pb-4 text-gray-600 border-t border-gray-100 origin-top">
                    <p class="pt-4">Persyaratan kunjungan meliputi kartu identitas yang berlaku, bukti hubungan keluarga, dan mematuhi tata tertib kunjungan yang telah ditetapkan. Detail lebih lanjut akan ditampilkan saat pendaftaran online.</p>
                </div>
            </div>

            {{-- FAQ Item 4 --}}
            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg shadow-sm bg-white">
                <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                    <span class="text-xl font-semibold text-slate-800">Apakah ada batasan jumlah pengunjung per narapidana?</span>
                    <i class="fa-solid" :class="open ? 'fa-minus text-yellow-500' : 'fa-plus text-blue-500'"></i>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0" class="px-6 pb-4 text-gray-600 border-t border-gray-100 origin-top">
                    <p class="pt-4">Ya, ada batasan jumlah pengunjung per narapidana untuk menjaga ketertiban dan keamanan. Informasi detail mengenai batasan ini akan diberikan pada saat pendaftaran atau dapat dilihat di pengumuman.</p>
                </div>
            </div>

            {{-- FAQ Item 5 --}}
            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg shadow-sm bg-white">
                <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                    <span class="text-xl font-semibold text-slate-800">Bagaimana jika saya terlambat datang saat jadwal kunjungan?</span>
                    <i class="fa-solid" :class="open ? 'fa-minus text-yellow-500' : 'fa-plus text-blue-500'"></i>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0" class="px-6 pb-4 text-gray-600 border-t border-gray-100 origin-top">
                    <p class="pt-4">Pengunjung diharapkan datang tepat waktu sesuai jadwal yang telah ditentukan. Keterlambatan dapat mengakibatkan pembatalan kunjungan, tergantung pada kebijakan dan ketersediaan waktu.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection