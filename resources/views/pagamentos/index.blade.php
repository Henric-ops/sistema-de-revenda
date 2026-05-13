@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pagamentos</h1>
        <a href="{{ route('pagamentos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Novo Pagamento
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtros -->
    <div class="mb-6 bg-gray-100 p-4 rounded">
        <form method="GET" action="{{ route('pagamentos.index') }}" class="grid grid-cols-4 gap-4">
            <input type="text" name="metodo" placeholder="Método de Pagamento" 
                value="{{ request('metodo') }}" class="px-4 py-2 border border-gray-300 rounded">
            
            <input type="date" name="data_inicio" placeholder="Data Início"
                value="{{ request('data_inicio') }}" class="px-4 py-2 border border-gray-300 rounded">
            
            <input type="date" name="data_fim" placeholder="Data Fim"
                value="{{ request('data_fim') }}" class="px-4 py-2 border border-gray-300 rounded">
            
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filtrar
            </button>
        </form>
    </div>

    <!-- Tabela -->
    <div class="overflow-x-auto shadow-md rounded">
        <table class="w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-700 font-bold">ID</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-bold">Cliente</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-bold">Valor Pago</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-bold">Método</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-bold">Data</th>
                    <th class="px-6 py-3 text-center text-gray-700 font-bold">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagamentos as $pagamento)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-800">#{{ $pagamento->id }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $pagamento->compra->cliente->nome }}</td>
                        <td class="px-6 py-4 text-gray-800 font-bold">R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ ucfirst($pagamento->metodo_pagamento) }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $pagamento->data_pagamento->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('pagamentos.show', $pagamento) }}" class="text-blue-500 hover:text-blue-700 mr-2">Ver</a>
                            <a href="{{ route('pagamentos.edit', $pagamento) }}" class="text-green-500 hover:text-green-700 mr-2">Editar</a>
                            <form method="POST" action="{{ route('pagamentos.destroy', $pagamento) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Nenhum pagamento encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="mt-6">
        {{ $pagamentos->links() }}
    </div>
</div>
@endsection
