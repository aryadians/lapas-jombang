<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- 1. ASSETS PENTING (Font, Icon, Tailwind) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    
    {{-- BACKGROUND & CONTAINER UTAMA --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-900">
        
        {{-- LOGO DI ATAS FORM --}}
        <div class="mb-6 flex flex-col items-center">
            <a href="{{ url('/') }}" class="flex flex-col items-center group">
                {{-- Pastikan path logo benar --}}
                <img src="{{ asset('img/logo.png') }}" class="w-20 h-20 mb-3 drop-shadow-lg group-hover:scale-110 transition-transform duration-300" alt="Logo">
                <h2 class="text-2xl font-bold text-white tracking-wide">LAPAS KELAS 2B JOMBANG</h2>
                <p class="text-xs text-yellow-500 font-semibold tracking-widest uppercase mt-1">Sistem Informasi Pemasyarakatan</p>
            </a>
        </div>

        {{-- KOTAK FORM LOGIN (SLOT) --}}
        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border-t-4 border-yellow-500">
            {{-- Ini yang menampilkan Form Login --}}
            {{ $slot }}
        </div>

        {{-- COPYRIGHT --}}
        <div class="mt-8 text-slate-500 text-sm">
            &copy; {{ date('Y') }} Lapas Kelas 2B Jombang.
        </div>
    </div>

    {{-- WIDGET AKSESIBILITAS --}}
    {{-- Pastikan file resources/views/components/aksesibilitas.blade.php sudah dibuat --}}
    <x-aksesibilitas /> 

</body>
</html>