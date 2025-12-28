<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran Kunjungan - {{ $kunjungan->nama_pengunjung }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }
        .header img {
            max-height: 80px;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 2.2rem;
            color: #2c3e50;
            margin: 0;
        }
        .header p {
            font-size: 1rem;
            color: #7f8c8d;
            margin: 5px 0 0;
        }
        .section-title {
            font-size: 1.4rem;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-top: 30px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .data-row {
            display: flex;
            margin-bottom: 10px;
        }
        .data-row .label {
            flex: 0 0 200px;
            font-weight: 500;
            color: #555;
        }
        .data-row .value {
            flex: 1;
            font-weight: 600;
            color: #222;
        }
        .qr-section {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }
        .qr-section img {
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            max-width: 200px;
            height: auto;
        }
        .qr-section p {
            font-size: 0.9rem;
            color: #666;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.85rem;
            color: #999;
        }
    </style>
</head>
<body onload="window.print()" class="bg-gray-100">
    <div class="container">
        <div class="header">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Lapas Jombang">
            <h1>Bukti Pendaftaran Kunjungan</h1>
            <p>Lembaga Pemasyarakatan Kelas IIB Jombang</p>
        </div>

        <div class="section-title">Data Pengunjung</div>
        <div class="data-row">
            <div class="label">Nama Lengkap</div>
            <div class="value">{{ $kunjungan->nama_pengunjung }}</div>
        </div>
        <div class="data-row">
            <div class="label">NIK</div>
            <div class="value">{{ $kunjungan->nik_pengunjung }}</div>
        </div>
        <div class="data-row">
            <div class="label">Email</div>
            <div class="value">{{ $kunjungan->email_pengunjung }}</div>
        </div>
        <div class="data-row">
            <div class="label">No. WhatsApp</div>
            <div class="value">{{ $kunjungan->no_wa_pengunjung }}</div>
        </div>
        <div class="data-row">
            <div class="label">Alamat</div>
            <div class="value">{{ $kunjungan->alamat_pengunjung }}</div>
        </div>

        <div class="section-title">Detail Kunjungan</div>
        <div class="data-row">
            <div class="label">Warga Binaan yang Dikunjungi</div>
            <div class="value">{{ $kunjungan->nama_wbp }}</div>
        </div>
        <div class="data-row">
            <div class="label">Hubungan dengan WBP</div>
            <div class="value">{{ $kunjungan->hubungan }}</div>
        </div>
        <div class="data-row">
            <div class="label">Tanggal Kunjungan</div>
            <div class="value">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}</div>
        </div>
        <div class="data-row">
            <div class="label">Sesi Kunjungan</div>
            <div class="value">{{ $kunjungan->sesi ? 'Sesi ' . ucfirst($kunjungan->sesi) : 'Tidak ada sesi khusus' }}</div>
        </div>
        <div class="data-row">
            <div class="label">Nomor Antrian Harian</div>
            <div class="value">#{{ $kunjungan->nomor_antrian_harian }}</div>
        </div>
        <div class="data-row">
            <div class="label">Status</div>
            <div class="value">{{ ucfirst($kunjungan->status) }}</div>
        </div>
        <div class="data-row">
            <div class="label">Tanggal Pendaftaran</div>
            <div class="value">{{ $kunjungan->created_at->translatedFormat('l, d F Y - H:i') }}</div>
        </div>

        <div class="qr-section">
            <p>Scan QR Code ini untuk verifikasi saat kedatangan:</p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode(route('kunjungan.verify', ['kunjungan' => $kunjungan->qr_token])) }}" alt="QR Code Verifikasi Kunjungan">
            <p class="mt-2">Kode Verifikasi: <strong>{{ $kunjungan->qr_token }}</strong></p>
        </div>

        <div class="footer">
            <p>Mohon tunjukkan bukti pendaftaran ini kepada petugas di Lapas Kelas IIB Jombang.</p>
            <p>&copy; {{ date('Y') }} Lapas Kelas IIB Jombang. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
