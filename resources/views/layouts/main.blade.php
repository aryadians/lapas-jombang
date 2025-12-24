<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lapas Kelas 2B Jombang</title>

    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased text-slate-800 bg-white">

    <nav class="bg-slate-900/95 backdrop-blur-md fixed w-full z-50 shadow-lg border-b border-slate-800 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <img class="h-10 w-auto group-hover:scale-105 transition-transform duration-300"
                            src="{{ asset('img/logo.png') }}"
                            alt="Logo Lapas">

                        <div class="flex flex-col">
                            <span class="font-bold text-white text-lg tracking-wide group-hover:text-yellow-400 transition">LAPAS KELAS 2B JOMBANG</span>
                            <span class="text-[10px] text-yellow-500 uppercase tracking-wider font-semibold">Kementerian Imigrasi dan Pemasyarakatan RI</span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-gray-300 hover:text-white hover:border-b-2 hover:border-yellow-500 px-1 py-2 text-sm font-medium transition-all">Beranda</a>
                    <a href="#profil" class="text-gray-300 hover:text-white hover:border-b-2 hover:border-yellow-500 px-1 py-2 text-sm font-medium transition-all">Profil</a>
                    <a href="#berita" class="text-gray-300 hover:text-white hover:border-b-2 hover:border-yellow-500 px-1 py-2 text-sm font-medium transition-all">Berita</a>
                    <a href="#pengumuman" class="text-gray-300 hover:text-white hover:border-b-2 hover:border-yellow-500 px-1 py-2 text-sm font-medium transition-all">Pengumuman</a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    {{-- Button Pendaftaran Kunjungan --}}
                    <a href="{{ route('kunjungan.create') }}"
                        class="text-sm font-bold text-slate-900 bg-yellow-500 hover:bg-yellow-400 px-6 py-2.5 rounded-full transition shadow-lg hover:shadow-yellow-500/30 transform hover:-translate-y-0.5 whitespace-nowrap">
                        Pendaftaran Kunjungan
                    </a>



                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-full transition shadow-lg hover:shadow-blue-500/30">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-slate-900 bg-yellow-500 hover:bg-yellow-400 px-5 py-2.5 rounded-full transition shadow-lg hover:shadow-yellow-500/30 transform hover:-translate-y-0.5">
                        Login Petugas
                    </a>
                    @endauth
                    @endif
                </div>


                <div class="-mr-2 flex md:hidden">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden md:hidden bg-slate-800 border-t border-slate-700" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('kunjungan.create') }}"
                    class="block w-full text-center px-5 py-3 rounded-md font-bold text-slate-900 bg-yellow-500 hover:bg-yellow-600 transition shadow-md">
                    Pendaftaran Kunjungan
                </a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-slate-700">Beranda</a>
                <a href="#profil" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-slate-700">Profil</a>
                <a href="#berita" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-slate-700">Berita</a>

                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="block w-full text-center mt-4 px-5 py-3 rounded-md font-bold text-white bg-blue-600">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="block w-full text-center mt-4 px-5 py-3 rounded-md font-bold text-slate-900 bg-yellow-500">Login Petugas</a>
                @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="pt-20">
        @yield('content')
    </div>

</body>

</html>