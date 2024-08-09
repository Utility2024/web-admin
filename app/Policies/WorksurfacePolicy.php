<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Worksurface;
use App\Models\User;

class WorksurfacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Worksurface');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Worksurface $worksurface): bool
    {
        return $user->checkPermissionTo('view Worksurface');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Worksurface');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Worksurface $worksurface): bool
    {
        return $user->checkPermissionTo('update Worksurface');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Worksurface $worksurface): bool
    {
        return $user->checkPermissionTo('delete Worksurface');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Worksurface $worksurface): bool
    {
        return $user->checkPermissionTo('restore Worksurface');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Worksurface $worksurface): bool
    {
        return $user->checkPermissionTo('force-delete Worksurface');
    }
}
