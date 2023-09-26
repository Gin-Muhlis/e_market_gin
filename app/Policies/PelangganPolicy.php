<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PelangganPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pelanggan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list pelanggans');
    }

    /**
     * Determine whether the pelanggan can view the model.
     */
    public function view(User $user, Pelanggan $model): bool
    {
        return $user->hasPermissionTo('view pelanggans');
    }

    /**
     * Determine whether the pelanggan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pelanggans');
    }

    /**
     * Determine whether the pelanggan can update the model.
     */
    public function update(User $user, Pelanggan $model): bool
    {
        return $user->hasPermissionTo('update pelanggans');
    }

    /**
     * Determine whether the pelanggan can delete the model.
     */
    public function delete(User $user, Pelanggan $model): bool
    {
        return $user->hasPermissionTo('delete pelanggans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete pelanggans');
    }

    /**
     * Determine whether the pelanggan can restore the model.
     */
    public function restore(User $user, Pelanggan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the pelanggan can permanently delete the model.
     */
    public function forceDelete(User $user, Pelanggan $model): bool
    {
        return false;
    }
}
