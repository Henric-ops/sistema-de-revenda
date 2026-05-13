<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;

class ClientePolicy
{
    /**
     * Determine if user can view all clientes
     */
    public function viewAny(User $user): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can view a specific cliente
     */
    public function view(User $user, Cliente $cliente): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can create a cliente
     */
    public function create(User $user): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can update a cliente
     */
    public function update(User $user, Cliente $cliente): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can delete a cliente
     */
    public function delete(User $user, Cliente $cliente): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can restore a cliente
     */
    public function restore(User $user, Cliente $cliente): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can permanently delete a cliente
     */
    public function forceDelete(User $user, Cliente $cliente): bool
    {
        return $user->id !== null;
    }
}
