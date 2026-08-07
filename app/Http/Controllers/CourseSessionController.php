<?php

namespace App\Http\Controllers;

use App\Models\CourseSession;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseSessionController extends Controller
{
    /**
     * Liste des cours de langues avec filtres (recherche, langue, niveau, mode) + pagination.
     */
    public function index(Request $request): View
    {
        $courses = CourseSession::query()
            ->published()
            ->search($request->input('q'))
            ->when($request->filled('language'), fn ($q) => $q->where('language', $request->input('language')))
            ->when($request->filled('level'), fn ($q) => $q->where('level', $request->input('level')))
            ->when($request->filled('mode'), fn ($q) => $q->where('mode', $request->input('mode')))
            ->upcoming()
            ->paginate(9)
            ->withQueryString();

        $languages = CourseSession::published()->whereNotNull('language')->distinct()->pluck('language');
        $modes = CourseSession::published()->whereNotNull('mode')->distinct()->pluck('mode');

        return view('language-courses.index', compact('courses', 'languages', 'modes'));
    }

    /**
     * Détail d'une session de cours.
     */
    public function show(CourseSession $courseSession): View
    {
        $related = CourseSession::published()
            ->where('language', $courseSession->language)
            ->where('id', '!=', $courseSession->id)
            ->limit(3)
            ->get();

        return view('language-courses.show', [
            'course' => $courseSession,
            'related' => $related,
        ]);
    }
}
