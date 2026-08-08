<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentProfileController extends Controller
{
    public function edit(): View
    {
        $profile = auth()->user()->studentProfile;

        return view('dashboard.profile-edit', compact('profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'string', 'in:homme,femme,autre'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'education_level' => ['nullable', 'string', 'max:50'],
        ]);

        auth()->user()->update(['name' => $validated['name']]);

        StudentProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'phone' => $validated['phone'],
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'nationality' => $validated['nationality'] ?? null,
                'city' => $validated['city'] ?? null,
                'address' => $validated['address'] ?? null,
                'education_level' => $validated['education_level'] ?? null,
            ]
        );

        return redirect()->route('student.profile.edit')->with('success', 'Ton profil a été mis à jour.');
    }
}
