<?php

namespace App\Policies;

use App\Models\FishingTrip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FishingTripPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Gli utenti possono vedere le proprie uscite
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FishingTrip $fishingTrip): bool
    {
        return $user->id === $fishingTrip->user_id || $fishingTrip->is_public;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Tutti gli utenti autenticati possono creare uscite
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FishingTrip $fishingTrip): bool
    {
        return $user->id === $fishingTrip->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FishingTrip $fishingTrip): bool
    {
        return $user->id === $fishingTrip->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FishingTrip $fishingTrip): bool
    {
        return $user->id === $fishingTrip->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FishingTrip $fishingTrip): bool
    {
        return $user->id === $fishingTrip->user_id;
    }
}
