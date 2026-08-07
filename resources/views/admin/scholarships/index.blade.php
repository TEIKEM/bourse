@extends('layouts.admin')

@section('title', 'Gestion des Bourses - Admin')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#0a1033]">Gestion des Bourses</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $scholarships->total() }} bourse(s) au total.</p>
        </div>
        <a href="{{ route('admin.scholarships.create') }}" class="px-5 py-3 bg-red-600 hover:bg-red-500 text-white font-bold text-sm rounded-xl shadow-md transition">
            + Ajouter une bourse
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-slate-500 tracking-wider">
                <tr>
                    <th class="text-left px-6 py-3">Titre</th>
                    <th class="text-left px-6 py-3">Pays</th>
                    <th class="text-left px-6 py-3">Niveau</th>
                    <th class="text-left px-6 py-3">Places</th>
                    <th class="text-left px-6 py-3">Date limite</th>
                    <th class="text-left px-6 py-3">Statut</th>
                    <th class="text-right px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($scholarships as $scholarship)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-[#0a1033]">{{ $scholarship->title }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $scholarship->flag }} {{ $scholarship->country }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $scholarship->level }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $scholarship->capacity ?? 'Illimité' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $scholarship->deadline?->format('d/m/Y') ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if($scholarship->is_published)
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-md bg-emerald-100 text-emerald-700">Publiée</span>
                            @else
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-md bg-gray-100 text-gray-500">Brouillon</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                            <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}" class="text-xs font-bold text-[#0a1033] hover:text-red-600 transition">Modifier</a>
                            <form action="{{ route('admin.scholarships.destroy', $scholarship->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette bourse définitivement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400">Aucune bourse pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $scholarships->links() }}
    </div>

@endsection
