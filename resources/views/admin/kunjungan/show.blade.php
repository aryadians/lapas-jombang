@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Detail Kunjungan</h2>
            <p class="text-sm text-slate-600 mt-1">Informasi lengkap pendaftaran ID: <span class="font-bold text-blue-600">#{{ $kunjungan->id }}</span></p>
        </div>
        <a href="{{ route('admin.kunjungan.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition-all duration-200">
            <i class="fa-solid fa-arrow-left"></i>Kembali ke Daftar
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
        <p class="font-bold"><i class="fa-solid fa-check-circle mr-2"></i>Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- MAIN CONTENT (LEFT) --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                
                {{-- Data Pengunjung --}}
                <div class="border-b border-slate-200">
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center gap-3">
                        <i class="fa-solid fa-user text-blue-700 text-lg w-6 text-center"></i>
                        <h3 class="text-lg font-bold text-slate-800">Data Pengunjung</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Pengunjung</label>
                            <p class="text-base font-semibold text-slate-800">{{ $kunjungan->nama_pengunjung }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nomor Identitas (NIK)</label>
                            <p class="text-base font-semibold text-slate-800 font-mono">{{ $kunjungan->nik_pengunjung }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Email</label>
                            <p class="text-sm font-medium text-slate-800 break-all">{{ $kunjungan->email_pengunjung ?? '—' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nomor WhatsApp</label>
                            <p class="text-sm font-medium text-slate-800">
                                @if($kunjungan->no_wa_pengunjung)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kunjungan->no_wa_pengunjung) }}" target="_blank" class="text-green-600 hover:text-green-700 font-bold inline-flex items-center gap-2 hover:underline">
                                        <i class="fa-brands fa-whatsapp"></i>{{ $kunjungan->no_wa_pengunjung }}
                                    </a>
                                @else — @endif
                            </p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat</label>
                            <p class="text-sm font-medium text-slate-800 leading-relaxed">{{ $kunjungan->alamat_pengunjung ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Data Narapidana --}}
                <div class="border-b border-slate-200">
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center gap-3">
                        <i class="fa-solid fa-user-shield text-purple-700 text-lg w-6 text-center"></i>
                        <h3 class="text-lg font-bold text-slate-800">Data Narapidana (WBP)</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Narapidana</label>
                            <p class="text-base font-semibold text-slate-800">{{ $kunjungan->nama_wbp }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Hubungan Keluarga</label>
                            <p class="text-base font-semibold text-slate-800 capitalize">{{ $kunjungan->hubungan }}</p>
                        </div>
                    </div>
                </div>

                 {{-- Jadwal Kunjungan --}}
                <div>
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center gap-3">
                        <i class="fa-solid fa-calendar-check text-orange-700 text-lg w-6 text-center"></i>
                        <h3 class="text-lg font-bold text-slate-800">Jadwal Kunjungan</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Kunjungan</label>
                            <p class="text-base font-semibold text-slate-800">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Sesi</label>
                            <p class="text-base font-semibold text-slate-800 capitalize">{{ $kunjungan->sesi ?? 'Belum ditentukan' }}</p>
                        </div>
                        @if($kunjungan->nomor_antrian_harian)
                        <div class="md:col-span-2 mt-2">
                             <label class="block text-xs font-bold text-blue-700 uppercase tracking-wider">Nomor Antrian</label>
                             <p class="text-4xl font-black text-blue-800 font-mono">#{{ $kunjungan->nomor_antrian_harian }}</p>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        {{-- SIDEBAR (RIGHT) --}}
        <div class="space-y-6">

            {{-- STATUS CARD --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="bg-slate-800 text-white px-6 py-4">
                    <h3 class="text-lg font-bold flex items-center gap-2"><i class="fa-solid fa-info-circle"></i>Status Pendaftaran</h3>
                </div>
                <div class="p-6">
                    @if($kunjungan->status == 'approved')
                        <div class="bg-green-50 border-2 border-green-300 rounded-xl p-5 text-center">
                            <i class="fa-solid fa-circle-check text-green-600 text-5xl mb-3"></i>
                            <h4 class="text-2xl font-bold text-green-800">Disetujui</h4>
                            @if($kunjungan->approved_at)
                            <p class="text-sm text-green-700 font-semibold mt-2"><i class="fa-solid fa-calendar-check mr-1"></i> Disetujui pada {{ \Carbon\Carbon::parse($kunjungan->approved_at)->translatedFormat('d F Y H:i') }}</p>
                            @endif
                        </div>
                    @elseif($kunjungan->status == 'rejected')
                        <div class="bg-red-50 border-2 border-red-300 rounded-xl p-5 text-center">
                            <i class="fa-solid fa-circle-xmark text-red-600 text-5xl mb-3"></i>
                            <h4 class="text-2xl font-bold text-red-800">Ditolak</h4>
                            @if($kunjungan->rejected_at)
                             <p class="text-sm text-red-700 font-semibold mt-2"><i class="fa-solid fa-calendar-xmark mr-1"></i> Ditolak pada {{ \Carbon\Carbon::parse($kunjungan->rejected_at)->translatedFormat('d F Y H:i') }}</p>
                            @endif
                        </div>
                    @else
                        <div class="bg-yellow-50 border-2 border-yellow-300 rounded-xl p-5 text-center">
                             <i class="fa-solid fa-hourglass-half text-yellow-600 text-5xl mb-3"></i>
                             <h4 class="text-2xl font-bold text-yellow-800">Menunggu</h4>
                             <p class="text-sm text-yellow-700 font-semibold mt-2"><i class="fa-solid fa-calendar-plus mr-1"></i> Didaftarkan pada {{ \Carbon\Carbon::parse($kunjungan->created_at)->translatedFormat('d F Y H:i') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- QR CODE CARD (Only if Approved) --}}
            @if($kunjungan->status == 'approved' && $kunjungan->qr_token)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="bg-slate-800 text-white px-6 py-4">
                    <h3 class="text-lg font-bold flex items-center gap-2"><i class="fa-solid fa-qrcode"></i>Kode QR Kunjungan</h3>
                </div>
                <div id="qr-code-section" class="p-6 text-center">
                    <div class="flex justify-center p-4 bg-gray-50 border rounded-lg shadow-inner">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ $kunjungan->qr_token }}" alt="QR Code Kunjungan" class="w-full max-w-[250px] h-auto">
                    </div>
                    <button onclick="printQrCode()" class="mt-4 w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition-all">
                        <i class="fa-solid fa-print"></i>Cetak Kode QR
                    </button>
                </div>
            </div>
            @endif

            {{-- ACTIONS CARD --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="bg-slate-800 text-white px-6 py-4">
                    <h3 class="text-lg font-bold flex items-center gap-2"><i class="fa-solid fa-cogs"></i>Aksi</h3>
                </div>
                <div class="p-6 space-y-3">
                    @if($kunjungan->status == 'pending')
                        <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" onclick="confirmUpdate(event, 'approved', '{{ $kunjungan->nama_pengunjung }}')" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg shadow-lg transition-all transform hover:shadow-xl hover:-translate-y-0.5">
                                <i class="fa-solid fa-check-circle"></i>Setujui Kunjungan
                            </button>
                        </form>
                        <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" onclick="confirmUpdate(event, 'rejected', '{{ $kunjungan->nama_pengunjung }}')" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold rounded-lg shadow-lg transition-all transform hover:shadow-xl hover:-translate-y-0.5">
                                <i class="fa-solid fa-times-circle"></i>Tolak Kunjungan
                            </button>
                        </form>
                        <div class="border-t border-slate-200 my-4"></div>
                    @endif

                    <form action="{{ route('admin.kunjungan.destroy', $kunjungan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete(event)" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-red-100 hover:bg-red-200 text-red-700 font-bold rounded-lg transition-all">
                            <i class="fa-solid fa-trash-alt"></i>Hapus Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
            
            {{-- Print script needs to be outside the conditional QR card --}}
            @if($kunjungan->status == 'approved' && $kunjungan->qr_token)
            <script>
            function printQrCode() {
                const qrCodeSection = document.getElementById('qr-code-section').innerHTML;
                const printWindow = window.open('', '_blank', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Cetak Kode QR</title>');
                printWindow.document.write('<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">');
                printWindow.document.write('<style>body{text-align:center;font-family:sans-serif;padding-top:2rem;} img{max-width:300px !important;} h4,button{display:none;}</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write('<h3>Tiket Kunjungan Lapas Jombang</h3><p>ID Pendaftaran: #{{ $kunjungan->id }}</p>');
                printWindow.document.write(qrCodeSection);
                printWindow.document.write('<p style="margin-top:1rem;">Harap tunjukkan kode QR ini kepada petugas saat melakukan kunjungan.</p>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.focus();
                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 250);
            }
            </script>
            @endif
        </div>
    </div>
</div>
@endsection
