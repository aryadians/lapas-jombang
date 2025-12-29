@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Kelola Pengguna</h1>
            <p class="text-slate-600 mt-1">Tambah, edit, dan kelola akun pengguna sistem</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
            <i class="fas fa-user-plus"></i>
            Tambah Pengguna
        </a>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
        <div class="flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    {{-- Filter and Search --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 card-3d hover:shadow-2xl transition-all duration-300">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300">
            </div>
            <select name="role" class="px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white">
                <option value="">Semua Role</option>
                <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin_humas" {{ request('role') == 'admin_humas' ? 'selected' : '' }}>Admin Humas</option>
                <option value="admin_registrasi" {{ request('role') == 'admin_registrasi' ? 'selected' : '' }}>Admin Registrasi</option>
                <option value="admin_umum" {{ request('role') == 'admin_umum' ? 'selected' : '' }}>Admin Umum</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-300">
                <i class="fas fa-search mr-2"></i>Cari
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border-2 border-slate-300 hover:border-slate-400 text-slate-700 font-semibold rounded-lg transition-all duration-300">
                <i class="fas fa-times mr-2"></i>Reset
            </a>
        </form>
    </div>

    {{-- Users Table --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden card-3d hover:shadow-2xl transition-all duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-right font-bold text-slate-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-800">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @php
                                $roleConfig = [
                                    'super_admin' => ['badge' => 'bg-red-100 text-red-800 border border-red-300', 'label' => 'Super Admin', 'icon' => 'fa-crown'],
                                    'admin_humas' => ['badge' => 'bg-blue-100 text-blue-800 border border-blue-300', 'label' => 'Admin Humas', 'icon' => 'fa-bullhorn'],
                                    'admin_registrasi' => ['badge' => 'bg-purple-100 text-purple-800 border border-purple-300', 'label' => 'Admin Registrasi', 'icon' => 'fa-clipboard-list'],
                                    'admin_umum' => ['badge' => 'bg-green-100 text-green-800 border border-green-300', 'label' => 'Admin Umum', 'icon' => 'fa-cog'],
                                    'user' => ['badge' => 'bg-slate-100 text-slate-800 border border-slate-300', 'label' => 'User', 'icon' => 'fa-user'],
                                ];
                                $config = $roleConfig[$user->role] ?? $roleConfig['user'];
                            @endphp
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold {{ $config['badge'] }}">
                                <i class="fas {{ $config['icon'] }} text-xs"></i>
                                {{ $config['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-sm">{{ $user->created_at->translatedFormat('d F Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-lg transition-all duration-300 text-sm">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus pengguna ini?');" class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-semibold rounded-lg transition-all duration-300 text-sm">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fas fa-users text-5xl mb-3"></i>
                                <p class="text-lg font-semibold">Tidak ada pengguna ditemukan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 flex justify-center">
            <div class="bg-slate-50 rounded-lg p-3">
                {{ $users->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
