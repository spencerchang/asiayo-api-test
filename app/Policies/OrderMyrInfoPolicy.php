<?php

namespace App\Policies;

use App\Models\OrderMyrInfo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderMyrInfoPolicy
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
    public function view(User $user, OrderMyrInfo $orderMyrInfo): bool
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
    public function update(User $user, OrderMyrInfo $orderMyrInfo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrderMyrInfo $orderMyrInfo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OrderMyrInfo $orderMyrInfo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OrderMyrInfo $orderMyrInfo): bool
    {
        return false;
    }
}
