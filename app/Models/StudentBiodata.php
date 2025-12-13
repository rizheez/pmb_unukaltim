<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentBiodata extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nik',
        'nisn',
        'last_education',
        'school_origin',
        'major',
        'phone',
        'gender',
        'birth_place',
        'birth_date',
        'religion',
        'address',
        'photo_path',
        'kk_path',
        'ktp_path',
        'certificate_path',
    ];

    protected $appends = ['photo_url', 'kk_url', 'ktp_url', 'certificate_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo_path 
            ? \Illuminate\Support\Facades\Storage::url($this->photo_path) 
            : 'https://placehold.co/200x200?text=No+Photo';
    }

    public function getKkUrlAttribute()
    {
        return $this->kk_path 
            ? \Illuminate\Support\Facades\Storage::url($this->kk_path) 
            : null;
    }

    public function getKtpUrlAttribute()
    {
        return $this->ktp_path 
            ? \Illuminate\Support\Facades\Storage::url($this->ktp_path) 
            : null;
    }

    public function getCertificateUrlAttribute()
    {
        return $this->certificate_path 
            ? \Illuminate\Support\Facades\Storage::url($this->certificate_path) 
            : null;
    }

    public function verifications()
    {
        return $this->hasMany(DocumentVerification::class);
    }

    public function getPendingVerificationsAttribute()
    {
        return $this->verifications()
            ->where('status', 'rejected')
            ->where('is_read', false)
            ->count();
    }
}
