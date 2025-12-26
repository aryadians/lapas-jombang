@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Pendaftaran Kunjungan</h2>
            <p class="text-sm text-gray-500">Kelola pendaftaran kunjungan tatap muka.</p>
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
        <p class="font-bold">Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    {{-- FILTER FORM --}}
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <form action="{{ route('admin.kunjungan.index') }}" method="GET">
            <div class="flex items-center gap-4">
                <div class="w-full">
                    <label for="status" class="text-sm font-medium text-gray-700">Filter berdasarkan Status:</label>
                    <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="pt-6">
                    <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white px-6 py-2 rounded-lg">Filter</button>
                </div>
            </div>
        </form>
    </div>

    {{-- DATA TABLE --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold">Data Pemohon</th>
                        <th class="px-6 py-4 font-bold">Kontak</th>
                        <th class="px-6 py-4 font-bold">Tujuan Kunjungan</th>
                        <th class="px-6 py-4 font-bold">Jadwal Kunjungan</th>
                        <th class="px-6 py-4 font-bold">Tgl. Daftar</th>
                        <th class="px-6 py-4 font-bold">Status</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($kunjungans as $kunjungan)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        <td class="px-6 py-4 align-top">
                            <span class="font-semibold text-slate-800 block">{{ $kunjungan->nama_pengunjung }}</span>
                            <span class="text-xs text-gray-500">NIK: {{ $kunjungan->nik_pengunjung }}</span>
                        </td>
                        <td class="px-6 py-4 align-top text-xs text-gray-600">
                            <div class="flex items-center gap-1.5 mb-1">
                                <i class="fa-solid fa-envelope w-3 text-center text-slate-400"></i>
                                <span>{{ $kunjungan->email_pengunjung ?? '-' }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="fa-brands fa-whatsapp w-3 text-center text-slate-400"></i>
                                <span>{{ $kunjungan->no_wa_pengunjung ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 align-top">
                             <span class="font-semibold text-slate-800 block">{{ $kunjungan->nama_wbp }}</span>
                            <span class="text-xs text-gray-500">Hubungan: {{ $kunjungan->hubungan }}</span>
                        </td>
                        <td class="px-6 py-4 align-top text-gray-600">
                            <span class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('d F Y') }}</span>
                            @if($kunjungan->nomor_antrian_harian)
                                <span class="block text-xs mt-1">No. Antrian: <strong class="text-slate-900">#{{ $kunjungan->nomor_antrian_harian }}</strong></span>
                            @endif
                            @if($kunjungan->sesi)
                                <span class="block text-xs capitalize">Sesi: <strong class="text-slate-900">{{ $kunjungan->sesi }}</strong></span>
                            @endif
                        </td>
                        <td class="px-6 py-4 align-top text-gray-500 text-xs">
                            {{ $kunjungan->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 align-top">
                            @if($kunjungan->status == 'approved')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">Disetujui</span>
                            @elseif($kunjungan->status == 'rejected')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">Ditolak</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">Menunggu</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center align-top">
                            <div class="flex justify-center items-center gap-2">
                                @if($kunjungan->status == 'pending')
                                <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="p-2 text-green-600 bg-green-50 hover:bg-green-100 rounded-lg transition" title="Setujui">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition" title="Tolak">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.kunjungan.destroy', $kunjungan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-600 bg-gray-100 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                <p>Tidak ada data pendaftaran kunjungan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($kunjungans->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $kunjungans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
