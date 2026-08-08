<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentDocumentController extends Controller
{
    /**
     * Liste tous les documents de l'étudiant, groupés par candidature/inscription.
     */
    public function index(): View
    {
        $applications = auth()->user()->scholarshipApplications()->with(['scholarship', 'documents'])->get();
        $enrollments = auth()->user()->courseEnrollments()->with(['courseSession', 'documents'])->get();

        return view('dashboard.documents', compact('applications', 'enrollments'));
    }

    /**
     * Remplace le fichier d'un document existant.
     */
    public function update(Request $request, ApplicationDocument $document): RedirectResponse
    {
        $this->authorizeOwnership($document);

        $request->validate([
            'file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        // Supprime l'ancien fichier physique
        Storage::disk('public')->delete($document->path);

        $file = $request->file('file');
        $folder = class_basename($document->documentable_type) === 'ScholarshipApplication'
            ? 'applications/' . $document->documentable_id
            : 'enrollments/' . $document->documentable_id;

        $path = $file->store($folder, 'public');

        $document->update([
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()->route('student.documents.index')->with('success', 'Document remplacé avec succès.');
    }

    /**
     * Supprime un document.
     */
    public function destroy(ApplicationDocument $document): RedirectResponse
    {
        $this->authorizeOwnership($document);

        Storage::disk('public')->delete($document->path);
        $document->delete();

        return redirect()->route('student.documents.index')->with('success', 'Document supprimé.');
    }

    /**
     * Vérifie que le document appartient bien à une candidature/inscription de l'utilisateur connecté.
     */
    private function authorizeOwnership(ApplicationDocument $document): void
    {
        $owner = $document->documentable?->user_id;

        abort_unless($owner === auth()->id(), 403, "Ce document ne t'appartient pas.");
    }
}
