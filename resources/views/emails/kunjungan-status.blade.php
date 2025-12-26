@component('mail::message')

# Status Pendaftaran Kunjungan Anda

Halo **{{ $kunjungan->nama_pengunjung }}**,

Berikut adalah pembaruan status untuk pendaftaran kunjungan Anda ke Lapas Kelas IIB Jombang.

@if ($kunjungan->status === 'approved')

## Pendaftaran Disetujui

Selamat! Pendaftaran kunjungan Anda telah disetujui oleh petugas kami. Mohon perhatikan detail di bawah ini dan tunjukkan email ini kepada petugas saat tiba di lokasi.

@component('mail::panel')
### Detail Kunjungan
**Nomor Pendaftaran:** #{{ $kunjungan->id }} <br>
**Nama Pengunjung:** {{ $kunjungan->nama_pengunjung }} <br>
**NIK Pengunjung:** {{ $kunjungan->nik_pengunjung }} <br>
**Nama Warga Binaan:** {{ $kunjungan->nama_wbp }} <br>
**Hubungan:** {{ $kunjungan->hubungan }} <br>
**Tanggal Kunjungan:** {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}
@endcomponent

**PENTING:**
*   Silakan datang sesuai dengan tanggal dan sesi kunjungan yang berlaku.
*   Patuhi semua tata tertib dan aturan barang bawaan yang telah dijelaskan di website.
*   Pendaftaran ini berlaku untuk satu orang.

@component('mail::button', ['url' => url('/')])
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
@endcomponent
