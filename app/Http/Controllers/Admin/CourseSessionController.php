<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseSessionController extends Controller
{
    public function index(): View
    {
        $courses = CourseSession::latest()->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('admin.courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        CourseSession::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Cours créé avec succès.');
    }

    public function edit(CourseSession $course): View
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, CourseSession $course): RedirectResponse
    {
        $validated = $this->validated($request);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Cours mis à jour avec succès.');
    }

    public function destroy(CourseSession $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Cours supprimé.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'language' => ['required', 'string', 'max:50'],
            'level' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'mode' => ['required', 'string', 'max:50'],
            'location' => ['required', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:150'],
            'duration' => ['nullable', 'string', 'max:50'],
            'schedule' => ['nullable', 'string', 'max:100'],
            'start_date' => ['nullable', 'string', 'max:50'],
            'session_date' => ['nullable', 'date'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'status_badge' => ['nullable', 'string', 'max:100'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
