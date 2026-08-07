<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'KANTSA International Institute'))</title>

    <!-- Importation Tailwind CSS v4 via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="flex flex-col min-h-screen text-slate-900 font-sans antialiased">

    <!-- NAVBAR UNIQUE (visible sur toutes les pages) -->
    <header class="sticky top-0 z-50 w-full py-3 border-b border-red-600/20 bg-[#0a1033]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-6">

            <!-- Logo & Identité KANTSA -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.jpg') }}"
                     alt="Logo KANTSA International Institute"
                     class="h-14 sm:h-16 w-auto object-contain group-hover:scale-105 transition duration-300"
                     onerror="this.onerror=null; this.outerHTML='<span class=\'text-2xl font-black text-white\'>KANTSA</span>';">
            </a>

            <!-- Liens de Navigation Principaux -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-200">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition-colors">Accueil</a>
                <a href="{{ route('services.index') }}" class="hover:text-red-400 transition-colors">Nos Services</a>
                <a href="{{ route('language-courses.index') }}" class="hover:text-red-400 transition-colors">École de Langues</a>
                <a href="{{ route('scholarships.index') }}" class="hover:text-red-400 transition-colors">Bourses d'Études</a>
            </nav>

            <!-- Zone Authentification / Espace Utilisateur -->
            <div class="flex items-center gap-3">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm border border-white/20 transition duration-200">
                            <span class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center text-[10px] font-bold uppercase">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-slate-300" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>

                        <div x-show="open" x-cloak x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-sm text-[#0a1033] font-medium hover:bg-gray-50 transition">
                                Mon Espace
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 font-medium hover:bg-red-50 transition">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2.5 sm:px-5 sm:py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm backdrop-blur-md border border-white/20 transition duration-200">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2.5 sm:px-5 sm:py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-red-600/25 transition duration-200">
                        Inscription
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- MESSAGES FLASH -->
    @if(session('success'))
        <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-800 text-sm text-center py-3 px-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('info'))
        <div class="bg-blue-50 border-b border-blue-200 text-blue-800 text-sm text-center py-3 px-4">
            {{ session('info') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-b border-red-200 text-red-800 text-sm text-center py-3 px-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- CONTENU PRINCIPAL -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- PIED DE PAGE / FOOTER -->
    <footer class="bg-[#0a1033] text-gray-300 border-t border-red-600/20 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white text-lg font-bold mb-4">KANTSA <span class="text-red-500">International</span></h3>
                <p class="text-sm text-gray-400">
                    Accompagnement pour l'obtention de bourses d'études internationales et formation en langues étrangères.
                </p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Bourses d'études</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-red-400 transition">Allemagne</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Canada</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">France</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Chine</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Écoles de langues</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-red-400 transition">Allemand (A1 - C1)</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Anglais IELTS / TOEFL</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Préparation aux Visas</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Contact Cameroun</h4>
                <p class="text-sm text-gray-400 mb-1">📍 Douala / Yaoundé, Cameroun</p>
                <p class="text-sm text-gray-400 mb-1">📞 +237 600 00 00 00</p>
                <p class="text-sm text-gray-400">✉️ contact@kantsainstitute.cm</p>
            </div>
        </div>
        <div class="border-t border-red-600/10 py-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} KANTSA International Institute - Tous droits réservés.
        </div>
    </footer>

</body>
</html>
