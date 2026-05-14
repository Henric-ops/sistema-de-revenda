<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Pagamento;

class ClienteDashboardController extends Controller
{
    /**
     * Exibe o dashboard do cliente com suas compras e pagamentos
     */
    public function index()
    {
        // Busca cliente vinculado ao usuário logado
        $cliente = Cliente::where('user_id', auth()->id())
            ->where('ativo', true)
            ->first();

        // Se não encontrar cliente vinculado ou ativo
        if (!$cliente) {
            auth()->logout();
            return redirect('/login')
                ->with('erro', 'Seu acesso foi revogado ou não está ativado. Contate o administrador.');
        }

        // Verifica se o usuário logado é realmente cliente
        if (auth()->user()->tipo !== 'cliente') {
            auth()->logout();
            return redirect('/login')
                ->with('erro', 'Tipo de usuário inválido.');
        }

        // Compras do cliente
        $compras = Compra::where('cliente_id', $cliente->id)
            ->latest()
            ->get();

        // Pagamentos relacionados às compras
        $pagamentos = Pagamento::whereHas('compra', function ($query) use ($cliente) {
            $query->where('cliente_id', $cliente->id);
        })
            ->latest()
            ->get();

        // Totalizações
        $totalAberto = $compras->sum('saldo_restante');
        $totalPago = $pagamentos->sum('valor_pago');
        $totalComprado = $compras->sum('valor_total');
        $saldoPendente = $totalAberto;

        return view('clientes.dashboard', compact(
            'cliente',
            'compras',
            'pagamentos',
            'totalAberto',
            'totalPago',
            'totalComprado',
            'saldoPendente'
        ));
    }
}
    