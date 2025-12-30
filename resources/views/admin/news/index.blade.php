@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Kelola Berita</h1>
            <p class="text-slate-600 mt-1">Daftar semua berita dan artikel kegiatan Lapas.</p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-4 py-2.5 rounded-lg transition-all duration-300 border border-slate-200">
                <i class="fas fa-print"></i>
                <span>Cetak</span>
            </button>
            <a href="{{ route('news.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-5 rounded-lg shadow-lg transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-plus"></i>
                <span>Tambah Berita</span>
            </a>
        </div>
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

    {{-- SEARCH AND FILTER FORM --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
        <form method="GET" action="{{ route('news.index') }}" class="flex flex-col md:flex-row items-center gap-4">
            <div class="relative flex-grow w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita berdasarkan judul..." class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
            </div>
            <div class="w-full md:w-auto">
                <select name="status" class="w-full py-3 pl-4 pr-10 border-2 border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
                    <option value="">Semua Status</option>
                    <option value="published" @if(request('status') == 'published') selected @endif>Tayang</option>
                    <option value="draft" @if(request('status') == 'draft') selected @endif>Draft</option>
                </select>
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <i class="fas fa-filter"></i><span>Filter</span>
                </button>
                <a href="{{ route('news.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-slate-700 bg-slate-100 hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all border border-slate-200">
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>

    {{-- NEWS CARDS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($news as $item)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden transform hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl flex flex-col">
                <div class="relative">
                    @if(is_array($item->image) && count($item->image) > 0)
                        <img src="{{ $item->image[0] }}" alt="{{ $item->title }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 w-full bg-slate-100 flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-slate-300"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        @if($item->status == 'published')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                <span class="w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                Tayang
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-800 border border-slate-200 shadow-sm">
                                <span class="w-2 h-2 mr-2 bg-slate-500 rounded-full"></span>
                                Draft
                            </span>
                        @endif
                    </div>
                </div>
                <div class="p-5 flex-grow flex flex-col">
                    <h3 class="font-bold text-slate-800 text-lg leading-tight mb-2 flex-grow">{{ $item->title }}</h3>
                    <p class="text-sm text-slate-600 line-clamp-2">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                </div>
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                    <p class="text-xs text-slate-500 flex items-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $item->created_at->translatedFormat('d F Y') }}</span>
                    </p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('news.show', $item->id) }}" class="inline-flex items-center justify-center h-9 w-9 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-all duration-200" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('news.edit', $item->id) }}" class="inline-flex items-center justify-center h-9 w-9 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg transition-all duration-200" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete(event)" class="inline-flex items-center justify-center h-9 w-9 bg-red-100 hover:bg-red-200 text-red-800 rounded-lg transition-all duration-200" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3 text-center py-24">
                <div class="flex flex-col items-center justify-center text-slate-500">
                    <div class="bg-slate-100 p-6 rounded-full mb-4 border border-slate-200">
                        <i class="fas fa-newspaper text-5xl text-slate-400"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-slate-700">Belum Ada Berita</h3>
                    <p class="text-slate-500 mt-2">Klik "Tambah Berita" untuk membuat artikel baru.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($news->hasPages())
        <div class="mt-8">
            {{ $news->links() }}
        </div>
    @endif

</div>
@endsection