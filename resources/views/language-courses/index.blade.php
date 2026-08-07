@extends('layouts.app')

@section('title', 'Cours de Langues - KANTSA International Institute')

@section('content')

    {{--
        NOTE : dépose ta photo dans public/images/langues-listing-bg.jpg
        pour remplacer le fallback Unsplash utilisé ci-dessous.
        Cette vue attend :
          - $courses : collection paginée (LanguageCourse::paginate())
          - $languages, $modes : collections pour les filtres
    --}}

    <!-- BANNIÈRE DE PAGE -->
    <section class="relative py-16 lg:py-20 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/langues-listing-bg.jpg') }}"
                 alt="Cours de langues KANTSA"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/85"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="text-xs text-slate-300 mb-4">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Accueil</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold">École de Langues</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-3">Nos Cours de Langues</h1>
            <p class="text-slate-300 max-w-2xl">Allemand, Anglais IELTS/TOEFL — sessions intensives à Douala et Yaoundé, avec des enseignants certifiés.</p>
        </div>
    </section>

    <!-- BARRE DE FILTRES -->
    <section class="bg-white border-b border-gray-200 sticky top-[73px] z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <form action="{{ route('language-courses.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

                <div class="lg:col-span-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un cours..."
                           class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                </div>

                <select name="language" class="px-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                    <option value="">Toutes les langues</option>
                    @foreach($languages ?? ['Allemand', 'Anglais'] as $language)
                        <option value="{{ $language }}" {{ request('language') == $language ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                </select>

                <select name="mode" class="px-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                    <option value="">Tous les modes</option>
                    @foreach($modes ?? ['Présentiel', 'En ligne', 'Hybride'] as $mode)
                        <option value="{{ $mode }}" {{ request('mode') == $mode ? 'selected' : '' }}>{{ $mode }}</option>
                    @endforeach
                </select>

                <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-500 text-white font-bold text-sm rounded-xl shadow-md transition">
                    Filtrer
                </button>
            </form>
        </div>
    </section>

    <!-- LISTE DES COURS -->
    <section class="py-16 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-slate-500">
                    <strong class="text-[#0a1033]">{{ $courses->total() ?? 0 }}</strong> cours trouvé(s)
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($courses as $course)
                    <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-xs hover:shadow-xl transition duration-300 flex flex-col justify-between group">

                        <div class="h-44 w-full relative overflow-hidden bg-slate-200">
                            <img src="{{ $course->image_url ?? asset('images/course-default.jpg') }}"
                                 alt="{{ $course->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop';">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a1033]/70 via-transparent to-transparent"></div>

                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                                <span class="px-3 py-1 bg-[#0a1033] text-white font-bold text-[11px] rounded-full shadow-md">
                                    {{ $course->language }} — {{ $course->level }}
                                </span>
                                @if($course->status_badge)
                                    <span class="text-[11px] font-bold text-white bg-red-600 px-2.5 py-1 rounded-md shadow-md">
                                        {{ $course->status_badge }}
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-3 left-3 text-white font-semibold text-xs flex items-center gap-1">
                                <span>🏢 {{ $course->location }}</span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-[#0a1033] mb-2 leading-snug">{{ $course->title }}</h3>
                                <p class="text-xs text-slate-500 mb-6 leading-relaxed line-clamp-3">
                                    {{ $course->description }}
                                </p>
                            </div>

                            <div class="space-y-2 pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Mode :</span>
                                    <span class="font-bold text-[#0a1033] bg-gray-100 px-2.5 py-1 rounded-md">{{ $course->mode }}</span>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Durée :</span>
                                    <span class="font-bold text-[#0a1033]">{{ $course->duration ?? 'Non précisée' }}</span>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Prochaine rentrée :</span>
                                    <span class="font-bold text-red-600">{{ $course->formatted_start_date ?? 'À venir' }}</span>
                                </div>
                                @if($course->capacity)
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-400">Places disponibles :</span>
                                        <span class="font-bold text-[#0a1033]">{{ $course->capacity }} max</span>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('language-courses.show', $course->id ?? '') }}" class="mt-5 w-full text-center py-3 bg-[#0a1033] hover:bg-red-600 text-white font-bold text-xs rounded-xl transition uppercase tracking-wider">
                                Voir les détails
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-gray-200">
                        <p class="text-slate-400 text-sm">Aucun cours ne correspond à ta recherche pour le moment.</p>
                        <a href="{{ route('language-courses.index') }}" class="inline-block mt-4 text-xs font-bold text-red-600 uppercase tracking-wider">Réinitialiser les filtres</a>
                    </div>
                @endforelse
            </div>

            <!-- PAGINATION -->
            @if(isset($courses) && $courses->hasPages())
                <div class="mt-12">
                    {{ $courses->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection
