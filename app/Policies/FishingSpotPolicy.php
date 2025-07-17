<?php

namespace App\Policies;

use App\Models\FishingSpot;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FishingSpotPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Gli utenti possono vedere i propri punti
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FishingSpot $fishingSpot): bool
    {
        return $user->id === $fishingSpot->user_id || $fishingSpot->is_public;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Tutti gli utenti autenticati possono creare punti
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FishingSpot $fishingSpot): bool
    {
        return $user->id === $fishingSpot->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FishingSpot $fishingSpot): bool
    {
        return $user->id === $fishingSpot->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FishingSpot $fishingSpot): bool
    {
        return $user->id === $fishingSpot->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FishingSpot $fishingSpot): bool
    {
        return $user->id === $fishingSpot->user_id;
    }
}
