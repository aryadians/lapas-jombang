@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Kelola Berita</h2>
            <p class="text-sm text-gray-500">Daftar semua berita dan artikel kegiatan Lapas.</p>
        </div>
        <a href="{{ route('news.create') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg shadow-md transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Berita
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
        <p class="font-bold">Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold">Gambar</th>
                        <th class="px-6 py-4 font-bold">Judul Berita</th>
                        <th class="px-6 py-4 font-bold">Status</th> <th class="px-6 py-4 font-bold">Tanggal Upload</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($news as $item)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        
                        <td class="px-6 py-4">
                            @if($item->image)
                                <img src="{{ $item->image }}" alt="Thumbnail" class="h-12 w-20 object-cover rounded shadow-sm border border-gray-200">
                            @else
                                <div class="h-12 w-20 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">No Img</div>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-800 block text-base">{{ $item->title }}</span>
                            <span class="text-xs text-gray-400">{{ Str::limit($item->content, 50) }}</span>
                        </td>

                        <td class="px-6 py-4">
                            @if($item->status == 'published')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-600 rounded-full"></span>
                                    Tayang
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-gray-500 rounded-full"></span>
                                    Draft
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('news.edit', $item->id) }}" class="p-2 text-yellow-600 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                <p>Belum ada berita yang ditambahkan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection