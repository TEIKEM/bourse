@extends('layouts.admin')

@section('title', 'Comptes Utilisateurs - Admin')

@section('content')

    <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#0a1033]">Comptes Créés</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $users->total() }} compte(s) au total.</p>
        </div>

        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un nom ou email..."
                   class="px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm outline-none">
            <select name="role" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm text-slate-600 outline-none">
                <option value="">Tous les rôles</option>
                <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Étudiants</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrateurs</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white font-bold text-sm rounded-xl transition">Filtrer</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-slate-500 tracking-wider">
                <tr>
                    <th class="text-left px-6 py-3">Nom</th>
                    <th class="text-left px-6 py-3">Email</th>
                    <th class="text-left px-6 py-3">Téléphone</th>
                    <th class="text-left px-6 py-3">Rôle</th>
                    <th class="text-left px-6 py-3">Candidatures</th>
                    <th class="text-left px-6 py-3">Inscriptions</th>
                    <th class="text-left px-6 py-3">Créé le</th>
                    <th class="text-right px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-[#0a1033]">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->studentProfile->phone ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-md {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->scholarship_applications_count }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->course_enrollments_count }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="text-xs font-bold text-[#0a1033] hover:text-red-600 transition">Voir le dossier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-slate-400">Aucun compte trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

@endsection
