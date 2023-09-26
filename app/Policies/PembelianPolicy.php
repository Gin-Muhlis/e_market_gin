<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pembelian;
use Illuminate\Auth\Access\HandlesAuthorization;

class PembelianPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pembelian can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list pembelians');
    }

    /**
     * Determine whether the pembelian can view the model.
     */
    public function view(User $user, Pembelian $model): bool
    {
        return $user->hasPermissionTo('view pembelians');
    }

    /**
     * Determine whether the pembelian can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pembelians');
    }

    /**
     * Determine whether the pembelian can update the model.
     */
    public function update(User $user, Pembelian $model): bool
    {
        return $user->hasPermissionTo('update pembelians');
    }

    /**
     * Determine whether the pembelian can delete the model.
     */
    public function delete(User $user, Pembelian $model): bool
    {
        return $user->hasPermissionTo('delete pembelians');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete pembelians');
    }

    /**
     * Determine whether the pembelian can restore the model.
     */
    public function restore(User $user, Pembelian $model): bool
    {
        return false;
    }

    /**
     * Determine whether the pembelian can permanently delete the model.
     */
    public function forceDelete(User $user, Pembelian $model): bool
    {
        return false;
    }
}
