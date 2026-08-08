@extends('layouts.app')

@section('title', 'Mon Espace - KANTSA International Institute')

@section('content')

    <section class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-black text-[#0a1033]">Bonjour, {{ auth()->user()->name }} 👋</h1>
                <p class="text-sm text-slate-500 mt-1">Retrouve ici le suivi de tes candidatures et inscriptions.</p>
            </div>

            <!-- RACCOURCIS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
                <a href="{{ route('student.profile.edit') }}" class="bg-white rounded-2xl border border-gray-200 hover:border-red-300 p-5 transition flex items-center gap-3">
                    <span class="text-2xl">👤</span>
                    <div>
                        <p class="text-sm font-bold text-[#0a1033]">Mon profil</p>
                        <p class="text-xs text-slate-400">Modifier mes informations</p>
                    </div>
                </a>
                <a href="{{ route('student.documents.index') }}" class="bg-white rounded-2xl border border-gray-200 hover:border-red-300 p-5 transition flex items-center gap-3">
                    <span class="text-2xl">📎</span>
                    <div>
                        <p class="text-sm font-bold text-[#0a1033]">Mes documents</p>
                        <p class="text-xs text-slate-400">Voir / remplacer mes fichiers</p>
                    </div>
                </a>
                <a href="{{ route('scholarships.index') }}" class="bg-white rounded-2xl border border-gray-200 hover:border-red-300 p-5 transition flex items-center gap-3">
                    <span class="text-2xl">🎓</span>
                    <div>
                        <p class="text-sm font-bold text-[#0a1033]">Découvrir des bourses</p>
                        <p class="text-xs text-slate-400">Voir le catalogue complet</p>
                    </div>
                </a>
            </div>

            <!-- STATISTIQUES RAPIDES -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
                <div class="bg-white rounded-2xl border border-gray-200 p-4 text-center">
                    <p class="text-2xl font-black text-[#0a1033]">{{ $applications->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Candidatures</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 p-4 text-center">
                    <p class="text-2xl font-black text-emerald-600">{{ $applications->where('status', 'accepted')->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Acceptées</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 p-4 text-center">
                    <p class="text-2xl font-black text-[#0a1033]">{{ $enrollments->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Inscriptions</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 p-4 text-center">
                    <p class="text-2xl font-black text-emerald-600">{{ $enrollments->where('status', 'confirmed')->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Confirmées</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- MES CANDIDATURES AUX BOURSES -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6">
                    <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Mes candidatures aux bourses</h2>
                    <div class="space-y-3">
                        @forelse($applications as $app)
                            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="flex items-center justify-between mb-1">
                                    <a href="{{ route('scholarships.show', $app->scholarship->id) }}" class="font-semibold text-[#0a1033] text-sm hover:text-red-600 transition">{{ $app->scholarship->title }}</a>
                                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                        {{ $app->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($app->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : ($app->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700')) }}">
                                        {{ $app->status }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">{{ $app->scholarship->flag }} {{ $app->scholarship->university }} • {{ $app->scholarship->country }}</p>
                                @if($app->status === 'pending')
                                    <form action="{{ route('scholarships.apply.destroy', $app->scholarship->id) }}" method="POST" onsubmit="return confirm('Retirer cette candidature ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">Retirer ma candidature</button>
                                    </form>
                                @endif
                            </div>
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
                            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="flex items-center justify-between mb-1">
                                    <a href="{{ route('language-courses.show', $enr->courseSession->id) }}" class="font-semibold text-[#0a1033] text-sm hover:text-red-600 transition">{{ $enr->courseSession->title }}</a>
                                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                        {{ $enr->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($enr->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500') }}">
                                        {{ $enr->status }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">🏢 {{ $enr->courseSession->location }}</p>
                                @if($enr->status === 'pending')
                                    <form action="{{ route('courses.enroll.destroy', $enr->courseSession->id) }}" method="POST" onsubmit="return confirm('Retirer cette inscription ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">Retirer mon inscription</button>
                                    </form>
                                @endif
                            </div>
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
