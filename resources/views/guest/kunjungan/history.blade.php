@extends('layouts.main')

@section('content')
<div class="bg-slate-50 min-h-screen pb-20">
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        {{-- SEARCH FORM CARD --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-slate-800 p-6 text-center text-white">
                <h2 class="text-2xl font-bold">Riwayat Kunjungan Saya</h2>
                <p class="text-sm text-slate-300">Masukkan NIK Anda untuk melihat semua riwayat pendaftaran kunjungan.</p>
            </div>
            
            <form action="{{ route('kunjungan.history.results') }}" method="POST" class="p-8">
                @csrf
                <div>
                    <label for="nik" class="block text-sm font-semibold text-slate-700 mb-2">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik') }}" class="w-full rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('nik') border-red-500 @enderror" placeholder="Masukkan 16 digit NIK Anda" maxlength="16" required>
                    @error('nik')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-slate-900 bg-yellow-500 hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Riwayat
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
