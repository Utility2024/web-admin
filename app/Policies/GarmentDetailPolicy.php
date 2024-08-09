<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\GarmentDetail;
use App\Models\User;

class GarmentDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any GarmentDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GarmentDetail $garmentdetail): bool
    {
        return $user->checkPermissionTo('view GarmentDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create GarmentDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GarmentDetail $garmentdetail): bool
    {
        return $user->checkPermissionTo('update GarmentDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GarmentDetail $garmentdetail): bool
    {
        return $user->checkPermissionTo('delete GarmentDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GarmentDetail $garmentdetail): bool
    {
        return $user->checkPermissionTo('restore GarmentDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GarmentDetail $garmentdetail): bool
    {
        return $user->checkPermissionTo('force-delete GarmentDetail');
    }
}
