<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\GroundMonitorBoxDetail;
use App\Models\User;

class GroundMonitorBoxDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any GroundMonitorBoxDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GroundMonitorBoxDetail $groundmonitorboxdetail): bool
    {
        return $user->checkPermissionTo('view GroundMonitorBoxDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create GroundMonitorBoxDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GroundMonitorBoxDetail $groundmonitorboxdetail): bool
    {
        return $user->checkPermissionTo('update GroundMonitorBoxDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GroundMonitorBoxDetail $groundmonitorboxdetail): bool
    {
        return $user->checkPermissionTo('delete GroundMonitorBoxDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GroundMonitorBoxDetail $groundmonitorboxdetail): bool
    {
        return $user->checkPermissionTo('restore GroundMonitorBoxDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GroundMonitorBoxDetail $groundmonitorboxdetail): bool
    {
        return $user->checkPermissionTo('force-delete GroundMonitorBoxDetail');
    }
}
