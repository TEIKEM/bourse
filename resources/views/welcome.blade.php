@extends('layouts.app')

@section('title', 'Accueil - Bourses d\'Études & École de Langues au Cameroun')

@section('content')

    <!-- 1. HERO SECTION -->
    <section class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-indigo-950 text-white overflow-hidden py-20 lg:py-28">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs sm:text-sm font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sessions de cours d'Allemand A1-C1 ouvertes à Douala & Yaoundé
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                    Votre passeport pour étudier à <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">l'International</span>
                </h1>

                <p class="text-lg text-gray-300 max-w-2xl mx-auto lg:mx-0">
                    Nous accompagnons les étudiants camerounais dans l'obtention de bourses d'études, l'admission universitaire et l'apprentissage intensif des langues étrangères.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                    <a href="#bourses" class="px-7 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 transition-all text-center">
                        Explorer les bourses
                    </a>
                    <a href="#langues" class="px-7 py-3.5 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold rounded-xl backdrop-blur-xs transition-all text-center">
                        Nos cours de langues
                    </a>
                </div>

                <!-- Proof points -->
                <div class="pt-8 grid grid-cols-3 gap-4 border-t border-blue-800/60 max-w-lg mx-auto lg:mx-0">
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-white">+500</p>
                        <p class="text-xs text-gray-400">Étudiants partis</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-emerald-400">95%</p>
                        <p class="text-xs text-gray-400">Taux de visa</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-white">15+</p>
                        <p class="text-xs text-gray-400">Pays partenaires</p>
                    </div>
                </div>
            </div>

            <!-- Formulaire rapide de recherche / contact -->
            <div class="lg:col-span-5 bg-white text-gray-900 rounded-2xl p-6 sm:p-8 shadow-2xl border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-1">Évaluer mon éligibilité</h3>
                <p class="text-sm text-gray-500 mb-6">Recevez un accompagnement personnalisé gratuitement.</p>

                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Nom complet</label>
                        <input type="text" placeholder="Ex: Paul Biya" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Téléphone (WhatsApp)</label>
                        <input type="tel" placeholder="+237 6..." class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Destination souhaitée</label>
                        <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-sm bg-white">
                            <option value="">Sélectionner un pays</option>
                            <option value="DE">Allemagne</option>
                            <option value="CA">Canada</option>
                            <option value="FR">France</option>
                            <option value="CN">Chine</option>
                            <option value="IT">Italie</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Niveau d'études actuel</label>
                        <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-sm bg-white">
                            <option value="bac">Baccalauréat</option>
                            <option value="licence">Licence / Bachelor</option>
                            <option value="master">Master</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition">
                        Soumettre mon dossier
                    </button>
                </form>
            </div>

        </div>
    </section>

    <!-- 2. NOS SERVICES PRINCIPAUX -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">Un accompagnement de A à Z</h2>
                <p class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Nos Pôles d'Expertise</p>
                <p class="text-gray-600 mt-4">Des solutions structurées pour transformer votre projet d'études en réussite concrète.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-blue-200 hover:shadow-xl transition group">
                    <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-blue-600 group-hover:text-white transition">
                        🎓
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Bourses & Admissions</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Recherche ciblée de bourses partielles et complètes, constitution du dossier académique et négociation d'exemptions.
                    </p>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 inline-flex items-center gap-1">En savoir plus &rarr;</a>
                </div>

                <!-- Service 2 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-blue-200 hover:shadow-xl transition group">
                    <div class="w-14 h-14 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-emerald-600 group-hover:text-white transition">
                        🗣️
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">École de Langues</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Formations intensives en Allemand (A1 à C1), Anglais (IELTS/TOEFL) préparées par des enseignants certifiés.
                    </p>
                    <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-800 inline-flex items-center gap-1">Consulter le planning &rarr;</a>
                </div>

                <!-- Service 3 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-blue-200 hover:shadow-xl transition group">
                    <div class="w-14 h-14 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl font-bold mb-6 group-hover:bg-indigo-600 group-hover:text-white transition">
                        📁
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Visa & Installation</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Assistance pour le compte bloqué, assurance santé internationale, rendez-vous d'ambassade et logement.
                    </p>
                    <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-1">Voir nos garanties &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. BOURSES RECENTES (Cartes) -->
    <section id="bourses" class="py-16 lg:py-24 bg-gray-50 border-y border-gray-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <h2 class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">Opportunités du moment</h2>
                    <p class="text-3xl font-extrabold text-gray-900">Bourses Ouvertes à la Candidature</p>
                </div>
                <a href="#" class="mt-4 md:mt-0 text-sm font-semibold text-blue-600 hover:text-blue-800 inline-flex items-center gap-1">
                    Voir toutes les bourses (48) &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Card Bourse 1 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs hover:shadow-lg transition flex flex-col">
                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 font-semibold text-xs rounded-full">Bourse Complète</span>
                            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-md">J-15 avant clôture</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Bourse d'Excellence DAAD</h3>
                        <p class="text-xs text-gray-500 mb-4">🇩🇪 Université Technique de Munich • Allemagne</p>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Prise en charge totale des frais de scolarité, billet d'avion et allocation mensuelle de 934€.
                        </p>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="text-gray-500">Niveau : <strong class="text-gray-800">Master / Doctorat</strong></span>
                        <a href="#" class="font-bold text-blue-600 hover:underline">Postuler &rarr;</a>
                    </div>
                </div>

                <!-- Card Bourse 2 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs hover:shadow-lg transition flex flex-col">
                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start gap-2 mb-4">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 font-semibold text-xs rounded-full">Exemption Partielle</span>
                            <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-md">Ouvert</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Exemption de Frais Majorés</h3>
                        <p class="text-xs text-gray-500 mb-4">🇨🇦 Université de Montréal • Canada</p>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Réduction importante des droits de scolarité pour les étudiants francophones du Cameroun.
                        </p>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="text-gray-500">Niveau : <strong class="text-gray-800">Licence / Master</strong></span>
                        <a href="#" class="font-bold text-blue-600 hover:underline">Postuler &rarr;</a>
                    </div>
                </div>

                <!-- Card Bourse 3 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs hover:shadow-lg transition flex flex-col">
                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 font-semibold text-xs rounded-full">Bourse Gouvernementale</span>
                            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-md">Places limitées</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Bourse CSC Chinoise</h3>
                        <p class="text-xs text-gray-500 mb-4">🇨🇳 Tsinghua University • Chine</p>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Logement sur le campus, assurance médicale et allocation mensuelle pour programmes en anglais.
                        </p>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="text-gray-500">Niveau : <strong class="text-gray-800">Touts Niveaux</strong></span>
                        <a href="#" class="font-bold text-blue-600 hover:underline">Postuler &rarr;</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. PÔLE ECOLE DE LANGUES -->
    <section id="langues" class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Centre de préparation intensif</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                        Apprenez l'Allemand & l'Anglais avec nos Experts
                    </h2>
                    <p class="text-gray-600">
                        Pour l'Allemagne, la maîtrise de la langue est la clé d'obtention du visa. Nos centres de Douala et Yaoundé vous préparent aux examens officiels du Goethe-Institut et de l'IELTS.
                    </p>

                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <span class="p-1 bg-emerald-100 text-emerald-700 rounded-md text-xs font-bold">✓</span>
                            <p class="text-sm text-gray-700 font-medium">Niveaux A1, A2, B1, B2 et C1 avec professeurs certifiés</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="p-1 bg-emerald-100 text-emerald-700 rounded-md text-xs font-bold">✓</span>
                            <p class="text-sm text-gray-700 font-medium">Cours du jour, cours du soir et sessions intensives de week-end</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="p-1 bg-emerald-100 text-emerald-700 rounded-md text-xs font-bold">✓</span>
                            <p class="text-sm text-gray-700 font-medium">Simulations d'examens et préparation aux entretiens d'ambassade</p>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="#" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-xl shadow-md transition inline-block">
                            S'inscrire à une session
                        </a>
                    </div>
                </div>

                <!-- Tableau du planning -->
                <div class="lg:col-span-6 bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Prochaines rentrées programmées</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-white rounded-xl border border-gray-200 flex justify-between items-center">
                            <div>
                                <span class="text-xs font-bold text-blue-600 uppercase">Allemand B1 Intensive</span>
                                <p class="text-sm font-semibold text-gray-800">Centre de Douala (Akwa)</p>
                                <p class="text-xs text-gray-500">Durée : 8 semaines</p>
                            </div>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg">15 Août</span>
                        </div>

                        <div class="p-4 bg-white rounded-xl border border-gray-200 flex justify-between items-center">
                            <div>
                                <span class="text-xs font-bold text-blue-600 uppercase">Allemand A1 Débutant</span>
                                <p class="text-sm font-semibold text-gray-800">Centre de Yaoundé (Bastos)</p>
                                <p class="text-xs text-gray-500">Durée : 10 semaines</p>
                            </div>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg">01 Septembre</span>
                        </div>

                        <div class="p-4 bg-white rounded-xl border border-gray-200 flex justify-between items-center">
                            <div>
                                <span class="text-xs font-bold text-indigo-600 uppercase">IELTS Preparation</span>
                                <p class="text-sm font-semibold text-gray-800">En Ligne & Présentiel</p>
                                <p class="text-xs text-gray-500">Durée : 4 semaines</p>
                            </div>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg">10 Septembre</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. TÉMOIGNAGES -->
    <section class="py-16 lg:py-24 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-blue-400 uppercase tracking-widest mb-2">Ils sont déjà installés</h2>
                <p class="text-3xl font-extrabold sm:text-4xl">Témoignages de nos Étudiants</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Témoignage 1 -->
                <div class="p-6 rounded-2xl bg-gray-800/80 border border-gray-700/80 flex flex-col justify-between">
                    <p class="text-gray-300 text-sm italic mb-6">
                        "Grâce à l'équipe, j'ai obtenu mon visa pour l'Allemagne et validé mon test B2 du premier coup. L'accompagnement pour le compte bloqué m'a évité beaucoup de stress."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-sm">
                            MN
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Marc Nkwenti</p>
                            <p class="text-xs text-gray-400">Étudiant à TU Berlin (Allemagne)</p>
                        </div>
                    </div>
                </div>

                <!-- Témoignage 2 -->
                <div class="p-6 rounded-2xl bg-gray-800/80 border border-gray-700/80 flex flex-col justify-between">
                    <p class="text-gray-300 text-sm italic mb-6">
                        "J'ai pu décrocher une bourse d'exemption au Canada en Master. Le cabinet m'a aidé à rédiger ma lettre de motivation et à structurer mon projet d'études."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-600 flex items-center justify-center font-bold text-sm">
                            SE
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Sandra Kamga</p>
                            <p class="text-xs text-gray-400">Université de Laval (Canada)</p>
                        </div>
                    </div>
                </div>

                <!-- Témoignage 3 -->
                <div class="p-6 rounded-2xl bg-gray-800/80 border border-gray-700/80 flex flex-col justify-between">
                    <p class="text-gray-300 text-sm italic mb-6">
                        "Une équipe très professionnelle à Douala. Transparence totale sur les coûts et suivi personnalisé du début jusqu'à mon arrivée en Chine."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-amber-600 flex items-center justify-center font-bold text-sm">
                            AT
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Alain Tagne</p>
                            <p class="text-xs text-gray-400">Wuhan University (Chine)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection