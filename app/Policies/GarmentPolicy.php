<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Garment;
use App\Models\User;

class GarmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Garment');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Garment $garment): bool
    {
        return $user->checkPermissionTo('view Garment');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Garment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Garment $garment): bool
    {
        return $user->checkPermissionTo('update Garment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Garment $garment): bool
    {
        return $user->checkPermissionTo('delete Garment');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Garment $garment): bool
    {
        return $user->checkPermissionTo('restore Garment');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Garment $garment): bool
    {
        return $user->checkPermissionTo('force-delete Garment');
    }
}
