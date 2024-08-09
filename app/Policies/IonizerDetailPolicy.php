<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\IonizerDetail;
use App\Models\User;

class IonizerDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any IonizerDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, IonizerDetail $ionizerdetail): bool
    {
        return $user->checkPermissionTo('view IonizerDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create IonizerDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IonizerDetail $ionizerdetail): bool
    {
        return $user->checkPermissionTo('update IonizerDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IonizerDetail $ionizerdetail): bool
    {
        return $user->checkPermissionTo('delete IonizerDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IonizerDetail $ionizerdetail): bool
    {
        return $user->checkPermissionTo('restore IonizerDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IonizerDetail $ionizerdetail): bool
    {
        return $user->checkPermissionTo('force-delete IonizerDetail');
    }
}
