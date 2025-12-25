@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h2>
            <p class="text-sm text-gray-500">Kelola akun dan peran pengguna sistem.</p>
        </div>
    </div>

    {{-- SUCCESS/ERROR MESSAGES --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif

    {{-- DATA TABLE --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold">Pengguna</th>
                        <th class="px-6 py-4 font-bold">Peran (Role)</th>
                        <th class="px-6 py-4 font-bold">Tanggal Registrasi</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-800 block">{{ $user->name }}</span>
                            <span class="text-xs text-gray-500">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role == 'admin')
                                <span class="px-2.5 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Admin</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-semibold text-slate-800 bg-slate-100 rounded-full">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-yellow-600 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            Tidak ada data pengguna untuk ditampilkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($users->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
