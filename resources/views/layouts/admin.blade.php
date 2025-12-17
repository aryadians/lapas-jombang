<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Lapas Jombang</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-72 bg-slate-900 text-white flex flex-col shadow-2xl transition-all duration-300">
            <div class="h-24 flex items-center px-6 bg-slate-950 border-b border-slate-800">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-auto mr-3" onerror="this.style.display='none'">
                <div>
                    <h1 class="font-bold text-lg tracking-wide">ADMIN PANEL</h1>
                    <p class="text-xs text-yellow-500 uppercase font-semibold">Lapas Jombang</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-blue-900 text-white border-l-4 border-yellow-500 shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} rounded-xl transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('news.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('news.*') ? 'bg-blue-900 text-white border-l-4 border-yellow-500 shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} rounded-xl transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <span class="font-medium">Kelola Berita</span>
                </a>

                <a href="{{ route('announcements.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('announcements.*') ? 'bg-blue-900 text-white border-l-4 border-yellow-500 shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} rounded-xl transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    <span class="font-medium">Kelola Pengumuman</span>
                </a>
            </nav>

            <div class="p-6 border-t border-slate-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="flex justify-between items-center py-4 px-8 bg-white shadow-sm border-b border-gray-200">
                <h2 class="text-2xl font-bold text-slate-800">Sistem Informasi Lapas</h2>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-bold text-slate-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-lg border-2 border-yellow-500">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>