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
        <div class="space-y-8">
            <div class="border-b pb-4">
                <h3 class="text-xl font-semibold text-slate-800 mb-2">Apa itu Lapas Jombang?</h3>
                <p class="text-gray-600">Lapas Jombang adalah lembaga pemasyarakatan Kelas IIB Jombang yang bertugas melaksanakan pembinaan terhadap narapidana dan tahanan.</p>
            </div>
            <div class="border-b pb-4">
                <h3 class="text-xl font-semibold text-slate-800 mb-2">Bagaimana cara melakukan pendaftaran kunjungan?</h3>
                <p class="text-gray-600">Pendaftaran kunjungan dapat dilakukan secara online melalui website ini pada menu "Pendaftaran Kunjungan". Ikuti langkah-langkah yang tertera pada formulir pendaftaran.</p>
            </div>
            <div class="border-b pb-4">
                <h3 class="text-xl font-semibold text-slate-800 mb-2">Apa saja persyaratan untuk kunjungan?</h3>
                <p class="text-gray-600">Persyaratan kunjungan meliputi kartu identitas yang berlaku, bukti hubungan keluarga, dan mematuhi tata tertib kunjungan yang telah ditetapkan. Detail lebih lanjut akan ditampilkan saat pendaftaran online.</p>
            </div>
            <div class="border-b pb-4">
                <h3 class="text-xl font-semibold text-slate-800 mb-2">Apakah ada batasan jumlah pengunjung per narapidana?</h3>
                <p class="text-gray-600">Ya, ada batasan jumlah pengunjung per narapidana untuk menjaga ketertiban dan keamanan. Informasi detail mengenai batasan ini akan diberikan pada saat pendaftaran atau dapat dilihat di pengumuman.</p>
            </div>
            <div class="pb-4">
                <h3 class="text-xl font-semibold text-slate-800 mb-2">Bagaimana jika saya terlambat datang saat jadwal kunjungan?</h3>
                <p class="text-gray-600">Pengunjung diharapkan datang tepat waktu sesuai jadwal yang telah ditentukan. Keterlambatan dapat mengakibatkan pembatalan kunjungan, tergantung pada kebijakan dan ketersediaan waktu.</p>
            </div>
        </div>
    </div>
</section>
@endsection
