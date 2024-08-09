<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SolderingDetail;
use App\Models\User;

class SolderingDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SolderingDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SolderingDetail $solderingdetail): bool
    {
        return $user->checkPermissionTo('view SolderingDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SolderingDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SolderingDetail $solderingdetail): bool
    {
        return $user->checkPermissionTo('update SolderingDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SolderingDetail $solderingdetail): bool
    {
        return $user->checkPermissionTo('delete SolderingDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SolderingDetail $solderingdetail): bool
    {
        return $user->checkPermissionTo('restore SolderingDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SolderingDetail $solderingdetail): bool
    {
        return $user->checkPermissionTo('force-delete SolderingDetail');
    }
}
