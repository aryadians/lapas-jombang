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

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="images" class="block text-sm font-semibold text-slate-700 mb-2">Foto Utama (Bisa Lebih Dari Satu)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-56 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition overflow-hidden p-4">
                            <div id="placeholder-container" class="flex flex-col items-center justify-center pt-5 pb-6 {{ (isset($news->image) && count($news->image) > 0) ? 'hidden' : '' }}">
                                <i class="fa-solid fa-cloud-arrow-up text-5xl mb-3 text-gray-400"></i>
                                <p class="text-sm text-gray-600 mb-1"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB per gambar)</p>
                            </div>
                            
                            <div id="current-images-container" class="absolute inset-0 w-full h-full flex flex-wrap gap-2 justify-center items-center p-2 overflow-y-auto {{ (isset($news->image) && count($news->image) > 0) ? '' : 'hidden' }}">
                                @if(isset($news->image) && is_array($news->image))
                                    @foreach($news->image as $existingImage)
                                        <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                            <img src="{{ $existingImage }}" class="w-full h-full object-cover" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div id="previews-container" class="hidden absolute inset-0 w-full h-full flex flex-wrap gap-2 justify-center items-center p-2 overflow-y-auto"></div>

                            <input id="dropzone-file" type="file" name="images[]" multiple class="hidden" onchange="previewFilesEdit(this)" accept="image/png, image/jpeg" />
                        </label>
                    </div>
                    @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
    function previewFilesEdit(input) {
        var previewsContainer = document.getElementById('previews-container');
        var placeholder = document.getElementById('placeholder-container');
        var currentImagesContainer = document.getElementById('current-images-container');
        
        previewsContainer.innerHTML = ''; // Clear previous previews
        
        if (input.files && input.files.length > 0) {
            placeholder.classList.add('hidden');
            currentImagesContainer.classList.add('hidden'); // Hide existing images when new ones are selected
            previewsContainer.classList.remove('hidden');

            for (let i = 0; i < input.files.length; i++) {
                var file = input.files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imgContainer = document.createElement('div');
                    imgContainer.className = 'relative w-24 h-24 rounded-lg overflow-hidden border border-gray-200 shadow-sm';
                    
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';
                    
                    var fileNameOverlay = document.createElement('div');
                    fileNameOverlay.className = 'absolute bottom-0 left-0 right-0 bg-gray-800 bg-opacity-75 text-white text-xs px-1 py-0.5 truncate';
                    fileNameOverlay.textContent = file.name;

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(fileNameOverlay);
                    previewsContainer.appendChild(imgContainer);
                }
                reader.readAsDataURL(file);
            }
        } else {
            // If no new files are selected, revert to showing existing images or placeholder
            if (currentImagesContainer.children.length > 0) { // Check if there are existing images
                currentImagesContainer.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                currentImagesContainer.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
            previewsContainer.classList.add('hidden');
            previewsContainer.innerHTML = '';
        }
    }
</script>
@endsection