<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pemasok;
use Illuminate\Auth\Access\HandlesAuthorization;

class PemasokPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pemasok can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list pemasoks');
    }

    /**
     * Determine whether the pemasok can view the model.
     */
    public function view(User $user, Pemasok $model): bool
    {
        return $user->hasPermissionTo('view pemasoks');
    }

    /**
     * Determine whether the pemasok can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pemasoks');
    }

    /**
     * Determine whether the pemasok can update the model.
     */
    public function update(User $user, Pemasok $model): bool
    {
        return $user->hasPermissionTo('update pemasoks');
    }

    /**
     * Determine whether the pemasok can delete the model.
     */
    public function delete(User $user, Pemasok $model): bool
    {
        return $user->hasPermissionTo('delete pemasoks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete pemasoks');
    }

    /**
     * Determine whether the pemasok can restore the model.
     */
    public function restore(User $user, Pemasok $model): bool
    {
        return false;
    }

    /**
     * Determine whether the pemasok can permanently delete the model.
     */
    public function forceDelete(User $user, Pemasok $model): bool
    {
        return false;
    }
}
