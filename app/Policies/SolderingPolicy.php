<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Soldering;
use App\Models\User;

class SolderingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Soldering');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Soldering $soldering): bool
    {
        return $user->checkPermissionTo('view Soldering');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Soldering');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Soldering $soldering): bool
    {
        return $user->checkPermissionTo('update Soldering');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Soldering $soldering): bool
    {
        return $user->checkPermissionTo('delete Soldering');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Soldering $soldering): bool
    {
        return $user->checkPermissionTo('restore Soldering');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Soldering $soldering): bool
    {
        return $user->checkPermissionTo('force-delete Soldering');
    }
}
