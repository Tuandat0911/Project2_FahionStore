<?php

namespace App\Policies;

use App\Models\InventoryTransaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InventoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.list-inventory'));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.add-inventory'));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InventoryTransaction $inventoryTransaction): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InventoryTransaction $inventoryTransaction): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InventoryTransaction $inventoryTransaction): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InventoryTransaction $inventoryTransaction): bool
    {
        //
    }
}
