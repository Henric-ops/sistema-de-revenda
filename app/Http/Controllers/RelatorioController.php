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
}