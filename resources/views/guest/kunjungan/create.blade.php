@extends('layouts.guest')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">

    {{-- HEADER --}}
    <div class="bg-slate-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-yellow-500 mb-4">
                Pendaftaran Kunjungan Tatap Muka
            </h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-sm md:text-base">
                Mohon baca ketentuan, jadwal, dan alur layanan di bawah ini dengan seksama sebelum melakukan pendaftaran kunjungan.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">

        {{-- SECTION 1: JADWAL & KUOTA (Sumber: Gambar 2.jpg) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg border-t-4 border-blue-600 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Waktu Pelayanan</h2>
                </div>

                <div class="space-y-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="font-bold text-blue-800 mb-1">Setiap SENIN</h3>
                        <div class="flex justify-between text-sm text-slate-700 border-b border-blue-200 pb-2 mb-2">
                            <span>Sesi Pagi</span>
                            <span class="font-bold">08.30 - 10.00 WIB</span>
                        </div>
                        <div class="flex justify-between text-sm text-slate-700">
                            <span>Sesi Siang</span>
                            <span class="font-bold">13.30 - 14.30 WIB</span>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-lg">
                        <h3 class="font-bold text-slate-800 mb-1">Setiap SELASA - KAMIS</h3>
                        <div class="flex justify-between text-sm text-slate-700">
                            <span>Sesi Pagi</span>
                            <span class="font-bold">08.30 - 10.00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border-t-4 border-yellow-500 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-yellow-100 p-2 rounded-lg text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Jenis & Kuota Kunjungan</h2>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-3 rounded-lg text-center">
                            <span class="block text-xs text-gray-500 uppercase font-bold">Senin & Rabu</span>
                            <span class="block text-lg font-bold text-slate-900">NARAPIDANA</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg text-center">
                            <span class="block text-xs text-gray-500 uppercase font-bold">Selasa & Kamis</span>
                            <span class="block text-lg font-bold text-slate-900">TAHANAN</span>
                        </div>
                    </div>

                    <div class="text-sm bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                        <p class="font-bold text-slate-800 mb-2">Kuota Antrian:</p>
                        <ul class="list-disc list-inside space-y-1 text-slate-700">
                            <li>Senin Pagi: <strong>120</strong> | Siang: <strong>40</strong></li>
                            <li>Selasa - Kamis: <strong>150</strong> Antrian</li>
                        </ul>
                    </div>

                    <div class="text-xs text-red-500 italic mt-2">
                        * Pendaftaran wajib H-1. Khusus kunjungan Senin, daftar di hari Jumat.
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 2: BARANG BAWAAN (Sumber: Gambar 4.jpg & 5.jpg) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-emerald-600 px-6 py-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Barang Diperbolehkan
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-500 mt-1">✓</span>
                            <div class="text-sm text-slate-600">
                                <strong class="block text-slate-800">Buah-buahan</strong>
                                Wajib dikupas, tanpa biji, dipotong siap makan. (Salak wajib kupas/buang biji).
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-500 mt-1">✓</span>
                            <div class="text-sm text-slate-600">
                                <strong class="block text-slate-800">Makanan Berkuah</strong>
                                Harus <strong>BENING</strong> & polos. Sambal/kecap dipisah.
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-500 mt-1">✓</span>
                            <div class="text-sm text-slate-600">
                                <strong class="block text-slate-800">Lauk Pauk</strong>
                                Terlihat jelas isinya. Telur utuh wajib dibelah/dikupas. (Usus/Jeroan dilarang).
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-emerald-500 mt-1">✓</span>
                            <div class="text-sm text-slate-600">
                                <strong class="block text-slate-800">Kemasan Plastik</strong>
                                Bungkus plastik bening ukuran 45 (1 plastik per rombongan).
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-red-600 px-6 py-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        DILARANG KERAS
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Makanan Berongga</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Minuman / Cairan</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Kemasan Pabrik</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Makanan Bercangkang</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Saos Sachet</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Rokok / Korek</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Elektronik / HP</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Pisang / Durian</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Obat / Narkotika</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Senjata Tajam</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Kuah Gelap/Keruh</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs font-medium text-red-700">
                            <span>❌ Kaca / Logam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 3: ALUR LAYANAN (Sumber: Gambar 3.jpg) --}}
        <div class="bg-white rounded-xl shadow-lg p-8 mb-10">
            <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center border-b pb-4">Alur Layanan Kunjungan</h2>

            <div class="relative border-l-4 border-slate-200 ml-4 space-y-8">

                {{-- Step 1 --}}
                <div class="relative pl-8">
                    <div class="absolute -left-3 top-0 bg-yellow-500 w-6 h-6 rounded-full border-4 border-white shadow"></div>
                    <h4 class="font-bold text-lg text-slate-800">Daftar Online</h4>
                    <p class="text-slate-600 text-sm">Maksimal H-1 Kunjungan. <br>Layanan WhatsApp: <span class="font-mono bg-green-100 text-green-700 px-2 rounded">08573333400</span></p>
                </div>

                {{-- Step 2 --}}
                <div class="relative pl-8">
                    <div class="absolute -left-3 top-0 bg-slate-300 w-6 h-6 rounded-full border-4 border-white shadow"></div>
                    <h4 class="font-bold text-lg text-slate-800">Ruang Transit & Loket</h4>
                    <p class="text-slate-600 text-sm">Menunggu panggilan petugas, lalu menuju Loket Pelayanan.</p>
                </div>

                {{-- Step 3 --}}
                <div class="relative pl-8">
                    <div class="absolute -left-3 top-0 bg-slate-300 w-6 h-6 rounded-full border-4 border-white shadow"></div>
                    <h4 class="font-bold text-lg text-slate-800">Penggeledahan & P2U</h4>
                    <p class="text-slate-600 text-sm">Pemeriksaan badan/barang. Cek identitas & stempel di P2U.</p>
                </div>

                {{-- Step 4 --}}
                <div class="relative pl-8">
                    <div class="absolute -left-3 top-0 bg-slate-300 w-6 h-6 rounded-full border-4 border-white shadow"></div>
                    <h4 class="font-bold text-lg text-slate-800">Ganti Alas Kaki</h4>
                    <p class="text-slate-600 text-sm">Wajib ganti sandal yang disediakan Lapas.</p>
                </div>

                {{-- Step 5 --}}
                <div class="relative pl-8">
                    <div class="absolute -left-3 top-0 bg-green-500 w-6 h-6 rounded-full border-4 border-white shadow"></div>
                    <h4 class="font-bold text-lg text-green-700">MELAKSANAKAN KUNJUNGAN</h4>
                    <p class="text-slate-600 text-sm">Serahkan kertas kunjungan ke petugas pengawas.</p>
                </div>

                {{-- Step 6 --}}
                <div class="relative pl-8">
                    <div class="absolute -left-3 top-0 bg-slate-300 w-6 h-6 rounded-full border-4 border-white shadow"></div>
                    <h4 class="font-bold text-lg text-slate-800">Selesai</h4>
                    <p class="text-slate-600 text-sm">Ambil identitas, kembalikan ID Card, periksa stempel, pulang.</p>
                </div>
            </div>
        </div>

        {{-- TOMBOL ACTION --}}
        <div class="flex flex-col items-center justify-center space-y-4 pt-4 pb-12">
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg text-center max-w-2xl text-sm">
                Saya telah membaca dan memahami seluruh ketentuan, jadwal, dan barang bawaan yang diperbolehkan.
            </div>

            {{-- Disini nanti form atau tombol lanjut ke form --}}
            <button class="bg-slate-900 text-white font-bold text-lg px-12 py-4 rounded-full shadow-xl hover:bg-slate-800 hover:scale-105 transition transform duration-300 flex items-center gap-3">
                <span>Isi Formulir Pendaftaran</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </div>

    </div>
</div>
@endsection