@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800">Kelola Pengumuman</h2>
            <p class="text-sm text-gray-500 mt-1">Informasi penting untuk pegawai dan pengunjung.</p>
        </div>
        <a href="{{ route('announcements.create') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-700 text-white px-6 py-3 rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <i class="fa-solid fa-plus"></i>
            Buat Pengumuman Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex items-center gap-3 mb-6" role="alert">
        <i class="fa-solid fa-circle-check text-green-500 text-xl"></i>
        <div>
            <p class="font-bold">Sukses!</p>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    {{-- SEARCH FORM --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <form method="GET" action="{{ route('announcements.index') }}" class="flex gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Pengumuman</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul atau isi..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-slate-500">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="px-6 py-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg transition">
                    <i class="fa-solid fa-search mr-2"></i>
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('announcements.index') }}" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-base text-left">
                <thead class="text-sm text-slate-700 uppercase bg-slate-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-extrabold">Tanggal Kegiatan</th>
                        <th class="px-6 py-4 font-extrabold">Judul Pengumuman</th>
                        <th class="px-6 py-4 font-extrabold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($announcements as $item)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition duration-150">
                        <td class="px-6 py-4">
                            <div class="flex flex-col items-center justify-center bg-blue-50 text-blue-700 rounded-lg p-2 w-20 border border-blue-100">
                                <span class="text-2xl font-bold">{{ $item->date->format('d') }}</span>
                                <span class="text-xs uppercase">{{ $item->date->format('M') }}</span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-800 block text-lg">{{ $item->title }}</span>
                            <span class="text-sm text-gray-500">{{ Str::limit($item->content, 80) }}</span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('announcements.edit', $item->id) }}" class="p-2.5 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200" title="Edit">
                                    <i class="fa-solid fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('announcements.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-all duration-200" title="Hapus">
                                        <i class="fa-solid fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-bullhorn text-5xl mb-3"></i>
                                <p class="font-medium text-lg">Belum ada pengumuman yang ditambahkan.</p>
                                <p class="text-sm mt-1">Klik "Buat Pengumuman Baru" untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-white border-t border-gray-100 flex justify-center items-center">
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection