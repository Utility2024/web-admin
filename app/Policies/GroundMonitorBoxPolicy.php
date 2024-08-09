<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\GroundMonitorBox;
use App\Models\User;

class GroundMonitorBoxPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any GroundMonitorBox');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GroundMonitorBox $groundmonitorbox): bool
    {
        return $user->checkPermissionTo('view GroundMonitorBox');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create GroundMonitorBox');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GroundMonitorBox $groundmonitorbox): bool
    {
        return $user->checkPermissionTo('update GroundMonitorBox');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GroundMonitorBox $groundmonitorbox): bool
    {
        return $user->checkPermissionTo('delete GroundMonitorBox');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GroundMonitorBox $groundmonitorbox): bool
    {
        return $user->checkPermissionTo('restore GroundMonitorBox');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GroundMonitorBox $groundmonitorbox): bool
    {
        return $user->checkPermissionTo('force-delete GroundMonitorBox');
    }
}
