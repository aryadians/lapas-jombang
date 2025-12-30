@extends('layouts.admin')

@section('title', 'Verifikasi Kunjungan')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Verifikasi Kunjungan</h1>
            <p class="text-slate-600 mt-1">Verifikasi pendaftaran kunjungan menggunakan token atau QR code.</p>
        </div>
        <a href="{{ route('admin.kunjungan.index') }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2.5 px-5 rounded-lg shadow-sm transition-all border border-slate-200">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Kelola Kunjungan</span>
        </a>
    </header>

    {{-- VERIFICATION FORM AND SCANNER --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Manual Token Input --}}
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Input Manual Token</h2>
            <p class="text-slate-600 mb-6">Masukkan token yang tertera di bawah kode QR pengunjung untuk verifikasi.</p>
            <form action="{{ route('admin.kunjungan.verifikasi.submit') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="qr_token" class="text-sm font-medium text-slate-700 mb-1 block">Token Kode QR</label>
                        <input type="text" name="qr_token" id="qr_token" class="w-full pl-4 pr-4 py-3 border-2 border-slate-200 rounded-lg bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all text-lg font-mono tracking-widest" placeholder="ABC-123" value="{{ request('qr_token') }}" required autofocus>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="fas fa-check-circle"></i>
                        <span>Verifikasi Token</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- QR Code Scanner --}}
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-8 flex flex-col items-center justify-center text-center">
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Pindai dengan Kamera</h2>
            <p class="text-slate-500 mb-4"><i>(Fitur dalam pengembangan)</i></p>
            <div id="qr-scanner-placeholder" class="w-full max-w-sm aspect-square bg-slate-100 rounded-2xl border-4 border-dashed border-slate-300 flex items-center justify-center">
                <div class="text-slate-400">
                    <i class="fas fa-qrcode text-6xl"></i>
                    <p class="mt-4 font-semibold">Area Pindai Kamera</p>
                </div>
            </div>
        </div>
    </div>

    {{-- VERIFICATION RESULT --}}
    @if(isset($kunjungan))
        <div class="mt-8">
            @if($kunjungan)
                {{-- Success Result --}}
                <div class="bg-green-50 border-2 border-green-200 rounded-2xl shadow-lg p-8">
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-6xl text-green-500"></i>
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-green-800">Kunjungan Ditemukan dan Valid</h3>
                            <p class="text-green-700">Detail pendaftaran yang sesuai dengan token yang dimasukkan:</p>
                        </div>
                        @if($kunjungan->status == 'approved')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-semibold bg-green-200 text-green-900 border border-green-300">
                                Status: Disetujui
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-semibold bg-yellow-200 text-yellow-900 border border-yellow-300">
                                Status: {{ ucfirst($kunjungan->status) }}
                            </span>
                        @endif
                    </div>
                    <div class="mt-6 border-t-2 border-green-200 pt-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-green-700 font-semibold">Nama Pengunjung:</span>
                                <span class="font-bold text-green-900">{{ $kunjungan->nama_pengunjung }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-green-700 font-semibold">NIK:</span>
                                <span class="font-bold text-green-900">{{ $kunjungan->nik_pengunjung }}</span>
                            </div>
                             <div class="flex justify-between">
                                <span class="text-green-700 font-semibold">Jumlah Pengikut:</span>
                                <span class="font-bold text-green-900">{{ $kunjungan->jumlah_pengikut }} orang</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-green-700 font-semibold">Nama Warga Binaan:</span>
                                <span class="font-bold text-green-900">{{ $kunjungan->nama_wbp }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-green-700 font-semibold">Tanggal Kunjungan:</span>
                                <span class="font-bold text-green-900">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-green-700 font-semibold">Sesi:</span>
                                <span class="font-bold text-green-900">{{ ucfirst($kunjungan->sesi) }} (Antrian #{{ $kunjungan->nomor_antrian_harian }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Error Result --}}
                <div class="bg-red-50 border-2 border-red-200 rounded-2xl shadow-lg p-8">
                    <div class="flex items-center gap-6">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times-circle text-6xl text-red-500"></i>
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-red-800">Token Tidak Ditemukan atau Tidak Valid</h3>
                            <p class="text-red-700">Token yang Anda masukkan tidak cocok dengan data pendaftaran kunjungan manapun. Pastikan token sudah benar dan coba lagi.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
