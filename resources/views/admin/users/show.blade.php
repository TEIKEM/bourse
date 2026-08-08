@extends('layouts.admin')

@section('title', $user->name . ' - Dossier complet')

@section('content')

    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-slate-500 hover:text-red-600 transition">&larr; Retour aux comptes</a>
        <h1 class="text-2xl font-black text-[#0a1033] mt-2">{{ $user->name }}</h1>
        <p class="text-sm text-slate-500">{{ $user->email }} • Compte créé le {{ $user->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- PROFIL -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sticky top-6">
                <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Profil</h2>
                @php $profile = $user->studentProfile; @endphp
                @if($profile)
                    <div class="space-y-3 text-sm">
                        <div><span class="text-slate-400 text-xs block">Téléphone</span><span class="font-semibold text-[#0a1033]">{{ $profile->phone }}</span></div>
                        <div><span class="text-slate-400 text-xs block">Date de naissance</span><span class="font-semibold text-[#0a1033]">{{ $profile->date_of_birth?->format('d/m/Y') ?? '—' }}</span></div>
                        <div><span class="text-slate-400 text-xs block">Genre</span><span class="font-semibold text-[#0a1033]">{{ $profile->gender ?? '—' }}</span></div>
                        <div><span class="text-slate-400 text-xs block">Nationalité</span><span class="font-semibold text-[#0a1033]">{{ $profile->nationality ?? '—' }}</span></div>
                        <div><span class="text-slate-400 text-xs block">Ville</span><span class="font-semibold text-[#0a1033]">{{ $profile->city ?? '—' }}</span></div>
                        <div><span class="text-slate-400 text-xs block">Adresse</span><span class="font-semibold text-[#0a1033]">{{ $profile->address ?? '—' }}</span></div>
                        <div><span class="text-slate-400 text-xs block">Niveau d'études</span><span class="font-semibold text-[#0a1033]">{{ $profile->education_level ?? '—' }}</span></div>
                    </div>
                @else
                    <p class="text-sm text-slate-400">Pas de profil étudiant (compte administrateur).</p>
                @endif
            </div>
        </div>

        <!-- HISTORIQUE -->
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-3xl border border-gray-200 p-6">
                <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Candidatures aux bourses ({{ $user->scholarshipApplications->count() }})</h2>
                <div class="space-y-2">
                    @forelse($user->scholarshipApplications as $app)
                        <a href="{{ route('admin.applications.show', $app->id) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-red-200 transition">
                            <div>
                                <p class="text-sm font-semibold text-[#0a1033]">{{ $app->scholarship->title }}</p>
                                <p class="text-xs text-slate-400">{{ $app->created_at->format('d/m/Y') }}</p>
                            </div>
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                {{ $app->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($app->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : ($app->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700')) }}">
                                {{ $app->status }}
                            </span>
                        </a>
                    @empty
                        <p class="text-sm text-slate-400">Aucune candidature.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-200 p-6">
                <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Inscriptions aux cours ({{ $user->courseEnrollments->count() }})</h2>
                <div class="space-y-2">
                    @forelse($user->courseEnrollments as $enr)
                        <a href="{{ route('admin.enrollments.show', $enr->id) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-red-200 transition">
                            <div>
                                <p class="text-sm font-semibold text-[#0a1033]">{{ $enr->courseSession->title }}</p>
                                <p class="text-xs text-slate-400">{{ $enr->created_at->format('d/m/Y') }}</p>
                            </div>
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                {{ $enr->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($enr->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500') }}">
                                {{ $enr->status }}
                            </span>
                        </a>
                    @empty
                        <p class="text-sm text-slate-400">Aucune inscription.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

@endsection
