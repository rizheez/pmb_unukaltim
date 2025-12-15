<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'registration_type_id',
        'registration_path',
        'choice_1',
        'choice_2',
        'choice_3',
        'status',
        'registration_period_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrationPeriod()
    {
        return $this->belongsTo(RegistrationPeriod::class);
    }

    public function registrationType()
    {
        return $this->belongsTo(RegistrationType::class);
    }

    public function programStudiChoice1()
    {
        return $this->belongsTo(ProgramStudi::class, 'choice_1');
    }

    public function programStudiChoice2()
    {
        return $this->belongsTo(ProgramStudi::class, 'choice_2');
    }

    public function programStudiChoice3()
    {
        return $this->belongsTo(ProgramStudi::class, 'choice_3');
    }

    /**
     * Check if all required documents are verified
     */
    public function checkAndUpdateVerificationStatus()
    {
        $biodata = $this->user->studentBiodata;

        if (! $biodata) {
            return false;
        }

        // Get all verifications for required documents
        $requiredDocs = ['photo', 'kk', 'ktp', 'certificate', 'biodata'];
        $verifications = $biodata->verifications()
            ->whereIn('document_type', $requiredDocs)
            ->get();

        // Check if all required documents are verified and approved
        $allApproved = true;
        $hasRejected = false;

        foreach ($requiredDocs as $docType) {
            $verification = $verifications->where('document_type', $docType)->first();

            if (! $verification || $verification->status !== 'approved') {
                $allApproved = false;
            }

            if ($verification && $verification->status === 'rejected') {
                $hasRejected = true;
            }
        }

        // Update registration status based on verification
        if ($allApproved && $this->status === 'submitted') {
            $this->update(['status' => 'verified']);

            return true;
        } elseif ($hasRejected && $this->status === 'verified') {
            // Revert to submitted if any document is rejected
            $this->update(['status' => 'submitted']);

            return false;
        }

        return $allApproved;
    }

    /**
     * Get status label in Indonesian
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'draft' => 'Draft',
            'submitted' => 'Terdaftar',
            'verified' => 'Terverifikasi',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
        ];

        return $labels[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get status badge color class
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'draft' => 'bg-gray-100 text-gray-800',
            'submitted' => 'bg-blue-100 text-blue-800',
            'verified' => 'bg-green-100 text-green-800',
            'accepted' => 'bg-teal-100 text-teal-800',
            'rejected' => 'bg-red-100 text-red-800',
        ];

        return $classes[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}
