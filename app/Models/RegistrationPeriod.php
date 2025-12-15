<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'wave_number',
        'academic_year',
        'start_date',
        'end_date',
        'is_active',
        'quota',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Scope for active period
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now()->startOfDay()); // Bandingkan dengan awal hari
    }

    // Relationship to registrations
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // Check if period is currently open
    public function isOpen()
    {
        return $this->is_active
            && now()->between($this->start_date->startOfDay(), $this->end_date->endOfDay());
    }

    // Check if period has expired
    public function isExpired()
    {
        return now()->greaterThan($this->end_date->endOfDay());
    }

    // Check if period is upcoming (belum dimulai)
    public function isUpcoming()
    {
        return now()->lessThan($this->start_date->startOfDay());
    }

    // Check if period can be activated
    public function canBeActivated()
    {
        // Periode hanya bisa diaktifkan jika tanggal sekarang dalam range
        return now()->between($this->start_date->startOfDay(), $this->end_date->endOfDay());
    }

    // Get status label
    public function getStatusAttribute()
    {
        if ($this->isExpired()) {
            return 'Berakhir';
        }

        if ($this->isUpcoming()) {
            return 'Akan Datang';
        }

        if ($this->isOpen()) {
            return 'Aktif';
        }

        return 'Nonaktif';
    }

    // Get status badge class
    public function getStatusBadgeClassAttribute()
    {
        if ($this->isExpired()) {
            return 'bg-gray-100 text-gray-800';
        }

        if ($this->isUpcoming()) {
            return 'bg-blue-100 text-blue-800';
        }

        if ($this->isOpen()) {
            return 'bg-green-100 text-green-800';
        }

        return 'bg-red-100 text-red-800';
    }

    // Auto-deactivate expired periods
    public static function deactivateExpiredPeriods()
    {
        return self::where('is_active', true)
            ->where('end_date', '<', now()->startOfDay()) // Hanya deactivate jika sudah lewat hari ini
            ->update(['is_active' => false]);
    }
}
