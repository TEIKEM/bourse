@extends('layouts.app')

@section('title', $service->title . ' - KANTSA International Institute')

@section('content')

    <!-- BANNIÈRE -->
    <section class="relative py-16 lg:py-24 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $service->image_url ?? asset('images/services-listing-bg.jpg') }}"
                 alt="{{ $service->title }}"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/85"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="text-xs text-slate-300 mb-4">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('services.index') }}" class="hover:text-red-400 transition">Nos Services</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold">{{ $service->title }}</span>
            </nav>

            <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-3xl mb-5">
                {{ $service->icon ?? '📌' }}
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-3">{{ $service->title }}</h1>
            @if($service->short_description)
                <p class="text-slate-200 text-sm sm:text-base max-w-2xl">{{ $service->short_description }}</p>
            @endif
        </div>
    </section>

    <!-- CONTENU -->
    <section class="py-16 lg:py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8">
                    <h2 class="text-lg font-bold text-[#0a1033] mb-4">En détail</h2>
                    <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $service->description ?? $service->short_description ?? "Description à venir." }}
                    </p>
                </div>

                @if($others->count())
                    <div>
                        <h2 class="text-lg font-bold text-[#0a1033] mb-4">Autres services</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach($others as $item)
                                <a href="{{ route('services.show', $item->slug) }}" class="block bg-white rounded-2xl border border-gray-200 p-4 hover:border-red-300 hover:shadow-md transition">
                                    <p class="text-xl mb-2">{{ $item->icon ?? '📌' }}</p>
                                    <p class="text-sm font-semibold text-[#0a1033] leading-snug">{{ $item->title }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="bg-[#0a1033] rounded-3xl p-6 sm:p-8 text-white sticky top-24 text-center">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-red-400 mb-4">Intéressé(e) ?</h3>
                    <p class="text-sm text-slate-300 mb-6">Contacte-nous pour évaluer gratuitement ton profil.</p>
                    <a href="{{ $service->cta_link ?? route('home') . '#services' }}" class="block text-center py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-xs uppercase tracking-wider">
                        {{ $service->cta_label ?? 'Nous contacter' }}
                    </a>
                </div>
            </div>

        </div>
    </section>

@endsection
