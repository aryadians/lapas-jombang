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
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
        <div class="flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    {{-- SEARCH AND FILTER FORM --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.kunjungan.index') }}" method="GET" class="space-y-4">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari nama pengunjung, NIK, atau nama WBP...">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="block w-full py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="block w-full py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="block w-full py-2 pl-3 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.kunjungan.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- DATA TABLE AND BULK ACTION FORM --}}
    <form id="bulk-action-form" method="POST">
        @csrf
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden card-3d hover:shadow-2xl transition-all duration-300">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-4 font-bold w-12">
                                <input type="checkbox" id="selectAll" class="rounded border-slate-300 cursor-pointer w-4 h-4 text-blue-600 transition-all">
                            </th>
                            <th class="px-6 py-4 font-bold">Data Pemohon</th>
                            <th class="px-6 py-4 font-bold">Kontak</th>
                            <th class="px-6 py-4 font-bold">Tujuan Kunjungan</th>
                            <th class="px-6 py-4 font-bold">Jadwal Kunjungan</th>
                            <th class="px-6 py-4 font-bold">Tgl. Daftar</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($kunjungans as $kunjungan)
                        <tr class="odd:bg-white even:bg-slate-50 hover:bg-blue-50/50 transition-colors duration-200 group">
                            <td class="px-4 py-4 align-top">
                                <input type="checkbox" name="ids[]" class="kunjungan-checkbox rounded border-slate-300 cursor-pointer w-4 h-4 text-blue-600 transition-all" value="{{ $kunjungan->id }}">
                            </td>
                            <td class="px-6 py-4 align-top">
                                <span class="font-semibold text-slate-800 block group-hover:text-blue-700 transition-colors duration-200">{{ $kunjungan->nama_pengunjung }}</span>
                                <span class="text-xs text-slate-600">NIK: {{ $kunjungan->nik_pengunjung }}</span>
                            </td>
                            <td class="px-6 py-4 align-top text-xs text-slate-600">
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
                                <span class="text-xs text-slate-600">Hubungan: {{ $kunjungan->hubungan }}</span>
                            </td>
                            <td class="px-6 py-4 align-top text-slate-700">
                                <span class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('d F Y') }}</span>
                                @if($kunjungan->nomor_antrian_harian)
                                    <span class="block text-xs mt-1">No. Antrian: <strong class="text-slate-900">#{{ $kunjungan->nomor_antrian_harian }}</strong></span>
                                @endif
                                @if($kunjungan->sesi)
                                    <span class="block text-xs capitalize">Sesi: <strong class="text-slate-900">{{ $kunjungan->sesi }}</strong></span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top text-slate-600 text-xs">
                                {{ $kunjungan->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 align-top">
                                @if($kunjungan->status == 'approved')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-300">
                                        <i class="fa-solid fa-check-circle mr-1"></i>Disetujui
                                    </span>
                                @elseif($kunjungan->status == 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-300">
                                        <i class="fa-solid fa-times-circle mr-1"></i>Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-300">
                                        <i class="fa-solid fa-clock mr-1"></i>Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right align-top">
                                <div class="flex justify-end items-center gap-1.5">
                                    <a href="{{ route('admin.kunjungan.show', $kunjungan->id) }}" class="inline-flex items-center gap-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-lg transition-all duration-200 text-xs whitespace-nowrap" title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>Lihat
                                    </a>
                                    @if($kunjungan->status == 'pending')
                                    <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" class="inline-block" onsubmit="showConfirmation(event, { title: 'Setujui Kunjungan?', text: 'Anda akan menyetujui kunjungan ini.', icon: 'question', confirmButtonText: 'Ya, Setujui!' })">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg transition-all duration-200 text-xs whitespace-nowrap" title="Setujui">
                                            <i class="fa-solid fa-check"></i>Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" class="inline-block" onsubmit="showConfirmation(event, { title: 'Tolak Kunjungan?', text: 'Anda akan menolak kunjungan ini.', icon: 'warning', confirmButtonText: 'Ya, Tolak!' })">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-700 font-semibold rounded-lg transition-all duration-200 text-xs whitespace-nowrap" title="Tolak">
                                            <i class="fa-solid fa-times"></i>Tolak
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('admin.kunjungan.destroy', $kunjungan->id) }}" method="POST" class="inline-block" onsubmit="confirmDelete(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-semibold rounded-lg transition-all duration-200 text-xs whitespace-nowrap" title="Hapus">
                                            <i class="fa-solid fa-trash-alt"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="bg-slate-50 p-4 rounded-full mb-3 border border-slate-200">
                                        <i class="fa-solid fa-inbox text-4xl"></i>
                                    </div>
                                    <p class="font-medium text-lg text-slate-600">Tidak ada data pendaftaran kunjungan.</p>
                                    <p class="text-sm text-slate-500 mt-1">Gunakan filter untuk menampilkan data yang relevan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kunjungans->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $kunjungans->links() }}
            </div>
            @endif
        </div>
    </form>

    {{-- BULK ACTION BAR --}}
    <div id="bulkActionBar" class="hidden fixed bottom-6 right-6 bg-white rounded-2xl shadow-2xl border border-slate-200 p-4 flex items-center gap-3 z-50 animate__animated animate__fadeInUp">
        <span class="text-sm font-semibold text-slate-700 px-3">
            <span id="selectedCount">0</span> terpilih
        </span>
        <div class="h-8 w-px bg-slate-200"></div>
        <div class="flex gap-2">
            <button type="submit" form="bulk-action-form" formaction="{{ route('admin.kunjungan.bulk-update') }}" onclick="confirmBulkAction(event, 'update', 'approved')" class="inline-flex items-center gap-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all duration-200 text-sm" title="Setujui Terpilih">
                <i class="fa-solid fa-check-circle"></i>Setujui
            </button>
            <button type="submit" form="bulk-action-form" formaction="{{ route('admin.kunjungan.bulk-update') }}" onclick="confirmBulkAction(event, 'update', 'rejected')" class="inline-flex items-center gap-1 px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg transition-all duration-200 text-sm" title="Tolak Terpilih">
                <i class="fa-solid fa-times-circle"></i>Tolak
            </button>
            <button type="submit" form="bulk-action-form" formaction="{{ route('admin.kunjungan.bulk-delete') }}" onclick="confirmBulkAction(event, 'delete')" class="inline-flex items-center gap-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 text-sm" title="Hapus Terpilih">
                <i class="fa-solid fa-trash-alt"></i>Hapus
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.kunjungan-checkbox');
    const bulkActionBar = document.getElementById('bulkActionBar');
    const selectedCountSpan = document.getElementById('selectedCount');

    function updateBulkActionBar() {
        const selectedCount = document.querySelectorAll('.kunjungan-checkbox:checked').length;
        if (selectedCount > 0) {
            selectedCountSpan.textContent = selectedCount;
            bulkActionBar.classList.remove('hidden');
        } else {
            bulkActionBar.classList.add('hidden');
        }
    }

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateBulkActionBar();
        });
    }

    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else if (document.querySelectorAll('.kunjungan-checkbox:checked').length === itemCheckboxes.length) {
                selectAllCheckbox.checked = true;
            }
            updateBulkActionBar();
        });
    });
});
</script>
@endsection
