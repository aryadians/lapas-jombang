@component('mail::message')

# Konfirmasi Pendaftaran Kunjungan Anda

Halo **{{ $kunjungan->nama_pengunjung }}**,

Terima kasih telah mendaftar kunjungan ke Lapas Kelas IIB Jombang. Pendaftaran Anda telah kami terima dengan status **PENDING**.

Berikut adalah detail pendaftaran Anda:

@component('mail::panel')
### Detail Pendaftaran Kunjungan
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
<br> **Status:** **PENDING**
@endcomponent

**Langkah Selanjutnya:**
*   Petugas kami akan segera memverifikasi data pendaftaran Anda.
*   Anda akan menerima email terpisah yang berisi informasi status pendaftaran Anda (Disetujui/Ditolak) dalam waktu maksimal 1x24 jam.
*   Mohon siapkan dokumen yang diperlukan (misalnya KTP/identitas diri) saat kunjungan.

@component('mail::button', ['url' => route('kunjungan.status', $kunjungan->id), 'color' => 'success'])
Cek Status Pendaftaran Anda
@endcomponent

@component('mail::button', ['url' => url('/')])
Kembali ke Halaman Utama
@endcomponent

Terima kasih atas perhatian Anda.

Hormat kami,<br>
**Petugas Layanan Lapas Kelas IIB Jombang**
@endcomponent
