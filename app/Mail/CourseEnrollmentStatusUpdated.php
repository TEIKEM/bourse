<?php

namespace App\Mail;

use App\Models\CourseEnrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseEnrollmentStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public CourseEnrollment $enrollment)
    {
    }

    public function build(): self
    {
        $subjects = [
            'confirmed' => '🎉 Ton inscription est confirmée !',
            'cancelled' => 'Ton inscription a été annulée',
            'pending' => 'Mise à jour de ton inscription',
        ];

        return $this->subject($subjects[$this->enrollment->status] ?? 'Mise à jour de ton inscription')
            ->view('emails.enrollment-status');
    }
}
