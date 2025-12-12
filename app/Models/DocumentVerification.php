<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentVerification extends Model
{
    protected $fillable = [
        'student_biodata_id',
        'verified_by',
        'document_type',
        'status',
        'notes',
        'verified_at',
        'is_read',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    public function studentBiodata()
    {
        return $this->belongsTo(StudentBiodata::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function getDocumentTypeNameAttribute()
    {
        return match($this->document_type) {
            'kk' => 'Kartu Keluarga',
            'ktp' => 'KTP',
            'certificate' => 'Ijazah/SKL',
            'photo' => 'Foto',
            'biodata' => 'Data Biodata',
            default => $this->document_type,
        };
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'approved' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>',
            'rejected' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>',
            'pending' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>',
            default => $this->status,
        };
    }
}
