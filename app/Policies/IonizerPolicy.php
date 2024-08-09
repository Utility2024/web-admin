<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Ionizer;
use App\Models\User;

class IonizerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Ionizer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ionizer $ionizer): bool
    {
        return $user->checkPermissionTo('view Ionizer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Ionizer');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ionizer $ionizer): bool
    {
        return $user->checkPermissionTo('update Ionizer');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ionizer $ionizer): bool
    {
        return $user->checkPermissionTo('delete Ionizer');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ionizer $ionizer): bool
    {
        return $user->checkPermissionTo('restore Ionizer');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ionizer $ionizer): bool
    {
        return $user->checkPermissionTo('force-delete Ionizer');
    }
}
