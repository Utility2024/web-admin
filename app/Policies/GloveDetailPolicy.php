<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\GloveDetail;
use App\Models\User;

class GloveDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any GloveDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GloveDetail $glovedetail): bool
    {
        return $user->checkPermissionTo('view GloveDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create GloveDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GloveDetail $glovedetail): bool
    {
        return $user->checkPermissionTo('update GloveDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GloveDetail $glovedetail): bool
    {
        return $user->checkPermissionTo('delete GloveDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GloveDetail $glovedetail): bool
    {
        return $user->checkPermissionTo('restore GloveDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GloveDetail $glovedetail): bool
    {
        return $user->checkPermissionTo('force-delete GloveDetail');
    }
}
