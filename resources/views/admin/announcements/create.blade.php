@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('announcements.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors duration-200">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Kembali ke Daftar Pengumuman
    </a>

    <div x-data="inView" x-init="init()" :class="{'opacity-0 translate-y-4': !inView}" class="transition duration-700 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-gray-50">
            <h2 class="text-2xl font-extrabold text-slate-800">Buat Pengumuman Baru</h2>
            <p class="text-sm text-gray-600 mt-1">Isi formulir di bawah ini untuk membuat pengumuman baru.</p>
        </div>

        <form action="{{ route('announcements.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Pengumuman</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition @error('title') border-red-500 @enderror" 
                       placeholder="Contoh: Jadwal Kunjungan Idul Fitri" required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kegiatan / Berlaku</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition @error('date') border-red-500 @enderror" required>
                @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Isi Pengumuman</label>
                <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                <trix-editor input="content" class="trix-content bg-white rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition @error('content') border-red-500 @enderror"></trix-editor>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                <select id="status" name="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition @error('status') border-red-500 @enderror" required>
                    <option value="published" @if(old('status') == 'published') selected @endif>Published (Terbitkan)</option>
                    <option value="draft" @if(old('status') == 'draft') selected @endif>Draft (Simpan Konsep)</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Terbitkan Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection