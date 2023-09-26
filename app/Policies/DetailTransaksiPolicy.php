<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DetailTransaksi;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailTransaksiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detailTransaksi can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can view the model.
     */
    public function view(User $user, DetailTransaksi $model): bool
    {
        return $user->hasPermissionTo('view detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can update the model.
     */
    public function update(User $user, DetailTransaksi $model): bool
    {
        return $user->hasPermissionTo('update detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can delete the model.
     */
    public function delete(User $user, DetailTransaksi $model): bool
    {
        return $user->hasPermissionTo('delete detailtransaksis');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can restore the model.
     */
    public function restore(User $user, DetailTransaksi $model): bool
    {
        return false;
    }

    /**
     * Determine whether the detailTransaksi can permanently delete the model.
     */
    public function forceDelete(User $user, DetailTransaksi $model): bool
    {
        return false;
    }
}
