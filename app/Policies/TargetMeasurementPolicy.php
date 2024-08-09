<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\TargetMeasurement;
use App\Models\User;

class TargetMeasurementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any TargetMeasurement');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TargetMeasurement $targetmeasurement): bool
    {
        return $user->checkPermissionTo('view TargetMeasurement');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create TargetMeasurement');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TargetMeasurement $targetmeasurement): bool
    {
        return $user->checkPermissionTo('update TargetMeasurement');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TargetMeasurement $targetmeasurement): bool
    {
        return $user->checkPermissionTo('delete TargetMeasurement');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TargetMeasurement $targetmeasurement): bool
    {
        return $user->checkPermissionTo('restore TargetMeasurement');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TargetMeasurement $targetmeasurement): bool
    {
        return $user->checkPermissionTo('force-delete TargetMeasurement');
    }
}
