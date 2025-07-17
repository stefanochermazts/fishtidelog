<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FishingSpot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'latitude',
        'longitude',
        'address',
        'type',
        'best_times',
        'species_common',
        'is_public',
        'is_favorite',
    ];

    protected $casts = [
        'best_times' => 'array',
        'species_common' => 'array',
        'is_public' => 'boolean',
        'is_favorite' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fishingTrips(): HasMany
    {
        return $this->hasMany(FishingTrip::class);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeFavorites($query)
    {
        return $query->where('is_favorite', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getDistanceFromAttribute($lat, $lng): float
    {
        // Calcolo distanza usando formula di Haversine
        $lat1 = deg2rad($this->latitude);
        $lng1 = deg2rad($this->longitude);
        $lat2 = deg2rad($lat);
        $lng2 = deg2rad($lng);
        
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        
        $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlng/2) * sin($dlng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return 6371 * $c; // Raggio della Terra in km
    }

    public function getTripsCountAttribute(): int
    {
        return $this->fishingTrips()->count();
    }

    public function getTotalWeightAttribute(): float
    {
        return $this->fishingTrips()
            ->join('fish_catches', 'fishing_trips.id', '=', 'fish_catches.fishing_trip_id')
            ->sum('fish_catches.weight') ?? 0;
    }
}
