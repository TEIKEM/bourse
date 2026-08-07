@extends('layouts.app')

@section('title', 'Mon Espace - KANTSA International Institute')

@section('content')

    <section class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-black text-[#0a1033]">Bonjour, {{ auth()->user()->name }} 👋</h1>
                <p class="text-sm text-slate-500 mt-1">Retrouve ici le suivi de tes candidatures et inscriptions.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- MES CANDIDATURES AUX BOURSES -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6">
                    <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Mes candidatures aux bourses</h2>
                    <div class="space-y-3">
                        @forelse($applications as $app)
                            <a href="{{ route('scholarships.show', $app->scholarship->id) }}" class="block p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-red-200 transition">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="font-semibold text-[#0a1033] text-sm">{{ $app->scholarship->title }}</p>
                                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                        {{ $app->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($app->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600') }}">
                                        {{ $app->status }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500">{{ $app->scholarship->flag }} {{ $app->scholarship->university }} • {{ $app->scholarship->country }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-400 mb-3">Tu n'as encore postulé à aucune bourse.</p>
                            <a href="{{ route('scholarships.index') }}" class="inline-block text-xs font-bold text-red-600 uppercase tracking-wider">Découvrir les bourses &rarr;</a>
                        @endforelse
                    </div>
                </div>

                <!-- MES INSCRIPTIONS AUX COURS -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6">
                    <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Mes inscriptions aux cours</h2>
                    <div class="space-y-3">
                        @forelse($enrollments as $enr)
                            <a href="{{ route('language-courses.show', $enr->courseSession->id) }}" class="block p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-red-200 transition">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="font-semibold text-[#0a1033] text-sm">{{ $enr->courseSession->title }}</p>
                                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                        {{ $enr->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($enr->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600') }}">
                                        {{ $enr->status }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500">🏢 {{ $enr->courseSession->location }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-400 mb-3">Tu n'es inscrit(e) à aucun cours pour le moment.</p>
                            <a href="{{ route('language-courses.index') }}" class="inline-block text-xs font-bold text-red-600 uppercase tracking-wider">Voir les cours disponibles &rarr;</a>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
