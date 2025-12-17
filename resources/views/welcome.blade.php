@extends('layouts.main')

@section('content')

<section class="relative bg-navy-light text-white py-24">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Lapas Kelas 2B Jombang</h1>
        <p class="text-xl text-gray-300 mb-8">Pelayanan Prima, Pemasyarakatan Maju.</p>
        <a href="#profil" class="bg-gold text-navy-dark bg-yellow-500 hover:bg-yellow-400 font-bold py-3 px-8 rounded-full shadow-lg transition">
            Selengkapnya
        </a>
    </div>
    </section>

<section id="profil" class="py-16 bg-white">
    <div class="container mx-auto px-6 text-center max-w-3xl">
        <h2 class="text-3xl font-bold text-navy-dark mb-6">Tentang Kami</h2>
        <p class="text-gray-600 leading-relaxed">
            Lembaga Pemasyarakatan Kelas 2B Jombang berkomitmen untuk memberikan pembinaan kepada warga binaan agar menjadi manusia seutuhnya, menyadari kesalahan, memperbaiki diri, dan tidak mengulangi tindak pidana.
        </p>
    </div>
</section>

<section id="berita" class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-navy-dark border-l-4 border-blue-600 pl-4">Berita Terkini</h2>
            <a href="#" class="text-blue-700 font-semibold hover:underline">Lihat Semua Berita &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <img src="https://via.placeholder.com/400x250" alt="News" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-xs font-bold text-blue-600 uppercase">Kegiatan</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 text-gray-800">Kunjungan Kakanwil Jatim</h3>
                    <p class="text-gray-600 text-sm mb-4">Kepala Kantor Wilayah melakukan monitoring dan evaluasi di Lapas Jombang...</p>
                    <a href="#" class="text-navy-dark font-semibold text-sm hover:text-blue-600">Baca Selengkapnya</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <img src="https://via.placeholder.com/400x250" alt="News" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-xs font-bold text-blue-600 uppercase">Pembinaan</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 text-gray-800">Pelatihan Kemandirian WBP</h3>
                    <p class="text-gray-600 text-sm mb-4">Warga Binaan Pemasyarakatan mengikuti pelatihan pertukangan kayu...</p>
                    <a href="#" class="text-navy-dark font-semibold text-sm hover:text-blue-600">Baca Selengkapnya</a>
                </div>
            </div>

            <div class="bg-navy-dark text-white rounded-lg p-6 shadow-md">
                <h3 class="text-xl font-bold mb-4 text-yellow-500">📢 Pengumuman</h3>
                <ul class="space-y-4">
                    <li class="border-b border-gray-700 pb-3">
                        <span class="text-xs text-gray-400 block">03 Des 2025</span>
                        <a href="#" class="hover:text-yellow-400 transition">Jadwal Kunjungan Tatap Muka Terbaru</a>
                    </li>
                    <li class="border-b border-gray-700 pb-3">
                        <span class="text-xs text-gray-400 block">01 Des 2025</span>
                        <a href="#" class="hover:text-yellow-400 transition">Persyaratan Penitipan Barang Makanan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection