<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FishSpecies extends Model
{
    use HasFactory;

    protected $fillable = [
        'scientific_name',
        'common_name_en',
        'common_name_it',
        'common_name_fr',
        'common_name_de',
        'family',
        'order',
        'description_en',
        'description_it',
        'description_fr',
        'description_de',
        'habitat',
        'max_length',
        'max_weight',
        'conservation_status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relazione con le catture
     */
    public function catches(): HasMany
    {
        return $this->hasMany(FishCatch::class, 'species_id');
    }

    /**
     * Ottiene il nome comune nella lingua corrente
     */
    public function getCommonNameAttribute(): string
    {
        $locale = app()->getLocale();
        $field = "common_name_{$locale}";
        
        return $this->$field ?? $this->common_name_en;
    }

    /**
     * Ottiene la descrizione nella lingua corrente
     */
    public function getDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        $field = "description_{$locale}";
        
        return $this->$field ?? $this->description_en;
    }

    /**
     * Ottiene il nome completo (nome comune + scientifico)
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->common_name} ({$this->scientific_name})";
    }

    /**
     * Scope per specie attive
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope per ricerca per nome
     */
    public function scopeSearchByName($query, $search)
    {
        $locale = app()->getLocale();
        $commonNameField = "common_name_{$locale}";
        
        return $query->where(function($q) use ($search, $commonNameField) {
            $q->where($commonNameField, 'LIKE', "%{$search}%")
              ->orWhere('scientific_name', 'LIKE', "%{$search}%")
              ->orWhere('common_name_en', 'LIKE', "%{$search}%");
        });
    }

    /**
     * Ottiene le statistiche della specie
     */
    public function getStatisticsAttribute(): array
    {
        $catches = $this->catches;
        
        return [
            'total_catches' => $catches->count(),
            'total_weight' => $catches->sum('weight'),
            'avg_weight' => $catches->avg('weight'),
            'max_weight' => $catches->max('weight'),
            'avg_length' => $catches->avg('length'),
            'max_length' => $catches->max('length'),
        ];
    }
}
