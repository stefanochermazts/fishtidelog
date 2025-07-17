<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class FishingTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fishing_spot_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'latitude',
        'longitude',
        'location_name',
        'weather_conditions',
        'temperature',
        'wind_direction',
        'wind_speed',
        'tide_phase',
        'tide_height',
        'lunar_phase',
        'notes',
        'equipment_used',
        'is_public',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'equipment_used' => 'array',
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function catches(): HasMany
    {
        return $this->hasMany(FishCatch::class);
    }

    public function fishingSpot(): BelongsTo
    {
        return $this->belongsTo(FishingSpot::class);
    }

    public function getDurationAttribute(): string
    {
        if (!$this->end_time) {
            return 'In corso';
        }
        
        $duration = $this->start_time->diffInMinutes($this->end_time);
        $hours = floor($duration / 60);
        $minutes = $duration % 60;
        
        return "{$hours}h {$minutes}m";
    }

    public function getTotalCatchesAttribute(): int
    {
        return $this->catches()->count();
    }

    public function getTotalWeightAttribute(): float
    {
        return $this->catches()->sum('weight') ?? 0;
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
