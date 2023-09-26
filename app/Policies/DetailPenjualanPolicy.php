<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DetailPenjualan;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPenjualanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detailPenjualan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can view the model.
     */
    public function view(User $user, DetailPenjualan $model): bool
    {
        return $user->hasPermissionTo('view detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can update the model.
     */
    public function update(User $user, DetailPenjualan $model): bool
    {
        return $user->hasPermissionTo('update detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can delete the model.
     */
    public function delete(User $user, DetailPenjualan $model): bool
    {
        return $user->hasPermissionTo('delete detailpenjualans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can restore the model.
     */
    public function restore(User $user, DetailPenjualan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the detailPenjualan can permanently delete the model.
     */
    public function forceDelete(User $user, DetailPenjualan $model): bool
    {
        return false;
    }
}
