@extends('layouts.app')

@section('title', 'KANTSA International Institute - Bourses d\'Études & École de Langues au Cameroun')

@section('content')

    {{--
        NOTE POUR TES PROPRES IMAGES :
        Chaque section a sa propre image de fond, chargée depuis public/images/...
        Tant que le fichier n'existe pas, onerror bascule automatiquement sur une
        belle image de remplacement (Unsplash) cohérente avec le sujet.
        Dépose simplement tes photos aux emplacements suivants (mêmes noms) :
          - public/images/hero-bg.jpg        (photo générale : étudiants / voyage)
          - public/images/services-bg.jpg    (photo accompagnement / bureau / conseil)
          - public/images/langues-bg.jpg     (photo salle de classe / cours de langue)
          - public/images/bourses-bg.jpg     (photo campus / remise de diplôme)
          - public/images/temoignages-bg.jpg (photo étudiants heureux / groupe)
    --}}

    <!-- 1. HERO SECTION — image entièrement visible, pas de carte opaque dessus -->
    <section class="relative min-h-[75vh] flex flex-col justify-center bg-[#0a1033] text-white overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-students.jpg') }}"
                 alt="KANTSA International Institute - Étudier à l'international"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1920&auto=format&fit=crop';">

            <!-- Voile très léger : l'image reste bien visible, juste assez de contraste pour lire le texte -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a1033]/90 via-[#0a1033]/25 to-[#0a1033]/40"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full text-center">

            <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-red-600/20 border border-red-500/30 text-red-300 text-xs sm:text-sm font-semibold backdrop-blur-md mb-6">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-ping"></span>
                KANTSA International Institute • Douala & Yaoundé
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight drop-shadow-lg mb-6">
                Votre passeport pour étudier à <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-red-300 to-blue-300">l'International</span> avec <span class="text-red-500">KANTSA</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-100 max-w-2xl mx-auto font-normal leading-relaxed drop-shadow-md mb-8">
                KANTSA International Institute accompagne les étudiants au Cameroun pour l'obtention de bourses, les admissions universitaires et la maîtrise rapide des langues étrangères (Allemand A1-C1, IELTS).
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-2 mb-12">
                <a href="#bourses" class="px-8 py-4 bg-red-600 hover:bg-red-500 text-white font-bold rounded-2xl shadow-xl shadow-red-600/30 transition-all duration-300 text-center transform hover:-translate-y-1">
                    Explorer nos Bourses
                </a>
                <a href="#langues" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold rounded-2xl backdrop-blur-md transition-all duration-300 text-center transform hover:-translate-y-1">
                    Centre de Langues
                </a>
            </div>

            <div class="grid grid-cols-3 gap-6 border-t border-white/15 max-w-lg mx-auto pt-8">
                <div>
                    <p class="text-2xl sm:text-3xl font-black text-white">+500</p>
                    <p class="text-xs text-slate-300 font-medium mt-1">Étudiants installés</p>
                </div>
                <div>
                    <p class="text-2xl sm:text-3xl font-black text-red-400">95%</p>
                    <p class="text-xs text-slate-300 font-medium mt-1">Succès Visas</p>
                </div>
                <div>
                    <p class="text-2xl sm:text-3xl font-black text-white">15+</p>
                    <p class="text-xs text-slate-300 font-medium mt-1">Pays Partenaires</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 1bis. BANDE FORMULAIRE — séparée de l'image, ne masque plus rien -->
    <section class="relative bg-[#0a1033] border-t border-white/10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
            <div class="bg-white rounded-3xl shadow-2xl p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-[#0a1033]">Évaluation Gratuite</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Testez votre éligibilité à un projet d'études avec KANTSA</p>
                    </div>
                </div>

                <form action="{{ route('applications.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                    @csrf

                    @if(!auth()->check())
                        <input type="text" name="name" required placeholder="Nom & Prénom" class="lg:col-span-1 px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm text-slate-800 placeholder-slate-400 outline-none transition">
                        <input type="email" name="email" required placeholder="Adresse Email" class="lg:col-span-1 px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm text-slate-800 placeholder-slate-400 outline-none transition">
                    @endif

                    <input type="tel" name="phone" required placeholder="Téléphone / WhatsApp" class="lg:col-span-1 px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm text-slate-800 placeholder-slate-400 outline-none transition">

                    <select name="country" required class="lg:col-span-1 px-3 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                        <option value="">Destination</option>
                        <option value="DE">Allemagne</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="CN">Chine</option>
                        <option value="IT">Italie</option>
                    </select>

                    <select name="level" required class="lg:col-span-1 px-3 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                        <option value="">Niveau Actuel</option>
                        <option value="bac">Baccalauréat</option>
                        <option value="licence">Licence</option>
                        <option value="master">Master</option>
                    </select>

                    <button type="submit" class="sm:col-span-2 lg:col-span-5 py-3.5 mt-1 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition duration-300 text-xs tracking-wider uppercase">
                        Tester mon Éligibilité
                    </button>
                </form>
            </div>
        </div>
        <div class="text-center pt-10 pb-4">
            <a href="#services" class="inline-flex flex-col items-center text-slate-400 hover:text-white transition group">
                <span class="text-[11px] font-semibold tracking-wider uppercase mb-1.5 group-hover:text-red-400 transition">Découvrir nos offres</span>
                <span class="text-xl animate-bounce">↓</span>
            </a>
        </div>
    </section>

    <!-- 2. NOS SERVICES — image de fond visible -->
    <section id="services" class="relative py-20 lg:py-28 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/services-bg.jpg') }}"
                 alt="Accompagnement KANTSA"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/78"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-red-400 uppercase tracking-widest mb-3">Un accompagnement complet avec KANTSA</h2>
                <p class="text-3xl font-black text-white sm:text-4xl">Nos Domaines d'Expertise</p>
                <p class="text-slate-300 mt-4 leading-relaxed">Des solutions structurées pour concrétiser vos ambitions d'études à l'étranger.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 hover:border-red-400/40 hover:bg-white/15 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-red-500/20 text-red-300 border border-red-400/30 flex items-center justify-center text-2xl font-bold mb-6 group-hover:scale-110 transition">
                            🎓
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Bourses & Admissions</h3>
                        <p class="text-slate-300 text-sm leading-relaxed mb-6">
                            Sélection de bourses, montage du dossier académique et négociation d'exemptions de frais de scolarité.
                        </p>
                    </div>
                    <a href="#bourses" class="text-xs font-bold text-red-300 group-hover:text-red-200 inline-flex items-center gap-1 uppercase tracking-wider">Découvrir les Bourses &rarr;</a>
                </div>

                <div class="p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 hover:border-blue-300/40 hover:bg-white/15 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-blue-400/20 text-blue-200 border border-blue-300/30 flex items-center justify-center text-2xl font-bold mb-6 group-hover:scale-110 transition">
                            🗣️
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">École de Langues</h3>
                        <p class="text-slate-300 text-sm leading-relaxed mb-6">
                            Formations intensives en Allemand (A1 à C1) et Anglais (IELTS/TOEFL) dispensées par nos enseignants certifiés.
                        </p>
                    </div>
                    <a href="#langues" class="text-xs font-bold text-blue-200 group-hover:text-blue-100 inline-flex items-center gap-1 uppercase tracking-wider">Voir les sessions &rarr;</a>
                </div>

                <div class="p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 hover:border-red-400/40 hover:bg-white/15 transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-red-500/20 text-red-300 border border-red-400/30 flex items-center justify-center text-2xl font-bold mb-6 group-hover:scale-110 transition">
                            📁
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Visa & Installation</h3>
                        <p class="text-slate-300 text-sm leading-relaxed mb-6">
                            Assistance pour compte bloqué, assurance voyage, réservation de logement et préparation aux entretiens consulaires.
                        </p>
                    </div>
                    <a href="#" class="text-xs font-bold text-red-300 group-hover:text-red-200 inline-flex items-center gap-1 uppercase tracking-wider">En savoir plus &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. PÔLE ÉCOLE DE LANGUES — image de fond visible -->
    <section id="langues" class="relative py-20 lg:py-28 text-white overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/langues-bg.jpg') }}"
                 alt="Cours de langues KANTSA"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/75"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <div class="lg:col-span-6 space-y-6">
                    <span class="inline-block px-3.5 py-1 rounded-full bg-red-600/20 border border-red-500/30 text-red-300 text-xs font-bold uppercase tracking-widest">
                        Centre Agréé KANTSA
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight drop-shadow-md">
                        Apprenez l'Allemand & l'Anglais avec nos Experts
                    </h2>
                    <p class="text-slate-100 leading-relaxed drop-shadow-sm">
                        Pour étudier en Allemagne ou au Canada, la préparation linguistique est essentielle. Nos centres préparent efficacement aux diplômes officiels (Goethe-Institut, ÖSD, IELTS).
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-red-600/20 text-red-300 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                            <p class="text-sm text-white font-medium drop-shadow-sm">Niveaux A1, A2, B1, B2 et C1 avec suivi individuel</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-red-600/20 text-red-300 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                            <p class="text-sm text-white font-medium drop-shadow-sm">Programmes Intensifs du jour, du soir et du week-end</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-red-600/20 text-red-300 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                            <p class="text-sm text-white font-medium drop-shadow-sm">Examens blancs réguliers et simulations d'entretien d'ambassade</p>
                        </div>
                    </div>

                    <div class="pt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-[#0a1033]/60 backdrop-blur-md rounded-2xl border border-white/15">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="text-red-400">📍</span>
                                <p class="text-sm font-bold text-white">Campus Douala</p>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Akwa, Immeuble ABC (2ème étage), face direction générale</p>
                        </div>
                        <div class="p-4 bg-[#0a1033]/60 backdrop-blur-md rounded-2xl border border-white/15">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="text-red-400">📍</span>
                                <p class="text-sm font-bold text-white">Campus Yaoundé</p>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">Bastos, Immeuble Le Progrès (à 100m du carrefour Migoa)</p>
                        </div>
                    </div>

                    <div class="pt-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-6 py-4 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition inline-block text-xs uppercase tracking-wider">
                                Réserver mes cours sur mon espace
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-6 py-4 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition inline-block text-xs uppercase tracking-wider">
                                S'inscrire à une session de langue
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="lg:col-span-6 bg-[#0a1033]/55 backdrop-blur-xl border border-white/15 rounded-3xl p-6 sm:p-8 shadow-2xl">
                    <h3 class="text-xl font-bold text-white mb-1">Prochaines rentrées de langues</h3>
                    <p class="text-xs text-slate-300 mb-6">Effectifs réduits par classe (15 élèves maximum).</p>

                    <div class="space-y-4">
                        @forelse($sessions as $session)
                            <div class="p-4 bg-white/10 rounded-2xl border border-white/15 hover:border-red-400/50 transition">
                                <div class="flex justify-between items-start mb-2 gap-2">
                                    <span class="text-xs font-bold px-3 py-1 rounded-lg bg-blue-400/20 text-blue-200 border border-blue-300/30 uppercase">
                                        {{ $session->title }}
                                    </span>
                                    <span class="px-3 py-1 bg-red-500/20 text-red-200 border border-red-400/30 text-xs font-bold rounded-lg shrink-0">
                                        {{ $session->start_date }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 text-xs font-medium text-slate-200 mt-2">
                                    <span>🏢 {{ $session->location }}</span>
                                    @if(isset($session->address))
                                        <span class="text-slate-400">({{ $session->address }})</span>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between text-xs text-slate-300 mt-3 pt-3 border-t border-white/10">
                                    <span>Horaire : <strong class="text-white">{{ $session->schedule ?? '08h00 - 12h00' }}</strong></span>
                                    <span>Durée : <strong class="text-white">{{ $session->duration }}</strong></span>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 bg-white/5 rounded-2xl border border-white/10 text-center text-xs text-slate-300">
                                Aucune session ouverte pour le moment.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. CATALOGUE DES BOURSES — image de fond visible -->
    <section id="bourses" class="relative py-20 lg:py-28 text-white bg-blue-950 overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/bourses-bg.jpg') }}"
                 alt="Bourses d'études KANTSA"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/78"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-xs font-bold text-red-400 uppercase tracking-widest mb-2">Partir étudier avec KANTSA</h2>
                    <p class="text-3xl font-black text-white sm:text-4xl">Programmes de Bourses Actifs</p>
                    <p class="text-sm text-slate-300 mt-2">Sélectionnez votre destination et découvrez les opportunités prises en charge.</p>
                </div>
                <a href="#" class="text-xs font-bold text-red-400 hover:text-red-300 uppercase tracking-wider inline-flex items-center gap-1 shrink-0">
                    Voir tout le catalogue &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($scholarships as $scholarship)
                    <div class="bg-[#0a1033]/85 backdrop-blur-md rounded-3xl border border-white/10 overflow-hidden shadow-xl hover:border-red-400/40 transition duration-300 flex flex-col justify-between group">

                        <div class="h-48 w-full relative overflow-hidden bg-slate-800">
                            <img src="{{ $scholarship->image_url ?? asset('images/scholarship-default.jpg') }}"
                                 alt="{{ $scholarship->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?q=80&w=600&auto=format&fit=crop';">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a1033] via-transparent to-black/30"></div>

                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                                <span class="px-3 py-1 bg-[#0a1033] text-white font-bold text-[11px] rounded-full shadow-md border border-white/20">
                                    {{ $scholarship->type }}
                                </span>
                                <span class="text-[11px] font-bold text-white bg-red-600 px-2.5 py-1 rounded-md shadow-md">
                                    {{ $scholarship->status_badge }}
                                </span>
                            </div>

                            <div class="absolute bottom-3 left-3 text-white font-semibold text-xs flex items-center gap-1">
                                <span>{{ $scholarship->flag }}</span>
                                <span>{{ $scholarship->university }}</span> • <span>{{ $scholarship->country }}</span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-white mb-2 leading-snug">{{ $scholarship->title }}</h3>

                                <p class="text-xs text-slate-300 mb-6 leading-relaxed line-clamp-3">
                                    {{ $scholarship->description }}
                                </p>
                            </div>

                            <div class="space-y-2 pt-4 border-t border-white/10">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Niveau requis :</span>
                                    <span class="font-bold text-white bg-white/10 px-2.5 py-1 rounded-md border border-white/15">{{ $scholarship->level }}</span>
                                </div>

                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Prise en charge :</span>
                                    <span class="font-bold text-red-400">{{ $scholarship->coverage ?? 'Scolarité + Logement' }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white/5 rounded-3xl border border-white/10">
                        <p class="text-slate-300 text-sm">Aucune offre disponible actuellement.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. TÉMOIGNAGES — image de fond visible -->
    <section class="relative py-20 lg:py-28 text-white overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/temoignages-bg.jpg') }}"
                 alt="Étudiants KANTSA"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1523580494863-6f3031224c94?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/80"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-red-400 uppercase tracking-widest mb-2">Expériences Vécues</h2>
                <p class="text-3xl font-black text-white sm:text-4xl">Ils ont réussi avec KANTSA</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 flex flex-col justify-between">
                    <p class="text-slate-100 text-sm italic mb-6 leading-relaxed">
                        "Grâce à l'accompagnement de KANTSA, j'ai obtenu mon visa d'études pour l'Allemagne et réussi le test B2 d'Allemand du premier coup."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-red-500/20 border border-red-400/30 text-red-300 flex items-center justify-center font-bold text-sm">
                            KA
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">Karl A.</p>
                            <p class="text-xs text-slate-300">Étudiant à Munich, Allemagne</p>
                        </div>
                    </div>
                </div>

                <div class="p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 flex flex-col justify-between">
                    <p class="text-slate-100 text-sm italic mb-6 leading-relaxed">
                        "Le suivi pour la bourse canadienne a été irréprochable. De la constitution du dossier à l'arrivée sur le campus, l'équipe est restée disponible."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-400/20 border border-blue-300/30 text-blue-200 flex items-center justify-center font-bold text-sm">
                            MN
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">Marie N.</p>
                            <p class="text-xs text-slate-300">Boursière à Montréal, Canada</p>
                        </div>
                    </div>
                </div>

                <div class="p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 flex flex-col justify-between">
                    <p class="text-slate-100 text-sm italic mb-6 leading-relaxed">
                        "Les cours d'IELTS au centre de Yaoundé sont très bien structurés. J'ai obtenu un score de 7.5 en 2 mois de préparation."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-red-500/20 border border-red-400/30 text-red-300 flex items-center justify-center font-bold text-sm">
                            PT
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">Patrick T.</p>
                            <p class="text-xs text-slate-300">Étudiant, Campus Yaoundé</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
