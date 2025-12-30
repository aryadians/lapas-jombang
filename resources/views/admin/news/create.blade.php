@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Berita
    </a>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h2 class="text-2xl font-bold text-slate-800">Tulis Berita Baru</h2>
            <p class="text-sm text-slate-600 mt-1">Isi formulir untuk mempublikasikan berita atau kegiatan terbaru.</p>
        </div>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="createNewsForm" class="p-8 space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all @error('title') border-red-300 @enderror"
                       placeholder="Contoh: Kunjungan Kerja Kakanwil Jawa Timur" required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="images" class="block text-sm font-semibold text-slate-700 mb-2">Gambar Unggulan</label>
                <div class="mt-2 flex justify-center rounded-lg border-2 border-dashed border-slate-300 px-6 py-10 @error('images.*') border-red-300 @enderror">
                    <div class="text-center" id="image-uploader">
                        <i class="fas fa-photo-video text-4xl text-slate-400"></i>
                        <div class="mt-4 flex text-sm leading-6 text-slate-600">
                            <label for="dropzone-file" class="relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500">
                                <span>Unggah file</span>
                                <input id="dropzone-file" name="images[]" type="file" class="sr-only" multiple onchange="previewFiles(this)">
                            </label>
                            <p class="pl-1">atau tarik dan lepas</p>
                        </div>
                        <p class="text-xs leading-5 text-slate-500">PNG, JPG, GIF hingga 2MB per file</p>
                    </div>
                    <div id="previews-container" class="hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
                </div>
                @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Isi Berita</label>
                <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                <div class="rounded-lg border-2 border-slate-200 focus-within:border-blue-400 focus-within:ring-4 focus-within:ring-blue-100 transition-all @error('content') border-red-300 @enderror">
                    <trix-editor input="content" class="trix-content"></trix-editor>
                </div>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                <select id="status" name="status" class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all bg-white @error('status') border-red-300 @enderror">
                    <option value="published" @if(old('status') == 'published') selected @endif>Terbitkan</option>
                    <option value="draft" @if(old('status') == 'draft') selected @endif>Simpan sebagai Draft</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('news.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition-all border border-slate-200">
                    Batal
                </a>
                <button type="submit" onclick="confirmCreate(event)" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-all">
                    <i class="fas fa-save mr-2"></i>Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.trix-content { min-height: 250px; }
trix-editor { border: none !important; }
trix-editor:focus { outline: none; }
</style>

<script>
function confirmCreate(event) {
    event.preventDefault();
    const form = document.getElementById('createNewsForm');
    
    Swal.fire({
        ...swalTheme,
        title: 'Publikasikan Berita?',
        text: "Pastikan semua isi berita sudah benar sebelum dipublikasikan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Publikasikan',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

function previewFiles(input) {
    const uploader = document.getElementById('image-uploader');
    const previewsContainer = document.getElementById('previews-container');
    previewsContainer.innerHTML = '';
    
    if (input.files.length > 0) {
        uploader.classList.add('hidden');
        previewsContainer.classList.remove('hidden');

        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative w-full h-32 rounded-lg overflow-hidden border-2 border-slate-200 shadow-sm';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';

                imgContainer.appendChild(img);
                previewsContainer.appendChild(imgContainer);
            }
            reader.readAsDataURL(file);
        });
    } else {
        uploader.classList.remove('hidden');
        previewsContainer.classList.add('hidden');
    }
}
</script>
@endsection