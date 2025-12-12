<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active registration types
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get registrations using this type
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'registration_type_id');
    }
}
