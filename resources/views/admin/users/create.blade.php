@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Back Button --}}
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Pengguna
    </a>

    {{-- Create Form --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h2 class="text-2xl font-bold text-slate-800">Tambah Pengguna Baru</h2>
            <p class="text-sm text-slate-600 mt-1">Buat akun pengguna baru untuk sistem Lapas Jombang.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" id="createUserForm" class="p-8 space-y-6">
            @csrf

            {{-- Name Field --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('name') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror" 
                       placeholder="Contoh: Ahmad Rizki" required>
                @error('name') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            {{-- Email Field --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('email') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror" 
                       placeholder="contoh@lapas.go.id" required>
                @error('email') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            {{-- Role Selection --}}
            <div>
                <label for="role" class="block text-sm font-semibold text-slate-700 mb-3">Peran (Role)</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @php
                        $roles = [
                            'super_admin' => ['label' => 'Super Admin', 'icon' => 'fa-crown', 'color' => 'red', 'desc' => 'Akses penuh ke semua fitur'],
                            'admin_humas' => ['label' => 'Admin Humas', 'icon' => 'fa-bullhorn', 'color' => 'blue', 'desc' => 'Kelola berita dan pengumuman'],
                            'admin_registrasi' => ['label' => 'Admin Registrasi', 'icon' => 'fa-clipboard-list', 'color' => 'purple', 'desc' => 'Kelola pendaftaran kunjungan'],
                            'admin_umum' => ['label' => 'Admin Umum', 'icon' => 'fa-cog', 'color' => 'green', 'desc' => 'Admin umum sistem'],
                            'user' => ['label' => 'User', 'icon' => 'fa-user', 'color' => 'slate', 'desc' => 'User biasa'],
                        ];
                    @endphp
                    @foreach($roles as $roleValue => $roleData)
                    <label class="relative flex items-start p-4 rounded-lg border-2 border-slate-200 hover:border-slate-300 hover:bg-slate-50 cursor-pointer transition-all duration-300 group
                        {{ old('role') == $roleValue ? 'border-'.$roleData['color'].'-400 bg-'.$roleData['color'].'-50' : '' }}">
                        <input type="radio" name="role" value="{{ $roleValue }}" 
                               class="w-4 h-4 text-{{ $roleData['color'] }}-600 cursor-pointer mt-1" 
                               {{ old('role') == $roleValue ? 'checked' : '' }} required>
                        <div class="ml-3">
                            <div class="flex items-center gap-2">
                                <i class="fas {{ $roleData['icon'] }} text-{{ $roleData['color'] }}-600"></i>
                                <span class="font-semibold text-slate-800">{{ $roleData['label'] }}</span>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">{{ $roleData['desc'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('role') <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <hr class="border-slate-200 my-6">

            {{-- Password Field --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('password') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror"
                           placeholder="Minimal 8 karakter" required>
                    <span class="absolute right-3 top-3 text-slate-400 cursor-pointer" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <p class="text-xs text-slate-600 mt-1">Minimum 8 karakter, campurkan huruf, angka, dan simbol untuk keamanan maksimal.</p>
                @error('password') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            {{-- Password Confirmation Field --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200"
                           placeholder="Ulangi kata sandi yang sama" required>
                    <span class="absolute right-3 top-3 text-slate-400 cursor-pointer" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-500 hover:bg-slate-600 text-white font-semibold rounded-lg transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition-all transform hover:-translate-y-1" onclick="return showConfirmModal(event)">
                    <i class="fas fa-user-plus mr-2"></i>Buat Pengguna Baru
                </button>
            </div>
        </form>
    </div>
</div>

{{-- CONFIRMATION MODAL --}}
<div id="confirmModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 animate-fadeIn">
    <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full overflow-hidden animate-scaleUp">
        <div id="modalHeader" class="px-6 py-5 border-b-2 border-blue-500 bg-blue-50">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl font-bold">+</div>
                <h3 class="text-xl font-bold text-slate-800">Buat Pengguna Baru?</h3>
            </div>
        </div>
        <div class="p-6">
            <p id="modalMessage" class="text-slate-700 font-semibold text-center mb-6">Anda akan menambahkan pengguna baru ke sistem dengan peran yang dipilih. Pastikan data yang diisi sudah benar.</p>
            <div class="flex gap-3">
                <button onclick="hideConfirmModal()" class="flex-1 px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-lg transition-all transform hover:-translate-y-0.5">
                    Batal
                </button>
                <button onclick="confirmAction()" class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all transform hover:-translate-y-0.5">
                    Ya, Buat Pengguna
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let pendingForm = null;

function showConfirmModal(e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const role = document.querySelector('input[name="role"]:checked')?.value || '';
    
    if (!name || !email || !role) {
        alert('Mohon isi semua field yang diperlukan');
        return false;
    }
    
    pendingForm = e.target.form;
    const modal = document.getElementById('confirmModal');
    const message = document.getElementById('modalMessage');
    message.textContent = `Buat pengguna baru bernama "${name}" dengan email "${email}" dan peran "${role}"? Pastikan data sudah benar.`;
    
    console.log('Modal akan ditampilkan');
    console.log('Nama:', name, 'Email:', email, 'Role:', role);
    
    modal.classList.remove('hidden');
    return false;
}

function hideConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    pendingForm = null;
}

function confirmAction() {
    console.log('confirmAction called for user creation');
    console.log('Pending form:', pendingForm);
    if (pendingForm) {
        console.log('Submitting user creation form');
        pendingForm.submit();
    } else {
        console.log('No pending form to submit');
    }
    hideConfirmModal();
}

function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = event.target.closest('i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
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
