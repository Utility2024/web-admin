<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\WorksurfaceDetail;
use App\Models\User;

class WorksurfaceDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any WorksurfaceDetail');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WorksurfaceDetail $worksurfacedetail): bool
    {
        return $user->checkPermissionTo('view WorksurfaceDetail');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create WorksurfaceDetail');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WorksurfaceDetail $worksurfacedetail): bool
    {
        return $user->checkPermissionTo('update WorksurfaceDetail');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WorksurfaceDetail $worksurfacedetail): bool
    {
        return $user->checkPermissionTo('delete WorksurfaceDetail');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WorksurfaceDetail $worksurfacedetail): bool
    {
        return $user->checkPermissionTo('restore WorksurfaceDetail');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WorksurfaceDetail $worksurfacedetail): bool
    {
        return $user->checkPermissionTo('force-delete WorksurfaceDetail');
    }
}
