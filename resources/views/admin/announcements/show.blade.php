@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('announcements.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Pengumuman
    </a>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h1 class="text-3xl font-bold text-slate-800">{{ $announcement->title }}</h1>
            <div class="flex items-center text-sm text-slate-500 mt-2">
                <span>Tanggal Acara: {{ \Carbon\Carbon::parse($announcement->date)->translatedFormat('d F Y') }}</span>
                <span class="mx-2">&bull;</span>
                @if($announcement->status == 'published')
                    <span class="font-semibold text-green-600">Diterbitkan</span>
                @else
                    <span class="font-semibold text-yellow-600">Draft</span>
                @endif
            </div>
        </div>

        <div class="p-8 trix-content">
            {!! $announcement->content !!}
        </div>

        <div class="p-8 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
            <a href="{{ route('announcements.edit', $announcement->id) }}" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow-md transition-all">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="confirmDelete(event)" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition-all">
                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.trix-content h1 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
}
.trix-content h2 {
    font-size: 1.25rem;
    font-weight: bold;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
}
.trix-content blockquote {
    border-left: 4px solid #ccc;
    margin-left: 1rem;
    padding-left: 1rem;
    color: #666;
    font-style: italic;
}
.trix-content ul, .trix-content ol {
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}
.trix-content li {
    margin-bottom: 0.5rem;
}
</style>
@endsection
