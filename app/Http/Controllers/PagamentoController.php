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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamento $pagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagamentosRequest $request, Pagamento $pagamento)
    {
        //
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
