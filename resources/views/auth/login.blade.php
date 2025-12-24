<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h3 class="text-2xl font-bold text-slate-900">Login Petugas</h3>
        <p class="text-slate-500 text-sm mt-1">Silakan masukkan akun SIMPEG/Sistem Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email / NIP</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-envelope text-slate-400"></i>
                </div>
                <input id="email" 
                    class="block w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm transition duration-150 ease-in-out" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                    placeholder="nama@kemenkumham.go.id" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-lock text-slate-400"></i>
                </div>
                
                <input id="password" 
                    :type="show ? 'text' : 'password'"
                    class="block w-full pl-10 pr-10 py-2.5 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm transition duration-150 ease-in-out"
                    name="password"
                    required 
                    autocomplete="current-password" 
                    placeholder="••••••••" />
                
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button" @click="show = !show" class="text-slate-400 hover:text-slate-600 focus:outline-none p-1">
                        <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-yellow-500 shadow-sm focus:ring-yellow-500 cursor-pointer" name="remember">
                <span class="ml-2 text-sm text-slate-600 group-hover:text-slate-900 transition">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-yellow-600 hover:text-yellow-500 font-semibold transition" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-slate-900 bg-yellow-500 hover:bg-yellow-400 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 uppercase tracking-wider">
            <span>Masuk Dashboard</span>
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </button>
    </form>
</x-guest-layout>