<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration - KANTSA International Institute')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="h-full font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-full min-h-screen">

        <!-- SIDEBAR -->
        <aside class="hidden lg:flex lg:flex-col w-64 shrink-0 bg-[#0a1033] text-white">
            <div class="h-20 flex items-center px-6 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.jpg') }}" alt="KANTSA" class="h-10 w-auto object-contain"
                         onerror="this.onerror=null; this.outerHTML='<span class=\'font-black text-white\'>KANTSA</span>';">
                    <span class="text-xs font-bold uppercase tracking-widest text-red-400">Admin</span>
                </a>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:bg-white/10' }}">
                    📊 Tableau de bord
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:bg-white/10' }}">
                    👥 Comptes
                </a>
                <a href="{{ route('admin.scholarships.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.scholarships.*') ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:bg-white/10' }}">
                    🎓 Bourses
                </a>
                <a href="{{ route('admin.courses.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.courses.*') ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:bg-white/10' }}">
                    🗣️ Cours de Langues
                </a>
                <a href="{{ route('admin.services.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.services.*') ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:bg-white/10' }}">
                    📁 Services
                </a>

                <div class="pt-4 mt-4 border-t border-white/10 text-xs text-slate-500 uppercase tracking-widest px-4">Dossiers étudiants</div>
                <a href="{{ route('admin.applications.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.applications.*') ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:bg-white/10' }}">
                    📨 Candidatures
                </a>
                <a href="{{ route('admin.enrollments.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.enrollments.*') ? 'bg-red-600 text-white font-bold' : 'text-slate-300 hover:bg-white/10' }}">
                    📝 Inscriptions
                </a>
            </nav>

            <div class="p-4 border-t border-white/10 space-y-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-300 hover:bg-white/10 transition text-sm">
                    ← Retour au site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-red-400 hover:bg-white/10 transition text-sm text-left">
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTENU -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Topbar mobile -->
            <header class="lg:hidden sticky top-0 z-40 bg-[#0a1033] text-white px-4 py-3 flex items-center justify-between">
                <span class="font-black">KANTSA <span class="text-red-400">Admin</span></span>
                <a href="{{ route('admin.dashboard') }}" class="text-xs underline">Menu</a>
            </header>

            <!-- Messages flash -->
            @if(session('success'))
                <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-800 text-sm text-center py-3 px-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border-b border-red-200 text-red-800 text-sm text-center py-3 px-4">
                    {{ session('error') }}
                </div>
            @endif

            <main class="flex-1 p-6 lg:p-10">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
