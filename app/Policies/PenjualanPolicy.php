<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Penjualan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenjualanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the penjualan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list penjualans');
    }

    /**
     * Determine whether the penjualan can view the model.
     */
    public function view(User $user, Penjualan $model): bool
    {
        return $user->hasPermissionTo('view penjualans');
    }

    /**
     * Determine whether the penjualan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create penjualans');
    }

    /**
     * Determine whether the penjualan can update the model.
     */
    public function update(User $user, Penjualan $model): bool
    {
        return $user->hasPermissionTo('update penjualans');
    }

    /**
     * Determine whether the penjualan can delete the model.
     */
    public function delete(User $user, Penjualan $model): bool
    {
        return $user->hasPermissionTo('delete penjualans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete penjualans');
    }

    /**
     * Determine whether the penjualan can restore the model.
     */
    public function restore(User $user, Penjualan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the penjualan can permanently delete the model.
     */
    public function forceDelete(User $user, Penjualan $model): bool
    {
        return false;
    }
}
