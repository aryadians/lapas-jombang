@extends('layouts.admin')

@section('content')
{{-- Load Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 3D Perspective & Card */
    .perspective-1000 { perspective: 1000px; }
    .card-3d {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform-style: preserve-3d;
        backface-visibility: hidden;
    }
    .card-3d:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15);
        z-index: 10;
    }

    /* Glassmorphism */
    .glass-panel {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Gradient Text */
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(to right, #1e293b, #2563eb);
    }
</style>

<div class="space-y-8 pb-12 perspective-1000">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate__animated animate__fadeInDown">
        <div>
            <h1 class="text-4xl font-extrabold text-gradient">Manajemen Pengguna</h1>
            <p class="text-slate-500 mt-2 font-medium">Kelola akses dan data pengguna sistem.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-500/30 transition-all hover:-translate-y-1 active:scale-95">
            <i class="fas fa-user-plus group-hover:rotate-12 transition-transform"></i>
            <span>Tambah Pengguna</span>
        </a>
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

    {{-- SEARCH AND FILTER FORM --}}
    <form method="GET" action="{{ route('admin.users.index') }}" class="animate__animated animate__fadeInUp">
        <div class="glass-panel rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col md:flex-row items-center gap-4">
                {{-- Search Input --}}
                <div class="relative flex-grow w-full md:w-auto group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-0 transition-all font-medium text-slate-700 placeholder-slate-400">
                </div>

                {{-- Role Filter --}}
                <div class="w-full md:w-auto relative">
                    <select name="role" class="w-full py-3 pl-4 pr-10 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:outline-none focus:border-blue-500 focus:ring-0 transition-all font-medium text-slate-700 appearance-none cursor-pointer">
                        <option value="">Semua Role</option>
                        <option value="super_admin" @if(request('role') == 'super_admin') selected @endif>👑 Super Admin</option>
                        <option value="admin_humas" @if(request('role') == 'admin_humas') selected @endif>📢 Admin Humas</option>
                        <option value="admin_registrasi" @if(request('role') == 'admin_registrasi') selected @endif>📝 Admin Registrasi</option>
                        <option value="admin_umum" @if(request('role') == 'admin_umum') selected @endif>⚙️ Admin Umum</option>
                        <option value="user" @if(request('role') == 'user') selected @endif>👤 User</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 pointer-events-none"></i>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 font-bold rounded-xl text-white bg-slate-800 hover:bg-slate-900 transition-all shadow-md active:scale-95">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 font-bold rounded-xl text-slate-600 bg-white border-2 border-slate-200 hover:bg-slate-50 transition-all active:scale-95">
                        Reset
                    </a>
                </div>
            </div>
        </div>
    </form>

    {{-- USERS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 animate__animated animate__fadeInUp delay-100">
        @forelse($users as $user)
            {{-- User Card --}}
            <div class="card-3d bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative group flex flex-col h-full">
                {{-- Role Color Bar --}}
                @php
                    $roleColors = [
                        'super_admin' => 'bg-red-500',
                        'admin_humas' => 'bg-blue-500',
                        'admin_registrasi' => 'bg-purple-500',
                        'admin_umum' => 'bg-green-500',
                        'user' => 'bg-slate-400',
                    ];
                    $barColor = $roleColors[$user->role] ?? 'bg-slate-400';
                @endphp
                <div class="absolute top-0 left-0 w-full h-1.5 {{ $barColor }}"></div>

                <div class="p-6 flex-grow">
                    <div class="flex items-start justify-between mb-4">
                        {{-- Avatar --}}
                        <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-slate-700 to-slate-900 text-white flex items-center justify-center font-bold text-2xl shadow-lg transform group-hover:scale-110 transition-transform duration-300 border-4 border-white">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        
                        {{-- Action Menu --}}
                        <div class="flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all" title="Edit">
                                <i class="fas fa-pen text-xs"></i>
                            </a>
                            <button onclick="confirmDelete(event, '{{ $user->id }}', '{{ $user->name }}')" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all" title="Hapus">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="hidden">
                                @csrf @method('DELETE')
                            </form>
                        </div>
                    </div>

                    {{-- User Info --}}
                    <div>
                        <h3 class="font-bold text-xl text-slate-800 mb-1 line-clamp-1" title="{{ $user->name }}">{{ $user->name }}</h3>
                        <p class="text-sm text-slate-500 flex items-center gap-2 mb-4 line-clamp-1" title="{{ $user->email }}">
                            <i class="far fa-envelope text-slate-400"></i> {{ $user->email }}
                        </p>
                        
                        {{-- Role Badge --}}
                        @php
                            $roleConfig = [
                                'super_admin' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Super Admin', 'icon' => 'fa-crown'],
                                'admin_humas' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'label' => 'Admin Humas', 'icon' => 'fa-bullhorn'],
                                'admin_registrasi' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700', 'label' => 'Admin Registrasi', 'icon' => 'fa-clipboard-list'],
                                'admin_umum' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'label' => 'Admin Umum', 'icon' => 'fa-cog'],
                                'user' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'label' => 'User', 'icon' => 'fa-user'],
                            ];
                            $config = $roleConfig[$user->role] ?? $roleConfig['user'];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ $config['bg'] }} {{ $config['text'] }}">
                            <i class="fas {{ $config['icon'] }}"></i> {{ $config['label'] }}
                        </span>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center text-xs font-medium text-slate-500">
                    <span>Bergabung:</span>
                    <span>{{ $user->created_at->translatedFormat('d M Y') }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 xl:col-span-3 text-center py-20">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 animate__animated animate__pulse animate__infinite">
                    <i class="fas fa-users-slash text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700">Tidak Ada Pengguna</h3>
                <p class="text-slate-500 mt-1">Coba ubah filter pencarian atau tambahkan pengguna baru.</p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($users->hasPages())
        <div class="mt-8 animate__animated animate__fadeInUp">
            {{ $users->links() }}
        </div>
    @endif
</div>

{{-- Script SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, userId, userName) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Hapus Pengguna?',
            html: `Anda yakin ingin menghapus pengguna <b>${userName}</b>?<br>Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-2xl shadow-xl',
                confirmButton: 'rounded-xl px-6 py-2 font-bold',
                cancelButton: 'rounded-xl px-6 py-2 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${userId}`).submit();
            }
        });
    }
</script>
@endsection