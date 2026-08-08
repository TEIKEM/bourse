@extends('layouts.app')

@section('title', 'Mon Profil - KANTSA International Institute')

@section('content')

    <section class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-slate-500 hover:text-red-600 transition">&larr; Retour à mon espace</a>
                <h1 class="text-2xl font-black text-[#0a1033] mt-2">Modifier mon profil</h1>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('student.profile.update') }}" method="POST" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nom complet</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" disabled
                               class="w-full px-4 py-3 rounded-xl bg-gray-100 border border-gray-200 text-sm text-slate-400 outline-none">
                        <p class="text-xs text-slate-400 mt-1">Non modifiable ici.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Téléphone</label>
                        <input type="tel" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" required
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Date de naissance</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile?->date_of_birth?->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Genre</label>
                        <select name="gender" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                            <option value="">Non précisé</option>
                            <option value="homme" {{ old('gender', $profile->gender ?? '') == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ old('gender', $profile->gender ?? '') == 'femme' ? 'selected' : '' }}>Femme</option>
                            <option value="autre" {{ old('gender', $profile->gender ?? '') == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nationalité</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $profile->nationality ?? '') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ville</label>
                        <input type="text" name="city" value="{{ old('city', $profile->city ?? '') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Niveau d'études</label>
                        <select name="education_level" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                            <option value="">Non précisé</option>
                            <option value="bac" {{ old('education_level', $profile->education_level ?? '') == 'bac' ? 'selected' : '' }}>Baccalauréat</option>
                            <option value="licence" {{ old('education_level', $profile->education_level ?? '') == 'licence' ? 'selected' : '' }}>Licence</option>
                            <option value="master" {{ old('education_level', $profile->education_level ?? '') == 'master' ? 'selected' : '' }}>Master</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Adresse</label>
                        <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-sm uppercase tracking-wider">
                    Enregistrer les modifications
                </button>
            </form>

        </div>
    </section>

@endsection
