<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Pagamento;
class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function inadimplentes()
    {
        $compras = Compra::where('status', '!=', 'pago')
            ->with('cliente', 'pagamentos')
            ->latest()
            ->get();

        return view(
            'relatorios.inadimplentes',
            compact('compras')
        );
    }

    public function pagamentos()
    {
        $pagamentos = Pagamento::latest()
            ->get();

        return view(
            'relatorios.pagamentos',
            compact('pagamentos')
        );
    }
}
