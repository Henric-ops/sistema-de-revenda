<?php

namespace App\Policies;

use App\Models\Compra;
use App\Models\User;

class CompraPolicy
{
    /**
     * Determine if user can view all compras
     */
    public function viewAny(User $user): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can view a specific compra
     */
    public function view(User $user, Compra $compra): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can create a compra
     */
    public function create(User $user): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can update a compra
     */
    public function update(User $user, Compra $compra): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can delete a compra
     */
    public function delete(User $user, Compra $compra): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can restore a compra
     */
    public function restore(User $user, Compra $compra): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can permanently delete a compra
     */
    public function forceDelete(User $user, Compra $compra): bool
    {
        return $user->id !== null;
    }
}
