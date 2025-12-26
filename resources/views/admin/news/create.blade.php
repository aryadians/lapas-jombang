@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-slate-900 mb-4 transition">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Berita
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100">
            <h2 class="text-xl font-bold text-slate-800">Tulis Berita Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Isi formulir di bawah ini untuk mempublikasikan berita atau kegiatan terbaru.</p>
        </div>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                       class="w-full rounded-lg border-gray-300 focus:border-slate-900 focus:ring-slate-900 shadow-sm transition"
                       placeholder="Contoh: Kunjungan Kerja Kakanwil Jawa Timur..." required>
                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Utama</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition overflow-hidden">
                        
                        <div id="placeholder-container" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm text-gray-500 mb-1"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                        </div>

                        <img id="preview-image" class="hidden absolute inset-0 w-full h-full object-cover" />

                        <input id="dropzone-file" type="file" name="image" class="hidden" onchange="previewFile(this)" />
                    </label>
                </div>
                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Isi Berita</label>
                <textarea name="content" rows="8" 
                          class="w-full rounded-lg border-gray-300 focus:border-slate-900 focus:ring-slate-900 shadow-sm transition" 
                          placeholder="Tuliskan detail berita di sini..." required>{{ old('content') }}</textarea>
                @error('content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
    <label class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-slate-900 focus:ring-slate-900 shadow-sm transition">
        <option value="published" selected>Published (Tayang)</option>
        <option value="draft">Draft (Simpan Saja)</option>
    </select>
</div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                    Publikasikan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewFile(input) {
        var file = input.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                var previewImg = document.getElementById('preview-image');
                var placeholder = document.getElementById('placeholder-container');
                
                previewImg.src = reader.result;
                previewImg.classList.remove('hidden'); // Tampilkan gambar
                placeholder.classList.add('hidden');   // Sembunyikan teks
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection