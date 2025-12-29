@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Detail Pendaftaran Kunjungan</h2>
            <p class="text-sm text-slate-600 mt-1">Informasi lengkap pendaftaran kunjungan tatap muka</p>
        </div>
        <a href="{{ route('admin.kunjungan.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition-all duration-200">
            <i class="fa-solid fa-arrow-left"></i>Kembali
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
        <p class="font-bold"><i class="fa-solid fa-check-circle mr-2"></i>Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- MAIN CONTENT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- DATA PENGUNJUNG SECTION --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 px-6 py-4 flex items-center gap-3">
                    <div class="bg-blue-200 p-3 rounded-lg">
                        <i class="fa-solid fa-user text-blue-700 text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Data Pengunjung</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Pengunjung</label>
                        <p class="text-lg font-bold text-slate-900">{{ $kunjungan->nama_pengunjung }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nomor Identitas</label>
                        <p class="text-lg font-bold text-slate-900 font-mono">{{ $kunjungan->nik_pengunjung }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Email</label>
                        <p class="text-sm font-semibold text-slate-900 break-all">{{ $kunjungan->email_pengunjung ?? '—' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nomor WhatsApp</label>
                        <p class="text-sm font-semibold text-slate-900">
                            @if($kunjungan->no_wa_pengunjung)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kunjungan->no_wa_pengunjung) }}" target="_blank" class="text-green-600 hover:text-green-700 font-bold inline-flex items-center gap-2 hover:underline">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    {{ $kunjungan->no_wa_pengunjung }}
                                </a>
                            @else
                                —
                            @endif
                        </p>
                    </div>
                    <div class="md:col-span-2 bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Alamat</label>
                        <p class="text-sm font-semibold text-slate-900 leading-relaxed">{{ $kunjungan->alamat_pengunjung ?? '—' }}</p>
                    </div>
                </div>
            </div>

            {{-- DATA WBP SECTION --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 border-b border-purple-200 px-6 py-4 flex items-center gap-3">
                    <div class="bg-purple-200 p-3 rounded-lg">
                        <i class="fa-solid fa-user-shield text-purple-700 text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Data Narapidana</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Narapidana</label>
                        <p class="text-lg font-bold text-slate-900">{{ $kunjungan->nama_wbp }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Hubungan Keluarga</label>
                        <p class="text-lg font-bold text-slate-900 capitalize">{{ $kunjungan->hubungan }}</p>
                    </div>
                </div>
            </div>

            {{-- JADWAL KUNJUNGAN SECTION --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-orange-50 to-orange-100 border-b border-orange-200 px-6 py-4 flex items-center gap-3">
                    <div class="bg-orange-200 p-3 rounded-lg">
                        <i class="fa-solid fa-calendar-check text-orange-700 text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Jadwal Kunjungan</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Tanggal Kunjungan</label>
                        <p class="text-lg font-bold text-slate-900">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('d F Y') }}</p>
                    </div>
                    @if($kunjungan->sesi)
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Sesi</label>
                        <p class="text-lg font-bold text-slate-900 capitalize">{{ $kunjungan->sesi }}</p>
                    </div>
                    @endif
                    @if($kunjungan->nomor_antrian_harian)
                    <div class="md:col-span-2 bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg p-4 border-2 border-blue-300">
                        <label class="block text-xs font-bold text-blue-700 uppercase tracking-wider mb-2">Nomor Antrian</label>
                        <p class="text-3xl font-black text-blue-800 font-mono">#{{ $kunjungan->nomor_antrian_harian }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- DESKRIPSI KUNJUNGAN SECTION --}}
            @if($kunjungan->deskripsi)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gradient-to-r from-cyan-50 to-cyan-100 border-b border-cyan-200 px-6 py-4 flex items-center gap-3">
                    <div class="bg-cyan-200 p-3 rounded-lg">
                        <i class="fa-solid fa-file-alt text-cyan-700 text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Deskripsi Kunjungan</h3>
                </div>
                <div class="p-6 bg-slate-50 border border-slate-200 rounded-lg">
                    <p class="text-slate-700 leading-relaxed whitespace-pre-wrap text-sm md:text-base">{{ $kunjungan->deskripsi }}</p>
                </div>
            </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- STATUS CARD --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="bg-slate-800 text-white px-6 py-4">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <i class="fa-solid fa-info-circle"></i>Status Pendaftaran
                    </h3>
                </div>
                
                <div class="p-6">
                    @if($kunjungan->status == 'approved')
                        <div class="bg-green-50 border-2 border-green-300 rounded-xl p-5 mb-4">
                            <div class="flex items-center gap-3 mb-3">
                                <i class="fa-solid fa-circle-check text-green-600 text-3xl"></i>
                                <span class="text-2xl font-bold text-green-700">Disetujui</span>
                            </div>
                            @if($kunjungan->approved_at)
                            <p class="text-sm text-green-700 font-semibold">
                                <i class="fa-solid fa-calendar-check mr-2"></i>
                                {{ \Carbon\Carbon::parse($kunjungan->approved_at)->translatedFormat('d F Y H:i') }}
                            </p>
                            @endif
                        </div>
                    @elseif($kunjungan->status == 'rejected')
                        <div class="bg-red-50 border-2 border-red-300 rounded-xl p-5 mb-4">
                            <div class="flex items-center gap-3 mb-3">
                                <i class="fa-solid fa-circle-xmark text-red-600 text-3xl"></i>
                                <span class="text-2xl font-bold text-red-700">Ditolak</span>
                            </div>
                            @if($kunjungan->rejected_at)
                            <p class="text-sm text-red-700 font-semibold">
                                <i class="fa-solid fa-calendar-xmark mr-2"></i>
                                {{ \Carbon\Carbon::parse($kunjungan->rejected_at)->translatedFormat('d F Y H:i') }}
                            </p>
                            @endif
                        </div>
                    @else
                        <div class="bg-yellow-50 border-2 border-yellow-300 rounded-xl p-5 mb-4">
                            <div class="flex items-center gap-3 mb-3">
                                <i class="fa-solid fa-hourglass-end text-yellow-600 text-3xl"></i>
                                <span class="text-2xl font-bold text-yellow-700">Menunggu</span>
                            </div>
                            <p class="text-sm text-yellow-700 font-semibold">
                                <i class="fa-solid fa-calendar-plus mr-2"></i>
                                {{ \Carbon\Carbon::parse($kunjungan->created_at)->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    @endif

                    {{-- NOTES --}}
                    @if($kunjungan->notes)
                    <div class="border-t border-slate-200 pt-4">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Catatan</label>
                        <p class="text-sm text-slate-700 bg-slate-100 p-3 rounded-lg border border-slate-300">{{ $kunjungan->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- TIMELINE --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="bg-slate-800 text-white px-6 py-4">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <i class="fa-solid fa-clock"></i>Timeline
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-star text-yellow-500"></i>
                            <span class="text-slate-700 font-semibold">Dibuat</span>
                        </div>
                        <span class="text-sm text-slate-600 font-mono">{{ $kunjungan->created_at->translatedFormat('d F Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-rotate-right text-blue-500"></i>
                            <span class="text-slate-700 font-semibold">Diperbarui</span>
                        </div>
                        <span class="text-sm text-slate-600 font-mono">{{ $kunjungan->updated_at->translatedFormat('d F Y H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- ACTIONS --}}
            @if($kunjungan->status == 'pending')
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="bg-slate-800 text-white px-6 py-4">
                    <h3 class="text-lg font-bold">Aksi</h3>
                </div>
                <div class="p-6 space-y-3">
                    <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" onsubmit="return showConfirmModal(event, 'setuju')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg shadow-lg transition-all transform hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fa-solid fa-check-circle"></i>Setujui Kunjungan
                        </button>
                    </form>
                    <form action="{{ route('admin.kunjungan.update', $kunjungan->id) }}" method="POST" onsubmit="return showConfirmModal(event, 'tolak')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold rounded-lg shadow-lg transition-all transform hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fa-solid fa-times-circle"></i>Tolak Kunjungan
                        </button>
                    </form>
                </div>
            </div>
            @endif

            {{-- DELETE BUTTON --}}
            <form action="{{ route('admin.kunjungan.destroy', $kunjungan->id) }}" method="POST" onsubmit="return showConfirmModal(event, 'hapus')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-slate-300 to-slate-400 hover:from-red-100 hover:to-red-200 text-slate-800 hover:text-red-700 font-bold rounded-lg shadow-lg transition-all border border-slate-400 hover:border-red-400 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-trash-alt"></i>Hapus Pendaftaran
                </button>
            </form>

        </div>

    </div>

</div>

{{-- CONFIRMATION MODAL --}}
<div id="confirmModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 animate-fadeIn">
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
</div>

<style>
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
</style>

<script>
let pendingForm = null;
let actionType = null;

function showConfirmModal(e, type) {
    console.log('showConfirmModal called with type:', type);
    e.preventDefault();
    pendingForm = e.target.closest('form');
    actionType = type;
    
    console.log('Pending form:', pendingForm);
    console.log('Action type:', actionType);
    
    const modal = document.getElementById('confirmModal');
    const header = document.getElementById('modalHeader');
    const message = document.getElementById('modalMessage');
    const confirmBtn = document.getElementById('confirmBtn');
    
    let config = {};
    if (type === 'setuju') {
        config = {
            icon: '✓',
            iconColor: 'bg-green-100 text-green-600',
            title: 'Setujui Kunjungan?',
            titleColor: 'border-green-500 bg-green-50',
            message: 'Pengunjung akan menerima notifikasi persetujuan kunjungan mereka.',
            btnText: 'Ya, Setujui',
            btnColor: 'bg-green-600 hover:bg-green-700'
        };
    } else if (type === 'tolak') {
        config = {
            icon: '✗',
            iconColor: 'bg-red-100 text-red-600',
            title: 'Tolak Kunjungan?',
            titleColor: 'border-red-500 bg-red-50',
            message: 'Pengunjung akan menerima notifikasi penolakan kunjungan mereka.',
            btnText: 'Ya, Tolak',
            btnColor: 'bg-red-600 hover:bg-red-700'
        };
    } else if (type === 'hapus') {
        config = {
            icon: '!',
            iconColor: 'bg-slate-100 text-slate-600',
            title: 'Hapus Pendaftaran?',
            titleColor: 'border-slate-500 bg-slate-50',
            message: 'Data pendaftaran kunjungan akan dihapus secara permanen dan tidak dapat dikembalikan.',
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

function hideConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    pendingForm = null;
    actionType = null;
}

function confirmAction() {
    console.log('confirmAction called');
    console.log('Pending form:', pendingForm);
    hideConfirmModal();
    if (pendingForm) {
        console.log('Submitting form');
        pendingForm.submit();
    } else {
        console.log('No pending form to submit');
    }
}

// Close modal on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') hideConfirmModal();
});
</script>
@endsection
