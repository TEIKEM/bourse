@extends('layouts.app')

@section('title', "Inscription - " . $course->title)

@section('content')

    <section class="relative py-16 lg:py-20 text-white overflow-hidden">
        <div class="absolute inset-0 z-0 bg-[#0a1033]"></div>
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="text-xs text-slate-300 mb-4">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('language-courses.show', $course->id) }}" class="hover:text-red-400 transition">{{ $course->title }}</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold">Inscription</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-black text-white mb-2">S'inscrire à : {{ $course->title }}</h1>
            <p class="text-slate-300 text-sm">🏢 {{ $course->location }} • {{ $course->formatted_start_date ?? 'Rentrée à venir' }}</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8">
                <p class="text-sm text-slate-500 mb-6">
                    Connecté(e) en tant que <strong class="text-[#0a1033]">{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }}).
                </p>

                <div class="grid grid-cols-2 gap-4 mb-8 text-sm">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs text-slate-400 mb-1">Mode</p>
                        <p class="font-bold text-[#0a1033]">{{ $course->mode }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs text-slate-400 mb-1">Durée</p>
                        <p class="font-bold text-[#0a1033]">{{ $course->duration ?? 'Non précisée' }}</p>
                    </div>
                    @if($course->price)
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 col-span-2">
                            <p class="text-xs text-slate-400 mb-1">Tarif</p>
                            <p class="font-bold text-red-600">{{ $course->formatted_price }}</p>
                        </div>
                    @endif
                </div>

                <form action="{{ route('courses.enroll.store', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="pt-2 border-t border-gray-100 mb-6">
                        <h3 class="text-xs font-bold text-red-600 uppercase tracking-wider mb-4 mt-4">Documents à joindre</h3>
                        <p class="text-xs text-slate-400 mb-4">PDF, JPG ou PNG — tous optionnels, mais recommandés pour accélérer le traitement.</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Pièce d'identité</label>
                                <input type="file" name="documents[id_card]" accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-xs file:font-semibold file:text-[#0a1033] hover:file:bg-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Photo d'identité</label>
                                <input type="file" name="documents[photo]" accept=".jpg,.jpeg,.png"
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-xs file:font-semibold file:text-[#0a1033] hover:file:bg-gray-200">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Preuve de paiement (si déjà réglé)</label>
                                <input type="file" name="documents[payment_proof]" accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-xs file:font-semibold file:text-[#0a1033] hover:file:bg-gray-200">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-sm uppercase tracking-wider">
                        Confirmer mon inscription
                    </button>
                    <p class="text-xs text-slate-400 text-center mt-3">Notre équipe te contactera pour finaliser le paiement et les modalités.</p>
                </form>
            </div>
        </div>
    </section>

@endsection
