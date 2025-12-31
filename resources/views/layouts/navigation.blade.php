<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-950 border-b border-white/10 backdrop-blur-xl shadow-2xl transition-all duration-300">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> {{-- Tinggi ditambah sedikit agar lega --}}
            <div class="flex items-center">
                <div class="shrink-0 flex items-center group perspective-1000">
                    <a href="{{ route('dashboard') }}" class="relative transform transition-all duration-500 group-hover:rotate-y-12 group-hover:scale-110">
                        <div class="absolute -inset-2 bg-blue-500/30 rounded-full blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <x-application-logo class="relative block h-10 w-auto fill-current text-white drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]" />
                    </a>
                </div>

                <div class="hidden space-x-2 sm:ms-10 sm:flex items-center">
                    {{-- Item: Dashboard --}}
                    <a href="{{ route('dashboard') }}" 
                       class="relative px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 group
                       {{ request()->routeIs('dashboard') 
                          ? 'bg-blue-600/20 text-blue-400 border border-blue-500/50 shadow-[0_0_15px_rgba(59,130,246,0.3)]' 
                          : 'text-slate-300 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/10' 
                       }}">
                        
                        {{-- 3D Hover Lift Effect --}}
                        <span class="relative z-10 flex items-center gap-2 transform transition-transform duration-300 group-hover:-translate-y-0.5">
                            <i class="fas fa-home text-lg {{ request()->routeIs('dashboard') ? 'text-blue-400' : 'text-slate-400 group-hover:text-blue-400' }}"></i>
                            {{ __('Dashboard') }}
                        </span>
                        
                        {{-- Active Indicator Line (Bottom) --}}
                        @if(request()->routeIs('dashboard'))
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-blue-400 rounded-full shadow-[0_0_10px_#60a5fa]"></div>
                        @endif
                    </a>

                    {{-- Tambahkan Menu Lain Disini dengan Format yang Sama --}}
                    {{-- Contoh: Menu Kunjungan --}}
                    {{-- <a href="..." class="..."> ... </a> --}}
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-4 py-2 border border-white/10 text-sm leading-4 font-medium rounded-xl text-slate-300 bg-white/5 hover:bg-white/10 hover:text-white hover:border-blue-500/50 hover:shadow-[0_0_15px_rgba(59,130,246,0.2)] focus:outline-none transition ease-in-out duration-300 transform hover:-translate-y-0.5">
                            
                            {{-- User Avatar Placeholder --}}
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold shadow-inner">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>

                            <div class="flex flex-col items-start">
                                <span class="font-bold">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-slate-400">Administrator</span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 transition-transform duration-300" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- Dropdown Container Styling (Override default x-dropdown if needed via classes) --}}
                        <div class="bg-slate-900 border border-slate-700 rounded-lg overflow-hidden">
                            
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-blue-900/50 hover:text-blue-400 transition-colors">
                                <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="hover:bg-red-900/30 hover:text-red-400 transition-colors text-red-300"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/10 focus:outline-none transition duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-900/95 backdrop-blur-xl border-t border-white/10">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                class="rounded-lg text-slate-300 hover:text-white hover:bg-blue-600/20 hover:border-blue-500 transition-all">
                <i class="fas fa-home mr-2"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-4 border-t border-white/10 bg-slate-800/50">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-lg text-slate-300 hover:bg-white/5">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="rounded-lg text-red-400 hover:bg-red-900/20 hover:text-red-300"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>