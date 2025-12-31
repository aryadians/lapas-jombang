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
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15);
        z-index: 10;
    }

    /* Glassmorphism */
    .glass-panel {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
    }

    /* Gradient Text */
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(to right, #1e293b, #2563eb);
    }

    /* Date Badge 3D */
    .date-badge-3d {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.3), inset 0 2px 4px rgba(255, 255, 255, 0.3);
        border-radius: 1rem;
    }
</style>

<div class="space-y-8 pb-12 perspective-1000">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate__animated animate__fadeInDown">
        <div>
            <h1 class="text-3xl font-extrabold text-gradient">Kelola Pengumuman</h1>
            <p class="text-slate-500 mt-1 font-medium">Informasi penting untuk pegawai dan pengunjung.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="group flex items-center gap-2 bg-white text-slate-600 font-bold px-5 py-2.5 rounded-xl shadow-sm border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all active:scale-95">
                <i class="fas fa-print text-slate-400 group-hover:text-slate-600 transition-colors"></i>
                <span>Cetak</span>
            </button>
            <a href="{{ route('announcements.create') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-blue-500/30 transition-all hover:-translate-y-1 active:scale-95">
                <i class="fas fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                <span>Buat Pengumuman</span>
            </a>
        </div>
    </header>

    {{-- ALERT MESSAGES --}}
    @if(session('success'))
    <div class="animate__animated animate__bounceIn bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-start gap-3">
        <div class="mt-0.5"><i class="fas fa-check-circle text-emerald-500 text-xl"></i></div>
        <div>
            <h3 class="font-bold text-emerald-800">Berhasil!</h3>
            <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    {{-- SEARCH FORM --}}
    <form method="GET" action="{{ route('announcements.index') }}" class="animate__animated animate__fadeInUp">
        <div class="glass-panel rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="relative flex-grow w-full md:w-auto group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul pengumuman..." class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-0 transition-all font-medium text-slate-700 placeholder-slate-400">
                </div>
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-900 transition-all shadow-lg active:scale-95">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('announcements.index') }}" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white text-slate-600 font-bold rounded-xl border-2 border-slate-200 hover:bg-slate-50 transition-all active:scale-95">
                        Reset
                    </a>
                </div>
            </div>
        </div>
    </form>

    {{-- ANNOUNCEMENTS LIST --}}
    <div class="space-y-6 animate__animated animate__fadeInUp delay-100">
        @forelse ($announcements as $item)
            <div class="card-3d bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative group">
                <div class="p-6 flex flex-col md:flex-row items-start md:items-center gap-6">
                    
                    {{-- 3D Date Badge --}}
                    <div class="flex-shrink-0 date-badge-3d text-white flex flex-col items-center justify-center w-20 h-20 md:w-24 md:h-24 transform group-hover:rotate-3 transition-transform duration-300">
                        <span class="text-3xl font-black leading-none drop-shadow-sm">{{ $item->date->format('d') }}</span>
                        <span class="text-xs font-bold uppercase tracking-widest mt-1 opacity-90">{{ $item->date->format('M') }}</span>
                        <span class="text-[10px] font-medium opacity-75">{{ $item->date->format('Y') }}</span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow min-w-0">
                        <h3 class="text-xl font-bold text-slate-800 leading-tight mb-2 group-hover:text-blue-600 transition-colors line-clamp-1">
                            {{ $item->title }}
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-2 md:line-clamp-2 pr-4">
                            {{ Str::limit(strip_tags($item->content), 180) }}
                        </p>
                        
                        {{-- Meta Info (Optional) --}}
                        <div class="flex items-center gap-4 mt-3 text-xs text-slate-400 font-medium">
                            <span class="flex items-center gap-1"><i class="far fa-clock"></i> {{ $item->created_at->diffForHumans() }}</span>
                            {{-- Jika ada kategori atau author bisa ditambah disini --}}
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 w-full md:w-auto md:flex-col lg:flex-row justify-end pt-4 md:pt-0 border-t md:border-t-0 border-slate-100">
                        <a href="{{ route('announcements.show', $item->id) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-600 hover:bg-blue-100 hover:text-blue-600 transition-all" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('announcements.edit', $item->id) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-600 hover:bg-indigo-100 hover:text-indigo-600 transition-all" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="confirmDelete(event, '{{ $item->id }}', '{{ $item->title }}')" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-600 hover:bg-red-100 hover:text-red-600 transition-all" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                        <form id="delete-form-{{ $item->id }}" action="{{ route('announcements.destroy', $item->id) }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-24 animate__animated animate__fadeIn">
                <div class="inline-block p-6 rounded-full bg-slate-50 border border-slate-100 mb-4 shadow-sm">
                    <i class="fas fa-bullhorn text-5xl text-slate-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-700">Belum Ada Pengumuman</h3>
                <p class="text-slate-500 mt-2 max-w-sm mx-auto">Pengumuman yang Anda buat akan muncul di sini. Klik tombol di atas untuk memulai.</p>
                <a href="{{ route('announcements.create') }}" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg">
                    Buat Sekarang
                </a>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($announcements->hasPages())
        <div class="mt-10 animate__animated animate__fadeInUp">
            {{ $announcements->links() }}
        </div>
    @endif
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

    function confirmDelete(event, id, title) {
        event.preventDefault();
        
        Swal.fire({
            ...swal3DConfig,
            title: 'Hapus Pengumuman?',
            text: `Anda akan menghapus "${title}". Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
@endsection