@extends('layouts.main')

@section('content')
{{-- WRAPPER UTAMA DENGAN ALPINE JS --}}
<div x-data="{ showForm: false }" class="bg-slate-50 min-h-screen pb-20">

    {{-- ============================================================== --}}
    {{-- BAGIAN 1: INFORMASI & TATA TERTIB (Muncul Awal) --}}
    {{-- ============================================================== --}}
    <div x-show="!showForm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100">

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

            {{-- 1. JADWAL & KUOTA (Sesuai Gambar 1 & 2) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                {{-- Waktu --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-blue-600">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-blue-100 p-3 rounded-full text-blue-600"><i class="fa-solid fa-clock text-xl"></i></div>
                        <h3 class="font-bold text-xl text-slate-800">Waktu Layanan</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-slate-50 p-3 rounded border-l-4 border-blue-500">
                            <span class="block font-bold text-slate-900 text-sm">SETIAP SENIN</span>
                            <div class="text-sm text-slate-600 mt-1">
                                <div class="flex justify-between"><span>Sesi Pagi:</span> <strong>08.30 - 10.00</strong></div>
                                <div class="flex justify-between"><span>Sesi Siang:</span> <strong>13.30 - 14.30</strong></div>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-3 rounded border-l-4 border-slate-500">
                            <span class="block font-bold text-slate-900 text-sm">SELASA - KAMIS</span>
                            <div class="text-sm text-slate-600 mt-1">
                                <div class="flex justify-between"><span>Sesi Pagi:</span> <strong>08.30 - 10.00</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Jenis Kunjungan --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-yellow-500">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-yellow-100 p-3 rounded-full text-yellow-600"><i class="fa-solid fa-calendar-check text-xl"></i></div>
                        <h3 class="font-bold text-xl text-slate-800">Jadwal Kunjungan</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-center h-full pb-4">
                        <div class="flex flex-col justify-center bg-slate-50 rounded border border-slate-200 p-2">
                            <span class="text-xs font-bold text-slate-500 uppercase">Senin & Rabu</span>
                            <span class="text-xl font-black text-slate-900">NAPI</span>
                            <span class="text-[10px] text-slate-400">(Narapidana)</span>
                        </div>
                        <div class="flex flex-col justify-center bg-slate-50 rounded border border-slate-200 p-2">
                            <span class="text-xs font-bold text-slate-500 uppercase">Selasa & Kamis</span>
                            <span class="text-xl font-black text-slate-900">TAHANAN</span>
                            <span class="text-[10px] text-slate-400">(Tahanan)</span>
                        </div>
                    </div>
                </div>

                {{-- Kuota --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-emerald-500">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-emerald-100 p-3 rounded-full text-emerald-600"><i class="fa-solid fa-users text-xl"></i></div>
                        <h3 class="font-bold text-xl text-slate-800">Kuota Antrian</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center bg-emerald-50 p-3 rounded">
                            <span class="text-sm font-medium text-slate-700">Senin (Pagi)</span>
                            <span class="bg-white text-emerald-700 font-bold px-3 py-1 rounded border border-emerald-200 text-sm">120 Orang</span>
                        </li>
                        <li class="flex justify-between items-center bg-emerald-50 p-3 rounded">
                            <span class="text-sm font-medium text-slate-700">Senin (Siang)</span>
                            <span class="bg-white text-emerald-700 font-bold px-3 py-1 rounded border border-emerald-200 text-sm">40 Orang</span>
                        </li>
                        <li class="flex justify-between items-center bg-slate-50 p-3 rounded">
                            <span class="text-sm font-medium text-slate-700">Selasa - Kamis</span>
                            <span class="bg-white text-slate-700 font-bold px-3 py-1 rounded border border-slate-200 text-sm">150 Orang</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 2. ALUR LAYANAN (Sesuai Gambar 3 - Ada 9 Langkah) --}}
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-12 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-2 h-full bg-yellow-500"></div>
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900">ALUR LAYANAN KUNJUNGAN</h2>
                    <p class="text-slate-500 mt-2">Ikuti 9 langkah berikut untuk kenyamanan bersama</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">1</div>
                        <h4 class="font-bold text-slate-900">Daftar Online (H-1)</h4>
                        <p class="text-xs text-slate-600 mt-1">Daftar via Website/WA: <strong>08573333400</strong>. Maksimal H-1 kunjungan.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">2</div>
                        <h4 class="font-bold text-slate-900">Ruang Transit</h4>
                        <p class="text-xs text-slate-600 mt-1">Pengunjung menunggu di ruang transit hingga petugas memanggil.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">3</div>
                        <h4 class="font-bold text-slate-900">Loket Pelayanan</h4>
                        <p class="text-xs text-slate-600 mt-1">Menuju loket untuk verifikasi data pendaftaran.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">4</div>
                        <h4 class="font-bold text-slate-900">Penggeledahan</h4>
                        <p class="text-xs text-slate-600 mt-1">Pemeriksaan badan dan barang bawaan kunjungan.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">5</div>
                        <h4 class="font-bold text-slate-900">P2U (Identitas)</h4>
                        <p class="text-xs text-slate-600 mt-1">Pemeriksaan identitas, pemberian stempel, dan ID Card.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">6</div>
                        <h4 class="font-bold text-slate-900">Ganti Alas Kaki</h4>
                        <p class="text-xs text-slate-600 mt-1">Wajib mengganti alas kaki dengan sandal dari pihak Lapas.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-green-50 border border-green-200 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold mb-3">7</div>
                        <h4 class="font-bold text-green-800">PELAKSANAAN</h4>
                        <p class="text-xs text-green-700 mt-1">Serahkan kertas kunjungan ke petugas pengawas & lakukan kunjungan.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">8</div>
                        <h4 class="font-bold text-slate-900">Selesai Kunjungan</h4>
                        <p class="text-xs text-slate-600 mt-1">Ambil KTP, kembalikan ID Card & sandal di ruang P2U.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center p-4 bg-slate-50 rounded-xl hover:shadow-md transition">
                        <div class="w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold mb-3">9</div>
                        <h4 class="font-bold text-slate-900">Keluar Lapas</h4>
                        <p class="text-xs text-slate-600 mt-1">Petugas memeriksa stempel tangan, pengunjung boleh pulang.</p>
                    </div>
                </div>
            </div>

            {{-- 3. KETENTUAN BARANG BAWAAN (Sesuai Gambar 4 & 5) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

                {{-- A. DIPERBOLEHKAN (Gambar 4) --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100">
                    <div class="bg-yellow-500 px-6 py-4 flex items-center justify-between">
                        <h3 class="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> DIPERBOLEHKAN
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">
                        {{-- Buah --}}
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🍇</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Buah-buahan</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Wajib <strong>dikupas</strong>, tidak ada biji, bentuk potongan siap makan.
                                    <br><span class="text-red-500 italic">(Salak dikupas/buang biji. Pisang & Durian DILARANG).</span>
                                </p>
                            </div>
                        </div>
                        {{-- Makanan Berkuah --}}
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🍜</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Makanan Berkuah</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Harus <strong>BENING</strong>. Tidak boleh dicampur sambal/kecap/saos (polos).
                                </p>
                            </div>
                        </div>
                        {{-- Lauk Pauk --}}
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🍗</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Lauk Pauk</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Terlihat jelas isinya. Telur utuh wajib dibelah/dikupas.
                                    <br><span class="text-red-500 italic">(Usus dan Jeroan DILARANG).</span>
                                </p>
                            </div>
                        </div>
                        {{-- Plastik --}}
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 rounded-full flex items-center justify-center text-2xl">🛍️</div>
                            <div>
                                <h4 class="font-bold text-slate-800">Kemasan</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Wajib bungkus <strong>Plastik Bening</strong> ukuran 45.
                                    <br>1 Rombongan hanya boleh bawa 1 plastik.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- B. DILARANG (Gambar 5) --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100">
                    <div class="bg-red-600 px-6 py-4 flex items-center justify-between">
                        <h3 class="font-extrabold text-white text-lg flex items-center gap-2">
                            <i class="fa-solid fa-ban"></i> TIDAK DIPERBOLEHKAN
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-center">
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🍢</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Makanan Berongga</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🥤</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Minuman / Cairan</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🍞</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Kemasan Pabrik</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🦀</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Makanan Bercangkang</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🧂</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Saos Sachet</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🚬</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Rokok / Korek</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">📱</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Barang Elektronik</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">💊</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Obat / Narkotika</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🍲</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Kuah Gelap/Keruh</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🔪</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Senjata Tajam</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🥄</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Kaca / Logam</span>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg flex flex-col items-center">
                                <span class="text-2xl mb-1">🤢</span>
                                <span class="text-[10px] font-bold text-red-800 leading-tight">Bau Menyengat (Durian)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL ACTION --}}
            <div class="flex flex-col items-center justify-center space-y-6 pb-12">
                <p class="text-slate-500 italic text-sm text-center">
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
            {{-- Header Form --}}
            <div class="bg-slate-900 px-8 py-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-yellow-500">Formulir Kunjungan</h2>
                    <p class="text-slate-400 text-sm">Lengkapi data di bawah ini dengan benar.</p>
                </div>
                <button @click="showForm = false" class="text-slate-400 hover:text-white transition flex items-center gap-2 text-sm font-semibold">
                    <i class="fa-solid fa-xmark text-lg"></i> Batal
                </button>
            </div>

            <div class="p-8 md:p-10">
                <form method="POST" action="#" class="space-y-8">
                    @csrf

                    {{-- Section: Data Pengunjung --}}
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center gap-2">
                            <span class="bg-yellow-500 text-slate-900 text-xs px-2 py-1 rounded-full">1</span> Data Pengunjung
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap (Sesuai KTP)</label>
                                <input type="text" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="Contoh: Budi Santoso">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">NIK (Nomor Induk Kependudukan)</label>
                                <input type="number" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="16 Digit Angka">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor WhatsApp Aktif</label>
                                <input type="number" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="08xxxxxxxxxx">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                                <input type="text" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="Desa, Kecamatan, Kota">
                            </div>
                        </div>
                    </div>

                    {{-- Section: Data WBP --}}
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center gap-2">
                            <span class="bg-yellow-500 text-slate-900 text-xs px-2 py-1 rounded-full">2</span> Data Tujuan Kunjungan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Warga Binaan (WBP)</label>
                                <input type="text" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="Siapa yang ingin dikunjungi?">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Hubungan</label>
                                <select class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition">
                                    <option value="" disabled selected>Pilih Hubungan...</option>
                                    <option>Orang Tua (Ayah/Ibu)</option>
                                    <option>Suami / Istri</option>
                                    <option>Anak Kandung</option>
                                    <option>Saudara Kandung</option>
                                    <option>Kuasa Hukum / Pengacara</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Tanggal Kunjungan</label>
                                <input type="date" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition">
                                <p class="text-xs text-slate-500 mt-2 bg-yellow-50 p-2 rounded border border-yellow-100 inline-block">
                                    <i class="fa-solid fa-circle-info text-yellow-600 mr-1"></i>
                                    Pastikan tanggal sesuai jadwal: <strong>Senin/Rabu (Napi)</strong>, <strong>Selasa/Kamis (Tahanan)</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-4">
                        <button type="button" @click="showForm = false" class="px-6 py-3 text-slate-600 font-bold hover:text-slate-900 transition">Kembali</button>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold px-8 py-3 rounded-lg shadow-lg hover:shadow-yellow-500/50 transition transform hover:-translate-y-1 flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> KIRIM SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection