<?php

namespace App\Policies;

use App\Models\Pagamento;
use App\Models\User;

class PagamentoPolicy
{
    /**
     * Determine if user can view all pagamentos
     */
    public function viewAny(User $user): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can view a specific pagamento
     */
    public function view(User $user, Pagamento $pagamento): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can create a pagamento
     */
    public function create(User $user): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can update a pagamento
     */
    public function update(User $user, Pagamento $pagamento): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can delete a pagamento
     */
    public function delete(User $user, Pagamento $pagamento): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can restore a pagamento
     */
    public function restore(User $user, Pagamento $pagamento): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine if user can permanently delete a pagamento
     */
    public function forceDelete(User $user, Pagamento $pagamento): bool
    {
        return $user->id !== null;
    }
}
