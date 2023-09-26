<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdukPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the produk can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list produks');
    }

    /**
     * Determine whether the produk can view the model.
     */
    public function view(User $user, Produk $model): bool
    {
        return $user->hasPermissionTo('view produks');
    }

    /**
     * Determine whether the produk can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create produks');
    }

    /**
     * Determine whether the produk can update the model.
     */
    public function update(User $user, Produk $model): bool
    {
        return $user->hasPermissionTo('update produks');
    }

    /**
     * Determine whether the produk can delete the model.
     */
    public function delete(User $user, Produk $model): bool
    {
        return $user->hasPermissionTo('delete produks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete produks');
    }

    /**
     * Determine whether the produk can restore the model.
     */
    public function restore(User $user, Produk $model): bool
    {
        return false;
    }

    /**
     * Determine whether the produk can permanently delete the model.
     */
    public function forceDelete(User $user, Produk $model): bool
    {
        return false;
    }
}
