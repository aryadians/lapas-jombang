@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Manajemen Pengguna</h1>
            <p class="text-slate-600 mt-1">Tambah, edit, dan kelola akun pengguna sistem.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-5 rounded-lg shadow-lg transition-all transform hover:-translate-y-0.5">
            <i class="fas fa-user-plus"></i>
            <span>Tambah Pengguna</span>
        </a>
    </header>

    {{-- ALERT MESSAGES --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex items-center gap-3" role="alert">
        <i class="fas fa-check-circle text-green-500 text-xl"></i>
        <div>
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md flex items-center gap-3" role="alert">
        <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
        <div>
            <p class="font-bold">Gagal!</p>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    {{-- SEARCH AND FILTER FORM --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row items-center gap-4">
            <div class="relative flex-grow w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
            </div>
            <div class="w-full md:w-auto">
                <select name="role" class="w-full py-3 pl-4 pr-10 border-2 border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
                    <option value="">Semua Role</option>
                    <option value="super_admin" @if(request('role') == 'super_admin') selected @endif>Super Admin</option>
                    <option value="admin_humas" @if(request('role') == 'admin_humas') selected @endif>Admin Humas</option>
                    <option value="admin_registrasi" @if(request('role') == 'admin_registrasi') selected @endif>Admin Registrasi</option>
                    <option value="admin_umum" @if(request('role') == 'admin_umum') selected @endif>Admin Umum</option>
                    <option value="user" @if(request('role') == 'user') selected @endif>User</option>
                </select>
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <i class="fas fa-filter"></i><span>Filter</span>
                </button>
                <a href="{{ route('admin.users.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-slate-700 bg-slate-100 hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all border border-slate-200">
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>

    {{-- USERS LIST / CARDS --}}
    <div class="space-y-4">
        @forelse($users as $user)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden transform hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl">
                <div class="p-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold text-lg border-2 border-yellow-500 flex-shrink-0">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-lg">{{ $user->name }}</p>
                            <p class="text-sm text-slate-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4 w-full md:w-auto">
                        @php
                            $roleConfig = [
                                'super_admin' => ['badge' => 'bg-red-100 text-red-800 border-red-200', 'label' => 'Super Admin', 'icon' => 'fa-crown'],
                                'admin_humas' => ['badge' => 'bg-blue-100 text-blue-800 border-blue-200', 'label' => 'Admin Humas', 'icon' => 'fa-bullhorn'],
                                'admin_registrasi' => ['badge' => 'bg-purple-100 text-purple-800 border-purple-200', 'label' => 'Admin Registrasi', 'icon' => 'fa-clipboard-list'],
                                'admin_umum' => ['badge' => 'bg-green-100 text-green-800 border-green-200', 'label' => 'Admin Umum', 'icon' => 'fa-cog'],
                                'user' => ['badge' => 'bg-slate-100 text-slate-800 border-slate-200', 'label' => 'User', 'icon' => 'fa-user'],
                            ];
                            $config = $roleConfig[$user->role] ?? $roleConfig['user'];
                        @endphp
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold {{ $config['badge'] }} border">
                            <i class="fas {{ $config['icon'] }} text-xs"></i>
                            {{ $config['label'] }}
                        </span>
                        <div class="w-px h-6 bg-slate-200 hidden md:block"></div>
                        <p class="text-sm text-slate-500 md:ml-2">
                            Dibuat: {{ $user->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-end gap-2 w-full md:w-auto">
                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete(event)" class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 hover:bg-red-200 text-red-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-24">
                <div class="flex flex-col items-center justify-center text-slate-500">
                    <div class="bg-slate-100 p-6 rounded-full mb-4 border border-slate-200">
                        <i class="fas fa-users text-5xl text-slate-400"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-slate-700">Tidak Ada Pengguna Ditemukan</h3>
                    <p class="text-slate-500 mt-2">Gunakan filter untuk mencari atau tambah pengguna baru.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($users->hasPages())
        <div class="mt-8">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
