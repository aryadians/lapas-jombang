<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-slate-900">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus, harap unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5"
    >Hapus Akun</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-slate-900">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-1 text-sm text-slate-600">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 rounded-lg border-slate-300 focus:ring-yellow-500 focus:border-yellow-500 transition shadow-sm py-3"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 text-slate-600 font-bold hover:text-slate-900 transition bg-slate-200 rounded-lg hover:bg-slate-300">
                    Batal
                </button>

                <button type="submit" class="ms-3 bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-lg shadow-md">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
