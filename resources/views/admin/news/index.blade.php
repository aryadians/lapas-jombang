@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800">Kelola Berita</h2>
            <p class="text-sm text-gray-500 mt-1">Daftar semua berita dan artikel kegiatan Lapas.</p>
        </div>
        <a href="{{ route('news.create') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-700 text-white px-6 py-3 rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <i class="fa-solid fa-plus"></i>
            Tambah Berita Baru
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

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-base text-left">
                <thead class="text-sm text-slate-700 uppercase bg-slate-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-extrabold">Gambar</th>
                        <th class="px-6 py-4 font-extrabold">Judul Berita</th>
                        <th class="px-6 py-4 font-extrabold">Status</th>
                        <th class="px-6 py-4 font-extrabold">Tanggal Upload</th>
                        <th class="px-6 py-4 font-extrabold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($news as $item)
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition duration-150">
                        
                        <td class="px-6 py-4">
                            @if($item->image)
                                <img src="{{ $item->image }}" alt="Thumbnail" class="h-16 w-24 object-cover rounded-lg shadow-sm border border-gray-200">
                            @else
                                <div class="h-16 w-24 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">No Img</div>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-800 block text-lg">{{ $item->title }}</span>
                            <span class="text-sm text-gray-500">{{ Str::limit($item->content, 70) }}</span>
                        </td>

                        <td class="px-6 py-4">
                            @if($item->status == 'published')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">
                                    <span class="w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                    Tayang
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800 border border-gray-200">
                                    <span class="w-2 h-2 mr-2 bg-gray-500 rounded-full"></span>
                                    Draft
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-calendar-alt text-gray-400"></i>
                                <span class="text-sm">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('news.edit', $item->id) }}" class="p-2.5 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200" title="Edit">
                                    <i class="fa-solid fa-edit text-lg"></i>
                                </a>
                                
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-all duration-200" title="Hapus">
                                        <i class="fa-solid fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-folder-open text-5xl mb-3"></i>
                                <p class="font-medium text-lg">Belum ada berita yang ditambahkan.</p>
                                <p class="text-sm mt-1">Klik "Tambah Berita Baru" untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-white border-t border-gray-100 flex justify-center items-center">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection