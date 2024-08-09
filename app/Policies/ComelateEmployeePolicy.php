<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ComelateEmployee;
use App\Models\User;

class ComelateEmployeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ComelateEmployee');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ComelateEmployee $comelateemployee): bool
    {
        return $user->checkPermissionTo('view ComelateEmployee');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ComelateEmployee');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ComelateEmployee $comelateemployee): bool
    {
        return $user->checkPermissionTo('update ComelateEmployee');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ComelateEmployee $comelateemployee): bool
    {
        return $user->checkPermissionTo('delete ComelateEmployee');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ComelateEmployee $comelateemployee): bool
    {
        return $user->checkPermissionTo('restore ComelateEmployee');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ComelateEmployee $comelateemployee): bool
    {
        return $user->checkPermissionTo('force-delete ComelateEmployee');
    }
}
