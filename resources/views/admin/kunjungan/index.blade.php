@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Pendaftaran Kunjungan</h1>
            <p class="text-slate-600 mt-1">Kelola dan verifikasi pendaftaran kunjungan tatap muka.</p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-4 py-2.5 rounded-lg transition-all duration-300 border border-slate-200">
                <i class="fas fa-print"></i>
                <span>Cetak</span>
            </button>
            <a href="{{ route('admin.kunjungan.verifikasi') }}" class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-5 rounded-lg shadow-lg transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-qrcode"></i>
                <span>Verifikasi QR</span>
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
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md flex items-center gap-3" role="alert">
        <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
        <div>
            <p class="font-bold">Gagal!</p>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    {{-- SEARCH, FILTER, AND BULK ACTION FORM --}}
    <form id="bulk-action-form" action="{{ route('admin.kunjungan.index') }}" method="GET">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 space-y-6">
            {{-- Search & Main Filters --}}
            <div class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-lg bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all" placeholder="Cari nama, NIK, atau WBP...">
                </div>
                <div class="flex items-center gap-4">
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="fas fa-filter"></i><span>Filter</span>
                    </button>
                    <a href="{{ route('admin.kunjungan.index') }}" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold rounded-lg text-slate-700 bg-slate-100 hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all border border-slate-200">
                        <span>Reset</span>
                    </a>
                </div>
            </div>
            
            {{-- Secondary Filters --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="tanggal_kunjungan" class="text-sm font-medium text-slate-600 mb-1 block">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal_kunjungan" value="{{ request('tanggal_kunjungan') }}" class="w-full py-2.5 px-4 border-2 border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
                </div>
                <div>
                    <label for="status" class="text-sm font-medium text-slate-600 mb-1 block">Status</label>
                    <select name="status" class="w-full py-2.5 pl-4 pr-10 border-2 border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label for="sesi" class="text-sm font-medium text-slate-600 mb-1 block">Sesi Kunjungan</label>
                    <select name="sesi" class="w-full py-2.5 pl-4 pr-10 border-2 border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all">
                        <option value="">Semua Sesi</option>
                        <option value="pagi" {{ request('sesi') == 'pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="siang" {{ request('sesi') == 'siang' ? 'selected' : '' }}>Siang</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- BULK ACTIONS AND SELECT ALL --}}
        <div class="flex items-center justify-between mt-6">
            <div class="flex items-center gap-3">
                <input type="checkbox" id="selectAll" class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                <label for="selectAll" class="font-semibold text-slate-700">Pilih Semua</label>
            </div>
            <div id="bulkActionBar" class="hidden flex items-center gap-2 animate__animated animate__fadeIn">
                <span class="text-sm font-semibold text-slate-600"><span id="selectedCount">0</span> terpilih</span>
                <div class="h-6 w-px bg-slate-300"></div>
                
                @csrf
                <button type="button" formaction="{{ route('admin.kunjungan.bulk-update') }}" onclick="confirmBulkAction(event, 'update', 'approved')" class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 hover:bg-green-200 text-green-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Setujui Terpilih">
                    <i class="fa-solid fa-check-circle"></i> Setujui
                </button>
                <button type="button" formaction="{{ route('admin.kunjungan.bulk-update') }}" onclick="confirmBulkAction(event, 'update', 'rejected')" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Tolak Terpilih">
                    <i class="fa-solid fa-times-circle"></i> Tolak
                </button>
                <button type="button" formaction="{{ route('admin.kunjungan.bulk-delete') }}" onclick="confirmBulkAction(event, 'delete')" class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 hover:bg-red-200 text-red-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Hapus Terpilih">
                    <i class="fa-solid fa-trash-alt"></i> Hapus
                </button>
            </div>
        </div>

        {{-- KUNJUNGAN CARDS GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">
            @forelse ($kunjungans as $kunjungan)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden transform hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl flex flex-col">
                {{-- Card Header --}}
                <div class="p-5 border-b border-slate-100 flex justify-between items-start">
                    <div class="flex items-center gap-4">
                        <input type="checkbox" name="ids[]" class="kunjungan-checkbox h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer" value="{{ $kunjungan->id }}">
                        <div>
                            <p class="font-bold text-slate-800 text-lg">{{ $kunjungan->nama_pengunjung }}</p>
                            <p class="text-sm text-slate-500">NIK: {{ $kunjungan->nik_pengunjung }}</p>
                        </div>
                    </div>
                    @if($kunjungan->status == 'approved')
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                            <i class="fa-solid fa-check-circle mr-1.5"></i>Disetujui
                        </div>
                    @elseif($kunjungan->status == 'rejected')
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                            <i class="fa-solid fa-times-circle mr-1.5"></i>Ditolak
                        </div>
                    @else
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                            <i class="fa-solid fa-clock mr-1.5"></i>Menunggu
                        </div>
                    @endif
                </div>

                {{-- Card Body --}}
                <div class="p-5 flex-grow space-y-4">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-slate-500 font-semibold">Tujuan Kunjungan</p>
                            <p class="text-slate-800 font-bold">{{ $kunjungan->nama_wbp }}</p>
                            <p class="text-slate-600">Hubungan: {{ $kunjungan->hubungan }}</p>
                        </div>
                        <div>
                            <p class="text-slate-500 font-semibold">Jadwal Kunjungan</p>
                            <p class="text-slate-800 font-bold">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('d F Y') }}</p>
                            @if($kunjungan->sesi)
                                <p class="text-slate-600 capitalize">Sesi {{ $kunjungan->sesi }}
                                @if($kunjungan->nomor_antrian_harian)
                                    <span class="font-bold text-slate-900">(Antrian #{{ $kunjungan->nomor_antrian_harian }})</span>
                                @endif
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="text-sm">
                        <p class="text-slate-500 font-semibold">Kontak Pemohon</p>
                        <div class="flex items-center gap-4 mt-1">
                            @if($kunjungan->email_pengunjung)
                            <div class="flex items-center gap-1.5 text-slate-600">
                                <i class="fa-solid fa-envelope text-slate-400"></i>
                                <span>{{ $kunjungan->email_pengunjung }}</span>
                            </div>
                            @endif
                            @if($kunjungan->no_wa_pengunjung)
                            <div class="flex items-center gap-1.5 text-slate-600">
                                <i class="fa-brands fa-whatsapp text-slate-400"></i>
                                <span>{{ $kunjungan->no_wa_pengunjung }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                    <p class="text-xs text-slate-500">
                        Didaftar: {{ $kunjungan->created_at->diffForHumans() }}
                    </p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.kunjungan.show', $kunjungan->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Lihat Detail">
                            <i class="fa-solid fa-eye"></i><span>Detail</span>
                        </a>
                        @if($kunjungan->status == 'pending')
                            <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" class="inline-block">
                                @csrf @method('PATCH') <input type="hidden" name="status" value="approved">
                                <button type="submit" onclick="confirmUpdate(event, 'approved', '{{ $kunjungan->nama_pengunjung }}')" class="inline-flex items-center gap-2 px-3 py-2 bg-green-100 hover:bg-green-200 text-green-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Setujui">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" class="inline-block">
                                @csrf @method('PATCH') <input type="hidden" name="status" value="rejected">
                                <button type="submit" onclick="confirmUpdate(event, 'rejected', '{{ $kunjungan->nama_pengunjung }}')" class="inline-flex items-center gap-2 px-3 py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Tolak">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </form>
                        @endif
                         <form action="{{ route('admin.kunjungan.destroy', $kunjungan->id) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="confirmDelete(event)" class="inline-flex items-center gap-2 px-3 py-2 bg-red-100 hover:bg-red-200 text-red-800 font-semibold rounded-lg transition-all duration-200 text-sm" title="Hapus">
                                <i class="fa-solid fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="lg:col-span-2 xl:col-span-3 text-center py-24">
                <div class="flex flex-col items-center justify-center text-slate-500">
                    <div class="bg-slate-100 p-6 rounded-full mb-4 border border-slate-200">
                        <i class="fa-solid fa-inbox text-5xl text-slate-400"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-slate-700">Tidak Ada Data Pendaftaran</h3>
                    <p class="text-slate-500 mt-2">Gunakan filter untuk mencari data atau belum ada pendaftaran yang masuk.</p>
                </div>
            </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if ($kunjungans->hasPages())
        <div class="mt-8">
            {{ $kunjungans->links() }}
        </div>
        @endif
    </form>
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
                checkbox.checked = this.checked;
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
    
    // Initial check
    updateBulkActionBar();
});
</script>
@endsection
