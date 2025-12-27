@component('mail::message')

<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ asset('img/logo.png') }}" alt="Lapas Jombang Logo" style="height: 80px; width: auto; display: inline-block;">
</div>

# Status Pendaftaran Kunjungan Anda

Halo **{{ $kunjungan->nama_pengunjung }}**,

Berikut adalah pembaruan status untuk pendaftaran kunjungan Anda ke Lapas Kelas IIB Jombang.

@if ($kunjungan->status === 'approved')

## Pendaftaran Disetujui

Selamat! Pendaftaran kunjungan Anda telah disetujui oleh petugas kami. Mohon perhatikan detail di bawah ini dan tunjukkan email ini kepada petugas saat tiba di lokasi.

@component('mail::panel')
### Detail Kunjungan
**Nomor Pendaftaran:** #{{ $kunjungan->id }} <br>
**Nomor Antrian Harian:** **#{{ $kunjungan->nomor_antrian_harian }}** <br>
**Nama Pengunjung:** {{ $kunjungan->nama_pengunjung }} <br>
**NIK Pengunjung:** {{ $kunjungan->nik_pengunjung }} <br>
**Alamat:** {{ $kunjungan->alamat_pengunjung }} <br>
**Nama Warga Binaan:** {{ $kunjungan->nama_wbp }} <br>
**Hubungan:** {{ $kunjungan->hubungan }} <br>
**Tanggal Kunjungan:** {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}
@if($kunjungan->sesi)
<br> **Sesi Kunjungan:** **{{ ucfirst($kunjungan->sesi) }}**
@endif
@endcomponent

@if($kunjungan->qr_token)
### Kode QR Verifikasi
Tunjukkan kode QR di bawah ini kepada petugas saat Anda tiba di lokasi untuk proses verifikasi yang lebih cepat.

<div style="text-align: center; margin-top: 15px; margin-bottom: 15px;">
    {!! QrCode::size(200)->generate($kunjungan->qr_token) !!}
</div>
@endif

**PENTING:**
*   Patuhi semua tata tertib dan aturan barang bawaan yang telah dijelaskan di website.
*   Pendaftaran ini berlaku untuk satu orang.
*   Harap tiba di lokasi sesuai dengan tanggal dan sesi kunjungan Anda.

@component('mail::button', ['url' => url('/'), 'color' => 'success'])
Kunjungi Website
@endcomponent

@else

## Pendaftaran Ditolak

Mohon maaf, pendaftaran kunjungan Anda dengan detail di bawah ini tidak dapat kami setujui saat ini.

@component('mail::panel')
### Detail Pendaftaran
**Nama Pengunjung:** {{ $kunjungan->nama_pengunjung }} <br>
**Nama Warga Binaan:** {{ $kunjungan->nama_wbp }} <br>
**Rencana Tanggal:** {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}
@endcomponent

Penolakan bisa disebabkan oleh beberapa hal, seperti kuota antrian yang sudah penuh, data yang tidak sesuai, atau tidak memenuhi syarat dan ketentuan lainnya.

Silakan coba mendaftar kembali di lain waktu dan pastikan semua data dan persyaratan telah sesuai.

@component('mail::button', ['url' => route('kunjungan.create'), 'color' => 'error'])
Daftar Ulang
@endcomponent

@endif

Terima kasih atas perhatian Anda.

Hormat kami,<br>
**Petugas Layanan Lapas Kelas IIB Jombang**

@slot('subcopy')
@component('mail::subcopy')
Ini adalah email yang dibuat secara otomatis. Mohon tidak membalas email ini. Semua informasi kunjungan dapat diakses melalui website resmi kami.
@endcomponent
@endslot

@endcomponent
