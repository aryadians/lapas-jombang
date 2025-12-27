<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900">
            Perbarui Password
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 mb-2">Password Saat Ini</label>
            <input type="password" id="update_password_current_password" name="current_password" autocomplete="current-password"
                   class="w-full max-w-lg rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('current_password', 'updatePassword') border-red-500 @enderror">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 mb-2">Password Baru</label>
            <input type="password" id="update_password_password" name="password" autocomplete="new-password"
                   class="w-full max-w-lg rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('password', 'updatePassword') border-red-500 @enderror">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password Baru</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password"
                   class="w-full max-w-lg rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3 @error('password_confirmation', 'updatePassword') border-red-500 @enderror">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white font-bold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-600"
                >Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
