<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\EquipmentGroundDetail;
use App\Models\User;

class EquipmentGroundDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any EquipmentGroundDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EquipmentGroundDetail $equipmentgrounddetail): bool
    {
        return $user->checkPermissionTo('view EquipmentGroundDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create EquipmentGroundDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EquipmentGroundDetail $equipmentgrounddetail): bool
    {
        return $user->checkPermissionTo('update EquipmentGroundDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EquipmentGroundDetail $equipmentgrounddetail): bool
    {
        return $user->checkPermissionTo('delete EquipmentGroundDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EquipmentGroundDetail $equipmentgrounddetail): bool
    {
        return $user->checkPermissionTo('restore EquipmentGroundDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EquipmentGroundDetail $equipmentgrounddetail): bool
    {
        return $user->checkPermissionTo('force-delete EquipmentGroundDetail');
    }
}
