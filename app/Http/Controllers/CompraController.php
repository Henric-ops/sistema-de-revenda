<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Requests\StoreComprasRequest;
use App\Http\Requests\UpdateComprasRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function index(Request $request)
    {

        $query = Compra::query()
            ->with('cliente');

        // BUSCA POR CLIENTE
        if ($request->filled('busca')) {

            $busca = trim($request->busca);

            $query->whereHas('cliente', function ($q) use ($busca) {

                $q->where('nome', 'LIKE', '%' . $busca . '%');

            });
        }

        // FILTRO STATUS
        if ($request->filled('status') && $request->status !== 'todos') {

            $query->where('status', $request->status);

        }

        // FILTRO POR PERÍODO
        if ($request->filled('periodo')) {

            switch ($request->periodo) {

                case 'hoje':

                    $query->whereDate('data_compra', now());

                    break;

                case 'semana':

                    $query->whereBetween('data_compra', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]);

                    break;

                case 'mes':

                    $query->whereMonth('data_compra', now()->month)
                        ->whereYear('data_compra', now()->year);

                    break;

                case 'personalizado':

                    if ($request->filled('data_inicio') && $request->filled('data_fim')) {

                        $query->whereBetween('data_compra', [
                            $request->data_inicio,
                            $request->data_fim
                        ]);
                    }

                    break;
            }
        }

        $compras = $query
            ->orderByDesc('data_compra')
            ->paginate(10)
            ->withQueryString();

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