@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('announcements.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-slate-900 mb-4 transition">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-yellow-50">
            <h2 class="text-xl font-bold text-slate-800">Edit Pengumuman</h2>
        </div>

        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" class="p-8 space-y-6">
            @csrf @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Pengumuman</label>
                <input type="text" name="title" value="{{ old('title', $announcement->title) }}" class="w-full rounded-lg border-gray-300 focus:ring-slate-900 focus:border-slate-900" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kegiatan / Berlaku</label>
                <input type="date" name="date" value="{{ old('date', $announcement->date->format('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 focus:ring-slate-900 focus:border-slate-900" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Isi Pengumuman</label>
                <textarea name="content" rows="6" class="w-full rounded-lg border-gray-300 focus:ring-slate-900 focus:border-slate-900" required>{{ old('content', $announcement->content) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300 focus:ring-slate-900 focus:border-slate-900" required>
                    <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Published (Terbitkan)</option>
                    <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft (Simpan Konsep)</option>
                </select>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition">
                    Update Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection