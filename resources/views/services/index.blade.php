@extends('layouts.app')

@section('title', 'Nos Services - KANTSA International Institute')

@section('content')

    {{--
        NOTE : dépose ta photo dans public/images/services-listing-bg.jpg
        pour remplacer le fallback Unsplash utilisé ci-dessous.
        Cette vue attend : $services (collection, via Service::published()->ordered()->get())
    --}}

    <!-- BANNIÈRE DE PAGE -->
    <section class="relative py-16 lg:py-20 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/services-listing-bg.jpg') }}"
                 alt="Services KANTSA"
                 class="w-full h-full object-cover object-center"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-[#0a1033]/85"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="text-xs text-slate-300 mb-4">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Accueil</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold">Nos Services</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-3">Nos Domaines d'Expertise</h1>
            <p class="text-slate-300 max-w-2xl">Un accompagnement complet, de l'orientation initiale jusqu'à ton installation sur le campus universitaire.</p>
        </div>
    </section>

    <!-- LISTE DES SERVICES -->
    <section class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="p-8 rounded-3xl bg-gray-50 border border-gray-100 hover:border-red-200 hover:shadow-xl transition duration-300 group flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 border border-red-100 flex items-center justify-center text-2xl font-bold mb-6 group-hover:scale-110 transition">
                                {{ $service->icon ?? '📌' }}
                            </div>
                            <h3 class="text-xl font-bold text-[#0a1033] mb-3">{{ $service->title }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed mb-6">
                                {{ $service->short_description }}
                            </p>
                        </div>
                        <a href="{{ route('services.show', $service->slug) }}" class="text-xs font-bold text-red-600 group-hover:text-red-700 inline-flex items-center gap-1 uppercase tracking-wider">
                            En savoir plus &rarr;
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-gray-50 rounded-3xl border border-gray-200">
                        <p class="text-slate-400 text-sm">Aucun service disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection
