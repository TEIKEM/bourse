<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::ordered()->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $this->validated($request);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service supprimé.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'icon' => ['nullable', 'string', 'max:10'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:100'],
            'cta_link' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['order'] = $data['order'] ?? 0;

        return $data;
    }
}
