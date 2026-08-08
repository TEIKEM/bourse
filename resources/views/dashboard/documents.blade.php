@extends('layouts.app')

@section('title', 'Mes Documents - KANTSA International Institute')

@section('content')

    <section class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-slate-500 hover:text-red-600 transition">&larr; Retour à mon espace</a>
                <h1 class="text-2xl font-black text-[#0a1033] mt-2">Mes Documents</h1>
                <p class="text-sm text-slate-500 mt-1">Consulte ou remplace les fichiers joints à tes candidatures et inscriptions.</p>
            </div>

            <!-- BOURSES -->
            <div class="mb-8">
                <h2 class="text-sm font-bold text-red-600 uppercase tracking-wider mb-4">Candidatures aux bourses</h2>
                @forelse($applications as $app)
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 mb-4">
                        <p class="font-semibold text-[#0a1033] text-sm mb-3">{{ $app->scholarship->title }}</p>
                        @forelse($app->documents as $doc)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 mb-2">
                                <div>
                                    <p class="text-sm font-medium text-[#0a1033]">{{ $doc->label }}</p>
                                    <p class="text-xs text-slate-400">{{ $doc->original_name }} • {{ $doc->formatted_size }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ $doc->url }}" target="_blank" class="text-xs font-bold text-[#0a1033] hover:text-red-600 transition">Voir</a>
                                    <label class="text-xs font-bold text-blue-600 hover:text-blue-800 cursor-pointer transition">
                                        Remplacer
                                        <form action="{{ route('student.documents.update', $doc->id) }}" method="POST" enctype="multipart/form-data" class="hidden" id="replace-form-{{ $doc->id }}">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                               onchange="const f=document.getElementById('replace-form-{{ $doc->id }}'); const dt=new DataTransfer(); dt.items.add(this.files[0]); const input=document.createElement('input'); input.type='file'; input.name='file'; input.files=dt.files; f.appendChild(input); f.submit();">
                                    </label>
                                    <form action="{{ route('student.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Supprimer ce document ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400">Aucun document joint.</p>
                        @endforelse
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Tu n'as pas encore de candidature.</p>
                @endforelse
            </div>

            <!-- COURS -->
            <div>
                <h2 class="text-sm font-bold text-red-600 uppercase tracking-wider mb-4">Inscriptions aux cours</h2>
                @forelse($enrollments as $enr)
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 mb-4">
                        <p class="font-semibold text-[#0a1033] text-sm mb-3">{{ $enr->courseSession->title }}</p>
                        @forelse($enr->documents as $doc)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100 mb-2">
                                <div>
                                    <p class="text-sm font-medium text-[#0a1033]">{{ $doc->label }}</p>
                                    <p class="text-xs text-slate-400">{{ $doc->original_name }} • {{ $doc->formatted_size }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ $doc->url }}" target="_blank" class="text-xs font-bold text-[#0a1033] hover:text-red-600 transition">Voir</a>
                                    <label class="text-xs font-bold text-blue-600 hover:text-blue-800 cursor-pointer transition">
                                        Remplacer
                                        <form action="{{ route('student.documents.update', $doc->id) }}" method="POST" enctype="multipart/form-data" class="hidden" id="replace-form-{{ $doc->id }}">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                               onchange="const f=document.getElementById('replace-form-{{ $doc->id }}'); const dt=new DataTransfer(); dt.items.add(this.files[0]); const input=document.createElement('input'); input.type='file'; input.name='file'; input.files=dt.files; f.appendChild(input); f.submit();">
                                    </label>
                                    <form action="{{ route('student.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Supprimer ce document ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400">Aucun document joint.</p>
                        @endforelse
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Tu n'as pas encore d'inscription.</p>
                @endforelse
            </div>

        </div>
    </section>

@endsection
