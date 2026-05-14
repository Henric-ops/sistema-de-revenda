<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagamentosRequest;
use App\Http\Requests\UpdatePagamentosRequest;
use App\Models\Pagamento;
use App\Models\Compra;
use Illuminate\Http\Request;
class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Pagamento::with('compra.cliente');

        // Filtro por compra
        if ($request->filled('compra_id')) {
            $query->where('compra_id', $request->compra_id);
        }

        // Busca por método de pagamento
        if ($request->filled('metodo')) {
            $query->where('metodo_pagamento', 'LIKE', '%' . $request->metodo . '%');
        }

        // Filtro por data
        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $query->whereBetween('data_pagamento', [
                $request->data_inicio,
                $request->data_fim,
            ]);
        }

        $pagamentos = $query
            ->orderByDesc('data_pagamento')
            ->paginate(15)
            ->withQueryString();

        return view('pagamentos.index', compact('pagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $compras = Compra::with('cliente')
            ->where('status', '!=', 'pago')
            ->get();

        return view('pagamentos.create', compact('compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePagamentosRequest $request)
    {

        Pagamento::create([

            'compra_id' => $request->compra_id,

            'valor_pago' => $request->valor_pago,

            'metodo_pagamento' => $request->metodo_pagamento,

            'data_pagamento' => $request->data_pagamento,

            'observacoes' => $request->observacoes,
        ]);

        $compra = Compra::find($request->compra_id);

        $totalPago = $compra->pagamentos->sum('valor_pago');

        if ($totalPago <= 0) {

            $compra->status = 'pendente';

        } elseif ($totalPago < $compra->valor_total) {

            $compra->status = 'parcialmente_pago';

        } else {

            $compra->status = 'pago';
        }

        $compra->save();

        return back()
            ->with('success', 'Pagamento registrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagamento $pagamento)
    {
        $pagamento->load('compra.cliente');

        return view('pagamentos.show', compact('pagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamento $pagamento)
    {

        $compras = Compra::with('cliente')
            ->where('status', '!=', 'pago')
            ->orWhere('id', $pagamento->compra_id)
            ->get();

        return view('pagamentos.edit', compact('pagamento', 'compras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagamentosRequest $request, Pagamento $pagamento)
    {

        $compraAnterior = $pagamento->compra;

        $pagamento->update([
            'compra_id' => $request->compra_id,
            'valor_pago' => $request->valor_pago,
            'metodo_pagamento' => $request->metodo_pagamento,
            'data_pagamento' => $request->data_pagamento,
            'observacoes' => $request->observacoes,
        ]);

        // Recalcular status da compra antiga
        $totalPagoAnterior = $compraAnterior->pagamentos
            ->where('id', '!=', $pagamento->id)
            ->sum('valor_pago');

        if ($totalPagoAnterior <= 0) {
            $compraAnterior->status = 'pendente';
        } elseif ($totalPagoAnterior < $compraAnterior->valor_total) {
            $compraAnterior->status = 'parcialmente_pago';
        } else {
            $compraAnterior->status = 'pago';
        }
        $compraAnterior->save();

        // Recalcular status da compra nova
        $compraAtual = $pagamento->compra->fresh();
        $totalPagoAtual = $compraAtual->pagamentos()->sum('valor_pago');

        if ($totalPagoAtual <= 0) {
            $compraAtual->status = 'pendente';
        } elseif ($totalPagoAtual < $compraAtual->valor_total) {
            $compraAtual->status = 'parcialmente_pago';
        } else {
            $compraAtual->status = 'pago';
        }
        $compraAtual->save();

        return redirect()
            ->route('pagamentos.show', $pagamento)
            ->with('success', 'Pagamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamento $pagamento)
    {

        $compra = $pagamento->compra;

        $pagamento->delete();

        // Recalcular status da compra
        $totalPago = $compra->pagamentos->sum('valor_pago');

        if ($totalPago <= 0) {
            $compra->status = 'pendente';
        } elseif ($totalPago < $compra->valor_total) {
            $compra->status = 'parcialmente_pago';
        } else {
            $compra->status = 'pago';
        }

        $compra->save();

        return back()
            ->with('success', 'Pagamento deletado com sucesso!');
    }
}
