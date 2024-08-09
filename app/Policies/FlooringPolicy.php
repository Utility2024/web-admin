<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Flooring;
use App\Models\User;

class FlooringPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Flooring');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Flooring $flooring): bool
    {
        return $user->checkPermissionTo('view Flooring');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Flooring');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Flooring $flooring): bool
    {
        return $user->checkPermissionTo('update Flooring');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Flooring $flooring): bool
    {
        return $user->checkPermissionTo('delete Flooring');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Flooring $flooring): bool
    {
        return $user->checkPermissionTo('restore Flooring');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Flooring $flooring): bool
    {
        return $user->checkPermissionTo('force-delete Flooring');
    }
}
