@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors duration-200">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Kembali ke Daftar Berita
    </a>

    <div x-data="inView" x-init="init()" :class="{'opacity-0 translate-y-4': !inView}" class="transition duration-700 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-yellow-50">
            <h2 class="text-2xl font-extrabold text-slate-800">Edit Berita</h2>
            <p class="text-sm text-gray-600 mt-1">Perbarui informasi berita yang sudah ada.</p>
        </div>

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" 
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition @error('title') border-red-500 @enderror"
                       placeholder="Contoh: Kunjungan Kerja Kakanwil Jawa Timur..." required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Preview Gambar</label>
                    <div class="relative w-full h-48 bg-gray-100 rounded-lg border border-gray-200 overflow-hidden group">
                        @if($news->image)
                            <img id="img-preview" src="{{ $news->image }}" class="w-full h-full object-cover transition-opacity duration-300">
                        @else
                            <img id="img-preview" src="" class="hidden w-full h-full object-cover">
                            <div id="no-img-text" class="absolute inset-0 flex items-center justify-center text-gray-400 text-sm">Tidak ada gambar</div>
                        @endif
                    </div>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Ganti Gambar (Opsional)</label>
                    <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition overflow-hidden p-4">
                        <div id="placeholder-container" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fa-solid fa-cloud-arrow-up text-5xl mb-3 text-gray-400"></i>
                            <p class="text-sm text-gray-600 mb-1"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                        </div>
                        <img id="file-preview-edit" class="hidden absolute inset-0 w-full h-full object-cover" />
                        <div id="file-name-edit" class="hidden absolute bottom-2 left-2 bg-gray-800 bg-opacity-75 text-white text-xs px-2 py-1 rounded"></div>
                        <input id="dropzone-file" type="file" name="image" class="hidden" onchange="previewFileEdit(this)" accept="image/png, image/jpeg" />
                    </label>
                </div>
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Isi Berita</label>
                <input id="content" type="hidden" name="content" value="{{ old('content', $news->content) }}">
                <trix-editor input="content" class="trix-content bg-white rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition @error('content') border-red-500 @enderror"></trix-editor>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                <select id="status" name="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition @error('status') border-red-500 @enderror">
                    <option value="published" @if(old('status', $news->status) == 'published') selected @endif>Published (Tayang)</option>
                    <option value="draft" @if(old('status', $news->status) == 'draft') selected @endif>Draft (Simpan Saja)</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <i class="fa-solid fa-save"></i> Update Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewFileEdit(input) {
        var file = input.files[0];
        var filePreview = document.getElementById('file-preview-edit');
        var placeholder = document.getElementById('placeholder-container');
        var fileNameDisplay = document.getElementById('file-name-edit');
        var imgPreview = document.getElementById('img-preview'); // Existing image preview

        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                filePreview.src = reader.result;
                filePreview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                fileNameDisplay.textContent = file.name;
                fileNameDisplay.classList.remove('hidden');
                
                // Hide existing image preview if new image is selected
                if(imgPreview) imgPreview.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            filePreview.src = '';
            filePreview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            fileNameDisplay.classList.add('hidden');

            // Show existing image preview if no new image is selected and one existed
            if(imgPreview && imgPreview.src) imgPreview.classList.remove('hidden');
            if(document.getElementById('no-img-text')) document.getElementById('no-img-text').classList.remove('hidden');

        }
    }
</script>
@endsection