<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TampungBayar;
use Illuminate\Auth\Access\HandlesAuthorization;

class TampungBayarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tampungBayar can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can view the model.
     */
    public function view(User $user, TampungBayar $model): bool
    {
        return $user->hasPermissionTo('view tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can update the model.
     */
    public function update(User $user, TampungBayar $model): bool
    {
        return $user->hasPermissionTo('update tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can delete the model.
     */
    public function delete(User $user, TampungBayar $model): bool
    {
        return $user->hasPermissionTo('delete tampungbayars');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can restore the model.
     */
    public function restore(User $user, TampungBayar $model): bool
    {
        return false;
    }

    /**
     * Determine whether the tampungBayar can permanently delete the model.
     */
    public function forceDelete(User $user, TampungBayar $model): bool
    {
        return false;
    }
}
