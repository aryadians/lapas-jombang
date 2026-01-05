@extends('layouts.main')

@section('content')
{{-- WRAPPER UTAMA DENGAN STATE ALPINE JS --}}
<div x-data="{ showForm: {{ session('errors') && $errors->any() ? 'true' : 'false' }} }" class="bg-slate-50 min-h-screen pb-20">

    {{-- ============================================================== --}}
    {{-- BAGIAN 1: INFORMASI & TATA TERTIB (Muncul Awal) --}}
    {{-- ============================================================== --}}
    <div x-show="!showForm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0">

        {{-- HEADER: JUDUL BESAR --}}
        <div class="bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 pt-16 pb-24 px-4 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 opacity-15 blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 opacity-10 blur-3xl"></div>
            <div class="max-w-7xl mx-auto text-center relative z-10">
                <div class="inline-flex items-center gap-2 bg-yellow-500 bg-opacity-20 text-yellow-400 font-bold tracking-widest uppercase text-sm mb-4 px-4 py-2 rounded-full border border-yellow-400 border-opacity-30">
                    <i class="fa-solid fa-gavel"></i>
                    <span>Layanan Publik</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight drop-shadow-lg">
                    Pendaftaran Kunjungan <span class="animate-text-shimmer bg-gradient-to-r from-yellow-400 to-yellow-300 bg-clip-text text-transparent">Tatap Muka</span>
                </h1>
                <p class="text-gray-200 max-w-4xl mx-auto text-lg leading-relaxed drop-shadow-sm">
                    Mohon pelajari <strong class="text-yellow-300 underline decoration-yellow-400">Jadwal</strong>, <strong class="text-yellow-300 underline decoration-yellow-400">Alur Layanan</strong>, dan <strong class="text-yellow-300 underline decoration-yellow-400">Ketentuan Barang</strong> di bawah ini sebelum mengisi formulir pendaftaran demi kelancaran kunjungan Anda.
                </p>
                <div class="mt-8 flex justify-center gap-4">
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm border border-white border-opacity-20 px-4 py-2 rounded-full text-white text-sm font-medium">
                        <i class="fa-solid fa-shield-alt mr-2"></i> Aman & Terpercaya
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm border border-white border-opacity-20 px-4 py-2 rounded-full text-white text-sm font-medium">
                        <i class="fa-solid fa-clock mr-2"></i> Proses Cepat
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">

            {{-- BADGE RESMI KEMENTERIAN --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-950 to-blue-900 text-yellow-400 px-6 py-3 rounded-full font-bold text-sm shadow-2xl border-2 border-yellow-500 border-opacity-50">
                    <i class="fa-solid fa-landmark text-lg"></i>
                    KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN RI
                    <i class="fa-solid fa-scale-balanced text-lg"></i>
                </div>
            </div>

            {{-- 1. JADWAL & KUOTA --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

                {{-- Card 1: Waktu Layanan --}}
                <div class="bg-white rounded-2xl shadow-2xl p-6 border-t-4 border-blue-600 flex flex-col h-full card-hover-scale transition-all duration-300 hover:shadow-blue-500/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200 rounded-full text-blue-600 shadow-lg">
                            <i class="fa-solid fa-clock text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800">Waktu Layanan</h3>
                            <p class="text-xs text-slate-500">Jam Operasional</p>
                        </div>
                    </div>
                    <div class="space-y-4 flex-grow">
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border-l-4 border-blue-500 hover:shadow-md transition-all duration-300 hover:from-blue-100 hover:to-blue-200">
                            <span class="block font-bold text-slate-900 text-sm mb-2">SETIAP SENIN</span>
                            <div class="text-sm text-slate-600 space-y-1">
                                <div class="flex justify-between"><span>Sesi Pagi:</span> <strong class="text-blue-700">08.30 - 10.00</strong></div>
                                <div class="flex justify-between"><span>Sesi Siang:</span> <strong class="text-blue-700">13.30 - 14.30</strong></div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-slate-50 to-slate-100 p-4 rounded-lg border-l-4 border-slate-500 hover:shadow-md transition-all duration-300 hover:from-slate-100 hover:to-slate-200">
                            <span class="block font-bold text-slate-900 text-sm mb-2">SELASA - KAMIS</span>
                            <div class="text-sm text-slate-600">
                                <div class="flex justify-between"><span>Sesi Pagi:</span> <strong class="text-slate-700">08.30 - 10.00</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Jadwal Kunjungan --}}
                <div class="bg-white rounded-2xl shadow-2xl p-6 border-t-4 border-yellow-500 flex flex-col h-full card-hover-scale transition-all duration-300 hover:shadow-yellow-500/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full text-yellow-600 shadow-lg">
                            <i class="fa-solid fa-calendar-check text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800">Jadwal Kunjungan</h3>
                            <p class="text-xs text-slate-500">Sesuai Status WBP</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 flex-grow">
                        {{-- Kotak NAPI --}}
                        <div class="flex flex-col justify-center items-center bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl border border-yellow-200 p-4 text-center h-full hover:shadow-lg hover:from-yellow-100 hover:to-yellow-200 transition-all duration-300 transform hover:scale-105">
                            <span class="text-xs font-bold text-slate-500 uppercase mb-2">Senin & Rabu</span>
                            <span class="text-2xl font-black text-slate-900">NAPI</span>
                            <span class="text-[10px] text-slate-400 mt-1">(Narapidana)</span>
                        </div>
                        {{-- Kotak TAHANAN --}}
                        <div class="flex flex-col justify-center items-center bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200 p-4 text-center h-full hover:shadow-lg hover:from-blue-100 hover:to-blue-200 transition-all duration-300 transform hover:scale-105">
                            <span class="text-xs font-bold text-slate-500 uppercase mb-2">Selasa & Kamis</span>
                            <span class="text-2xl font-black text-slate-900">TAHANAN</span>
                            <span class="text-[10px] text-slate-400 mt-1">(Tahanan)</span>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <span class="inline-block bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold px-6 py-2 rounded-full shadow-lg border border-red-400">
                            <i class="fa-solid fa-calendar-xmark mr-2"></i> JUMAT, SABTU & MINGGU LIBUR
                        </span>
                    </div>
                </div>

                {{-- Card 3: Kuota Antrian --}}
                <div class="bg-white rounded-2xl shadow-2xl p-6 border-t-4 border-emerald-500 flex flex-col h-full card-hover-scale transition-all duration-300 hover:shadow-emerald-500/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full text-emerald-600 shadow-lg">
                            <i class="fa-solid fa-users text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800">Kuota Antrian</h3>
                            <p class="text-xs text-slate-500">Batas Harian</p>
                        </div>
                    </div>
                    <div class="space-y-3 flex-grow">
                        <div class="flex justify-between items-center bg-gradient-to-r from-emerald-50 to-emerald-100 p-3 rounded-lg border border-emerald-200 hover:shadow-md transition-all duration-300 hover:from-emerald-100 hover:to-emerald-200">
                            <span class="text-sm font-medium text-slate-700">Senin (Pagi)</span>
                            <span class="bg-white text-emerald-700 font-bold px-3 py-1 rounded border border-emerald-200 text-sm shadow-sm">120 Orang</span>
                        </div>
                        <div class="flex justify-between items-center bg-gradient-to-r from-emerald-50 to-emerald-100 p-3 rounded-lg border border-emerald-200 hover:shadow-md transition-all duration-300 hover:from-emerald-100 hover:to-emerald-200">
                            <span class="text-sm font-medium text-slate-700">Senin (Siang)</span>
                            <span class="bg-white text-emerald-700 font-bold px-3 py-1 rounded border border-emerald-200 text-sm shadow-sm">40 Orang</span>
                        </div>
                        <div class="flex justify-between items-center bg-gradient-to-r from-slate-50 to-slate-100 p-3 rounded-lg border border-slate-200 hover:shadow-md transition-all duration-300 hover:from-slate-100 hover:to-slate-200">
                            <span class="text-sm font-medium text-slate-700">Selasa - Kamis</span>
                            <span class="bg-white text-slate-700 font-bold px-3 py-1 rounded border border-slate-200 text-sm shadow-sm">150 Orang</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. ALUR LAYANAN --}}
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-12 overflow-hidden relative border border-gray-100">
                <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-yellow-400 to-yellow-600"></div>
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-4">ALUR LAYANAN KUNJUNGAN</h2>
                    <p class="text-slate-500 mt-2 text-lg">Ikuti 9 langkah berikut untuk kenyamanan bersama</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 relative z-10">
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-900 to-blue-800 text-yellow-400 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:scale-110 transition-all duration-300">1</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Daftar Online (H-1)</h4>
                        <p class="text-sm text-slate-600">Daftar via Website atau WA: <br><strong class="text-blue-700">08573333400</strong></p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:border-yellow-500 group-hover:text-yellow-600 transition-all duration-300">2</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Ruang Transit</h4>
                        <p class="text-sm text-slate-600">Menunggu panggilan petugas di ruang transit.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:border-yellow-500 group-hover:text-yellow-600 transition-all duration-300">3</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Loket Pelayanan</h4>
                        <p class="text-sm text-slate-600">Verifikasi data & ambil nomor antrian.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:border-yellow-500 group-hover:text-yellow-600 transition-all duration-300">4</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Penggeledahan</h4>
                        <p class="text-sm text-slate-600">Pemeriksaan badan & barang bawaan.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:border-yellow-500 group-hover:text-yellow-600 transition-all duration-300">5</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">P2U (Identitas)</h4>
                        <p class="text-sm text-slate-600">Tukar KTP dengan ID Card Kunjungan.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:border-yellow-500 group-hover:text-yellow-600 transition-all duration-300">6</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Ganti Alas Kaki</h4>
                        <p class="text-sm text-slate-600">Wajib pakai sandal inventaris Lapas.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl hover:shadow-xl transition-all duration-300 group card-hover-scale hover:border-green-400">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-700 text-white rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:scale-110 transition-all duration-300">7</div>
                        <h4 class="font-bold text-green-800 text-lg mb-2">PELAKSANAAN</h4>
                        <p class="text-sm text-green-700">Masuk ruang kunjungan & bertemu WBP.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:border-yellow-500 group-hover:text-yellow-600 transition-all duration-300">8</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Selesai</h4>
                        <p class="text-sm text-slate-600">Ambil KTP & kembalikan ID Card.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl hover:shadow-xl transition-all duration-300 border border-slate-200 group hover:border-yellow-300 card-hover-scale">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-lg group-hover:border-yellow-500 group-hover:text-yellow-600 transition-all duration-300">9</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Pulang</h4>
                        <p class="text-sm text-slate-600">Cek stempel & tinggalkan area Lapas.</p>
                    </div>
                </div>
            </div>

            {{-- 3. KETENTUAN BARANG BAWAAN --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

                {{-- A. DIPERBOLEHKAN --}}
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100 h-full">
                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 px-6 py-4 flex items-center justify-between">
                        <h3 class="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                            <i class="fa-solid fa-check-circle text-green-600"></i> DIPERBOLEHKAN
                        </h3>
                        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-plus text-yellow-800"></i>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="flex gap-4 items-start p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-200 hover:shadow-md transition-all duration-300 card-hover-scale">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-200 rounded-full flex items-center justify-center text-2xl shadow-sm">🍇</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Buah-buahan</h4>
                                <p class="text-sm text-slate-600 mt-1">Wajib <strong>dikupas, potong, tanpa biji</strong>. (Salak/Durian dilarang).</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-200 hover:shadow-md transition-all duration-300 card-hover-scale">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-200 rounded-full flex items-center justify-center text-2xl shadow-sm">🍜</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Makanan Berkuah</h4>
                                <p class="text-sm text-slate-600 mt-1">Harus <strong>BENING & POLOS</strong>. Tanpa kecap/sambal campur.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-200 hover:shadow-md transition-all duration-300 card-hover-scale">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-200 rounded-full flex items-center justify-center text-2xl shadow-sm">🍗</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Lauk Pauk</h4>
                                <p class="text-sm text-slate-600 mt-1">Terlihat jelas isinya. Telur wajib dibelah. (Jeroan dilarang).</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-200 hover:shadow-md transition-all duration-300 card-hover-scale">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-200 rounded-full flex items-center justify-center text-2xl shadow-sm">🛍️</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Kemasan</h4>
                                <p class="text-sm text-slate-600 mt-1">Wajib <strong>Plastik Bening</strong> (Ukuran 45). 1 Plastik per rombongan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- B. DILARANG --}}
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100 h-full">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 flex items-center justify-between">
                        <h3 class="font-extrabold text-white text-lg flex items-center gap-2">
                            <i class="fa-solid fa-ban"></i> DILARANG KERAS
                        </h3>
                        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-xmark text-red-800"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-center">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">🍢</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Makanan Berongga</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">🥤</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Minuman / Cairan</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">🍞</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Kemasan Pabrik</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">🦀</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Makanan Bercangkang</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">🧂</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Saos Sachet</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">🚬</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Rokok / Korek</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">📱</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">HP / Elektronik</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">💊</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Obat / Narkoba</span>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:shadow-lg transition-all duration-300 card-hover-scale border border-red-200">
                                <span class="text-2xl mb-2">🤢</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Bau Menyengat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL ACTION --}}
            <div class="flex flex-col items-center justify-center space-y-6 pb-12">
                <div class="bg-gradient-to-r from-blue-50 to-gray-50 p-6 rounded-2xl border border-blue-200 shadow-lg max-w-2xl">
                    <div class="flex items-center justify-center gap-3 mb-3">
                        <i class="fa-solid fa-info-circle text-blue-600 text-xl"></i>
                        <span class="font-bold text-slate-800">PENTING</span>
                    </div>
                    <p class="text-slate-600 text-center italic text-sm leading-relaxed">
                        "Dengan menekan tombol di bawah, saya menyatakan telah membaca dan memahami seluruh tata tertib serta ketentuan yang berlaku untuk kunjungan ke Lapas Kelas IIB Jombang."
                    </p>
                </div>

                <button @click="showForm = true; window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="group relative inline-flex items-center justify-start overflow-hidden rounded-full bg-gradient-to-r from-blue-950 to-black px-12 py-6 font-bold text-white transition-all duration-300 hover:from-black hover:to-blue-950 hover:scale-105 shadow-2xl hover:shadow-blue-900/50 border-2 border-yellow-500 border-opacity-50">
                    <span class="absolute right-0 -mt-12 h-32 w-8 translate-x-12 rotate-12 bg-gradient-to-b from-yellow-500 to-yellow-600 opacity-30 transition-all duration-1000 ease-out group-hover:-translate-x-40"></span>
                    <span class="relative flex items-center gap-3 text-lg tracking-wide">
                        <i class="fa-solid fa-file-signature text-yellow-400"></i>
                        ISI FORMULIR PENDAFTARAN
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </span>
                </button>

                <div class="flex gap-4 text-xs text-slate-500">
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-shield-alt text-green-500"></i> Data Aman
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-clock text-blue-500"></i> Proses Cepat
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-users text-purple-500"></i> Layanan Publik
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================== --}}
    {{-- BAGIAN 2: FORMULIR PENDAFTARAN (Muncul setelah klik tombol) --}}
    {{-- ============================================================== --}}
    <div x-show="showForm"
        style="display: none;"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="pt-10 px-4 sm:px-6">

        <div class="max-w-4xl mx-auto bg-gradient-to-br from-white via-gray-50 to-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-200">
            <div class="bg-gradient-to-r from-blue-950 via-blue-900 to-blue-800 px-8 py-6 flex justify-between items-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500 opacity-10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <h2 class="text-2xl font-bold text-yellow-400 flex items-center gap-2">
                        <i class="fa-solid fa-clipboard-list"></i>
                        Formulir Kunjungan
                    </h2>
                    <p class="text-gray-200 text-sm mt-1">Lengkapi data di bawah ini dengan benar dan lengkap.</p>
                </div>
                {{-- Tombol Batal diperbesar --}}
                <button @click="showForm = false" class="relative z-10 text-gray-300 hover:text-white transition flex items-center gap-2 text-sm font-semibold bg-blue-800 bg-opacity-50 hover:bg-opacity-70 px-4 py-2 rounded-lg shadow-md backdrop-blur-sm">
                    <i class="fa-solid fa-xmark text-lg"></i> Batal
                </button>
            </div>

            <div class="p-10"> {{-- Padding diperbesar agar lebih lega --}}

                {{-- PESAN SUKSES --}}
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8" role="alert">
                        <p class="font-bold">Berhasil!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('kunjungan.store') }}" class="space-y-8 animate-fade-in">
                    @csrf

                    {{-- Data Pengunjung --}}
                    <div class="bg-gradient-to-r from-blue-50 to-gray-50 p-6 rounded-2xl border border-blue-100 animate-slide-up">
                        <h3 class="text-lg font-bold text-slate-800 border-b-2 border-blue-200 pb-3 mb-6 flex items-center gap-3">
                            <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-xs font-extrabold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1 animate-pulse">
                                <i class="fa-solid fa-user"></i> 1
                            </span> 
                            <span class="text-blue-800">Data Pengunjung</span>
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label for="nama_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-id-card text-blue-500"></i>
                                    Nama Lengkap (Sesuai KTP)
                                </label>
                                <input type="text" id="nama_pengunjung" name="nama_pengunjung" value="{{ old('nama_pengunjung') }}" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-blue-300 @error('nama_pengunjung') border-red-500 @enderror" placeholder="Masukkan nama lengkap Anda">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_nama_pengunjung"></p>
                            </div>
                            <div class="group">
                                <label for="nik_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-hashtag text-blue-500"></i>
                                    NIK (Nomor Induk Kependudukan)
                                </label>
                                <input type="text" id="nik_pengunjung" name="nik_pengunjung" value="{{ old('nik_pengunjung') }}" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-blue-300 @error('nik_pengunjung') border-red-500 @enderror" placeholder="Masukkan 16 digit NIK Anda" maxlength="16">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_nik_pengunjung"></p>
                            </div>
                            <div class="group">
                                <label for="no_wa_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-green-500"></i>
                                    Nomor WhatsApp Aktif
                                </label>
                                <input type="text" id="no_wa_pengunjung" name="no_wa_pengunjung" value="{{ old('no_wa_pengunjung') }}" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-blue-300 @error('no_wa_pengunjung') border-red-500 @enderror" placeholder="Contoh: 081234567890">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_no_wa_pengunjung"></p>
                            </div>
                            <div class="group">
                                <label for="email_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-envelope text-blue-500"></i>
                                    Alamat Email Aktif
                                </label>
                                <input type="email" id="email_pengunjung" name="email_pengunjung" value="{{ old('email_pengunjung') }}" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-blue-300 @error('email_pengunjung') border-red-500 @enderror" placeholder="Contoh: budi@email.com" required>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_email_pengunjung"></p>
                            </div>
                            <div class="md:col-span-2 group">
                                <label for="alamat_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-map-marker-alt text-red-500"></i>
                                    Alamat Lengkap
                                </label>
                                <input type="text" id="alamat_pengunjung" name="alamat_pengunjung" value="{{ old('alamat_pengunjung') }}" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-blue-300 @error('alamat_pengunjung') border-red-500 @enderror" placeholder="Masukkan alamat lengkap Anda (Desa/Kelurahan, Kecamatan, Kota/Kabupaten)">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_alamat_pengunjung"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Data WBP --}}
                    <div class="mt-8 bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-2xl border border-yellow-100 animate-slide-up-delay">
                        <h3 class="text-lg font-bold text-slate-800 border-b-2 border-yellow-200 pb-3 mb-6 flex items-center gap-3">
                            <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-slate-900 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1 animate-pulse">
                                <i class="fa-solid fa-users"></i> 2
                            </span> 
                            <span class="text-yellow-800">Data Tujuan Kunjungan</span>
                        </h3>
                        <div 
                            class="grid grid-cols-1 md:grid-cols-2 gap-6"
                            x-data="{
                                // Data & State
                                datesByDay: {{ json_encode($datesByDay) }},
                                selectedDay: '{{ old('selected_day', '') }}',
                                selectedDate: '{{ old('tanggal_kunjungan', '') }}',
                                selectedSesi: '{{ old('sesi', '') }}',
                                availableDates: [],
                                isMonday: false,
                                quotaInfo: '',
                                isLoading: false,
                                
                                // Methods
                                init() {
                                    // Initialize available dates if a day was already selected (e.g., due to validation error)
                                    if (this.selectedDay) {
                                        this.updateAvailableDates();
                                    }
                                    // If a date was already selected, fetch quota immediately
                                    if (this.selectedDate) {
                                        this.getQuota();
                                    }

                                    // Watch for changes and fetch quota
                                    this.$watch('selectedDate', () => this.getQuota());
                                    this.$watch('selectedSesi', () => this.getQuota());
                                },

                                handleDayChange() {
                                    this.updateAvailableDates();
                                    this.selectedDate = ''; // Reset date selection
                                    this.quotaInfo = ''; // Reset quota info
                                },

                                updateAvailableDates() {
                                    this.availableDates = this.datesByDay[this.selectedDay] || [];
                                    this.isMonday = (this.selectedDay === 'Senin');
                                },
                                
                                async getQuota() {
                                    // Don't fetch if date is not selected, or if it's Monday and session is not selected
                                    if (!this.selectedDate || (this.isMonday && !this.selectedSesi)) {
                                        this.quotaInfo = '';
                                        return;
                                    }

                                    this.isLoading = true;
                                    this.quotaInfo = 'Memeriksa kuota...';

                                    try {
                                        const params = new URLSearchParams({
                                            tanggal_kunjungan: this.selectedDate,
                                            sesi: this.isMonday ? this.selectedSesi : '',
                                        });

                                        const response = await fetch(`{{ route('kunjungan.quota.api') }}?${params}`);
                                        
                                        if (!response.ok) {
                                            const errorData = await response.json();
                                            throw new Error(errorData.message || 'Gagal mengambil data kuota.');
                                        }

                                        const data = await response.json();
                                        
                                        if (data.sisa_kuota > 0) {
                                            this.quotaInfo = `<span class='text-green-600 font-semibold'><i class='fa-solid fa-check-circle mr-1'></i>Sisa Kuota: ${data.sisa_kuota}</span>`;
                                        } else {
                                            this.quotaInfo = `<span class='text-red-600 font-semibold'><i class='fa-solid fa-times-circle mr-1'></i>Kuota Penuh</span>`;
                                        }

                                    } catch (error) {
                                        this.quotaInfo = `<span class='text-red-600 font-semibold'>Gagal memeriksa kuota.</span>`;
                                        console.error('Quota Fetch Error:', error);
                                    } finally {
                                        this.isLoading = false;
                                    }
                                }
                            }"
                        >
                            {{-- NAMA WBP --}}
                            <div class="group">
                                <label for="nama_wbp" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-user-tie text-yellow-600"></i>
                                    Nama Warga Binaan (WBP)
                                </label>
                                <input type="text" id="nama_wbp" name="nama_wbp" value="{{ old('nama_wbp') }}" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-yellow-300 @error('nama_wbp') border-red-500 @enderror" placeholder="Siapa nama WBP yang ingin Anda kunjungi?">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_nama_wbp"></p>
                            </div>

                            {{-- HUBUNGAN --}}
                            <div class="group">
                                <label for="hubungan" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-heart text-red-500"></i>
                                    Hubungan dengan WBP
                                </label>
                                <select id="hubungan" name="hubungan" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-yellow-300 @error('hubungan') border-red-500 @enderror">
                                    <option value="" disabled selected>Pilih hubungan Anda dengan WBP...</option>
                                    <option value="Orang Tua" @if(old('hubungan') == 'Orang Tua') selected @endif>Orang Tua</option>
                                    <option value="Suami / Istri" @if(old('hubungan') == 'Suami / Istri') selected @endif>Suami / Istri</option>
                                    <option value="Anak" @if(old('hubungan') == 'Anak') selected @endif>Anak</option>
                                    <option value="Saudara" @if(old('hubungan') == 'Saudara') selected @endif>Saudara</option>
                                    <option value="Teman" @if(old('hubungan') == 'Teman') selected @endif>Teman</option>
                                    <option value="Lainnya" @if(old('hubungan') == 'Lainnya') selected @endif>Lainnya</option>
                                </select>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_hubungan"></p>
                            </div>

                            {{-- HARI --}}
                            <div class="group">
                                <label for="hari" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-calendar-day text-blue-500"></i>
                                    Pilih Hari Kunjungan
                                </label>
                                <select id="hari" name="selected_day" @change="handleDayChange()" x-model="selectedDay" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-yellow-300">
                                    <option value="" disabled>Pilih hari kunjungan...</option>
                                    @foreach (array_keys($datesByDay) as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_hari"></p>
                            </div>

                            {{-- TANGGAL --}}
                            <div class="group">
                                <label for="tanggal_kunjungan" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-calendar-alt text-green-500"></i>
                                    Pilih Tanggal Kunjungan
                                </label>
                                <select id="tanggal_kunjungan" name="tanggal_kunjungan" x-model="selectedDate" :disabled="!selectedDay || availableDates.length === 0" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-yellow-300 disabled:bg-gray-50 disabled:cursor-not-allowed @error('tanggal_kunjungan') border-red-500 @enderror">
                                    <option value="" disabled>-- Pilih hari terlebih dahulu --</option>
                                    <template x-for="date in availableDates" :key="date.value">
                                        <option :value="date.value" x-text="date.label"></option>
                                    </template>
                                </select>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_tanggal_kunjungan"></p>
                                <!-- Quota Info Display -->
                                <div class="mt-3 p-3 bg-white rounded-lg border border-gray-200 shadow-sm">
                                    <div class="text-sm font-semibold h-5">
                                        <span x-show="isLoading" class="text-slate-500 flex items-center gap-1">
                                            <i class="fa-solid fa-spinner fa-spin"></i> Memeriksa kuota...
                                        </span>
                                        <span x-show="!isLoading" x-html="quotaInfo"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- Dropdown Sesi Dinamis --}}
                            <div x-show="isMonday" x-transition class="md:col-span-2 bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                                <label for="sesi" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-clock text-blue-600"></i>
                                    Sesi Kunjungan (Khusus Hari Senin)
                                </label>
                                <select id="sesi" name="sesi" x-model="selectedSesi" class="w-full rounded-xl border-2 border-gray-200 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition-all duration-300 shadow-sm py-3 px-4 bg-white hover:border-yellow-300 @error('sesi') border-red-500 @enderror">
                                    <option value="" disabled>Pilih sesi kunjungan...</option>
                                    <option value="pagi" @if(old('sesi') == 'pagi') selected @endif>Sesi Pagi (08:30 - 10:00)</option>
                                    <option value="siang" @if(old('sesi') == 'siang') selected @endif>Sesi Siang (13:30 - 14:30)</option>
                                </select>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_sesi"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Kirim --}}
                    <div class="pt-8 border-t-2 border-gray-200 flex items-center justify-between gap-4 bg-gradient-to-r from-gray-50 to-blue-50 p-6 rounded-2xl">
                        <button type="button" @click="showForm = false" class="px-8 py-3 text-slate-600 font-bold hover:text-slate-900 transition-all duration-300 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 rounded-xl shadow-md hover:shadow-lg transform hover:scale-105 flex items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:from-yellow-600 hover:via-yellow-700 hover:to-yellow-800 text-slate-900 font-bold px-12 py-4 rounded-xl shadow-xl hover:shadow-yellow-500/50 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 flex items-center gap-3 text-lg">
                            <i class="fa-solid fa-paper-plane text-xl"></i> 
                            <span>KIRIM PENDAFTARAN</span>
                            <i class="fa-solid fa-check-circle text-xl"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const fields = [
            { id: 'nama_pengunjung', rules: ['required', { type: 'maxlength', value: 255 }] },
            { id: 'nik_pengunjung', rules: ['required', { type: 'exactlength', value: 16 }, 'numeric'] },
            { id: 'no_wa_pengunjung', rules: ['required', { type: 'maxlength', value: 15 }, 'numeric'] },
            { id: 'email_pengunjung', rules: ['required', 'email', { type: 'maxlength', value: 255 }] },
            { id: 'alamat_pengunjung', rules: ['required'] },
            { id: 'nama_wbp', rules: ['required', { type: 'maxlength', value: 255 }] },
            { id: 'hubungan', rules: ['required'] },
            { id: 'hari', rules: ['required'] }, // For 'Pilih Hari' dropdown
            { id: 'tanggal_kunjungan', rules: ['required'] }, // For 'Pilih Tanggal' dropdown
            { id: 'sesi', rules: [{ type: 'requiredIfMonday', field: 'hari' }] }, // Conditional
        ];

        const errorMessages = {
            required: 'Field ini wajib diisi.',
            email: 'Format email tidak valid.',
            numeric: 'Hanya angka yang diperbolehkan.',
            maxlength: 'Maksimal :value karakter.',
            exactlength: 'Harus :value karakter.',
            requiredIfMonday: 'Sesi wajib dipilih untuk hari Senin.'
        };

        function showError(fieldId, message) {
            const errorElement = document.getElementById(`error_${fieldId}`);
            const inputElement = document.getElementById(fieldId);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
            }
            if (inputElement) {
                inputElement.classList.add('border-red-500');
                inputElement.classList.remove('border-slate-300', 'focus:ring-yellow-500', 'focus:border-yellow-500');
            }
        }

        function hideError(fieldId) {
            const errorElement = document.getElementById(`error_${fieldId}`);
            const inputElement = document.getElementById(fieldId);
            if (errorElement) {
                errorElement.classList.add('hidden');
                errorElement.textContent = '';
            }
            if (inputElement) {
                inputElement.classList.remove('border-red-500');
                inputElement.classList.add('border-slate-300', 'focus:ring-yellow-500', 'focus:border-yellow-500');
            }
        }

        function validateField(fieldId, rules) {
            const input = document.getElementById(fieldId);
            const value = input ? input.value.trim() : '';
            let isValid = true;
            let message = '';

            for (const rule of rules) {
                if (typeof rule === 'string') {
                    if (rule === 'required' && !value) {
                        isValid = false;
                        message = errorMessages.required;
                        break;
                    }
                    if (rule === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                        isValid = false;
                        message = errorMessages.email;
                        break;
                    }
                    if (rule === 'numeric' && value && !/^\d+$/.test(value)) {
                        isValid = false;
                        message = errorMessages.numeric;
                        break;
                    }
                } else if (typeof rule === 'object') {
                    if (rule.type === 'maxlength' && value.length > rule.value) {
                        isValid = false;
                        message = errorMessages.maxlength.replace(':value', rule.value);
                        break;
                    }
                    if (rule.type === 'exactlength' && value.length !== rule.value) {
                        isValid = false;
                        message = errorMessages.exactlength.replace(':value', rule.value);
                        break;
                    }
                    if (rule.type === 'requiredIfMonday') {
                        const hariInput = document.getElementById(rule.field);
                        if (hariInput && hariInput.value === 'Senin' && !value) {
                            isValid = false;
                            message = errorMessages.requiredIfMonday;
                            break;
                        }
                    }
                }
            }

            if (!isValid) {
                showError(fieldId, message);
                return false;
            } else {
                hideError(fieldId);
                return true;
            }
        }

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            if (input) {
                input.addEventListener('input', () => validateField(field.id, field.rules));
                input.addEventListener('blur', () => validateField(field.id, field.rules));
                // Special handling for select elements if they need immediate validation on change
                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', () => validateField(field.id, field.rules));
                }
            }
        });

        form.addEventListener('submit', function(event) {
            let formIsValid = true;
            fields.forEach(field => {
                if (!validateField(field.id, field.rules)) {
                    formIsValid = false;
                }
            });

            // Prevent form submission if any validation fails
            if (!formIsValid) {
                event.preventDefault();
                // Optionally scroll to the first error
                const firstError = document.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Trigger validation on load if there are old inputs (e.g., after a server-side validation failure)
        window.addEventListener('load', () => {
            fields.forEach(field => {
                const input = document.getElementById(field.id);
                if (input && input.value) { // Only validate if field has some value
                    validateField(field.id, field.rules);
                }
            });
        });
    });
</script>