@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-slate-900 mb-4 transition">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-yellow-50">
            <h2 class="text-xl font-bold text-slate-800">Edit Berita</h2>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi berita yang sudah ada.</p>
        </div>

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title', $news->title) }}" 
                       class="w-full rounded-lg border-gray-300 focus:border-slate-900 focus:ring-slate-900 shadow-sm transition" required>
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
                    <p class="text-xs text-blue-600 mt-2 italic">*Gambar akan berubah di atas saat Anda memilih file baru.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Ganti Gambar (Opsional)</label>
                    <label class="flex flex-col w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer hover:bg-slate-50 transition items-center justify-center">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                            <svg class="w-8 h-8 mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm text-gray-500 font-medium">Klik untuk ganti foto</p>
                        </div>
                        <input type="file" name="image" class="hidden" onchange="previewImageEdit(this)" />
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Isi Berita</label>
                <textarea name="content" rows="8" 
                          class="w-full rounded-lg border-gray-300 focus:border-slate-900 focus:ring-slate-900 shadow-sm transition" required>{{ old('content', $news->content) }}</textarea>
            </div>
<div class="mb-4">
    <label class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-slate-900 focus:ring-slate-900 shadow-sm transition">
        <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Published (Tayang)</option>
        <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft (Simpan Saja)</option>
    </select>
</div>
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition">
                    Update Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImageEdit(input) {
        var file = input.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(e){
                var img = document.getElementById('img-preview');
                var noImgText = document.getElementById('no-img-text');
                
                // Set sumber gambar baru
                img.src = e.target.result;
                img.classList.remove('hidden');
                
                // Sembunyikan teks "Tidak ada gambar" jika ada
                if(noImgText) noImgText.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection