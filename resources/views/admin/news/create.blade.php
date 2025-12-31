@extends('layouts.admin')

@section('content')
{{-- Load Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 3D Card Effect */
    .card-3d {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform-style: preserve-3d;
        backface-visibility: hidden;
    }
    
    /* Modern Gradient Text */
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(to right, #1e293b, #2563eb);
    }

    /* Input Styling */
    .input-3d {
        transition: all 0.3s ease;
        border: 2px solid #e2e8f0;
    }
    .input-3d:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }

    /* Drag & Drop Area */
    .upload-area {
        border: 2px dashed #cbd5e1;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }
    .upload-area:hover, .upload-area.dragover {
        border-color: #3b82f6;
        background-color: #eff6ff;
        transform: scale(1.01);
    }

    /* Trix Editor */
    trix-editor {
        border: 2px solid #e2e8f0 !important;
        border-radius: 0.75rem;
        padding: 1rem;
        min-height: 300px;
        background-color: white;
    }
    trix-editor:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
</style>

<div class="max-w-5xl mx-auto pb-12 space-y-8 perspective-1000">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate__animated animate__fadeInDown">
        <div>
            <h1 class="text-3xl font-extrabold text-gradient">Tulis Berita Baru</h1>
            <p class="text-slate-500 mt-1 font-medium">Bagikan informasi terbaru kepada publik.</p>
        </div>
        <a href="{{ route('news.index') }}" class="group inline-flex items-center gap-2 bg-white text-slate-600 font-bold py-2.5 px-5 rounded-xl shadow-sm border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all active:scale-95">
            <i class="fas fa-arrow-left text-slate-400 group-hover:text-slate-600 transition-colors"></i>
            <span>Kembali</span>
        </a>
    </header>

    {{-- FORM CREATE --}}
    <div class="card-3d bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden animate__animated animate__fadeInUp delay-100">
        
        {{-- Form Header --}}
        <div class="bg-gradient-to-r from-slate-50 to-blue-50 p-8 border-b border-slate-100 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg transform -rotate-3">
                <i class="fas fa-pen-nib text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Editor Berita</h2>
                <p class="text-slate-500 text-sm">Isi konten berita dengan lengkap dan menarik.</p>
            </div>
        </div>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="createNewsForm" class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- KOLOM KIRI: Konten Utama --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Judul --}}
                    <div class="space-y-2">
                        <label for="title" class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Judul Artikel</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                            class="input-3d w-full px-4 py-3.5 rounded-xl bg-slate-50 text-slate-800 font-bold text-lg placeholder-slate-400 focus:bg-white" 
                            placeholder="Judul berita yang menarik..." required>
                        @error('title') <p class="text-red-500 text-xs font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Konten (Trix) --}}
                    <div class="space-y-2">
                        <label for="content" class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Isi Berita</label>
                        <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                        <div class="relative">
                            <trix-editor input="content" class="trix-content prose max-w-none"></trix-editor>
                        </div>
                        @error('content') <p class="text-red-500 text-xs font-bold ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- KOLOM KANAN: Sidebar (Gambar & Status) --}}
                <div class="space-y-6">
                    
                    {{-- Upload Gambar --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Gambar Unggulan</label>
                        <div class="upload-area rounded-2xl p-6 text-center cursor-pointer relative group" id="drop-area">
                            <input type="file" name="images[]" id="images" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" multiple onchange="previewFiles(this)">
                            
                            <div id="upload-placeholder" class="transition-opacity duration-300">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-blue-500"></i>
                                </div>
                                <p class="text-sm font-bold text-slate-700">Klik atau Drag & Drop</p>
                                <p class="text-xs text-slate-500 mt-1">PNG, JPG (Max 2MB)</p>
                            </div>

                            {{-- Preview Container --}}
                            <div id="previews-container" class="hidden grid grid-cols-2 gap-2 mt-4"></div>
                        </div>
                        @error('images') <p class="text-red-500 text-xs font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Status --}}
                    <div class="space-y-2">
                        <label for="status" class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Status Publikasi</label>
                        <div class="relative">
                            <select id="status" name="status" class="input-3d w-full px-4 py-3.5 rounded-xl bg-slate-50 text-slate-700 font-medium focus:bg-white appearance-none cursor-pointer">
                                <option value="published" @if(old('status') == 'published') selected @endif>✅ Terbitkan Sekarang</option>
                                <option value="draft" @if(old('status') == 'draft') selected @endif>📝 Simpan Draft</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 pointer-events-none"></i>
                        </div>
                        @error('status') <p class="text-red-500 text-xs font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-6 border-t border-slate-100 space-y-3">
                        <button type="submit" onclick="confirmCreate(event)" class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i> Publikasikan
                        </button>
                        <a href="{{ route('news.index') }}" class="block w-full py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl text-center transition-all active:scale-95">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script SweetAlert & Preview --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert Config
    const swal3DConfig = {
        showClass: { popup: 'animate__animated animate__zoomInDown animate__faster' },
        hideClass: { popup: 'animate__animated animate__zoomOutUp animate__faster' },
        customClass: {
            popup: 'rounded-3xl shadow-2xl border-4 border-white/50 backdrop-blur-xl',
            title: 'text-2xl font-black text-slate-800',
            confirmButton: 'rounded-xl px-6 py-3 font-bold shadow-lg bg-blue-600 text-white mr-2',
            cancelButton: 'rounded-xl px-6 py-3 font-bold shadow-lg bg-slate-200 text-slate-600'
        },
        buttonsStyling: false
    };

    function confirmCreate(event) {
        event.preventDefault();
        const form = document.getElementById('createNewsForm');
        
        Swal.fire({
            ...swal3DConfig,
            title: 'Publikasikan Berita?',
            text: "Pastikan konten sudah sesuai sebelum diterbitkan.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Publikasikan',
            cancelButtonText: 'Cek Lagi'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Mengunggah...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => { Swal.showLoading(); }
                });
                form.submit();
            }
        });
    }

    // Image Preview Logic
    function previewFiles(input) {
        const placeholder = document.getElementById('upload-placeholder');
        const container = document.getElementById('previews-container');
        
        container.innerHTML = ''; // Reset preview

        if (input.files && input.files.length > 0) {
            placeholder.classList.add('hidden');
            container.classList.remove('hidden');

            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.className = 'relative w-full h-24 rounded-lg overflow-hidden border border-slate-200 shadow-sm animate__animated animate__fadeIn';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';
                    
                    imgDiv.appendChild(img);
                    container.appendChild(imgDiv);
                }
                reader.readAsDataURL(file);
            });
        } else {
            placeholder.classList.remove('hidden');
            container.classList.add('hidden');
        }
    }

    // Drag & Drop Visual Effect
    const dropArea = document.getElementById('drop-area');
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.add('dragover'), false);
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.remove('dragover'), false);
    });
</script>
@endsection