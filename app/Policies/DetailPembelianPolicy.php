<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DetailPembelian;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPembelianPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detailPembelian can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can view the model.
     */
    public function view(User $user, DetailPembelian $model): bool
    {
        return $user->hasPermissionTo('view detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can update the model.
     */
    public function update(User $user, DetailPembelian $model): bool
    {
        return $user->hasPermissionTo('update detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can delete the model.
     */
    public function delete(User $user, DetailPembelian $model): bool
    {
        return $user->hasPermissionTo('delete detailpembelians');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can restore the model.
     */
    public function restore(User $user, DetailPembelian $model): bool
    {
        return false;
    }

    /**
     * Determine whether the detailPembelian can permanently delete the model.
     */
    public function forceDelete(User $user, DetailPembelian $model): bool
    {
        return false;
    }
}
