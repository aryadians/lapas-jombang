@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Back Button --}}
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar Pengguna
    </a>

    {{-- Edit Form --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50">
            <h2 class="text-2xl font-bold text-slate-800">Edit Pengguna</h2>
            <p class="text-sm text-slate-600 mt-1">Ubah detail dan peran pengguna di sistem.</p>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PATCH')

            {{-- Name Field --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('name') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror" 
                       required>
                @error('name') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            {{-- Email Field --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('email') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror" 
                       required>
                @error('email') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            {{-- Role Selection --}}
            <div>
                <label for="role" class="block text-sm font-semibold text-slate-700 mb-3">Peran (Role)</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @php
                        $roles = [
                            'super_admin' => ['label' => 'Super Admin', 'icon' => 'fa-crown', 'color' => 'red'],
                            'admin_humas' => ['label' => 'Admin Humas', 'icon' => 'fa-megaphone', 'color' => 'blue'],
                            'admin_registrasi' => ['label' => 'Admin Registrasi', 'icon' => 'fa-clipboard-list', 'color' => 'purple'],
                            'admin_umum' => ['label' => 'Admin Umum', 'icon' => 'fa-cog', 'color' => 'green'],
                            'user' => ['label' => 'User', 'icon' => 'fa-user', 'color' => 'slate'],
                        ];
                    @endphp
                    @foreach($roles as $roleValue => $roleData)
                    <label class="relative flex items-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-300 group
                        {{ old('role', $user->role) == $roleValue ? 'border-'.$roleData['color'].'-400 bg-'.$roleData['color'].'-50' : 'border-slate-200 hover:border-slate-300' }}">
                        <input type="radio" name="role" value="{{ $roleValue }}" 
                               class="w-4 h-4 text-{{ $roleData['color'] }}-600 cursor-pointer" 
                               {{ old('role', $user->role) == $roleValue ? 'checked' : '' }}>
                        <div class="ml-3 flex items-center gap-2">
                            <i class="fas {{ $roleData['icon'] }} text-{{ $roleData['color'] }}-600"></i>
                            <span class="font-semibold text-slate-800 group-hover:text-slate-900">{{ $roleData['label'] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('role') <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <hr class="border-slate-200 my-6">

            {{-- Password Section --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <p class="text-sm text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Kosongi field password jika tidak ingin mengubah kata sandi.
                </p>
            </div>

            {{-- Password Field --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi Baru</label>
                <input type="password" name="password" id="password" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('password') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror"
                       placeholder="Biarkan kosong jika tidak ingin mengubah">
                @error('password') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            {{-- Password Confirmation Field --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-200"
                       placeholder="Konfirmasi kata sandi baru">
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-500 hover:bg-slate-600 text-white font-semibold rounded-lg transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
