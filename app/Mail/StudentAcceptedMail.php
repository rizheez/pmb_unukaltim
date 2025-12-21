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

class StudentAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $student;
    public Registration $registration;
    public string $programStudiName;

    /**
     * Create a new message instance.
     */
    public function __construct(User $student, Registration $registration, string $programStudiName)
    {
        $this->student = $student;
        $this->registration = $registration;
        $this->programStudiName = $programStudiName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat! Anda Diterima di PMB UNUK Kaltim',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.student-accepted',
            with: [
                'student' => $this->student,
                'registration' => $this->registration,
                'programStudiName' => $this->programStudiName,
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
