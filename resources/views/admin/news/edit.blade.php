@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Berita
    </a>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h2 class="text-2xl font-bold text-slate-800">Edit Berita</h2>
            <p class="text-sm text-slate-600 mt-1">Perbarui konten berita atau artikel.</p>
        </div>

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" id="editNewsForm" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all @error('title') border-red-300 @enderror"
                       required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="images" class="block text-sm font-semibold text-slate-700 mb-2">Gambar Unggulan</label>
                <div class="mt-2 flex justify-center rounded-lg border-2 border-dashed border-slate-300 px-6 py-10 @error('images.*') border-red-300 @enderror">
                    <div id="image-uploader" class="text-center {{ (isset($news->image) && count($news->image) > 0) ? 'hidden' : '' }}">
                        <i class="fas fa-photo-video text-4xl text-slate-400"></i>
                        <div class="mt-4 flex text-sm leading-6 text-slate-600">
                            <label for="dropzone-file" class="relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500">
                                <span>Unggah file baru</span>
                                <input id="dropzone-file" name="images[]" type="file" class="sr-only" multiple onchange="previewFilesEdit(this)">
                            </label>
                            <p class="pl-1">atau tarik dan lepas</p>
                        </div>
                        <p class="text-xs leading-5 text-slate-500">PNG, JPG, GIF hingga 2MB per file. Mengunggah file baru akan menggantikan yang lama.</p>
                    </div>
                    <div id="previews-container" class="{{ (isset($news->image) && count($news->image) > 0) ? '' : 'hidden' }} grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @if(isset($news->image) && is_array($news->image))
                            @foreach($news->image as $existingImage)
                            <div class="relative w-full h-32 rounded-lg overflow-hidden border-2 border-slate-200 shadow-sm">
                                <img src="{{ $existingImage }}" class="w-full h-full object-cover">
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                 <small class="text-slate-500 mt-2 block">Klik area di atas untuk mengganti gambar yang sudah ada.</small>
                @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Isi Berita</label>
                <input id="content" type="hidden" name="content" value="{{ old('content', $news->content) }}">
                 <div class="rounded-lg border-2 border-slate-200 focus-within:border-blue-400 focus-within:ring-4 focus-within:ring-blue-100 transition-all @error('content') border-red-300 @enderror">
                    <trix-editor input="content" class="trix-content"></trix-editor>
                </div>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                <select id="status" name="status" class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all bg-white @error('status') border-red-300 @enderror">
                    <option value="published" @if(old('status', $news->status) == 'published') selected @endif>Terbitkan</option>
                    <option value="draft" @if(old('status', $news->status) == 'draft') selected @endif>Simpan sebagai Draft</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 border-t border-slate-200 flex justify-end gap-3">
                 <a href="{{ route('news.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition-all border border-slate-200">
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
.trix-content { min-height: 250px; }
trix-editor { border: none !important; }
trix-editor:focus { outline: none; }
</style>

<script>
function confirmEdit(event) {
    event.preventDefault();
    const form = document.getElementById('editNewsForm');
    
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

function previewFilesEdit(input) {
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