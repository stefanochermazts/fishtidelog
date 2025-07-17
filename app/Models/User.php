<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_premium',
        'premium_until',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'premium_until' => 'datetime',
        ];
    }

    public function fishingTrips(): HasMany
    {
        return $this->hasMany(FishingTrip::class);
    }

    public function fishingSpots(): HasMany
    {
        return $this->hasMany(FishingSpot::class);
    }

    public function getTotalCatchesAttribute(): int
    {
        return $this->fishingTrips()
            ->join('fish_catches', 'fishing_trips.id', '=', 'fish_catches.fishing_trip_id')
            ->count();
    }

    public function getTotalWeightAttribute(): float
    {
        return $this->fishingTrips()
            ->join('fish_catches', 'fishing_trips.id', '=', 'fish_catches.fishing_trip_id')
            ->sum('fish_catches.weight') ?? 0;
    }

    /**
     * Controlla se l'utente è un amministratore
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Controlla se l'utente è premium
     */
    public function isPremium(): bool
    {
        return $this->is_premium && $this->premium_until && $this->premium_until->isFuture();
    }

    /**
     * Ottiene le statistiche dell'utente
     */
    public function getStats(): array
    {
        return [
            'fishing_trips' => $this->fishingTrips()->count(),
            'fishing_spots' => $this->fishingSpots()->count(),
            'catches' => $this->total_catches,
            'total_weight' => $this->total_weight,
            'premium' => $this->isPremium(),
            'registered_at' => $this->created_at,
        ];
    }
}
