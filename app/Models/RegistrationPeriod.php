<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
            ->where('end_date', '>=', now());
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
            && now()->between($this->start_date, $this->end_date);
    }
}
