<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Liste de tous les services (pas de pagination : peu de contenu attendu).
     */
    public function index(): View
    {
        $services = Service::published()->ordered()->get();

        return view('services.index', compact('services'));
    }

    /**
     * Détail d'un service (via son slug).
     */
    public function show(Service $service): View
    {
        $others = Service::published()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('services.show', compact('service', 'others'));
    }
}
