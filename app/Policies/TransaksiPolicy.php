<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transaksi can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list transaksis');
    }

    /**
     * Determine whether the transaksi can view the model.
     */
    public function view(User $user, Transaksi $model): bool
    {
        return $user->hasPermissionTo('view transaksis');
    }

    /**
     * Determine whether the transaksi can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create transaksis');
    }

    /**
     * Determine whether the transaksi can update the model.
     */
    public function update(User $user, Transaksi $model): bool
    {
        return $user->hasPermissionTo('update transaksis');
    }

    /**
     * Determine whether the transaksi can delete the model.
     */
    public function delete(User $user, Transaksi $model): bool
    {
        return $user->hasPermissionTo('delete transaksis');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete transaksis');
    }

    /**
     * Determine whether the transaksi can restore the model.
     */
    public function restore(User $user, Transaksi $model): bool
    {
        return false;
    }

    /**
     * Determine whether the transaksi can permanently delete the model.
     */
    public function forceDelete(User $user, Transaksi $model): bool
    {
        return false;
    }
}
