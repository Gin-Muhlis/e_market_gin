<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the barang can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list barangs');
    }

    /**
     * Determine whether the barang can view the model.
     */
    public function view(User $user, Barang $model): bool
    {
        return $user->hasPermissionTo('view barangs');
    }

    /**
     * Determine whether the barang can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create barangs');
    }

    /**
     * Determine whether the barang can update the model.
     */
    public function update(User $user, Barang $model): bool
    {
        return $user->hasPermissionTo('update barangs');
    }

    /**
     * Determine whether the barang can delete the model.
     */
    public function delete(User $user, Barang $model): bool
    {
        return $user->hasPermissionTo('delete barangs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete barangs');
    }

    /**
     * Determine whether the barang can restore the model.
     */
    public function restore(User $user, Barang $model): bool
    {
        return false;
    }

    /**
     * Determine whether the barang can permanently delete the model.
     */
    public function forceDelete(User $user, Barang $model): bool
    {
        return false;
    }
}
