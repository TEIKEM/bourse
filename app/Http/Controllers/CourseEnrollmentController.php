<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDocument;
use App\Models\CourseEnrollment;
use App\Models\CourseSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseEnrollmentController extends Controller
{
    private const DOCUMENT_LABELS = [
        'id_card' => "Pièce d'identité",
        'photo' => "Photo d'identité",
        'payment_proof' => 'Preuve de paiement (si disponible)',
    ];

    public function create(CourseSession $courseSession): View|RedirectResponse
    {
        $existing = CourseEnrollment::where('user_id', auth()->id())
            ->where('course_session_id', $courseSession->id)
            ->first();

        if ($existing) {
            return redirect()
                ->route('language-courses.show', $courseSession->id)
                ->with('info', 'Tu es déjà inscrit(e) à cette session. Statut actuel : ' . $existing->status);
        }

        return view('language-courses.enroll', ['course' => $courseSession]);
    }

    public function store(Request $request, CourseSession $courseSession): RedirectResponse
    {
        $request->validate([
            'documents.id_card' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'documents.photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:3072'],
            'documents.payment_proof' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $enrollment = CourseEnrollment::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'course_session_id' => $courseSession->id,
            ],
            [
                'status' => 'pending',
            ]
        );

        foreach (self::DOCUMENT_LABELS as $key => $label) {
            if ($request->hasFile("documents.{$key}")) {
                $this->storeDocument($enrollment, $request->file("documents.{$key}"), $label);
            }
        }

        return redirect()
            ->route('language-courses.show', $courseSession->id)
            ->with('success', "Ton inscription a bien été enregistrée ! Notre équipe te contactera pour finaliser les modalités.");
    }

    /**
     * Permet à l'étudiant de retirer sa propre inscription, uniquement si elle est encore "pending".
     */
    public function destroy(CourseSession $courseSession): \Illuminate\Http\RedirectResponse
    {
        $enrollment = CourseEnrollment::where('user_id', auth()->id())
            ->where('course_session_id', $courseSession->id)
            ->first();

        if (! $enrollment) {
            return redirect()->route('dashboard')->with('error', 'Aucune inscription trouvée pour cette session.');
        }

        if ($enrollment->status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'Cette inscription est déjà confirmée ou traitée, elle ne peut plus être retirée.');
        }

        foreach ($enrollment->documents as $doc) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($doc->path);
        }

        $enrollment->delete();

        return redirect()->route('dashboard')->with('success', 'Ton inscription a été retirée.');
    }

    private function storeDocument(CourseEnrollment $enrollment, $file, string $label): void
    {
        $path = $file->store('enrollments/' . $enrollment->id, 'public');

        ApplicationDocument::create([
            'documentable_type' => CourseEnrollment::class,
            'documentable_id' => $enrollment->id,
            'label' => $label,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
    }
}
