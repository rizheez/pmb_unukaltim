<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'registration_number',
        'registration_type_id',
        'registration_path',
        'registration_path_id',
        'referral_source',
        'referral_detail',
        'choice_1',
        'choice_2',
        'choice_3',
        'status',
        'registration_period_id',
        'accepted_at',
        'accepted_by',
        'acceptance_notes',
        'accepted_program_studi_id',
        'rejected_at',
        'rejected_by',
        'rejection_reason',
    ];

    /**
     * Generate unique registration number for a given period
     * Format: [ACADEMIC_YEAR][WAVE][SEQUENCE] e.g. 25260100001
     */
    public static function generateRegistrationNumber(RegistrationPeriod $period): string
    {
        // Parse academic year (2025/2026 -> 2526)
        $years = explode('/', $period->academic_year);
        $academicYear = substr($years[0], -2) . substr($years[1] ?? $years[0], -2);

        // Format wave number (1 -> 01)
        $wave = str_pad($period->wave_number, 2, '0', STR_PAD_LEFT);

        // Get next sequence number for this period
        $lastRegistration = self::where('registration_period_id', $period->id)
            ->whereNotNull('registration_number')
            ->orderByRaw('CAST(SUBSTRING(registration_number, -5) AS UNSIGNED) DESC')
            ->first();

        if ($lastRegistration) {
            $lastSequence = (int) substr($lastRegistration->registration_number, -5);
            $nextSequence = $lastSequence + 1;
        } else {
            $nextSequence = 1;
        }

        // Format sequence (1 -> 00001)
        $sequence = str_pad($nextSequence, 5, '0', STR_PAD_LEFT);

        return $academicYear . $wave . $sequence;
    }


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

    public function registrationPath()
    {
        return $this->belongsTo(RegistrationPath::class);
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
     * Prodi yang diterima (final acceptance)
     */
    public function acceptedProgramStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'accepted_program_studi_id');
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

        // Required documents (MUST be uploaded and verified)
        $requiredDocs = ['photo', 'kk', 'ktp', 'biodata'];

        // Optional documents (only check if uploaded)
        $optionalDocs = ['certificate'];

        $verifications = $biodata->verifications()->get();

        // Check if all required documents are verified and approved
        $allApproved = true;
        $hasRejected = false;

        // Check REQUIRED documents
        foreach ($requiredDocs as $docType) {
            $verification = $verifications->where('document_type', $docType)->first();

            // Required document must exist and be approved
            if (! $verification || $verification->status !== 'approved') {
                $allApproved = false;
            }

            if ($verification && $verification->status === 'rejected') {
                $hasRejected = true;
            }
        }

        // Check OPTIONAL documents (only if they exist)
        foreach ($optionalDocs as $docType) {
            $verification = $verifications->where('document_type', $docType)->first();

            // If optional document exists, it must be approved
            // If not uploaded, skip (don't block verification)
            if ($verification) {
                if ($verification->status !== 'approved') {
                    $allApproved = false;
                }

                if ($verification->status === 'rejected') {
                    $hasRejected = true;
                }
            }
            // If no verification exists for optional doc, it's OK (not uploaded)
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
            're_registration_pending' => 'Menunggu Daftar Ulang',
            're_registration_verified' => 'Daftar Ulang Terverifikasi',
            'enrolled' => 'Terdaftar Sebagai Mahasiswa',
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
            're_registration_pending' => 'bg-yellow-100 text-yellow-800',
            're_registration_verified' => 'bg-indigo-100 text-indigo-800',
            'enrolled' => 'bg-purple-100 text-purple-800',
        ];

        return $classes[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Check if status can transition to new status
     */
    public function canTransitionTo($newStatus): bool
    {
        $allowedTransitions = [
            'verified' => ['accepted', 'rejected'],
            'accepted' => ['re_registration_pending'],
            're_registration_pending' => ['re_registration_verified'],
            're_registration_verified' => ['enrolled'],
        ];

        return in_array($newStatus, $allowedTransitions[$this->status] ?? []);
    }

    /**
     * Relationship to user who accepted
     */
    public function acceptedBy()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    /**
     * Relationship to user who rejected
     */
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
