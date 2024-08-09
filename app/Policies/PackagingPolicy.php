<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Packaging;
use App\Models\User;

class PackagingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Packaging');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Packaging $packaging): bool
    {
        return $user->checkPermissionTo('view Packaging');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Packaging');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Packaging $packaging): bool
    {
        return $user->checkPermissionTo('update Packaging');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Packaging $packaging): bool
    {
        return $user->checkPermissionTo('delete Packaging');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Packaging $packaging): bool
    {
        return $user->checkPermissionTo('restore Packaging');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Packaging $packaging): bool
    {
        return $user->checkPermissionTo('force-delete Packaging');
    }
}
