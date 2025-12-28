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
        <div class="bg-slate-900 pt-16 pb-24 px-4 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-yellow-500 opacity-10 blur-3xl"></div>
            <div class="max-w-7xl mx-auto text-center relative z-10">
                <span class="text-yellow-500 font-bold tracking-widest uppercase text-sm mb-2 block">Layanan Publik</span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6">
                    Pendaftaran Kunjungan Tatap Muka
                </h1>
                <p class="text-slate-300 max-w-3xl mx-auto text-lg leading-relaxed">
                    Mohon pelajari <strong>Jadwal</strong>, <strong>Alur Layanan</strong>, dan <strong>Ketentuan Barang</strong> di bawah ini sebelum mengisi formulir pendaftaran demi kelancaran kunjungan Anda.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">

            {{-- 1. JADWAL & KUOTA --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

                {{-- Card 1: Waktu Layanan --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-blue-600 flex flex-col h-full transform hover:-translate-y-1 transition duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-blue-100 rounded-full text-blue-600">
                            <i class="fa-solid fa-clock text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800">Waktu Layanan</h3>
                            <p class="text-xs text-slate-500">Jam Operasional</p>
                        </div>
                    </div>
                    <div class="space-y-4 flex-grow">
                        <div class="bg-slate-50 p-4 rounded-lg border-l-4 border-blue-500 hover:bg-blue-50 transition">
                            <span class="block font-bold text-slate-900 text-sm mb-2">SETIAP SENIN</span>
                            <div class="text-sm text-slate-600 space-y-1">
                                <div class="flex justify-between"><span>Sesi Pagi:</span> <strong>08.30 - 10.00</strong></div>
                                <div class="flex justify-between"><span>Sesi Siang:</span> <strong>13.30 - 14.30</strong></div>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-lg border-l-4 border-slate-500 hover:bg-slate-100 transition">
                            <span class="block font-bold text-slate-900 text-sm mb-2">SELASA - KAMIS</span>
                            <div class="text-sm text-slate-600">
                                <div class="flex justify-between"><span>Sesi Pagi:</span> <strong>08.30 - 10.00</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Jadwal Kunjungan --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-yellow-500 flex flex-col h-full transform hover:-translate-y-1 transition duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-600">
                            <i class="fa-solid fa-calendar-check text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800">Jadwal Kunjungan</h3>
                            <p class="text-xs text-slate-500">Sesuai Status WBP</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 flex-grow">
                        {{-- Kotak NAPI --}}
                        <div class="flex flex-col justify-center items-center bg-slate-50 rounded-xl border border-slate-200 p-4 text-center h-full hover:bg-yellow-50 hover:border-yellow-200 transition">
                            <span class="text-xs font-bold text-slate-500 uppercase mb-2">Senin & Rabu</span>
                            <span class="text-2xl font-black text-slate-900">NAPI</span>
                            <span class="text-[10px] text-slate-400 mt-1">(Narapidana)</span>
                        </div>
                        {{-- Kotak TAHANAN --}}
                        <div class="flex flex-col justify-center items-center bg-slate-50 rounded-xl border border-slate-200 p-4 text-center h-full hover:bg-blue-50 hover:border-blue-200 transition">
                            <span class="text-xs font-bold text-slate-500 uppercase mb-2">Selasa & Kamis</span>
                            <span class="text-2xl font-black text-slate-900">TAHANAN</span>
                            <span class="text-[10px] text-slate-400 mt-1">(Tahanan)</span>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <span class="inline-block bg-red-100 text-red-600 text-xs font-bold px-4 py-1.5 rounded-full shadow-sm">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> Jumat & Minggu LIBUR
                        </span>
                    </div>
                </div>

                {{-- Card 3: Kuota Antrian --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-emerald-500 flex flex-col h-full transform hover:-translate-y-1 transition duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-emerald-100 rounded-full text-emerald-600">
                            <i class="fa-solid fa-users text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800">Kuota Antrian</h3>
                            <p class="text-xs text-slate-500">Batas Harian</p>
                        </div>
                    </div>
                    <div class="space-y-3 flex-grow">
                        <div class="flex justify-between items-center bg-emerald-50 p-3 rounded-lg border border-emerald-100 hover:shadow-sm transition">
                            <span class="text-sm font-medium text-slate-700">Senin (Pagi)</span>
                            <span class="bg-white text-emerald-700 font-bold px-3 py-1 rounded border border-emerald-200 text-sm">120 Orang</span>
                        </div>
                        <div class="flex justify-between items-center bg-emerald-50 p-3 rounded-lg border border-emerald-100 hover:shadow-sm transition">
                            <span class="text-sm font-medium text-slate-700">Senin (Siang)</span>
                            <span class="bg-white text-emerald-700 font-bold px-3 py-1 rounded border border-emerald-200 text-sm">40 Orang</span>
                        </div>
                        <div class="flex justify-between items-center bg-slate-50 p-3 rounded-lg border border-slate-200 hover:shadow-sm transition">
                            <span class="text-sm font-medium text-slate-700">Selasa - Kamis</span>
                            <span class="bg-white text-slate-700 font-bold px-3 py-1 rounded border border-slate-200 text-sm">150 Orang</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. ALUR LAYANAN --}}
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-12 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-2 h-full bg-yellow-500"></div>
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900">ALUR LAYANAN KUNJUNGAN</h2>
                    <p class="text-slate-500 mt-2">Ikuti 9 langkah berikut untuk kenyamanan bersama</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 relative z-10">
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-slate-900 text-yellow-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:scale-110 transition">1</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Daftar Online (H-1)</h4>
                        <p class="text-sm text-slate-600">Daftar via Website atau WA: <br><strong>08573333400</strong></p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:border-yellow-500 transition">2</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Ruang Transit</h4>
                        <p class="text-sm text-slate-600">Menunggu panggilan petugas di ruang transit.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:border-yellow-500 transition">3</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Loket Pelayanan</h4>
                        <p class="text-sm text-slate-600">Verifikasi data & ambil nomor antrian.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:border-yellow-500 transition">4</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Penggeledahan</h4>
                        <p class="text-sm text-slate-600">Pemeriksaan badan & barang bawaan.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:border-yellow-500 transition">5</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">P2U (Identitas)</h4>
                        <p class="text-sm text-slate-600">Tukar KTP dengan ID Card Kunjungan.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:border-yellow-500 transition">6</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Ganti Alas Kaki</h4>
                        <p class="text-sm text-slate-600">Wajib pakai sandal inventaris Lapas.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-green-50 border border-green-200 rounded-xl hover:shadow-lg transition group">
                        <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:scale-110 transition">7</div>
                        <h4 class="font-bold text-green-800 text-lg mb-2">PELAKSANAAN</h4>
                        <p class="text-sm text-green-700">Masuk ruang kunjungan & bertemu WBP.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:border-yellow-500 transition">8</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Selesai</h4>
                        <p class="text-sm text-slate-600">Ambil KTP & kembalikan ID Card.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-6 bg-slate-50 rounded-xl hover:shadow-lg transition border border-slate-100 group">
                        <div class="w-12 h-12 bg-white border-4 border-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md group-hover:border-yellow-500 transition">9</div>
                        <h4 class="font-bold text-slate-900 text-lg mb-2">Pulang</h4>
                        <p class="text-sm text-slate-600">Cek stempel & tinggalkan area Lapas.</p>
                    </div>
                </div>
            </div>

            {{-- 3. KETENTUAN BARANG BAWAAN --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

                {{-- A. DIPERBOLEHKAN --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100 h-full">
                    <div class="bg-yellow-500 px-6 py-4 flex items-center justify-between">
                        <h3 class="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> DIPERBOLEHKAN
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🍇</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Buah-buahan</h4>
                                <p class="text-sm text-slate-600 mt-1">Wajib <strong>dikupas, potong, tanpa biji</strong>. (Salak/Durian dilarang).</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🍜</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Makanan Berkuah</h4>
                                <p class="text-sm text-slate-600 mt-1">Harus <strong>BENING & POLOS</strong>. Tanpa kecap/sambal campur.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🍗</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Lauk Pauk</h4>
                                <p class="text-sm text-slate-600 mt-1">Terlihat jelas isinya. Telur wajib dibelah. (Jeroan dilarang).</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🛍️</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Kemasan</h4>
                                <p class="text-sm text-slate-600 mt-1">Wajib <strong>Plastik Bening</strong> (Ukuran 45). 1 Plastik per rombongan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- B. DILARANG --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100 h-full">
                    <div class="bg-red-600 px-6 py-4 flex items-center justify-between">
                        <h3 class="font-extrabold text-white text-lg flex items-center gap-2">
                            <i class="fa-solid fa-ban"></i> DILARANG KERAS
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-center">
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">🍢</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Makanan Berongga</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">🥤</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Minuman / Cairan</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">🍞</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Kemasan Pabrik</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">🦀</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Makanan Bercangkang</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">🧂</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Saos Sachet</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">🚬</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Rokok / Korek</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">📱</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">HP / Elektronik</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">💊</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Obat / Narkoba</span>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg flex flex-col items-center justify-center h-24 hover:bg-red-100 transition">
                                <span class="text-2xl mb-2">🤢</span>
                                <span class="text-xs font-bold text-red-800 leading-tight">Bau Menyengat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL ACTION --}}
            <div class="flex flex-col items-center justify-center space-y-6 pb-12">
                <p class="text-slate-500 italic text-sm text-center bg-yellow-50 px-6 py-3 rounded-full border border-yellow-200">
                    "Dengan menekan tombol di bawah, saya menyatakan telah membaca dan memahami tata tertib di atas."
                </p>

                <button @click="showForm = true; window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="group relative inline-flex items-center justify-start overflow-hidden rounded-full bg-slate-900 px-10 py-5 font-bold text-white transition-all duration-300 hover:bg-slate-800 hover:scale-105 shadow-2xl">
                    <span class="absolute right-0 -mt-12 h-32 w-8 translate-x-12 rotate-12 bg-white opacity-10 transition-all duration-1000 ease-out group-hover:-translate-x-40"></span>
                    <span class="relative flex items-center gap-3 text-lg tracking-wide">
                        ISI FORMULIR PENDAFTARAN <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </span>
                </button>
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

        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
            <div class="bg-slate-900 px-8 py-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-yellow-500">Formulir Kunjungan</h2>
                    <p class="text-slate-400 text-sm mt-1">Lengkapi data di bawah ini dengan benar.</p>
                </div>
                {{-- Tombol Batal diperbesar --}}
                <button @click="showForm = false" class="text-slate-400 hover:text-white transition flex items-center gap-2 text-sm font-semibold bg-slate-800 px-4 py-2 rounded-lg hover:bg-slate-700">
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

                <form method="POST" action="{{ route('kunjungan.store') }}" class="space-y-8">
                    @csrf

                    {{-- Data Pengunjung --}}
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-6 flex items-center gap-2">
                            <span class="bg-yellow-500 text-slate-900 text-xs font-extrabold px-2.5 py-1 rounded-full">1</span> Data Pengunjung
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap (Sesuai KTP)</label>
                                <input type="text" id="nama_pengunjung" name="nama_pengunjung" value="{{ old('nama_pengunjung') }}" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('nama_pengunjung') border-red-500 @enderror" placeholder="Contoh: Budi Santoso">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_nama_pengunjung"></p>
                            </div>
                            <div>
                                <label for="nik_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2">NIK (Nomor Induk Kependudukan)</label>
                                <input type="text" id="nik_pengunjung" name="nik_pengunjung" value="{{ old('nik_pengunjung') }}" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('nik_pengunjung') border-red-500 @enderror" placeholder="16 Digit Angka" maxlength="16">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_nik_pengunjung"></p>
                            </div>
                            <div>
                                <label for="no_wa_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2">Nomor WhatsApp Aktif</label>
                                <input type="text" id="no_wa_pengunjung" name="no_wa_pengunjung" value="{{ old('no_wa_pengunjung') }}" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('no_wa_pengunjung') border-red-500 @enderror" placeholder="08xxxxxxxxxx">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_no_wa_pengunjung"></p>
                            </div>
                            <div>
                                <label for="email_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email Aktif</label>
                                <input type="email" id="email_pengunjung" name="email_pengunjung" value="{{ old('email_pengunjung') }}" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('email_pengunjung') border-red-500 @enderror" placeholder="nama@email.com" required>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_email_pengunjung"></p>
                            </div>
                            <div>
                                <label for="alamat_pengunjung" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                                <input type="text" id="alamat_pengunjung" name="alamat_pengunjung" value="{{ old('alamat_pengunjung') }}" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('alamat_pengunjung') border-red-500 @enderror" placeholder="Desa, Kecamatan, Kota">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_alamat_pengunjung"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Data WBP --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-6 flex items-center gap-2">
                            <span class="bg-yellow-500 text-slate-900 text-xs font-extrabold px-2.5 py-1 rounded-full">2</span> Data Tujuan Kunjungan
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
                                            this.quotaInfo = `<span class='text-green-600'><i class='fa-solid fa-check-circle mr-1'></i>Sisa Kuota: ${data.sisa_kuota}</span>`;
                                        } else {
                                            this.quotaInfo = `<span class='text-red-600'><i class='fa-solid fa-times-circle mr-1'></i>Kuota Penuh</span>`;
                                        }

                                    } catch (error) {
                                        this.quotaInfo = `<span class='text-red-600'>Gagal memeriksa kuota.</span>`;
                                        console.error('Quota Fetch Error:', error);
                                    } finally {
                                        this.isLoading = false;
                                    }
                                }
                            }"
                        >
                            {{-- NAMA WBP --}}
                            <div>
                                <label for="nama_wbp" class="block text-sm font-semibold text-slate-700 mb-2">Nama Warga Binaan (WBP)</label>
                                <input type="text" id="nama_wbp" name="nama_wbp" value="{{ old('nama_wbp') }}" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('nama_wbp') border-red-500 @enderror" placeholder="Siapa yang ingin dikunjungi?">
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_nama_wbp"></p>
                            </div>

                            {{-- HUBUNGAN --}}
                            <div>
                                <label for="hubungan" class="block text-sm font-semibold text-slate-700 mb-2">Hubungan</label>
                                <select id="hubungan" name="hubungan" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 bg-white @error('hubungan') border-red-500 @enderror">
                                    <option value="" disabled selected>Pilih Hubungan...</option>
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
                            <div>
                                <label for="hari" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Hari</label>
                                <select id="hari" name="selected_day" @change="handleDayChange()" x-model="selectedDay" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 bg-white">
                                    <option value="" disabled>Pilih Hari Kunjungan...</option>
                                    @foreach (array_keys($datesByDay) as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_hari"></p>
                            </div>

                            {{-- TANGGAL --}}
                            <div>
                                <label for="tanggal_kunjungan" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Tanggal</label>
                                <select id="tanggal_kunjungan" name="tanggal_kunjungan" x-model="selectedDate" :disabled="!selectedDay || availableDates.length === 0" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 bg-white disabled:bg-slate-50 disabled:cursor-not-allowed">
                                    <option value="" disabled>-- Pilih Hari Dulu --</option>
                                    <template x-for="date in availableDates" :key="date.value">
                                        <option :value="date.value" x-text="date.label"></option>
                                    </template>
                                </select>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_tanggal_kunjungan"></p>
                                <!-- Quota Info Display -->
                                <div class="mt-2 text-sm font-semibold h-5">
                                    <span x-show="isLoading" class="text-slate-500">Memeriksa kuota...</span>
                                    <span x-show="!isLoading" x-html="quotaInfo"></span>
                                </div>
                            </div>

                            {{-- Dropdown Sesi Dinamis --}}
                            <div x-show="isMonday" x-transition class="md:col-span-2">
                                <label for="sesi" class="block text-sm font-semibold text-slate-700 mb-2">Sesi Kunjungan (Khusus Senin)</label>
                                <select id="sesi" name="sesi" x-model="selectedSesi" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 bg-white @error('sesi') border-red-500 @enderror">
                                    <option value="" disabled>Pilih Sesi...</option>
                                    <option value="pagi" @if(old('sesi') == 'pagi') selected @endif>Sesi Pagi (08:30 - 10:00)</option>
                                    <option value="siang" @if(old('sesi') == 'siang') selected @endif>Sesi Siang (13:30 - 14:30)</option>
                                </select>
                                <p class="mt-2 text-sm text-red-600 hidden" id="error_sesi"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Kirim --}}
                    <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                        <button type="button" @click="showForm = false" class="px-6 py-3 text-slate-600 font-bold hover:text-slate-900 transition bg-slate-100 rounded-lg hover:bg-slate-200">Kembali</button>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold px-10 py-3 rounded-lg shadow-lg hover:shadow-yellow-500/50 transition transform hover:-translate-y-1 flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> KIRIM SEKARANG
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