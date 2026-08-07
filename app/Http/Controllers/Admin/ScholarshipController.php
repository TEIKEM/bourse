<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScholarshipController extends Controller
{
    public function index(): View
    {
        $scholarships = Scholarship::latest()->paginate(15);

        return view('admin.scholarships.index', compact('scholarships'));
    }

    public function create(): View
    {
        return view('admin.scholarships.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        Scholarship::create($validated);

        return redirect()->route('admin.scholarships.index')->with('success', 'Bourse créée avec succès.');
    }

    public function edit(Scholarship $scholarship): View
    {
        return view('admin.scholarships.edit', compact('scholarship'));
    }

    public function update(Request $request, Scholarship $scholarship): RedirectResponse
    {
        $validated = $this->validated($request);

        $scholarship->update($validated);

        return redirect()->route('admin.scholarships.index')->with('success', 'Bourse mise à jour avec succès.');
    }

    public function destroy(Scholarship $scholarship): RedirectResponse
    {
        $scholarship->delete();

        return redirect()->route('admin.scholarships.index')->with('success', 'Bourse supprimée.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'university' => ['required', 'string', 'max:150'],
            'country' => ['required', 'string', 'max:100'],
            'flag' => ['nullable', 'string', 'max:10'],
            'type' => ['required', 'string', 'max:100'],
            'status_badge' => ['nullable', 'string', 'max:100'],
            'level' => ['required', 'string', 'max:50'],
            'coverage' => ['nullable', 'string', 'max:255'],
            'deadline' => ['nullable', 'date'],
            'capacity' => ['nullable', 'integer', 'min:0'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
