@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Edit Pengguna</h2>
        <p class="text-sm text-gray-500">Ubah detail dan peran pengguna.</p>
    </div>

    {{-- EDIT FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="p-8 space-y-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border-gray-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm" required>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-gray-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm" required>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Peran (Role)</label>
                    <select name="role" id="role" class="w-full rounded-lg border-gray-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm" required>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <hr class="border-gray-200">

                <p class="text-sm text-gray-500">Isi kolom di bawah hanya jika Anda ingin mengubah kata sandi.</p>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password" class="w-full rounded-lg border-gray-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm">
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Password Confirmation --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg border-gray-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm">
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Batal</a>
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-2.5 rounded-lg shadow-md transition-all duration-300">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
