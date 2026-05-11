<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();

        $totalCompras = Compra::count();

        $totalRecebido = Pagamento::sum('valor_pago');

        $totalVendas = Compra::sum('valor_total');

        $totalAberto = $totalVendas - $totalRecebido;

        $inadimplentes = Compra::where('status', '!=', 'pago')
            ->with('cliente')
            ->latest()
            ->take(5)
            ->get();

        $ultimosPagamentos = Pagamento::latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalClientes',
            'totalCompras',
            'totalRecebido',
            'totalAberto',
            'inadimplentes',
            'ultimosPagamentos'
        ));
    }
}
