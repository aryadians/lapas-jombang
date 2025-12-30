@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('announcements.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Pengumuman
    </a>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h2 class="text-2xl font-bold text-slate-800">Edit Pengumuman</h2>
            <p class="text-sm text-slate-600 mt-1">Perbarui detail pengumuman yang sudah ada.</p>
        </div>

        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" id="editAnnouncementForm" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Pengumuman</label>
                <input type="text" id="title" name="title" value="{{ old('title', $announcement->title) }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all @error('title') border-red-300 @enderror" required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kegiatan / Berlaku</label>
                <input type="date" id="date" name="date" value="{{ old('date', $announcement->date->format('Y-m-d')) }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all @error('date') border-red-300 @enderror" required>
                @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Isi Pengumuman</label>
                <input id="content" type="hidden" name="content" value="{{ old('content', $announcement->content) }}">
                <div class="rounded-lg border-2 border-slate-200 focus-within:border-blue-400 focus-within:ring-4 focus-within:ring-blue-100 transition-all @error('content') border-red-300 @enderror">
                    <trix-editor input="content" class="trix-content"></trix-editor>
                </div>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                <select id="status" name="status" class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all bg-white @error('status') border-red-300 @enderror" required>
                    <option value="published" @if(old('status', $announcement->status) == 'published') selected @endif>Terbitkan</option>
                    <option value="draft" @if(old('status', $announcement->status) == 'draft') selected @endif>Simpan sebagai Draft</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('announcements.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition-all border border-slate-200">
                    Batal
                </a>
                <button type="submit" onclick="confirmEdit(event)" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-all">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.trix-content { min-height: 200px; }
trix-editor { border: none !important; }
trix-editor:focus { outline: none; }
</style>

<script>
function confirmEdit(event) {
    event.preventDefault();
    const form = document.getElementById('editAnnouncementForm');
    
    Swal.fire({
        ...swalTheme,
        title: 'Simpan Perubahan?',
        text: "Pastikan semua perubahan sudah benar sebelum menyimpan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endsection