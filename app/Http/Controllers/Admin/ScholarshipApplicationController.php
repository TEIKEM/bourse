<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ScholarshipApplicationStatusUpdated;
use App\Models\ScholarshipApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ScholarshipApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $applications = ScholarshipApplication::with(['user.studentProfile', 'scholarship'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.applications.index', compact('applications'));
    }

    public function show(ScholarshipApplication $application): View
    {
        $application->load(['user.studentProfile', 'scholarship', 'documents']);

        return view('admin.applications.show', compact('application'));
    }

    /**
     * Met à jour le statut d'une candidature. Gère automatiquement le nombre
     * de places disponibles de la bourse (même logique que pour les cours) :
     * - passage vers "accepted" -> décrémente capacity de 1 (bloqué si complet)
     * - sortie de "accepted" -> restitue la place
     */
    public function updateStatus(Request $request, ScholarshipApplication $application): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,under_review,accepted,rejected'],
        ]);

        $newStatus = $request->input('status');
        $oldStatus = $application->status;

        if ($newStatus === $oldStatus) {
            return redirect()
                ->route('admin.applications.show', $application->id)
                ->with('info', 'Statut inchangé.');
        }

        $scholarship = $application->scholarship()->lockForUpdate()->first();

        try {
            DB::transaction(function () use ($application, $scholarship, $newStatus, $oldStatus) {
                if ($newStatus === 'accepted' && $oldStatus !== 'accepted') {
                    if ($scholarship && $scholarship->capacity !== null) {
                        if ($scholarship->capacity <= 0) {
                            throw new \RuntimeException('Impossible d\'accepter : plus aucune place disponible pour cette bourse.');
                        }
                        $scholarship->decrement('capacity');
                    }
                }

                if ($oldStatus === 'accepted' && $newStatus !== 'accepted') {
                    if ($scholarship && $scholarship->capacity !== null) {
                        $scholarship->increment('capacity');
                    }
                }

                $application->update(['status' => $newStatus]);
            });
        } catch (\RuntimeException $e) {
            return redirect()
                ->route('admin.applications.show', $application->id)
                ->with('error', $e->getMessage());
        }

        Mail::to($application->user->email)->send(new ScholarshipApplicationStatusUpdated($application->fresh(['scholarship', 'user'])));

        return redirect()
            ->route('admin.applications.show', $application->id)
            ->with('success', 'Statut de la candidature mis à jour, et étudiant notifié par email.');
    }
}
