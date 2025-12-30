@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Pengguna
    </a>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h2 class="text-2xl font-bold text-slate-800">Tambah Pengguna Baru</h2>
            <p class="text-sm text-slate-600 mt-1">Buat akun pengguna baru untuk sistem Lapas Jombang.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" id="createUserForm" class="p-8 space-y-6">
            @csrf

            {{-- Name, Email, Role --}}
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('name') border-red-300 @enderror" 
                           placeholder="Contoh: John Doe" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('email') border-red-300 @enderror" 
                           placeholder="j.doe@example.com" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Peran (Role)</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @php
                        $roles = [
                            'super_admin' => ['label' => 'Super Admin', 'icon' => 'fa-crown', 'color' => 'red'],
                            'admin_humas' => ['label' => 'Admin Humas', 'icon' => 'fa-bullhorn', 'color' => 'blue'],
                            'admin_registrasi' => ['label' => 'Admin Registrasi', 'icon' => 'fa-clipboard-list', 'color' => 'purple'],
                            'admin_umum' => ['label' => 'Admin Umum', 'icon' => 'fa-cog', 'color' => 'green'],
                            'user' => ['label' => 'User', 'icon' => 'fa-user', 'color' => 'slate'],
                        ];
                        @endphp
                        @foreach($roles as $roleValue => $roleData)
                        <label class="relative flex items-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-200 group {{ old('role') == $roleValue ? 'border-'.$roleData['color'].'-400 bg-'.$roleData['color'].'-50' : 'border-slate-200 hover:border-slate-300' }}">
                            <input type="radio" name="role" value="{{ $roleValue }}" class="w-4 h-4 text-{{ $roleData['color'] }}-600 cursor-pointer" {{ old('role') == $roleValue ? 'checked' : '' }} required>
                            <div class="ml-3 flex items-center gap-2">
                                <i class="fas {{ $roleData['icon'] }} text-{{ $roleData['color'] }}-600"></i>
                                <span class="font-semibold text-slate-800">{{ $roleData['label'] }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('role') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <hr class="border-slate-200">

            {{-- Password --}}
            <div class="space-y-4">
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('password') border-red-300 @enderror"
                           placeholder="Minimal 8 karakter" required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200"
                           placeholder="Ulangi kata sandi" required>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition-all border border-slate-200">
                    Batal
                </a>
                <button type="submit" onclick="confirmCreate(event)" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-all">
                    <i class="fas fa-save mr-2"></i>Buat Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function confirmCreate(event) {
    event.preventDefault();
    const form = document.getElementById('createUserForm');
    
    Swal.fire({
        ...swalTheme,
        title: 'Buat Pengguna Baru?',
        text: "Pastikan semua data yang dimasukkan sudah benar sebelum melanjutkan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Buat Pengguna',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endsection
