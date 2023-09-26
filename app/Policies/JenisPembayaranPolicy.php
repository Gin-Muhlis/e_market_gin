<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JenisPembayaran;
use Illuminate\Auth\Access\HandlesAuthorization;

class JenisPembayaranPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jenisPembayaran can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list jenispembayarans');
    }

    /**
     * Determine whether the jenisPembayaran can view the model.
     */
    public function view(User $user, JenisPembayaran $model): bool
    {
        return $user->hasPermissionTo('view jenispembayarans');
    }

    /**
     * Determine whether the jenisPembayaran can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create jenispembayarans');
    }

    /**
     * Determine whether the jenisPembayaran can update the model.
     */
    public function update(User $user, JenisPembayaran $model): bool
    {
        return $user->hasPermissionTo('update jenispembayarans');
    }

    /**
     * Determine whether the jenisPembayaran can delete the model.
     */
    public function delete(User $user, JenisPembayaran $model): bool
    {
        return $user->hasPermissionTo('delete jenispembayarans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete jenispembayarans');
    }

    /**
     * Determine whether the jenisPembayaran can restore the model.
     */
    public function restore(User $user, JenisPembayaran $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jenisPembayaran can permanently delete the model.
     */
    public function forceDelete(User $user, JenisPembayaran $model): bool
    {
        return false;
    }
}
