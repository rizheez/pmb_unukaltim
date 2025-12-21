<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\DocumentVerification;

class DocumentRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $student;
    public string $documentType;
    public ?string $notes;

    /**
     * Create a new message instance.
     */
    public function __construct(User $student, string $documentType, ?string $notes = null)
    {
        $this->student = $student;
        $this->documentType = $documentType;
        $this->notes = $notes;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Dokumen Pendaftaran Perlu Diperbaiki - PMB UNUK Kaltim',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.document-rejected',
            with: [
                'student' => $this->student,
                'documentType' => $this->documentType,
                'documentLabel' => $this->getDocumentLabel(),
                'notes' => $this->notes,
            ],
        );
    }

    /**
     * Get human-readable document type label
     */
    protected function getDocumentLabel(): string
    {
        $labels = [
            'kk' => 'Kartu Keluarga (KK)',
            'ktp' => 'KTP/Kartu Identitas',
            'certificate' => 'Ijazah/Surat Keterangan Lulus',
            'photo' => 'Pas Foto',
            'biodata' => 'Data Biodata',
        ];

        return $labels[$this->documentType] ?? ucfirst($this->documentType);
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
