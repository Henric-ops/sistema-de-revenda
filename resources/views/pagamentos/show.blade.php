@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Detalhes do Pagamento</h1>
        <div class="flex gap-2">
            <a href="{{ route('pagamentos.edit', $pagamento) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Editar
            </a>
            <form method="POST" action="{{ route('pagamentos.destroy', $pagamento) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Tem certeza?')">
                    Deletar
                </button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow-md mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Informações do Pagamento</h2>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 text-sm font-semibold">ID</p>
                <p class="text-gray-800">#{{ $pagamento->id }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Valor Pago</p>
                <p class="text-gray-800 font-bold text-lg">R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Método de Pagamento</p>
                <p class="text-gray-800">{{ ucfirst($pagamento->metodo_pagamento) }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Data do Pagamento</p>
                <p class="text-gray-800">{{ $pagamento->data_pagamento->format('d/m/Y') }}</p>
            </div>

            @if ($pagamento->observacoes)
                <div class="col-span-2">
                    <p class="text-gray-600 text-sm font-semibold">Observações</p>
                    <p class="text-gray-800">{{ $pagamento->observacoes }}</p>
                </div>
            @endif

            <div class="col-span-2">
                <p class="text-gray-600 text-sm font-semibold">Data de Criação</p>
                <p class="text-gray-800">{{ $pagamento->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Informações da Compra</h2>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 text-sm font-semibold">ID da Compra</p>
                <p class="text-gray-800">#{{ $pagamento->compra->id }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Cliente</p>
                <p class="text-gray-800">{{ $pagamento->compra->cliente->nome }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Valor da Compra</p>
                <p class="text-gray-800">R$ {{ number_format($pagamento->compra->valor_total, 2, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Status</p>
                <p class="text-gray-800">
                    @if ($pagamento->compra->status == 'pendente')
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Pendente</span>
                    @elseif ($pagamento->compra->status == 'parcialmente_pago')
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Parcialmente Pago</span>
                    @else
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Pago</span>
                    @endif
                </p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Total Pago</p>
                <p class="text-gray-800">R$ {{ number_format($pagamento->compra->pagamentos()->sum('valor_pago'), 2, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm font-semibold">Saldo Restante</p>
                <p class="text-gray-800">R$ {{ number_format($pagamento->compra->saldo_restante, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('pagamentos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Voltar
        </a>
    </div>
</div>
@endsection
