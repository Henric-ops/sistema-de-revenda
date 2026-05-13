@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Editar Pagamento</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pagamentos.update', $pagamento) }}" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="compra_id" class="block text-gray-700 font-bold mb-2">Compra <span class="text-red-500">*</span></label>
            <select name="compra_id" id="compra_id" class="w-full px-4 py-2 border border-gray-300 rounded @error('compra_id') border-red-500 @enderror" required>
                <option value="">Selecione uma compra</option>
                @foreach($compras as $compra)
                    <option value="{{ $compra->id }}" @selected(old('compra_id', $pagamento->compra_id) == $compra->id)>
                        #{{ $compra->id }} - {{ $compra->cliente->nome }} - R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('compra_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="valor_pago" class="block text-gray-700 font-bold mb-2">Valor Pago <span class="text-red-500">*</span></label>
            <input type="number" name="valor_pago" id="valor_pago" step="0.01" min="0.01" 
                value="{{ old('valor_pago', $pagamento->valor_pago) }}" class="w-full px-4 py-2 border border-gray-300 rounded @error('valor_pago') border-red-500 @enderror" required>
            @error('valor_pago')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="metodo_pagamento" class="block text-gray-700 font-bold mb-2">Método de Pagamento <span class="text-red-500">*</span></label>
            <select name="metodo_pagamento" id="metodo_pagamento" class="w-full px-4 py-2 border border-gray-300 rounded @error('metodo_pagamento') border-red-500 @enderror" required>
                <option value="">Selecione um método</option>
                <option value="dinheiro" @selected(old('metodo_pagamento', $pagamento->metodo_pagamento) == 'dinheiro')>Dinheiro</option>
                <option value="credito" @selected(old('metodo_pagamento', $pagamento->metodo_pagamento) == 'credito')>Cartão de Crédito</option>
                <option value="debito" @selected(old('metodo_pagamento', $pagamento->metodo_pagamento) == 'debito')>Cartão de Débito</option>
                <option value="pix" @selected(old('metodo_pagamento', $pagamento->metodo_pagamento) == 'pix')>PIX</option>
                <option value="boleto" @selected(old('metodo_pagamento', $pagamento->metodo_pagamento) == 'boleto')>Boleto</option>
                <option value="cheque" @selected(old('metodo_pagamento', $pagamento->metodo_pagamento) == 'cheque')>Cheque</option>
                <option value="transferencia" @selected(old('metodo_pagamento', $pagamento->metodo_pagamento) == 'transferencia')>Transferência</option>
            </select>
            @error('metodo_pagamento')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="data_pagamento" class="block text-gray-700 font-bold mb-2">Data do Pagamento <span class="text-red-500">*</span></label>
            <input type="date" name="data_pagamento" id="data_pagamento" 
                value="{{ old('data_pagamento', $pagamento->data_pagamento->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded @error('data_pagamento') border-red-500 @enderror" required>
            @error('data_pagamento')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="observacoes" class="block text-gray-700 font-bold mb-2">Observações</label>
            <textarea name="observacoes" id="observacoes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded @error('observacoes') border-red-500 @enderror">{{ old('observacoes', $pagamento->observacoes) }}</textarea>
            @error('observacoes')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Atualizar Pagamento
            </button>
            <a href="{{ route('pagamentos.show', $pagamento) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
