<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Registration;

class StudentRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $student;
    public Registration $registration;
    public string $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(User $student, Registration $registration, string $reason)
    {
        $this->student = $student;
        $this->registration = $registration;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan Status Pendaftaran PMB UNUK Kaltim',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.student-rejected',
            with: [
                'student' => $this->student,
                'registration' => $this->registration,
                'reason' => $this->reason,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
