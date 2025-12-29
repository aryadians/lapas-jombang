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

    {{-- SEARCH AND FILTER FORM --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.kunjungan.index') }}" method="GET" class="space-y-4">
            {{-- Baris 1: Pencarian --}}
            <div>
                <label for="search" class="sr-only">Cari</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-slate-500 focus:border-slate-500 sm:text-sm" placeholder="Cari nama pengunjung, NIK, atau nama WBP...">
                </div>
            </div>
            
            {{-- Baris 2: Filter dan Tombol --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Tanggal Mulai --}}
                <div>
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="block w-full py-2 border border-gray-300 rounded-lg leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 sm:text-sm">
                </div>

                {{-- Tanggal Selesai --}}
                <div>
                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="block w-full py-2 border border-gray-300 rounded-lg leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 sm:text-sm">
                </div>

                {{-- Status Select --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="block w-full py-2 pl-3 pr-10 border border-gray-300 rounded-lg leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 sm:text-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-end space-x-2">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Filter
                    </button>
                    <a href="{{ route('admin.kunjungan.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- DATA TABLE --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden card-3d hover:shadow-2xl transition-all duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-4 font-bold w-12">
                            <input type="checkbox" id="selectAll" class="rounded border-slate-300 cursor-pointer w-4 h-4 text-blue-600 transition-all" onchange="toggleSelectAll(this)">
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
                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-50 transition-colors duration-200 group">
                        <td class="px-4 py-4 align-top">
                            <input type="checkbox" class="kunjungan-checkbox rounded border-slate-300 cursor-pointer w-4 h-4 text-blue-600 transition-all" value="{{ $kunjungan->id }}" data-name="{{ $kunjungan->nama_pengunjung }}">
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
                                <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg transition-all duration-200 text-xs whitespace-nowrap" title="Setujui" onclick="return showConfirmModal(event, 'setuju', '{{ $kunjungan->nama_pengunjung }}')">
                                        <i class="fa-solid fa-check"></i>Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-semibold rounded-lg transition-all duration-200 text-xs whitespace-nowrap" title="Tolak" onclick="return showConfirmModal(event, 'tolak', '{{ $kunjungan->nama_pengunjung }}')">
                                        <i class="fa-solid fa-times"></i>Tolak
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.kunjungan.destroy', $kunjungan->id) }}" method="POST" class="inline-block" onsubmit="return showConfirmModal(event, 'hapus', '{{ $kunjungan->nama_pengunjung }}')">
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

        {{-- PAGINATION --}}
        @if ($kunjungans->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $kunjungans->links() }}
        </div>
        @endif
    </div>

    {{-- BULK ACTION SECTION --}}
    <div id="bulkActionBar" class="hidden fixed bottom-6 right-6 bg-white rounded-2xl shadow-2xl border border-slate-200 p-4 flex items-center gap-3 z-50 animate-fadeIn">
        <span class="text-sm font-semibold text-slate-700 px-3">
            <span id="selectedCount">0</span> terpilih
        </span>
        <div class="h-8 w-px bg-slate-200"></div>
        <div class="flex gap-2">
            <button onclick="bulkApprove()" class="inline-flex items-center gap-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all duration-200 text-sm" title="Setujui Terpilih">
                <i class="fa-solid fa-check-circle"></i>Setujui
            </button>
            <button onclick="bulkReject()" class="inline-flex items-center gap-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 text-sm" title="Tolak Terpilih">
                <i class="fa-solid fa-times-circle"></i>Tolak
            </button>
            <button onclick="bulkDelete()" class="inline-flex items-center gap-1 px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-semibold rounded-lg transition-all duration-200 text-sm" title="Hapus Terpilih">
                <i class="fa-solid fa-trash-alt"></i>Hapus
            </button>
        </div>
    </div>
</div>

<script>
let pendingForm = null;
let actionType = null;
let pendingName = null;

function toggleSelectAll(checkbox) {
    document.querySelectorAll('.kunjungan-checkbox').forEach(cb => {
        cb.checked = checkbox.checked;
    });
    updateBulkActionBar();
}

function updateBulkActionBar() {
    const selected = document.querySelectorAll('.kunjungan-checkbox:checked');
    const bulkBar = document.getElementById('bulkActionBar');
    const count = selected.length;
    
    if (count > 0) {
        document.getElementById('selectedCount').textContent = count;
        bulkBar.classList.remove('hidden');
    } else {
        bulkBar.classList.add('hidden');
    }
}

document.querySelectorAll('.kunjungan-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateBulkActionBar);
});

function getSelectedIds() {
    return Array.from(document.querySelectorAll('.kunjungan-checkbox:checked')).map(cb => cb.value);
}

function showConfirmModal(e, type, name = null) {
    e.preventDefault();
    pendingForm = e.target;
    actionType = type;
    pendingName = name;
    
    const modal = document.getElementById('confirmModal') || createConfirmModal();
    const header = modal.querySelector('#modalHeader');
    const message = modal.querySelector('#modalMessage');
    const confirmBtn = modal.querySelector('#confirmBtn');
    
    let config = {};
    if (type === 'setuju') {
        config = {
            icon: '✓',
            iconColor: 'bg-green-100 text-green-600',
            title: 'Setujui Kunjungan?',
            titleColor: 'border-green-500 bg-green-50',
            message: `Apakah Anda yakin ingin menyetujui kunjungan ${name ? 'dari ' + name : ''}?`,
            btnText: 'Ya, Setujui',
            btnColor: 'bg-green-600 hover:bg-green-700'
        };
    } else if (type === 'tolak') {
        config = {
            icon: '✗',
            iconColor: 'bg-red-100 text-red-600',
            title: 'Tolak Kunjungan?',
            titleColor: 'border-red-500 bg-red-50',
            message: `Apakah Anda yakin ingin menolak kunjungan ${name ? 'dari ' + name : ''}?`,
            btnText: 'Ya, Tolak',
            btnColor: 'bg-red-600 hover:bg-red-700'
        };
    } else if (type === 'hapus') {
        config = {
            icon: '!',
            iconColor: 'bg-slate-100 text-slate-600',
            title: 'Hapus Pendaftaran?',
            titleColor: 'border-slate-500 bg-slate-50',
            message: `Data pendaftaran ${name ? 'dari ' + name : ''} akan dihapus secara permanen dan tidak dapat dikembalikan.`,
            btnText: 'Ya, Hapus',
            btnColor: 'bg-slate-600 hover:bg-slate-700'
        };
    }
    
    header.innerHTML = `
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full ${config.iconColor} flex items-center justify-center text-xl font-bold">${config.icon}</div>
            <h3 class="text-xl font-bold text-slate-800">${config.title}</h3>
        </div>
    `;
    header.className = `px-6 py-5 border-b-2 ${config.titleColor}`;
    message.textContent = config.message;
    confirmBtn.textContent = config.btnText;
    confirmBtn.className = `${config.btnColor} transition-all`;
    
    modal.classList.remove('hidden');
}

function createConfirmModal() {
    const modal = document.createElement('div');
    modal.id = 'confirmModal';
    modal.className = 'hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 animate-fadeIn';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full overflow-hidden animate-scaleUp">
            <div id="modalHeader" class="px-6 py-5 border-b-2"></div>
            <div class="p-6">
                <p id="modalMessage" class="text-slate-700 font-semibold text-center mb-6"></p>
                <div class="flex gap-3">
                    <button onclick="hideConfirmModal()" class="flex-1 px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-lg transition-all transform hover:-translate-y-0.5">
                        Batal
                    </button>
                    <button onclick="confirmAction()" id="confirmBtn" class="flex-1 px-4 py-2.5 text-white font-bold rounded-lg transition-all transform hover:-translate-y-0.5"></button>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
    return modal;
}

function hideConfirmModal() {
    const modal = document.getElementById('confirmModal');
    if (modal) modal.classList.add('hidden');
    pendingForm = null;
    actionType = null;
    pendingName = null;
}

function confirmAction() {
    if (pendingForm) {
        pendingForm.submit();
    }
    hideConfirmModal();
}

function bulkApprove() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        showAlert('Pilih minimal satu pendaftaran', 'error');
        return;
    }
    
    const modal = document.getElementById('confirmModal') || createConfirmModal();
    const header = modal.querySelector('#modalHeader');
    const message = modal.querySelector('#modalMessage');
    const confirmBtn = modal.querySelector('#confirmBtn');
    
    header.innerHTML = `
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl font-bold">✓</div>
            <h3 class="text-xl font-bold text-slate-800">Setujui ${ids.length} Pendaftaran?</h3>
        </div>
    `;
    header.className = 'px-6 py-5 border-b-2 border-green-500 bg-green-50';
    message.textContent = `Semua ${ids.length} pendaftaran akan disetujui dan pengunjung akan menerima notifikasi.`;
    confirmBtn.textContent = 'Ya, Setujui Semua';
    confirmBtn.className = 'bg-green-600 hover:bg-green-700 transition-all';
    confirmBtn.onclick = () => submitBulkAction('approved', ids);
    
    modal.classList.remove('hidden');
}

function bulkReject() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        showAlert('Pilih minimal satu pendaftaran', 'error');
        return;
    }
    
    const modal = document.getElementById('confirmModal') || createConfirmModal();
    const header = modal.querySelector('#modalHeader');
    const message = modal.querySelector('#modalMessage');
    const confirmBtn = modal.querySelector('#confirmBtn');
    
    header.innerHTML = `
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xl font-bold">✗</div>
            <h3 class="text-xl font-bold text-slate-800">Tolak ${ids.length} Pendaftaran?</h3>
        </div>
    `;
    header.className = 'px-6 py-5 border-b-2 border-red-500 bg-red-50';
    message.textContent = `Semua ${ids.length} pendaftaran akan ditolak dan pengunjung akan menerima notifikasi.`;
    confirmBtn.textContent = 'Ya, Tolak Semua';
    confirmBtn.className = 'bg-red-600 hover:bg-red-700 transition-all';
    confirmBtn.onclick = () => submitBulkAction('rejected', ids);
    
    modal.classList.remove('hidden');
}

function bulkDelete() {
    console.log('bulkDelete called');
    const ids = getSelectedIds();
    console.log('Selected IDs:', ids);
    if (ids.length === 0) {
        showAlert('Pilih minimal satu pendaftaran', 'error');
        return;
    }
    
    const modal = document.getElementById('confirmModal') || createConfirmModal();
    const header = modal.querySelector('#modalHeader');
    const message = modal.querySelector('#modalMessage');
    const confirmBtn = modal.querySelector('#confirmBtn');
    
    header.innerHTML = `
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-xl font-bold">!</div>
            <h3 class="text-xl font-bold text-slate-800">Hapus ${ids.length} Pendaftaran?</h3>
        </div>
    `;
    header.className = 'px-6 py-5 border-b-2 border-slate-500 bg-slate-50';
    message.textContent = `${ids.length} pendaftaran akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.`;
    confirmBtn.textContent = 'Ya, Hapus Semua';
    confirmBtn.className = 'bg-slate-600 hover:bg-slate-700 transition-all';
    confirmBtn.onclick = () => submitBulkDelete(ids);
    
    modal.classList.remove('hidden');
}

function submitBulkAction(status, ids) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.style.display = 'none';
    form.action = '{{ route("admin.kunjungan.bulk-update") }}';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.innerHTML = `
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="status" value="${status}">
        ${ids.map(id => `<input type="hidden" name="ids[]" value="${id}">`).join('')}
    `;
    
    document.body.appendChild(form);
    hideConfirmModal();
    form.submit();
}

function submitBulkDelete(ids) {
    console.log('submitBulkDelete called with IDs:', ids);
    const form = document.createElement('form');
    form.method = 'POST';
    form.style.display = 'none';
    form.action = '{{ route("admin.kunjungan.bulk-delete") }}';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('CSRF Token:', csrfToken);
    form.innerHTML = `
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="_method" value="DELETE">
        ${ids.map(id => `<input type="hidden" name="ids[]" value="${id}">`).join('')}
    `;
    
    document.body.appendChild(form);
    hideConfirmModal();
    console.log('Form created and submitted');
    form.submit();
}

function showAlert(message, type) {
    alert(message);
}

// Close modal on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') hideConfirmModal();
});

// Add animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes scaleUp {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
    .animate-scaleUp { animation: scaleUp 0.3s ease-out; }
`;
document.head.appendChild(style);
</script>
@endsection
