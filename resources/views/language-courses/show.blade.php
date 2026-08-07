@extends('layouts.app')

@section('title', $course->title . ' - KANTSA International Institute')

@section('content')

    <!-- BANNIÈRE -->
    <section class="relative py-16 lg:py-24 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $course->image_url ?? asset('images/langues-listing-bg.jpg') }}"
                 alt="{{ $course->title }}"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/85"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="text-xs text-slate-300 mb-4">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('language-courses.index') }}" class="hover:text-red-400 transition">École de Langues</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold">{{ $course->title }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="px-3 py-1 bg-[#0a1033] border border-white/20 text-white font-bold text-[11px] rounded-full">
                    {{ $course->language }} — {{ $course->level }}
                </span>
                @if($course->status_badge)
                    <span class="text-[11px] font-bold text-white bg-red-600 px-2.5 py-1 rounded-md">
                        {{ $course->status_badge }}
                    </span>
                @endif
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-3">{{ $course->title }}</h1>
            <p class="text-slate-200 text-sm sm:text-base">
                🏢 {{ $course->location }} @if($course->address) — {{ $course->address }} @endif
            </p>
        </div>
    </section>

    <!-- CONTENU -->
    <section class="py-16 lg:py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- Colonne principale -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8">
                    <h2 class="text-lg font-bold text-[#0a1033] mb-4">Description du cours</h2>
                    <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $course->description ?? "Description à venir." }}</p>
                </div>

                @if($related->count())
                    <div>
                        <h2 class="text-lg font-bold text-[#0a1033] mb-4">Autres cours en {{ $course->language }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach($related as $item)
                                <a href="{{ route('language-courses.show', $item->id) }}" class="block bg-white rounded-2xl border border-gray-200 p-4 hover:border-red-300 hover:shadow-md transition">
                                    <p class="text-xs font-bold text-red-600 mb-1">{{ $item->level }}</p>
                                    <p class="text-sm font-semibold text-[#0a1033] leading-snug">{{ $item->title }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Colonne latérale : infos clés + CTA -->
            <div class="space-y-6">
                <div class="bg-[#0a1033] rounded-3xl p-6 sm:p-8 text-white sticky top-24">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-red-400 mb-6">Informations clés</h3>

                    <div class="space-y-4 text-sm">
                        <div class="flex items-center justify-between pb-3 border-b border-white/10">
                            <span class="text-slate-400">Mode</span>
                            <span class="font-bold text-white">{{ $course->mode }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b border-white/10">
                            <span class="text-slate-400">Durée</span>
                            <span class="font-bold text-white">{{ $course->duration ?? 'Non précisée' }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b border-white/10">
                            <span class="text-slate-400">Horaire</span>
                            <span class="font-bold text-white">{{ $course->schedule ?? 'Non précisé' }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b border-white/10">
                            <span class="text-slate-400">Prochaine rentrée</span>
                            <span class="font-bold text-red-400">{{ $course->formatted_start_date ?? 'À venir' }}</span>
                        </div>
                        @if($course->capacity)
                            <div class="flex items-center justify-between pb-3 border-b border-white/10">
                                <span class="text-slate-400">Places</span>
                                <span class="font-bold text-white">{{ $course->capacity }} max</span>
                            </div>
                        @endif
                        @if($course->price)
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Tarif</span>
                                <span class="font-bold text-white">{{ $course->formatted_price }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('courses.enroll', $course->id) }}" class="mt-8 block text-center py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-xs uppercase tracking-wider">
                        S'inscrire à ce cours
                    </a>
                </div>
            </div>

        </div>
    </section>

@endsection
