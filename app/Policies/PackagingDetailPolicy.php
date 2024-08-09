<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\PackagingDetail;
use App\Models\User;

class PackagingDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any PackagingDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PackagingDetail $packagingdetail): bool
    {
        return $user->checkPermissionTo('view PackagingDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create PackagingDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PackagingDetail $packagingdetail): bool
    {
        return $user->checkPermissionTo('update PackagingDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PackagingDetail $packagingdetail): bool
    {
        return $user->checkPermissionTo('delete PackagingDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PackagingDetail $packagingdetail): bool
    {
        return $user->checkPermissionTo('restore PackagingDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PackagingDetail $packagingdetail): bool
    {
        return $user->checkPermissionTo('force-delete PackagingDetail');
    }
}
