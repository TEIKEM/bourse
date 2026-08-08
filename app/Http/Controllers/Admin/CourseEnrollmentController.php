<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CourseEnrollmentStatusUpdated;
use App\Models\CourseEnrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CourseEnrollmentController extends Controller
{
    public function index(Request $request): View
    {
        $enrollments = CourseEnrollment::with(['user.studentProfile', 'courseSession'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function show(CourseEnrollment $enrollment): View
    {
        $enrollment->load(['user.studentProfile', 'courseSession', 'documents']);

        return view('admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Met à jour le statut d'une inscription. Gère automatiquement le nombre
     * de places disponibles de la session :
     * - passage vers "confirmed" -> décrémente capacity de 1 (bloqué si complet)
     * - sortie de "confirmed" (annulation, retour à pending) -> restitue la place
     */
    public function updateStatus(Request $request, CourseEnrollment $enrollment): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ]);

        $newStatus = $request->input('status');
        $oldStatus = $enrollment->status;

        if ($newStatus === $oldStatus) {
            return redirect()
                ->route('admin.enrollments.show', $enrollment->id)
                ->with('info', 'Statut inchangé.');
        }

        $course = $enrollment->courseSession()->lockForUpdate()->first();

        try {
            DB::transaction(function () use ($enrollment, $course, $newStatus, $oldStatus) {
                // On confirme une inscription qui ne l'était pas encore : on consomme une place
                if ($newStatus === 'confirmed' && $oldStatus !== 'confirmed') {
                    if ($course && $course->capacity !== null) {
                        if ($course->capacity <= 0) {
                            throw new \RuntimeException('Impossible de confirmer : plus aucune place disponible pour cette session.');
                        }
                        $course->decrement('capacity');
                    }
                }

                // On sort une inscription de l'état "confirmed" (annulation ou retour en attente) : on restitue la place
                if ($oldStatus === 'confirmed' && $newStatus !== 'confirmed') {
                    if ($course && $course->capacity !== null) {
                        $course->increment('capacity');
                    }
                }

                $enrollment->update(['status' => $newStatus]);
            });
        } catch (\RuntimeException $e) {
            return redirect()
                ->route('admin.enrollments.show', $enrollment->id)
                ->with('error', $e->getMessage());
        }

        Mail::to($enrollment->user->email)->send(new CourseEnrollmentStatusUpdated($enrollment->fresh(['courseSession', 'user'])));

        return redirect()
            ->route('admin.enrollments.show', $enrollment->id)
            ->with('success', 'Statut de l\'inscription mis à jour, et étudiant notifié par email.');
    }
}
