<x-guest-layout>
    <div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-yellow-500">
        
        <div class="bg-slate-50 p-6 text-center border-b border-gray-100">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('img/logo.png') }}" 
                     alt="Logo Lapas" 
                     class="h-20 w-auto drop-shadow-md hover:scale-105 transition-transform duration-300"
                     onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Logo_Kementerian_Hukum_dan_Hak_Asasi_Manusia_Republik_Indonesia.svg/1200px-Logo_Kementerian_Hukum_dan_Hak_Asasi_Manusia_Republik_Indonesia.svg.png';"> 
                     </div>
            
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">SISTEM INFORMASI</h2>
            <p class="text-sm font-semibold text-yellow-600 uppercase tracking-widest mt-1">Lapas Kelas 2B Jombang</p>
        </div>

        <div class="p-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <x-input-label for="email" :value="__('Email Petugas')" class="text-slate-800 font-bold mb-1" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <x-text-input id="email" class="block w-full pl-10 border-gray-300 focus:border-slate-800 focus:ring-slate-800 rounded-lg shadow-sm bg-gray-50 transition" 
                                      type="email" 
                                      name="email" 
                                      value="admin@lapas.com" 
                                      required autofocus autocomplete="username" 
                                      placeholder="nama@kemenkumham.go.id" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="text-slate-800 font-bold mb-1" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password" class="block w-full pl-10 border-gray-300 focus:border-slate-800 focus:ring-slate-800 rounded-lg shadow-sm bg-gray-50 transition"
                                        type="password"
                                        name="password"
                                        value="admin123"
                                        required autocomplete="current-password" 
                                        placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-slate-900 shadow-sm focus:ring-slate-900 cursor-pointer" name="remember">
                        <span class="ms-2 text-sm text-gray-600 group-hover:text-slate-900 transition">{{ __('Ingat Saya') }}</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 font-semibold transition" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition duration-150 uppercase tracking-wider">
                        Masuk Dashboard
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-gray-50 py-4 text-center border-t border-gray-100">
            <p class="text-xs text-gray-400">
                &copy; 2025 Lapas Kelas 2B Jombang.<br>
                Sistem Pemasyarakatan Terintegrasi.
            </p>
        </div>
    </div>
</x-guest-layout>