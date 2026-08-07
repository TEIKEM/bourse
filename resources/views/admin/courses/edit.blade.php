@extends('layouts.admin')

@section('title', 'Modifier le Cours - Admin')

@section('content')

    <div class="mb-8">
        <a href="{{ route('admin.courses.index') }}" class="text-xs font-bold text-slate-500 hover:text-red-600 transition">&larr; Retour aux cours</a>
        <h1 class="text-2xl font-black text-[#0a1033] mt-2">Modifier : {{ $course->title }}</h1>
    </div>

    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8">
        @csrf
        @method('PUT')
        @include('admin.courses.form')

        <button type="submit" class="mt-8 w-full sm:w-auto px-8 py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-sm uppercase tracking-wider">
            Enregistrer les modifications
        </button>
    </form>

@endsection
