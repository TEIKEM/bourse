@extends('layouts.admin')

@section('title', 'Inscription - ' . $enrollment->user->name)

@section('content')

    <div class="mb-8">
        <a href="{{ route('admin.enrollments.index') }}" class="text-xs font-bold text-slate-500 hover:text-red-600 transition">&larr; Retour aux inscriptions</a>
        <h1 class="text-2xl font-black text-[#0a1033] mt-2">Inscription de {{ $enrollment->user->name }}</h1>
        <p class="text-sm text-slate-500">Pour : {{ $enrollment->courseSession->title }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">

            <!-- PROFIL ÉTUDIANT -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6">
                <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Informations personnelles</h2>
                @php $profile = $enrollment->user->studentProfile; @endphp
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><span class="text-slate-400 text-xs block">Nom complet</span><span class="font-semibold text-[#0a1033]">{{ $enrollment->user->name }}</span></div>
                    <div><span class="text-slate-400 text-xs block">Email</span><span class="font-semibold text-[#0a1033]">{{ $enrollment->user->email }}</span></div>
                    <div><span class="text-slate-400 text-xs block">Téléphone</span><span class="font-semibold text-[#0a1033]">{{ $profile->phone ?? '—' }}</span></div>
                    <div><span class="text-slate-400 text-xs block">Date de naissance</span><span class="font-semibold text-[#0a1033]">{{ $profile?->date_of_birth?->format('d/m/Y') ?? '—' }}</span></div>
                    <div><span class="text-slate-400 text-xs block">Genre</span><span class="font-semibold text-[#0a1033]">{{ $profile->gender ?? '—' }}</span></div>
                    <div><span class="text-slate-400 text-xs block">Nationalité</span><span class="font-semibold text-[#0a1033]">{{ $profile->nationality ?? '—' }}</span></div>
                    <div><span class="text-slate-400 text-xs block">Ville</span><span class="font-semibold text-[#0a1033]">{{ $profile->city ?? '—' }}</span></div>
                    <div><span class="text-slate-400 text-xs block">Niveau d'études</span><span class="font-semibold text-[#0a1033]">{{ $profile->education_level ?? '—' }}</span></div>
                </div>
            </div>

            <!-- DOCUMENTS -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6">
                <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Documents joints ({{ $enrollment->documents->count() }})</h2>
                <div class="space-y-2">
                    @forelse($enrollment->documents as $doc)
                        <a href="{{ $doc->url }}" target="_blank" class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-red-200 transition">
                            <div>
                                <p class="text-sm font-semibold text-[#0a1033]">{{ $doc->label }}</p>
                                <p class="text-xs text-slate-400">{{ $doc->original_name }} • {{ $doc->formatted_size }}</p>
                            </div>
                            <span class="text-xs font-bold text-red-600">Ouvrir &rarr;</span>
                        </a>
                    @empty
                        <p class="text-sm text-slate-400">Aucun document joint par l'étudiant.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- STATUT -->
        <div>
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sticky top-6">
                <h2 class="text-sm font-bold text-[#0a1033] uppercase tracking-wider mb-4">Statut de l'inscription</h2>

                @if($enrollment->courseSession->capacity !== null)
                    <p class="text-xs text-slate-500 mb-4">
                        Places restantes sur la session : <strong class="{{ $enrollment->courseSession->capacity <= 0 ? 'text-red-600' : 'text-[#0a1033]' }}">{{ $enrollment->courseSession->capacity }}</strong>
                        @if($enrollment->courseSession->capacity <= 0 && $enrollment->status !== 'confirmed')
                            <span class="block text-red-600 font-semibold mt-1">⚠️ Session complète — confirmer débloquera une erreur tant qu'aucune place ne se libère.</span>
                            <form action="{{ route('admin.courses.increase-capacity', $enrollment->courseSession->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="amount" value="1">
                                <button type="submit" class="text-xs font-bold text-white bg-[#0a1033] hover:bg-red-600 px-3 py-2 rounded-lg transition">
                                    + Ajouter 1 place à cette session
                                </button>
                            </form>
                        @endif
                    </p>
                @endif

                <form action="{{ route('admin.enrollments.update-status', $enrollment->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <select name="status" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm outline-none transition">
                        <option value="pending" {{ $enrollment->status == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmed" {{ $enrollment->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                        <option value="cancelled" {{ $enrollment->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>

                    <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl transition text-sm">
                        Mettre à jour le statut
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-100 text-xs text-slate-400 space-y-1">
                    <p>Inscription reçue le {{ $enrollment->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </div>

    </div>

@endsection
