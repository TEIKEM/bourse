@extends('layouts.admin')

@section('title', 'Candidatures aux Bourses - Admin')

@section('content')

    <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#0a1033]">Candidatures aux Bourses</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $applications->total() }} candidature(s) au total.</p>
        </div>

        <form method="GET" class="flex gap-2">
            <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm text-slate-600 outline-none">
                <option value="">Tous les statuts</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>En cours d'examen</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Acceptée</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Refusée</option>
            </select>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-slate-500 tracking-wider">
                <tr>
                    <th class="text-left px-6 py-3">Étudiant</th>
                    <th class="text-left px-6 py-3">Bourse</th>
                    <th class="text-left px-6 py-3">Téléphone</th>
                    <th class="text-left px-6 py-3">Documents</th>
                    <th class="text-left px-6 py-3">Statut</th>
                    <th class="text-left px-6 py-3">Reçue le</th>
                    <th class="text-right px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($applications as $app)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-[#0a1033]">{{ $app->user->name }}</p>
                            <p class="text-xs text-slate-400">{{ $app->user->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $app->scholarship->title }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $app->user->studentProfile->phone ?? '—' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $app->documents->count() }} fichier(s)</td>
                        <td class="px-6 py-4">
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                {{ $app->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($app->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : ($app->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700')) }}">
                                {{ $app->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $app->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.applications.show', $app->id) }}" class="text-xs font-bold text-[#0a1033] hover:text-red-600 transition">Consulter le dossier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-slate-400">Aucune candidature pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $applications->links() }}
    </div>

@endsection
