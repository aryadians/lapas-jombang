@extends('layouts.main')

@section('content')
<div class="bg-slate-50 min-h-screen pb-20">
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6 rounded-lg shadow-md mb-8" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="h-6 w-6 text-green-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-lg">Pendaftaran Berhasil!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- MAIN CARD --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-slate-800 p-6 text-center text-white">
                <h2 class="text-2xl font-bold">Status Pendaftaran Kunjungan</h2>
                <p class="text-sm text-slate-300">Berikut adalah detail pendaftaran Anda.</p>
            </div>

            {{-- STATUS BADGE --}}
            <div class="p-6 flex justify-center">
                 @if($kunjungan->status == 'approved')
                    <span class="inline-flex items-center px-6 py-2 rounded-full text-lg font-bold bg-green-100 text-green-800 border-2 border-green-200">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Disetujui
                    </span>
                @elseif($kunjungan->status == 'rejected')
                    <span class="inline-flex items-center px-6 py-2 rounded-full text-lg font-bold bg-red-100 text-red-800 border-2 border-red-200">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                        Ditolak
                    </span>
                @else
                    <span class="inline-flex items-center px-6 py-2 rounded-full text-lg font-bold bg-yellow-100 text-yellow-800 border-2 border-yellow-200">
                        <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.75V6.25m0 11.5v1.5M4.75 12H6.25m11.5 0h1.5M7.05 7.05l1.06 1.06m7.84 7.84l1.06 1.06M7.05 16.95l1.06-1.06m7.84-7.84l1.06-1.06"></path></svg>
                        Menunggu Persetujuan
                    </span>
                @endif
            </div>

            {{-- Alasan Penolakan --}}
            @if ($kunjungan->status == 'rejected' && $kunjungan->rejection_reason)
            <div class="px-6 pb-6">
                <div class="bg-red-50 p-4 rounded-md border border-red-200">
                    <p class="text-sm font-bold text-red-800">Alasan Penolakan:</p>
                    <p class="text-sm text-red-700">{{ $kunjungan->rejection_reason }}</p>
                </div>
            </div>
            @endif
            
            <div class="px-6 pb-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- DATA PENGUNJUNG --}}
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-lg font-bold text-slate-800 border-b pb-2 mb-3">Data Pengunjung</h3>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->nama_pengunjung }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">NIK</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->nik_pengunjung }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Email</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->email_pengunjung }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">No. WhatsApp</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->no_wa_pengunjung }}</p>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500">Alamat</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->alamat_pengunjung }}</p>
                </div>
                
                {{-- DATA KUNJUNGAN --}}
                <div class="col-span-1 md:col-span-2 pt-4">
                    <h3 class="text-lg font-bold text-slate-800 border-b pb-2 mb-3">Detail Kunjungan</h3>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Warga Binaan yang Dikunjungi</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->nama_wbp }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Hubungan dengan WBP</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->hubungan }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Tanggal Kunjungan</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Sesi Kunjungan</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->sesi ? 'Sesi ' . ucfirst($kunjungan->sesi) : 'Tidak ada sesi khusus' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Nomor Antrian Harian</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">#{{ $kunjungan->nomor_antrian_harian }}</p>
                </div>
                 <div>
                    <label class="block text-sm font-medium text-gray-500">Tanggal Pendaftaran</label>
                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $kunjungan->created_at->translatedFormat('l, d F Y - H:i') }}</p>
                </div>

            </div>

            <div class="px-6 py-4 bg-gray-50 border-t flex justify-end">
                <a href="{{ route('kunjungan.create') }}" class="bg-slate-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-slate-700 transition">
                    Daftarkan Kunjungan Lain
                </a>
            </div>
        </div>

        <div class="text-center mt-8">
            <p class="text-sm text-gray-500">Terima kasih telah menggunakan layanan kami.</p>
        </div>

    </div>
</div>
@endsection
