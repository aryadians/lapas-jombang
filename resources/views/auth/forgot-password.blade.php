<x-guest-layout>
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-key text-2xl text-yellow-600"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-900">Lupa Password?</h3>
        <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
            Jangan khawatir! Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                <i class="fas fa-envelope mr-2 text-slate-400"></i>
                Alamat Email
            </label>
            <input id="email"
                class="block w-full px-4 py-3 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150 ease-in-out"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                placeholder="nama@kemenkumham.go.id" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="space-y-4">
            <button type="submit"
                class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-slate-900 bg-yellow-500 hover:bg-yellow-400 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 uppercase tracking-wider">
                <i class="fas fa-paper-plane"></i>
                <span>Kirim Link Reset Password</span>
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:text-slate-900 font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </form>

    <!-- Info Box -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-blue-800">Informasi</h4>
                <p class="text-sm text-blue-700 mt-1">
                    Link reset password akan dikirim ke email Anda dalam waktu 1-2 menit. Pastikan email yang Anda masukkan sudah terdaftar dalam sistem.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
