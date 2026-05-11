@extends('layouts.app')

@section('title', 'Editar Compra')

@section('content')

    <div class="form-container">

        <div class="form-header">

            <h2>
                Editar Compra
            </h2>

            <p>
                Atualize as informações da compra.
            </p>

        </div>

        <form action="{{ route('compras.update', $compra->id) }}" method="POST" class="custom-form">

            @csrf
            @method('PUT')

            {{-- CLIENTE --}}
            <div class="form-group">

                <label>
                    Cliente
                </label>

                <select name="cliente_id" required>

                    <option value="">
                        Selecione um cliente
                    </option>

                    @foreach($clientes as $cliente)

                        <option value="{{ $cliente->id }}" @selected($compra->cliente_id === $cliente->id)>

                            {{ $cliente->nome }}

                        </option>

                    @endforeach

                </select>

                @error('cliente_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            {{-- DESCRIÇÃO DOS PRODUTOS --}}
            <div class="form-group">

                <label>
                    Descrição dos Produtos
                </label>

                <textarea name="descricao_produtos" rows="3" placeholder="Descreva os produtos ou serviços..." required>{{ old('descricao_produtos', $compra->descricao_produtos) }}</textarea>

                @error('descricao_produtos')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            {{-- VALOR --}}
            <div class="form-group">

                <label>
                    Valor Total
                </label>

                <input type="number" step="0.01" name="valor_total" value="{{ old('valor_total', $compra->valor_total) }}" placeholder="0,00" required>

                @error('valor_total')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            {{-- FORMA DE PAGAMENTO --}}
            <div class="form-group">

                <label>
                    Forma de Pagamento
                </label>

                <select name="forma_pagamento" required>

                    <option value="">
                        Selecione a forma
                    </option>

                    <option value="Pix" @selected(old('forma_pagamento', $compra->forma_pagamento) == 'Pix')>Pix</option>

                    <option value="Dinheiro" @selected(old('forma_pagamento', $compra->forma_pagamento) == 'Dinheiro')>Dinheiro</option>

                    <option value="Cartão Débito" @selected(old('forma_pagamento', $compra->forma_pagamento) == 'Cartão Débito')>Cartão Débito</option>

                    <option value="Cartão Crédito" @selected(old('forma_pagamento', $compra->forma_pagamento) == 'Cartão Crédito')>Cartão Crédito</option>

                    <option value="Crediário" @selected(old('forma_pagamento', $compra->forma_pagamento) == 'Crediário')>Crediário</option>

                </select>

                @error('forma_pagamento')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            {{-- PARCELAS --}}
            <div class="form-group">

                <label>
                    Quantidade de Parcelas
                </label>

                <input type="number" name="qtd_parcelas" value="{{ old('qtd_parcelas', $compra->qtd_parcelas) }}" placeholder="Ex: 3" required>

                @error('qtd_parcelas')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            {{-- DATA --}}
            <div class="form-group">

                <label>
                    Data da Compra
                </label>

                <input type="date" name="data_compra" value="{{ old('data_compra', $compra->data_compra) }}" required>

                @error('data_compra')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            {{-- OBS --}}
            <div class="form-group">

                <label>
                    Observações
                </label>

                <textarea name="observacoes" rows="3" placeholder="Observações adicionais...">{{ old('observacoes', $compra->observacoes) }}</textarea>

                @error('observacoes')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-actions">

                <button type="submit" class="btn-primary-custom">

                    <i class="bi bi-check-circle"></i>

                    Atualizar Compra

                </button>

                <a href="{{ route('compras.index') }}" class="btn-secondary-custom">

                    <i class="bi bi-x-circle"></i>

                    Cancelar

                </a>

            </div>

        </form>

    </div>

@endsection
