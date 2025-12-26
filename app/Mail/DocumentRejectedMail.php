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
    public array $rejectedDocuments;

    /**
     * Create a new message instance.
     *
     * @param User $student
     * @param array $documents Array of ['type' => string, 'notes' => string|null]
     */
    public function __construct(User $student, array $documents)
    {
        $this->student = $student;

        // Process documents with labels immediately
        $this->rejectedDocuments = collect($documents)->map(function ($doc) {
            return [
                'type' => $doc['type'],
                'label' => $this->getDocumentLabel($doc['type']),
                'notes' => $doc['notes'] ?? null,
            ];
        })->all();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Dokumen Pendaftaran Perlu Diperbaiki - PMB UNU Kaltim',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.document-rejected',
        );
    }

    /**
     * Get human-readable document type label
     */
    protected function getDocumentLabel(string $documentType): string
    {
        $labels = [
            'kk' => 'Kartu Keluarga (KK)',
            'ktp' => 'KTP/Kartu Identitas',
            'certificate' => 'Ijazah/Surat Keterangan Lulus',
            'photo' => 'Pas Foto',
            'biodata' => 'Data Biodata',
        ];

        return $labels[$documentType] ?? ucfirst($documentType);
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
