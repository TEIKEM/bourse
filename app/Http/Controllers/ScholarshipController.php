<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScholarshipController extends Controller
{
    /**
     * Liste des bourses avec filtres (recherche, pays, niveau) + pagination.
     */
    public function index(Request $request): View
    {
        $scholarships = Scholarship::query()
            ->published()
            ->search($request->input('q'))
            ->when($request->filled('country'), fn ($q) => $q->where('country', $request->input('country')))
            ->when($request->filled('level'), fn ($q) => $q->where('level', $request->input('level')))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        // Liste dynamique des pays disponibles, pour peupler le filtre
        $countries = Scholarship::published()->distinct()->pluck('country');

        return view('scholarships.index', compact('scholarships', 'countries'));
    }

    /**
     * Détail d'une bourse.
     */
    public function show(Scholarship $scholarship): View
    {
        // Suggestions : d'autres bourses du même pays, en excluant celle-ci
        $related = Scholarship::published()
            ->where('country', $scholarship->country)
            ->where('id', '!=', $scholarship->id)
            ->limit(3)
            ->get();

        return view('scholarships.show', compact('scholarship', 'related'));
    }
}
