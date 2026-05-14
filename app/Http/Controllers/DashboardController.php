<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();

        $totalCompras = Compra::count();

        $totalRecebido = Pagamento::sum('valor_pago');

        // 🔥 saldo real em aberto
        $totalAberto = Compra::with('pagamentos')
            ->get()
            ->sum('saldo_restante');

        $inadimplentes = Compra::where('status', '!=', 'pago')
            ->with(['cliente', 'pagamentos'])
            ->latest()
            ->take(5)
            ->get();

        $ultimosPagamentos = Pagamento::latest()
            ->take(5)
            ->get();

        // 📊 GRÁFICOS (últimos 6 meses)
        $meses = [];
        $valoresRecebidos = [];
        $valoresInadimplencia = [];

        for ($i = 5; $i >= 0; $i--) {

            $mes = Carbon::now()->subMonths($i);

            $meses[] = $mes->format('M/Y');

            // 💰 TOTAL RECEBIDO NO MÊS
            $valoresRecebidos[] = Pagamento::whereYear('data_pagamento', $mes->year)
                ->whereMonth('data_pagamento', $mes->month)
                ->sum('valor_pago');

            // ⚠️ INADIMPLÊNCIA DO MÊS
            $comprasMes = Compra::with('pagamentos')
                ->whereYear('created_at', $mes->year)
                ->whereMonth('created_at', $mes->month)
                ->get();

            $valoresInadimplencia[] = $comprasMes->sum(function ($compra) {

                $totalPago = $compra->pagamentos->sum('valor_pago');

                return $compra->valor_total - $totalPago;
            });
        }

        return view('dashboard.index', compact(
            'totalClientes',
            'totalCompras',
            'totalRecebido',
            'totalAberto',
            'inadimplentes',
            'ultimosPagamentos',
            'meses',
            'valoresRecebidos',
            'valoresInadimplencia'
        ));
    }
}