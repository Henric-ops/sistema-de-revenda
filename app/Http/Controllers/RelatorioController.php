<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Pagamento;
use Barryvdh\DomPDF\Facade\Pdf;


class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function inadimplentesPdf()
    {
        $compras = Compra::where('status', '!=', 'pago')
            ->with('cliente', 'pagamentos')
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'relatorios.pdf.inadimplentes',
            compact('compras')
        );

        return $pdf->stream('clientes-inadimplentes.pdf');
    }

    public function pagamentosPdf()
    {
        $pagamentos = Pagamento::latest()
            ->with('compra.cliente')
            ->get();

        $pdf = Pdf::loadView(
            'relatorios.pdf.pagamentos',
            compact('pagamentos')
        );

        return $pdf->stream('pagamentos.pdf');
    }

    public function comprasPeriodo(Request $request)
    {
        $query = \App\Models\Compra::with('cliente');

        if ($request->periodo == 'hoje') {

            $query->whereDate('data_compra', today());

        } elseif ($request->periodo == 'semana') {

            $query->whereBetween('data_compra', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);

        } elseif ($request->periodo == 'mes') {

            $query->whereMonth('data_compra', now()->month)
                ->whereYear('data_compra', now()->year);

        } elseif (
            $request->periodo == 'personalizado'
            && $request->data_inicio
            && $request->data_fim
        ) {

            $query->whereBetween('data_compra', [
                $request->data_inicio,
                $request->data_fim
            ]);
        }

        $compras = $query
            ->orderBy('data_compra', 'desc')
            ->get();

        $totalVendido = $compras->sum('valor_total');

        $totalPago = $compras
            ->where('status', 'pago')
            ->sum('valor_total');

        $totalPendente = $compras
            ->where('status', '!=', 'pago')
            ->sum('valor_total');

        return view(
            'relatorios.compras-periodo',
            compact(
                'compras',
                'totalVendido',
                'totalPago',
                'totalPendente'
            )
        );
    }
}