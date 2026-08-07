@extends('layouts.admin')

@section('title', 'Inscriptions aux Cours - Admin')

@section('content')

    <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#0a1033]">Inscriptions aux Cours de Langues</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $enrollments->total() }} inscription(s) au total.</p>
        </div>

        <form method="GET" class="flex gap-2">
            <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm text-slate-600 outline-none">
                <option value="">Tous les statuts</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
            </select>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-slate-500 tracking-wider">
                <tr>
                    <th class="text-left px-6 py-3">Étudiant</th>
                    <th class="text-left px-6 py-3">Cours</th>
                    <th class="text-left px-6 py-3">Téléphone</th>
                    <th class="text-left px-6 py-3">Documents</th>
                    <th class="text-left px-6 py-3">Statut</th>
                    <th class="text-left px-6 py-3">Reçue le</th>
                    <th class="text-right px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($enrollments as $enr)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-[#0a1033]">{{ $enr->user->name }}</p>
                            <p class="text-xs text-slate-400">{{ $enr->user->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $enr->courseSession->title }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $enr->user->studentProfile->phone ?? '—' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $enr->documents->count() }} fichier(s)</td>
                        <td class="px-6 py-4">
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                {{ $enr->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($enr->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500') }}">
                                {{ $enr->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $enr->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.enrollments.show', $enr->id) }}" class="text-xs font-bold text-[#0a1033] hover:text-red-600 transition">Consulter le dossier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-slate-400">Aucune inscription pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $enrollments->links() }}
    </div>

@endsection
