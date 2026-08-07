@extends('layouts.admin')

@section('title', 'Dashboard Administrateur - KANTSA International Institute')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-black text-[#0a1033]">Tableau de bord — Administration</h1>
        <p class="text-sm text-slate-500 mt-1">Vue d'ensemble de l'activité KANTSA International Institute.</p>
    </div>

    <div class="mb-8 flex flex-wrap gap-3">
        <a href="{{ route('admin.scholarships.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:border-red-300 rounded-xl text-sm font-bold text-[#0a1033] transition">🎓 Gérer les bourses</a>
        <a href="{{ route('admin.courses.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:border-red-300 rounded-xl text-sm font-bold text-[#0a1033] transition">🗣️ Gérer les cours</a>
        <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:border-red-300 rounded-xl text-sm font-bold text-[#0a1033] transition">📁 Gérer les services</a>
    </div>

            <!-- STATISTIQUES -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
                <div class="bg-white rounded-2xl border border-gray-200 p-5">
                    <p class="text-2xl font-black text-[#0a1033]">{{ $stats['students'] }}</p>
                    <p class="text-xs text-slate-500 mt-1">Étudiants inscrits</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 p-5">
                    <p class="text-2xl font-black text-[#0a1033]">{{ $stats['scholarships'] }}</p>
                    <p class="text-xs text-slate-500 mt-1">Bourses publiées</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 p-5">
                    <p class="text-2xl font-black text-[#0a1033]">{{ $stats['courses'] }}</p>
                    <p class="text-xs text-slate-500 mt-1">Sessions de cours</p>
                </div>
                <div class="bg-white rounded-2xl border border-red-200 bg-red-50 p-5">
                    <p class="text-2xl font-black text-red-600">{{ $stats['pending_applications'] }}</p>
                    <p class="text-xs text-red-500 mt-1">Candidatures en attente</p>
                </div>
                <div class="bg-white rounded-2xl border border-red-200 bg-red-50 p-5">
                    <p class="text-2xl font-black text-red-600">{{ $stats['pending_enrollments'] }}</p>
                    <p class="text-xs text-red-500 mt-1">Inscriptions en attente</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- CANDIDATURES RÉCENTES -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6">
                    <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Dernières candidatures aux bourses</h2>
                    <div class="space-y-3">
                        @forelse($recentApplications as $app)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 text-sm">
                                <div>
                                    <p class="font-semibold text-[#0a1033]">{{ $app->user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $app->scholarship->title }}</p>
                                </div>
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                    {{ $app->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($app->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $app->status }}
                                </span>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400">Aucune candidature pour le moment.</p>
                        @endforelse
                    </div>
                </div>

                <!-- INSCRIPTIONS RÉCENTES -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6">
                    <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Dernières inscriptions aux cours</h2>
                    <div class="space-y-3">
                        @forelse($recentEnrollments as $enr)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 text-sm">
                                <div>
                                    <p class="font-semibold text-[#0a1033]">{{ $enr->user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $enr->courseSession->title }}</p>
                                </div>
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                    {{ $enr->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($enr->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $enr->status }}
                                </span>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400">Aucune inscription pour le moment.</p>
                        @endforelse
                    </div>
                </div>

            </div>

@endsection
