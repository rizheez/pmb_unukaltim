<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all program studi under this fakultas
     */
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class);
    }

    /**
     * Scope to get only active fakultas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
