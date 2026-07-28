<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Cabinet Bourses & Langues'))</title>

    <!-- Importation Tailwind CSS v4 via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen text-gray-800 font-sans antialiased">

    <!-- 1. EN-TÊTE / NAVBAR -->
    <header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-xs">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            <!-- Logo & Nom -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-xl text-blue-900">
                    <span class="p-2 bg-blue-600 text-white rounded-lg text-sm">🎓</span>
                    <span>Bourse<span class="text-blue-600">Services</span></span>
                </a>
            </div>

            <!-- Liens principaux -->
            <div class="hidden md:flex items-center gap-8 font-medium text-sm text-gray-700">
                <a href="{{ url('/') }}" class="hover:text-blue-600 transition">Accueil</a>
                <a href="#" class="hover:text-blue-600 transition">Nos Bourses</a>
                <a href="#" class="hover:text-blue-600 transition">Cours de Langues</a>
                <a href="#" class="hover:text-blue-600 transition">Services</a>
                <a href="#" class="hover:text-blue-600 transition">Contact</a>
            </div>

            <!-- Espace Connexion / Inscription -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="#" class="text-sm font-semibold text-gray-700 hover:text-blue-600">Mon Compte</a>
                @else
                    <a href="#" class="text-sm font-semibold text-gray-700 hover:text-blue-600 px-3 py-2">Connexion</a>
                    <a href="#" class="text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-xs transition">
                        Postuler
                    </a>
                @endauth
            </div>

        </nav>
    </header>

    <!-- 2. CONTENU PRINCIPAL (Incrusté par les vues enfants) -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 3. PIED DE PAGE / FOOTER -->
    <footer class="bg-blue-950 text-gray-300 border-t border-blue-900 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white text-lg font-bold mb-4">BourseServices</h3>
                <p class="text-sm text-gray-400">
                    Accompagnement pour l'obtention de bourses d'études internationales et formation en langues étrangères.
                </p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Bourses d'études</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Allemagne</a></li>
                    <li><a href="#" class="hover:text-white transition">Canada</a></li>
                    <li><a href="#" class="hover:text-white transition">France</a></li>
                    <li><a href="#" class="hover:text-white transition">Chine</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Écoles de langues</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Allemand (A1 - C1)</a></li>
                    <li><a href="#" class="hover:text-white transition">Anglais IELTS / TOEFL</a></li>
                    <li><a href="#" class="hover:text-white transition">Préparation aux Visas</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Contact Cameroun</h4>
                <p class="text-sm text-gray-400 mb-1">📍 Douala / Yaoundé, Cameroun</p>
                <p class="text-sm text-gray-400 mb-1">📞 +237 600 00 00 00</p>
                <p class="text-sm text-gray-400">✉️ contact@bourse-services.cm</p>
            </div>
        </div>
        <div class="border-t border-blue-900 py-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} BourseServices - Tous droits réservés.
        </div>
    </footer>

</body>
</html>