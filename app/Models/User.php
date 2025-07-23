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
        'trial_ends_at',
        'subscription_status',
        'subscription_starts_at',
        'subscription_ends_at',
        'subscription_price',
        'subscription_currency',
        'subscription_meta',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'subscription_meta',
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
            'trial_ends_at' => 'datetime',
            'subscription_starts_at' => 'datetime',
            'subscription_ends_at' => 'datetime',
            'subscription_meta' => 'array',
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
     * Controlla se l'utente è premium (ha abbonamento attivo)
     */
    public function isPremium(): bool
    {
        return $this->subscription_status === 'active' && 
               $this->subscription_ends_at && 
               $this->subscription_ends_at->isFuture();
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

    /**
     * Verifica se l'utente è nel periodo di trial
     */
    public function isOnTrial(): bool
    {
        return $this->subscription_status === 'trial' && 
               $this->trial_ends_at && 
               $this->trial_ends_at->isFuture();
    }

    /**
     * Verifica se l'utente ha un abbonamento attivo
     */
    public function hasActiveSubscription(): bool
    {
        return $this->subscription_status === 'active' && 
               $this->subscription_ends_at && 
               $this->subscription_ends_at->isFuture();
    }

    /**
     * Verifica se l'utente può accedere al servizio
     */
    public function canAccessService(): bool
    {
        return $this->isOnTrial() || $this->hasActiveSubscription();
    }

    /**
     * Verifica se l'abbonamento è scaduto
     */
    public function hasExpiredAccess(): bool
    {
        if ($this->subscription_status === 'trial') {
            return $this->trial_ends_at && $this->trial_ends_at->isPast();
        }
        
        if ($this->subscription_status === 'active') {
            return $this->subscription_ends_at && $this->subscription_ends_at->isPast();
        }
        
        return in_array($this->subscription_status, ['expired', 'cancelled']);
    }

    /**
     * Giorni rimanenti del trial
     */
    public function trialDaysRemaining(): int
    {
        if (!$this->isOnTrial()) {
            return 0;
        }
        
        return max(0, now()->diffInDays($this->trial_ends_at, false));
    }

    /**
     * Attiva l'abbonamento manualmente (per admin)
     */
    public function activateSubscription(int $months = 1, float $price = 4.99): void
    {
        $this->update([
            'subscription_status' => 'active',
            'subscription_starts_at' => now(),
            'subscription_ends_at' => now()->addMonths($months),
            'subscription_price' => $price,
            'subscription_currency' => 'EUR',
        ]);
    }

    /**
     * Cancella l'abbonamento
     */
    public function cancelSubscription(): void
    {
        $this->update([
            'subscription_status' => 'cancelled',
        ]);
    }

    /**
     * Marca come scaduto
     */
    public function markAsExpired(): void
    {
        $this->update([
            'subscription_status' => 'expired',
        ]);
    }

    /**
     * Inizializza il trial per un nuovo utente
     */
    public function initializeTrial(): void
    {
        $this->update([
            'trial_ends_at' => now()->addMonths(6),
            'subscription_status' => 'trial',
        ]);
    }
}
