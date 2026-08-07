@extends('layouts.admin')

@section('title', 'Ajouter une Bourse - Admin')

@section('content')

    <div class="mb-8">
        <a href="{{ route('admin.scholarships.index') }}" class="text-xs font-bold text-slate-500 hover:text-red-600 transition">&larr; Retour aux bourses</a>
        <h1 class="text-2xl font-black text-[#0a1033] mt-2">Ajouter une bourse</h1>
    </div>

    <form action="{{ route('admin.scholarships.store') }}" method="POST" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8">
        @csrf
        @include('admin.scholarships.form')

        <button type="submit" class="mt-8 w-full sm:w-auto px-8 py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-sm uppercase tracking-wider">
            Créer la bourse
        </button>
    </form>

@endsection
