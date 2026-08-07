@extends('layouts.app')

@section('title', 'Postuler - ' . $scholarship->title)

@section('content')

    <section class="relative py-16 lg:py-20 text-white overflow-hidden">
        <div class="absolute inset-0 z-0 bg-[#0a1033]"></div>
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="text-xs text-slate-300 mb-4">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('scholarships.show', $scholarship->id) }}" class="hover:text-red-400 transition">{{ $scholarship->title }}</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold">Candidature</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-black text-white mb-2">Postuler à : {{ $scholarship->title }}</h1>
            <p class="text-slate-300 text-sm">{{ $scholarship->flag }} {{ $scholarship->university }} • {{ $scholarship->country }}</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8">
                <p class="text-sm text-slate-500 mb-6">
                    Connecté(e) en tant que <strong class="text-[#0a1033]">{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }}).
                </p>

                <form action="{{ route('scholarships.apply.store', $scholarship->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Lettre de motivation <span class="text-slate-400 normal-case font-normal">(optionnel)</span>
                        </label>
                        <textarea name="motivation" rows="8" placeholder="Explique brièvement pourquoi tu postules à cette bourse, ton parcours et tes objectifs..."
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">{{ old('motivation') }}</textarea>
                    </div>

                    <div class="pt-2 border-t border-gray-100">
                        <h3 class="text-xs font-bold text-red-600 uppercase tracking-wider mb-4 mt-4">Documents à joindre</h3>
                        <p class="text-xs text-slate-400 mb-4">PDF, JPG ou PNG — 5 Mo max par fichier. Tous optionnels, mais recommandés pour accélérer le traitement.</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">CV</label>
                                <input type="file" name="documents[cv]" accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-xs file:font-semibold file:text-[#0a1033] hover:file:bg-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Diplôme / Relevé de notes</label>
                                <input type="file" name="documents[diploma]" accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-xs file:font-semibold file:text-[#0a1033] hover:file:bg-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Pièce d'identité</label>
                                <input type="file" name="documents[id_card]" accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-xs file:font-semibold file:text-[#0a1033] hover:file:bg-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Lettre de motivation (fichier)</label>
                                <input type="file" name="documents[motivation_letter]" accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-xs file:font-semibold file:text-[#0a1033] hover:file:bg-gray-200">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-sm uppercase tracking-wider">
                        Envoyer ma candidature
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection
