@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Kelola Pengumuman</h2>
            <p class="text-sm text-gray-500">Informasi penting untuk pegawai dan pengunjung.</p>
        </div>
        <a href="{{ route('announcements.create') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg shadow-md transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Buat Pengumuman
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
        <p class="font-bold">Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 font-bold">Tanggal Kegiatan</th>
                    <th class="px-6 py-4 font-bold">Judul Pengumuman</th>
                    <th class="px-6 py-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($announcements as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex flex-col items-center justify-center bg-blue-50 text-blue-700 rounded-lg p-2 w-16 border border-blue-100">
                            <span class="text-xl font-bold">{{ $item->date->format('d') }}</span>
                            <span class="text-xs uppercase">{{ $item->date->format('M') }}</span>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="font-semibold text-slate-800 block text-base">{{ $item->title }}</span>
                        <span class="text-xs text-gray-400">{{ Str::limit($item->content, 80) }}</span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('announcements.edit', $item->id) }}" class="p-2 text-yellow-600 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('announcements.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-500">Belum ada pengumuman aktif.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection