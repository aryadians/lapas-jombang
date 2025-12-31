@extends('layouts.admin')

@section('content')
{{-- Load Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 3D Perspective */
    .perspective-1000 { perspective: 1000px; }

    /* 3D Card Effect */
    .card-3d {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform-style: preserve-3d;
        backface-visibility: hidden;
    }
    .card-3d:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 30px -10px rgba(0, 0, 0, 0.15);
    }

    /* Gradient Text */
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(to right, #1e293b, #3b82f6);
    }

    /* Trix Content Styling - Modern Typography */
    .trix-content {
        color: #334155; /* slate-700 */
        line-height: 1.8;
        font-size: 1.05rem;
    }
    .trix-content h1 { font-size: 1.8rem; font-weight: 800; color: #1e293b; margin: 1.5rem 0 1rem; }
    .trix-content h2 { font-size: 1.5rem; font-weight: 700; color: #334155; margin: 1.5rem 0 1rem; }
    .trix-content p { margin-bottom: 1rem; }
    .trix-content ul, .trix-content ol { margin-left: 1.5rem; margin-bottom: 1rem; list-style-position: outside; }
    .trix-content ul { list-style-type: disc; }
    .trix-content ol { list-style-type: decimal; }
    .trix-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        font-style: italic;
        color: #64748b;
        background: #f8fafc;
        padding: 1rem;
        border-radius: 0 0.5rem 0.5rem 0;
        margin-bottom: 1rem;
    }
    .trix-content a { color: #2563eb; text-decoration: underline; }
    .trix-content img { border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin: 1rem 0; max-width: 100%; height: auto; }
</style>

<div class="max-w-5xl mx-auto space-y-8 pb-12 perspective-1000">

    {{-- HEADER NAV --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate__animated animate__fadeInDown">
        <div>
            <h1 class="text-3xl font-extrabold text-gradient">Detail Pengumuman</h1>
            <p class="text-slate-500 mt-1 font-medium">Tinjau detail informasi yang dipublikasikan.</p>
        </div>
        <a href="{{ route('announcements.index') }}" class="group inline-flex items-center gap-2 bg-white text-slate-600 font-bold py-2.5 px-5 rounded-xl shadow-sm border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all active:scale-95">
            <i class="fas fa-arrow-left text-slate-400 group-hover:text-slate-600 transition-colors"></i>
            <span>Kembali</span>
        </a>
    </header>

    {{-- MAIN CARD --}}
    <div class="card-3d bg-white rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden animate__animated animate__fadeInUp delay-100 relative">
        
        {{-- HERO BANNER --}}
        <div class="relative bg-gradient-to-r from-slate-900 to-blue-900 p-8 md:p-10 text-white overflow-hidden">
            {{-- Background Decoration --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-400 opacity-10 rounded-full blur-3xl -ml-16 -mb-16"></div>

            <div class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
                
                {{-- 3D Calendar Badge --}}
                <div class="flex-shrink-0 w-20 h-24 bg-white text-slate-800 rounded-2xl shadow-2xl flex flex-col overflow-hidden transform rotate-3 hover:rotate-0 transition-transform duration-300">
                    <div class="bg-red-500 h-8 flex items-center justify-center">
                        <span class="text-white text-xs font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($announcement->date)->format('M') }}</span>
                    </div>
                    <div class="flex-grow flex items-center justify-center bg-slate-50">
                        <span class="text-4xl font-black">{{ \Carbon\Carbon::parse($announcement->date)->format('d') }}</span>
                    </div>
                    <div class="bg-slate-200 h-6 flex items-center justify-center">
                        <span class="text-[10px] font-bold text-slate-500">{{ \Carbon\Carbon::parse($announcement->date)->format('Y') }}</span>
                    </div>
                </div>

                {{-- Title & Meta --}}
                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        @if($announcement->status == 'published')
                            <span class="px-3 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full shadow-lg shadow-emerald-500/30 flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> DITERBITKAN
                            </span>
                        @else
                            <span class="px-3 py-1 bg-amber-500 text-white text-xs font-bold rounded-full shadow-lg shadow-amber-500/30 flex items-center gap-1">
                                <i class="fas fa-edit"></i> DRAFT
                            </span>
                        @endif
                        <span class="px-3 py-1 bg-white/10 text-blue-100 text-xs font-medium rounded-full border border-white/20">
                            <i class="far fa-clock mr-1"></i> Dibuat {{ $announcement->created_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    <h2 class="text-2xl md:text-4xl font-extrabold leading-tight shadow-black drop-shadow-md">
                        {{ $announcement->title }}
                    </h2>
                </div>
            </div>
        </div>

        {{-- CONTENT BODY --}}
        <div class="p-8 md:p-10">
            <div class="trix-content">
                {!! $announcement->content !!}
            </div>
        </div>

        {{-- FOOTER ACTIONS --}}
        <div class="bg-slate-50 p-6 md:p-8 border-t border-slate-100 flex flex-wrap justify-between items-center gap-4">
            <div class="text-sm text-slate-500 italic">
                <i class="fas fa-info-circle mr-1"></i> Terakhir diupdate: {{ $announcement->updated_at->format('d M Y, H:i') }}
            </div>

            <div class="flex gap-3">
                <a href="{{ route('announcements.edit', $announcement->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm active:scale-95">
                    <i class="fas fa-edit text-blue-500"></i> Edit
                </a>
                
                <button onclick="confirmDelete(event)" class="inline-flex items-center gap-2 px-6 py-3 bg-red-100 text-red-600 font-bold rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm hover:shadow-red-200 active:scale-95">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>

                <form id="delete-form" action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const swal3DConfig = {
        showClass: { popup: 'animate__animated animate__zoomInDown animate__faster' },
        hideClass: { popup: 'animate__animated animate__zoomOutUp animate__faster' },
        customClass: {
            popup: 'rounded-3xl shadow-2xl border-4 border-white/50 backdrop-blur-xl',
            title: 'text-2xl font-black text-slate-800',
            confirmButton: 'rounded-xl px-6 py-3 font-bold shadow-lg bg-red-600 text-white mr-2',
            cancelButton: 'rounded-xl px-6 py-3 font-bold shadow-lg bg-slate-200 text-slate-600'
        },
        buttonsStyling: false
    };

    function confirmDelete(event) {
        event.preventDefault();
        
        Swal.fire({
            ...swal3DConfig,
            title: 'Hapus Pengumuman?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    }
</script>
@endsection