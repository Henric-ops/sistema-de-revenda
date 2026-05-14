<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteAtivoMiddleware
{
    /**
     * Verifica se o cliente logado está ativo e vinculado ao usuário
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->tipo === 'cliente') {
            $cliente = auth()->user()->cliente;

            // Se não encontrar cliente vinculado
            if (!$cliente) {
                auth()->logout();
                return redirect('/login')
                    ->with('erro', 'Cliente não vinculado. Contate o suporte.');
            }

            // Se o cliente não está ativo
            if (!$cliente->ativo) {
                auth()->logout();
                return redirect('/login')
                    ->with('erro', 'Seu acesso foi bloqueado. Contate o administrador.');
            }
        }

        return $next($request);
    }
}
