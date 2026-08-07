<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDocument;
use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScholarshipApplicationController extends Controller
{
    // La protection 'auth' est appliquée au niveau des routes (voir routes/web.php).

    private const DOCUMENT_LABELS = [
        'cv' => 'CV',
        'diploma' => 'Diplôme / Relevé de notes',
        'id_card' => "Pièce d'identité",
        'motivation_letter' => 'Lettre de motivation (fichier)',
    ];

    public function create(Scholarship $scholarship): View|RedirectResponse
    {
        $existing = ScholarshipApplication::where('user_id', auth()->id())
            ->where('scholarship_id', $scholarship->id)
            ->first();

        if ($existing) {
            return redirect()
                ->route('scholarships.show', $scholarship->id)
                ->with('info', 'Tu as déjà postulé à cette bourse. Statut actuel : ' . $existing->status);
        }

        return view('scholarships.apply', compact('scholarship'));
    }

    public function store(Request $request, Scholarship $scholarship): RedirectResponse
    {
        $validated = $request->validate([
            'motivation' => ['nullable', 'string', 'max:3000'],
            'documents.cv' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'documents.diploma' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'documents.id_card' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'documents.motivation_letter' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $application = ScholarshipApplication::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'scholarship_id' => $scholarship->id,
            ],
            [
                'motivation' => $validated['motivation'] ?? null,
                'status' => 'pending',
            ]
        );

        foreach (self::DOCUMENT_LABELS as $key => $label) {
            if ($request->hasFile("documents.{$key}")) {
                $this->storeDocument($application, $request->file("documents.{$key}"), $label);
            }
        }

        return redirect()
            ->route('scholarships.show', $scholarship->id)
            ->with('success', 'Ta candidature a bien été envoyée ! Notre équipe te contactera prochainement.');
    }

    private function storeDocument(ScholarshipApplication $application, $file, string $label): void
    {
        $path = $file->store('applications/' . $application->id, 'public');

        ApplicationDocument::create([
            'documentable_type' => ScholarshipApplication::class,
            'documentable_id' => $application->id,
            'label' => $label,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
    }
}
