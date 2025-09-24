<?php

namespace App\Policies;

use App\Models\TravelPlan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TravelPlanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }
    

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TravelPlan $travelPlan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    // app/Policies/TravelPlanPolicy.php
    public function view_own(User $user, TravelPlan $plan)
    {
        return $user->id === $plan->user_id;
    }

    public function react(User $user, TravelPlan $plan)
    {
        return $user->id !== $plan->user_id;
    }

    public function participate(User $user, TravelPlan $plan)
    {
        return $plan->participants->contains($user->id);    
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TravelPlan $travelPlan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TravelPlan $travelPlan): bool
    {
        return false;
    }
}
