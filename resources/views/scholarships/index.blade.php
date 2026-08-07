@extends('layouts.app')

@section('title', 'Toutes les Bourses - KANTSA International Institute')

@section('content')

    {{--
        NOTE : dépose ta photo dans public/images/bourses-listing-bg.jpg
        pour remplacer le fallback Unsplash utilisé ci-dessous.
        Cette vue attend :
          - $scholarships : collection paginée (Bourse::paginate())
          - $countries, $domains, $levels : collections pour les filtres (optionnel)
    --}}

    <!-- BANNIÈRE DE PAGE -->
    <section class="relative py-16 lg:py-20 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/bourses-listing-bg.jpg') }}"
                 alt="Catalogue des bourses KANTSA"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/85"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="text-xs text-slate-300 mb-4">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Accueil</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold">Bourses d'Études</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-3">Toutes nos Bourses d'Études</h1>
            <p class="text-slate-300 max-w-2xl">Parcourez l'ensemble de nos programmes de bourses actifs et trouvez celui qui correspond à votre profil et votre destination.</p>
        </div>
    </section>

    <!-- BARRE DE FILTRES -->
    <section class="bg-white border-b border-gray-200 sticky top-[73px] z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <form action="{{ route('scholarships.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

                <div class="lg:col-span-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher une bourse, une université..."
                           class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                </div>

                <select name="country" class="px-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                    <option value="">Toutes les destinations</option>
                    @foreach($countries ?? ['Allemagne', 'Canada', 'France', 'Chine', 'Italie'] as $country)
                        <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>

                <select name="level" class="px-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                    <option value="">Tous les niveaux</option>
                    <option value="licence" {{ request('level') == 'licence' ? 'selected' : '' }}>Licence</option>
                    <option value="master" {{ request('level') == 'master' ? 'selected' : '' }}>Master</option>
                    <option value="doctorat" {{ request('level') == 'doctorat' ? 'selected' : '' }}>Doctorat</option>
                </select>

                <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-500 text-white font-bold text-sm rounded-xl shadow-md transition">
                    Filtrer
                </button>
            </form>
        </div>
    </section>

    <!-- LISTE DES BOURSES -->
    <section class="py-16 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-slate-500">
                    <strong class="text-[#0a1033]">{{ $scholarships->total() ?? 0 }}</strong> bourse(s) trouvée(s)
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($scholarships as $scholarship)
                    <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-xs hover:shadow-xl transition duration-300 flex flex-col justify-between group">

                        <div class="h-48 w-full relative overflow-hidden bg-slate-200">
                            <img src="{{ $scholarship->image_url ?? asset('images/scholarship-default.jpg') }}"
                                 alt="{{ $scholarship->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?q=80&w=600&auto=format&fit=crop';">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a1033]/70 via-transparent to-transparent"></div>

                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                                <span class="px-3 py-1 bg-[#0a1033] text-white font-bold text-[11px] rounded-full shadow-md">
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
                                <h3 class="text-lg font-bold text-[#0a1033] mb-2 leading-snug">{{ $scholarship->title }}</h3>
                                <p class="text-xs text-slate-500 mb-6 leading-relaxed line-clamp-3">
                                    {{ $scholarship->description }}
                                </p>
                            </div>

                            <div class="space-y-2 pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Niveau requis :</span>
                                    <span class="font-bold text-[#0a1033] bg-gray-100 px-2.5 py-1 rounded-md">{{ $scholarship->level }}</span>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Date limite :</span>
                                    <span class="font-bold text-red-600">{{ $scholarship->deadline ?? 'Non précisée' }}</span>
                                </div>
                            </div>

                            <a href="{{ route('scholarships.show', $scholarship->id ?? '') }}" class="mt-5 w-full text-center py-3 bg-[#0a1033] hover:bg-red-600 text-white font-bold text-xs rounded-xl transition uppercase tracking-wider">
                                Voir les détails
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-gray-200">
                        <p class="text-slate-400 text-sm">Aucune bourse ne correspond à ta recherche pour le moment.</p>
                        <a href="{{ route('scholarships.index') }}" class="inline-block mt-4 text-xs font-bold text-red-600 uppercase tracking-wider">Réinitialiser les filtres</a>
                    </div>
                @endforelse
            </div>

            <!-- PAGINATION -->
            @if(isset($scholarships) && $scholarships->hasPages())
                <div class="mt-12">
                    {{ $scholarships->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection
