<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Requests\StoreComprasRequest;
use App\Http\Requests\UpdateComprasRequest;
use App\Models\Cliente;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('cliente')
            ->latest()
            ->get();

        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::where('ativo', true)->get();

        return view('compras.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComprasRequest $request)
    {
        Compra::create([

            'cliente_id' => $request->cliente_id,

            'descricao_produtos' => $request->descricao_produtos,

            'valor_total' => $request->valor_total,

            'forma_pagamento' => $request->forma_pagamento,

            'qtd_parcelas' => $request->qtd_parcelas,

            'status' => 'pendente',

            'observacoes' => $request->observacoes,

            'data_compra' => $request->data_compra,
        ]);

        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        $compra->load('cliente', 'pagamentos');

        return view(
            'compras.show',
            compact('compra')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        $clientes = Cliente::where('ativo', true)->get();

        return view('compras.edit', compact('compra', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComprasRequest $request, Compra $compra)
    {
        $compra->update([
            'cliente_id' => $request->cliente_id,
            'descricao_produtos' => $request->descricao_produtos,
            'valor_total' => $request->valor_total,
            'forma_pagamento' => $request->forma_pagamento,
            'qtd_parcelas' => $request->qtd_parcelas,
            'observacoes' => $request->observacoes,
            'data_compra' => $request->data_compra,
        ]);

        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        $compra->delete();

        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra deletada com sucesso!');
    }
}