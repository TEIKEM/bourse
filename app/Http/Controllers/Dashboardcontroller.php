<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Redirige l'utilisateur connecté vers son dashboard selon son rôle.
     * C'est la vue derrière la route 'dashboard' (utilisée par la navbar).
     */
    public function index(): RedirectResponse
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('student.dashboard');
    }
}

