@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800">Kelola Pengumuman</h2>
            <p class="text-sm text-gray-500 mt-1">Informasi penting untuk pegawai dan pengunjung.</p>
        </div>
        <div class="flex gap-2 print:hidden">
            <button onclick="window.print()" class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fa-solid fa-print"></i>
                Cetak
            </button>
            <a href="{{ route('announcements.create') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-700 text-white px-6 py-3 rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <i class="fa-solid fa-plus"></i>
                Buat Pengumuman Baru
            </a>
        </div>
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
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 print:hidden">
        <form method="GET" action="{{ route('announcements.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-slate-700 mb-2">Cari Pengumuman</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul..." class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200 font-semibold">
                    <i class="fa-solid fa-search mr-2"></i>
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('announcements.index') }}" class="px-6 py-3 bg-slate-500 hover:bg-slate-600 text-white rounded-lg transition-all duration-200 font-semibold">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden card-3d hover:shadow-2xl transition-all duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-bold">Tanggal</th>
                        <th class="px-6 py-4 font-bold">Judul Pengumuman</th>
                        <th class="px-6 py-4 font-bold text-right print:hidden">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($announcements as $item)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-50 transition-colors duration-200 group">
                        <td class="px-6 py-4 align-middle">
                            <div class="inline-flex flex-col items-center justify-center bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-800 rounded-lg p-2 w-20 border border-yellow-300 group-hover:border-yellow-400 transition-all duration-200">
                                <span class="text-xl font-bold">{{ $item->date->format('d') }}</span>
                                <span class="text-xs font-semibold uppercase tracking-wider">{{ $item->date->format('M') }}</span>
                                <span class="text-xs opacity-75">{{ $item->date->format('Y') }}</span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 align-middle">
                            <div class="flex-1">
                                <span class="font-bold text-slate-800 block text-base group-hover:text-yellow-700 transition-colors duration-200">{{ $item->title }}</span>
                                <span class="text-xs text-slate-600 mt-1 block line-clamp-2">{{ Str::limit(strip_tags($item->content), 100) }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-right align-middle print:hidden">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('announcements.edit', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-lg transition-all duration-200 text-sm" title="Edit">
                                    <i class="fa-solid fa-edit"></i>
                                    Edit
                                </a>
                                <form action="{{ route('announcements.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-semibold rounded-lg transition-all duration-200 text-sm" title="Hapus">
                                        <i class="fa-solid fa-trash-alt"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <div class="bg-slate-50 p-4 rounded-full mb-3 border border-slate-200">
                                    <i class="fa-solid fa-bullhorn text-4xl"></i>
                                </div>
                                <p class="font-medium text-lg text-slate-600">Belum ada pengumuman yang ditambahkan.</p>
                                <p class="text-sm text-slate-500 mt-1">Klik "Buat Pengumuman Baru" untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-white border-t border-gray-100 flex justify-center items-center print:hidden">
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection