@component('mail::message')

{{-- Header with Logo and Badges --}}
<div style="text-align: center; margin-bottom: 30px; background: linear-gradient(135deg, #1e293b 0%, #334155 100%); padding: 20px; border-radius: 12px; border: 2px solid #fbbf24;">
    <div style="margin-bottom: 15px;">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Lapas Jombang" style="height: 70px; width: auto; display: inline-block; border-radius: 50%; border: 4px solid #fbbf24; padding: 5px; background: white; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
    </div>
    <div style="display: inline-flex; align-items: center; gap: 10px; margin-bottom: 10px;">
        <span style="background: #dc2626; color: white; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; display: inline-flex; align-items: center; gap: 5px;">
            🛡️ LAPAS JOMBANG
        </span>
        <span style="background: #2563eb; color: white; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; display: inline-flex; align-items: center; gap: 5px;">
            ⚖️ KEMENKUMHAM RI
        </span>
    </div>
    <h1 style="color: #fbbf24; text-align: center; margin: 10px 0 5px 0; font-size: 24px; font-weight: bold; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">Status Pendaftaran Kunjungan</h1>
    <p style="color: #e2e8f0; text-align: center; font-size: 14px; margin: 0;">Sistem Informasi Pemasyarakatan - Lembaga Pemasyarakatan Kelas 2B Jombang</p>
</div>

@if ($kunjungan->status === 'approved')

{{-- Approved Badge --}}
<div style="text-align: center; margin-bottom: 20px;">
    <span style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; padding: 10px 20px; border-radius: 25px; font-size: 14px; font-weight: bold; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 8px rgba(22, 163, 74, 0.3);">
        ✅ PENDAFTARAN DISETUJUI
    </span>
</div>

# Selamat! Kunjungan Anda Disetujui

Halo **{{ $kunjungan->nama_pengunjung }}**,

Selamat! Pendaftaran kunjungan Anda telah **disetujui** oleh petugas kami. Mohon perhatikan detail di bawah ini dan tunjukkan email ini kepada petugas saat tiba di lokasi.

@component('mail::panel')
### 📋 Detail Kunjungan
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
### 📱 Kode QR Verifikasi
Tunjukkan kode QR di bawah ini kepada petugas saat Anda tiba di lokasi untuk proses verifikasi yang lebih cepat dan aman.

<div style="text-align: center; margin: 20px 0; padding: 20px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 12px;">
    {!! QrCode::size(200)->generate($kunjungan->qr_token) !!}
</div>
@endif

<div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 2px solid #fbbf24; border-radius: 10px; padding: 18px; margin: 20px 0; position: relative;">
    <div style="position: absolute; top: -10px; left: 20px; background: #f59e0b; color: white; padding: 4px 8px; border-radius: 12px; font-size: 10px; font-weight: bold;">
        ⚠️ PENTING
    </div>
    <ul style="color: #92400e; margin: 0; font-size: 14px; line-height: 1.6;">
        <li>Patuhi semua tata tertib dan aturan barang bawaan yang telah dijelaskan di website.</li>
        <li>Pendaftaran ini berlaku untuk satu orang pengunjung.</li>
        <li>Harap tiba di lokasi sesuai dengan tanggal dan sesi kunjungan Anda.</li>
        <li>Bawa kartu identitas asli untuk verifikasi.</li>
    </ul>
</div>

@component('mail::button', ['url' => url('/'), 'color' => 'success'])
🏛️ Kunjungi Website Lapas
@endcomponent

@else

{{-- Rejected Badge --}}
<div style="text-align: center; margin-bottom: 20px;">
    <span style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; padding: 10px 20px; border-radius: 25px; font-size: 14px; font-weight: bold; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);">
        ❌ PENDAFTARAN DITOLAK
    </span>
</div>

# Pendaftaran Kunjungan Ditolak

Halo **{{ $kunjungan->nama_pengunjung }}**,

Mohon maaf, pendaftaran kunjungan Anda dengan detail di bawah ini tidak dapat kami setujui saat ini.

@component('mail::panel')
### 📋 Detail Pendaftaran
**Nama Pengunjung:** {{ $kunjungan->nama_pengunjung }} <br>
**Nama Warga Binaan:** {{ $kunjungan->nama_wbp }} <br>
**Rencana Tanggal:** {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}
@endcomponent

<div style="background: #fee2e2; border: 2px solid #fca5a5; border-radius: 10px; padding: 18px; margin: 20px 0;">
    <p style="color: #991b1b; margin: 0; font-size: 14px;">
        <strong>Penolakan bisa disebabkan oleh beberapa hal:</strong><br>
        • Kuota antrian yang sudah penuh<br>
        • Data yang tidak sesuai atau tidak lengkap<br>
        • Tidak memenuhi syarat dan ketentuan lainnya<br>
        • Jadwal kunjungan yang bertabrakan
    </p>
</div>

Silakan coba mendaftar kembali di lain waktu dan pastikan semua data dan persyaratan telah sesuai.

@component('mail::button', ['url' => route('kunjungan.create'), 'color' => 'error'])
🔄 Daftar Ulang Kunjungan
@endcomponent

@endif

<div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 10px; padding: 18px; margin: 20px 0; position: relative;">
    <div style="position: absolute; top: -10px; left: 20px; background: #059669; color: white; padding: 4px 8px; border-radius: 12px; font-size: 10px; font-weight: bold;">
        📞 BANTUAN
    </div>
    <h3 style="color: #065f46; margin: 0 0 12px 0; font-size: 16px; font-weight: bold;">Butuh Bantuan?</h3>
    <p style="color: #065f46; margin: 0; font-size: 14px; line-height: 1.5;">
        Hubungi Administrator Sistem Lapas Jombang:<br>
        📧 <strong>Email:</strong> admin@lapasjombang.go.id<br>
        📱 <strong>WhatsApp:</strong> +62 812-3456-7890<br>
        🏢 <strong>Alamat:</strong> Jl. Raya Jombang No. 123, Jombang
    </p>
</div>

<div style="text-align: center; margin-top: 30px; padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 10px; border: 1px solid #cbd5e1;">
    <div style="display: inline-flex; align-items: center; gap: 10px; margin-bottom: 10px;">
        <span style="background: #1e293b; color: white; padding: 6px 12px; border-radius: 15px; font-size: 10px; font-weight: bold; display: inline-flex; align-items: center; gap: 4px;">
            🏛️ PEMASYARAKATAN
        </span>
        <span style="background: #2563eb; color: white; padding: 6px 12px; border-radius: 15px; font-size: 10px; font-weight: bold; display: inline-flex; align-items: center; gap: 4px;">
            🔒 KEAMANAN
        </span>
        <span style="background: #16a34a; color: white; padding: 6px 12px; border-radius: 15px; font-size: 10px; font-weight: bold; display: inline-flex; align-items: center; gap: 4px;">
            🤝 KEMANUSIAAN
        </span>
    </div>
    <p style="color: #475569; font-size: 12px; margin: 0; line-height: 1.5;">
        Email ini dikirim secara otomatis oleh Sistem Informasi Pemasyarakatan<br>
        <strong>Lembaga Pemasyarakatan Kelas 2B Jombang</strong><br>
        &copy; {{ date('Y') }} Kementerian Hukum dan HAM Republik Indonesia<br>
        <em>"Mewujudkan Pemasyarakatan yang Bermartabat"</em>
    </p>
</div>

@slot('subcopy')
<div style="text-align: center; color: #9ca3af; font-size: 11px;">
    Ini adalah email yang dibuat secara otomatis. Mohon tidak membalas email ini. Semua informasi kunjungan dapat diakses melalui website resmi kami.
</div>
@endslot

@endcomponent
