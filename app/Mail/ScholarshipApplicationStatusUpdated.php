<?php

namespace App\Mail;

use App\Models\ScholarshipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScholarshipApplicationStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ScholarshipApplication $application)
    {
    }

    public function build(): self
    {
        $subjects = [
            'under_review' => 'Ta candidature est en cours d\'examen',
            'accepted' => '🎉 Ta candidature a été acceptée !',
            'rejected' => 'Réponse concernant ta candidature',
            'pending' => 'Mise à jour de ta candidature',
        ];

        return $this->subject($subjects[$this->application->status] ?? 'Mise à jour de ta candidature')
            ->view('emails.application-status');
    }
}
