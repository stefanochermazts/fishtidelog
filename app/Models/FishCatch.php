<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FishCatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'fishing_trip_id',
        'species',
        'weight',
        'length',
        'bait_used',
        'technique_used',
        'catch_time',
        'latitude',
        'longitude',
        'notes',
        'photo_path',
        'released',
    ];

    protected $casts = [
        'catch_time' => 'datetime',
        'released' => 'boolean',
    ];

    public function fishingTrip(): BelongsTo
    {
        return $this->belongsTo(FishingTrip::class);
    }

    // Rimuoviamo la relazione species() dato che ora usiamo solo stringhe

    public function getFormattedWeightAttribute(): string
    {
        if (!$this->weight) {
            return 'N/A';
        }
        
        return number_format($this->weight, 2) . ' kg';
    }

    public function getFormattedLengthAttribute(): string
    {
        if (!$this->length) {
            return 'N/A';
        }
        
        return number_format($this->length, 1) . ' cm';
    }

    /**
     * Ottiene il nome della specie
     */
    public function getSpeciesNameAttribute(): string
    {
        return $this->species ?? 'N/A';
    }

    public function scopeBySpecies($query, $species)
    {
        return $query->where('species', $species);
    }

    public function scopeReleased($query)
    {
        return $query->where('released', true);
    }

    public function scopeKept($query)
    {
        return $query->where('released', false);
    }
}
