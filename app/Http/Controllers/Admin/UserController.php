<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Liste de tous les comptes créés (admins + étudiants), avec recherche et filtre par rôle.
     */
    public function index(Request $request): View
    {
        $users = User::with('studentProfile')
            ->withCount(['scholarshipApplications', 'courseEnrollments'])
            ->when($request->filled('role'), fn ($q) => $q->where('role', $request->input('role')))
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = $request->input('q');
                $q->where(function ($sub) use ($term) {
                    $sub->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Historique complet d'un compte : profil + toutes ses candidatures et inscriptions.
     */
    public function show(User $user): View
    {
        $user->load([
            'studentProfile',
            'scholarshipApplications.scholarship',
            'courseEnrollments.courseSession',
        ]);

        return view('admin.users.show', compact('user'));
    }
}
