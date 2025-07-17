<?php

namespace App\Policies;

use App\Models\FishCatch;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FishCatchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FishCatch $fishCatch): bool
    {
        return $user->id === $fishCatch->fishingTrip->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FishCatch $fishCatch): bool
    {
        return $user->id === $fishCatch->fishingTrip->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FishCatch $fishCatch): bool
    {
        return $user->id === $fishCatch->fishingTrip->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FishCatch $fishCatch): bool
    {
        return $user->id === $fishCatch->fishingTrip->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FishCatch $fishCatch): bool
    {
        return $user->id === $fishCatch->fishingTrip->user_id;
    }
}
