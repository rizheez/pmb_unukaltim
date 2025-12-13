<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';

    protected $fillable = [
        'fakultas_id',
        'name',
        'code',
        'jenjang',
        'description',
        'quota',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'quota' => 'integer',
    ];

    /**
     * Get the fakultas that owns this program studi
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    /**
     * Get registrations with this program as choice 1
     */
    public function registrationsChoice1()
    {
        return $this->hasMany(Registration::class, 'choice_1');
    }

    /**
     * Get registrations with this program as choice 2
     */
    public function registrationsChoice2()
    {
        return $this->hasMany(Registration::class, 'choice_2');
    }

    /**
     * Get registrations with this program as choice 3
     */
    public function registrationsChoice3()
    {
        return $this->hasMany(Registration::class, 'choice_3');
    }

    /**
     * Get formatted name with jenjang (e.g., "S1 - Akuntansi")
     */
    public function getFullNameAttribute()
    {
        return "{$this->jenjang} - {$this->name}";
    }

    /**
     * Scope to get only active program studi
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
