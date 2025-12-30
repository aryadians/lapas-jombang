@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Kelola Pengumuman</h1>
            <p class="text-slate-600 mt-1">Informasi penting untuk pegawai dan pengunjung.</p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-4 py-2.5 rounded-lg transition-all duration-300 border border-slate-200">
                <i class="fas fa-print"></i>
                <span>Cetak</span>
            </button>
            <a href="{{ route('announcements.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-5 rounded-lg shadow-lg transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-plus"></i>
                <span>Buat Pengumuman</span>
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

    {{-- SEARCH FORM --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
        <form method="GET" action="{{ route('announcements.index') }}" class="flex flex-col md:flex-row items-center gap-4">
            <div class="relative flex-grow w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengumuman..." class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <i class="fas fa-filter"></i><span>Filter</span>
                </button>
                <a href="{{ route('announcements.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-slate-700 bg-slate-100 hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all border border-slate-200">
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>

    {{-- ANNOUNCEMENTS LIST --}}
    <div class="space-y-4">
        @forelse ($announcements as $item)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden transform hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl">
                <div class="p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-800 rounded-lg p-3 w-20 h-20 border border-yellow-300">
                            <span class="text-2xl font-bold">{{ $item->date->format('d') }}</span>
                            <span class="text-sm font-semibold uppercase tracking-wider">{{ $item->date->format('M') }}</span>
                            <span class="text-xs opacity-75">{{ $item->date->format('Y') }}</span>
                        </div>
                        <div class="flex-grow">
                            <h3 class="font-bold text-slate-800 text-lg leading-tight">{{ $item->title }}</h3>
                            <p class="text-sm text-slate-600 mt-1 line-clamp-2">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-2 w-full sm:w-auto flex-shrink-0">
                        <a href="{{ route('announcements.show', $item->id) }}" class="inline-flex items-center justify-center h-9 w-9 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-all duration-200" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('announcements.edit', $item->id) }}" class="inline-flex items-center justify-center h-9 w-9 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg transition-all duration-200" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('announcements.destroy', $item->id) }}" method="POST" class="inline">
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
            <div class="text-center py-24">
                <div class="flex flex-col items-center justify-center text-slate-500">
                    <div class="bg-slate-100 p-6 rounded-full mb-4 border border-slate-200">
                        <i class="fas fa-bullhorn text-5xl text-slate-400"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-slate-700">Belum Ada Pengumuman</h3>
                    <p class="text-slate-500 mt-2">Klik "Buat Pengumuman" untuk membuat informasi baru.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($announcements->hasPages())
        <div class="mt-8">
            {{ $announcements->links() }}
        </div>
    @endif
</div>
@endsection