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

<section class="py-20 bg-gradient-to-b from-gray-50 to-white mb-16">
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
            <div x-data="{ open: false }" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gradient-to-r group-hover:from-blue-50 group-hover:to-cyan-50 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-lg">1</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-blue-700 transition-colors">Apa itu sistem pendaftaran kunjungan online?</h3>
                    </div>
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full group-hover:bg-blue-100 transition-colors">
                        <i class="fas fa-chevron-down text-gray-500 group-hover:text-blue-600 transition-all duration-300" :class="{'rotate-180': open}"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden">
                    <div class="px-8 pb-6">
                        <div class="h-px bg-gradient-to-r from-blue-200 to-cyan-200 mb-4"></div>
                        <p class="text-gray-600 leading-relaxed">
                            Sistem pendaftaran kunjungan online adalah platform digital yang memungkinkan Anda mendaftar kunjungan ke Lembaga Pemasyarakatan Kelas 2B Jombang secara mudah dan cepat melalui website resmi kami. Sistem ini dirancang untuk meningkatkan efisiensi pelayanan dan meminimalkan antrian fisik.
                        </p>
                    </div>
                </div>
            </div>
            
            {{-- FAQ Item 2 --}}
            <div x-data="{ open: false }" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
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
            <div x-data="{ open: false }" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
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
            <div x-data="{ open: false }" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
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

            {{-- FAQ Item 6 --}}
            <div x-data="{ open: false }" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gradient-to-r group-hover:from-indigo-50 group-hover:to-purple-50 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-lg">6</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-indigo-700 transition-colors">Berapa lama proses verifikasi pendaftaran?</h3>
                    </div>
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full group-hover:bg-indigo-100 transition-colors">
                        <i class="fas fa-chevron-down text-gray-500 group-hover:text-indigo-600 transition-all duration-300" :class="{'rotate-180': open}"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden">
                    <div class="px-8 pb-6">
                        <div class="h-px bg-gradient-to-r from-indigo-200 to-purple-200 mb-4"></div>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Proses verifikasi pendaftaran biasanya memakan waktu maksimal 1x24 jam pada hari kerja. Anda akan menerima email notifikasi mengenai status pendaftaran Anda. Pastikan email yang Anda daftarkan aktif dan cek folder spam jika belum menerima email konfirmasi.
                        </p>
                        <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-200">
                            <p class="text-sm text-indigo-800 font-medium">
                                💡 <strong>Tips:</strong> Simpan nomor pendaftaran Anda untuk memudahkan pengecekan status secara manual.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FAQ Item 7 --}}
            <div x-data="{ open: false }" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gradient-to-r group-hover:from-pink-50 group-hover:to-rose-50 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-lg">7</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-pink-700 transition-colors">Apakah bisa membatalkan atau mengubah jadwal kunjungan?</h3>
                    </div>
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full group-hover:bg-pink-100 transition-colors">
                        <i class="fas fa-chevron-down text-gray-500 group-hover:text-pink-600 transition-all duration-300" :class="{'rotate-180': open}"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden">
                    <div class="px-8 pb-6">
                        <div class="h-px bg-gradient-to-r from-pink-200 to-rose-200 mb-4"></div>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Pembatalan atau perubahan jadwal kunjungan dapat dilakukan maksimal 2 hari sebelum tanggal kunjungan yang dijadwalkan. Untuk melakukan pembatalan atau perubahan, silakan hubungi petugas melalui kontak yang tersedia atau datang langsung ke lokasi dengan membawa bukti pendaftaran.
                        </p>
                        <div class="bg-rose-50 rounded-lg p-4 border border-rose-200">
                            <p class="text-sm text-rose-800 font-medium">
                                ⚠️ <strong>Penting:</strong> Pembatalan di hari H atau tanpa pemberitahuan dapat mengakibatkan pembatasan akses sistem pendaftaran di masa mendatang.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FAQ Item 8 --}}
            <div x-data="{ open: false }" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
                <button @click="open = !open" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none group-hover:bg-gradient-to-r group-hover:from-teal-50 group-hover:to-cyan-50 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-lg">8</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-teal-700 transition-colors">Apa yang harus dibawa saat berkunjung?</h3>
                    </div>
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full group-hover:bg-teal-100 transition-colors">
                        <i class="fas fa-chevron-down text-gray-500 group-hover:text-teal-600 transition-all duration-300" :class="{'rotate-180': open}"></i>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden">
                    <div class="px-8 pb-6">
                        <div class="h-px bg-gradient-to-r from-teal-200 to-cyan-200 mb-4"></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-teal-50 rounded-lg p-4 border border-teal-200">
                                <h4 class="font-semibold text-teal-800 mb-2">Dokumen Wajib:</h4>
                                <ul class="text-sm text-teal-700 space-y-1">
                                    <li>• Kartu identitas asli (KTP/SIM)</li>
                                    <li>• Bukti pendaftaran online</li>
                                    <li>• Email konfirmasi (jika ada)</li>
                                </ul>
                            </div>
                            <div class="bg-cyan-50 rounded-lg p-4 border border-cyan-200">
                                <h4 class="font-semibold text-cyan-800 mb-2">Barang Terlarang:</h4>
                                <ul class="text-sm text-cyan-700 space-y-1">
                                    <li>• Telepon genggam</li>
                                    <li>• Kamera</li>
                                    <li>• Makanan/minuman</li>
                                    <li>• Barang tajam</li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Pastikan semua dokumen dalam keadaan baik dan mudah dibaca. Barang-barang terlarang akan disimpan di tempat penitipan dan dapat diambil kembali setelah kunjungan selesai.
                        </p>
                    </div>
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

        {{-- Contact Support Section --}}
        <div class="mt-20 bg-gradient-to-br from-slate-50 to-blue-50 rounded-3xl p-8 md:p-12 border border-slate-200">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-6">
                    <i class="fas fa-headset mr-2"></i>
                    Butuh Bantuan Lebih Lanjut?
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">
                    Hubungi Kami
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jika pertanyaan Anda belum terjawab, tim kami siap membantu Anda dengan pelayanan terbaik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Phone Support --}}
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-phone text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Telepon</h3>
                    <p class="text-gray-600 mb-4">Hubungi kami untuk informasi langsung</p>
                    <a href="tel:+62321512345" class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-full transition-all transform hover:-translate-y-1 hover:shadow-lg">
                        <i class="fas fa-phone mr-2"></i>
                        (0321) 512345
                    </a>
                </div>

                {{-- Email Support --}}
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-envelope text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Email</h3>
                    <p class="text-gray-600 mb-4">Kirim email untuk pertanyaan detail</p>
                    <a href="mailto:info@lapas-jombang.go.id" class="inline-flex items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full transition-all transform hover:-translate-y-1 hover:shadow-lg">
                        <i class="fas fa-envelope mr-2"></i>
                        info@lapas-jombang.go.id
                    </a>
                </div>

                {{-- Live Chat --}}
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-comments text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Live Chat</h3>
                    <p class="text-gray-600 mb-4">Chat langsung dengan petugas kami</p>
                    <button onclick="alert('Fitur live chat akan segera hadir!')" class="inline-flex items-center px-6 py-3 bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-full transition-all transform hover:-translate-y-1 hover:shadow-lg">
                        <i class="fas fa-comments mr-2"></i>
                        Mulai Chat
                    </button>
                </div>
            </div>

            {{-- Operating Hours --}}
            <div class="mt-12 bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <h4 class="text-lg font-bold text-slate-800 mb-4 text-center">Jam Operasional Layanan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <h5 class="font-semibold text-gray-800 mb-2">Pendaftaran Online</h5>
                        <p class="text-gray-600">24 Jam / 7 Hari</p>
                    </div>
                    <div class="text-center">
                        <h5 class="font-semibold text-gray-800 mb-2">Layanan Telepon & Email</h5>
                        <p class="text-gray-600">Senin - Jumat: 08:00 - 16:00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
@endsection
