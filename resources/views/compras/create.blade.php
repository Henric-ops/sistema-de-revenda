@extends('layouts.app')

@section('title', 'Nova Compra')

@push('styles')
    <style>
        /* ── LAYOUT ──────────────────────────────────────── */
        .create-wrapper {
            max-width: 680px;
        }

        /* ── HEADER ──────────────────────────────────────── */
        .create-header {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 32px;
        }

        .create-header-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 6px 16px rgba(156, 74, 48, .25);
        }

        .create-header-text h2 {
            font-size: 22px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0 0 4px;
        }

        .create-header-text p {
            font-size: 13px;
            color: #b09080;
            margin: 0;
            font-weight: 500;
        }

        /* ── CARD ────────────────────────────────────────── */
        .create-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 18px rgba(156, 74, 48, .06);
            overflow: hidden;
        }

        .create-card-body {
            padding: 32px;
        }

        /* Seção com título */
        .section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #b09080;
            margin-bottom: 18px;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f5ebe0;
        }

        .create-divider {
            height: 1px;
            background: #f5ebe0;
            margin: 26px 0;
        }

        /* Grid de 2 colunas */
        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .fields-grid .field-full {
            grid-column: 1 / -1;
        }

        /* ── CAMPOS ──────────────────────────────────────── */
        .field {
            margin-bottom: 18px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .field label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #4a3020;
            margin-bottom: 9px;
        }

        .field label i {
            font-size: 14px;
            color: #c0a898;
        }

        .field label .optional {
            font-weight: 400;
            color: #c0a898;
            font-size: 12px;
        }

        .field-wrap input,
        .field-wrap textarea,
        .field-wrap select {
            width: 100%;
            padding: 13px 16px;
            border-radius: 14px;
            border: 1.5px solid #ede0d4;
            background: #fdf9f6;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            color: #2a1a10;
            transition: border-color .2s, box-shadow .2s, background .2s;
            appearance: none;
            -webkit-appearance: none;
            resize: none;
        }

        .field-wrap input::placeholder,
        .field-wrap textarea::placeholder {
            color: #d0b8a8;
        }

        .field-wrap input:focus,
        .field-wrap textarea:focus,
        .field-wrap select:focus {
            outline: none;
            border-color: #9c4a30;
            background: white;
            box-shadow: 0 0 0 4px rgba(156, 74, 48, .1);
        }

        /* Select com seta customizada */
        .field-wrap.select-wrap {
            position: relative;
        }

        .field-wrap.select-wrap::after {
            content: '\F282';
            font-family: 'Bootstrap-Icons';
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #c0a898;
            pointer-events: none;
            font-size: 14px;
        }

        .field-wrap.select-wrap select {
            padding-right: 42px;
            cursor: pointer;
        }

        /* Prefixo R$ no valor */
        .field-wrap.prefix-wrap {
            position: relative;
        }

        .field-wrap.prefix-wrap .prefix {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            font-weight: 700;
            color: #b09080;
            pointer-events: none;
        }

        .field-wrap.prefix-wrap input {
            padding-left: 40px;
        }

        /* Preview do valor por parcela */
        .parcela-preview {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 7px;
            font-size: 12px;
            font-weight: 600;
            color: #9c4a30;
            min-height: 18px;
            transition: opacity .2s;
        }

        .parcela-preview i {
            font-size: 12px;
        }

        /* Erros */
        .field-error {
            font-size: 12px;
            color: #d94b4b;
            margin-top: 6px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .field-wrap input.is-invalid,
        .field-wrap textarea.is-invalid,
        .field-wrap select.is-invalid {
            border-color: #d94b4b;
            background: #fff8f8;
        }

        /* ── RODAPÉ ──────────────────────────────────────── */
        .create-card-footer {
            padding: 24px 32px;
            background: #fdf8f4;
            border-top: 1px solid #f5ebe0;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-salvar {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 13px 28px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(156, 74, 48, .25);
        }

        .btn-salvar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(156, 74, 48, .3);
        }

        .btn-salvar:active {
            transform: translateY(0);
        }

        .btn-cancelar {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 13px 22px;
            border-radius: 14px;
            border: 1.5px solid #ede0d4;
            background: white;
            color: #8a7060;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .2s, color .2s, background .2s;
        }

        .btn-cancelar:hover {
            border-color: #9c4a30;
            color: #9c4a30;
            background: #fdf4f0;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .fields-grid {
                grid-template-columns: 1fr;
            }

            .create-card-body {
                padding: 24px;
            }

            .create-card-footer {
                padding: 20px 24px;
                flex-direction: column;
            }

            .btn-salvar,
            .btn-cancelar {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')

    <div class="create-wrapper">

        {{-- HEADER --}}
        <div class="create-header">
            <div class="create-header-icon">
                <i class="bi bi-bag-plus-fill"></i>
            </div>
            <div class="create-header-text">
                <h2>Nova Compra</h2>
                <p>Registre uma nova compra no sistema.</p>
            </div>
        </div>

        <div class="create-card">
            <form action="{{ route('compras.store') }}" method="POST" id="form-compra">
                @csrf

                <div class="create-card-body">

                    {{-- SEÇÃO: Cliente --}}
                    <div class="section-label">
                        <i class="bi bi-person"></i> Cliente
                    </div>

                    <div class="field">
                        <label for="cliente_id">
                            <i class="bi bi-person-circle"></i>
                            Selecione o cliente
                        </label>
                        <div class="field-wrap select-wrap">
                            <select name="cliente_id" id="cliente_id" required>
                                <option value="">Escolha um cliente...</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" @selected(old('cliente_id') == $cliente->id)>
                                        {{ $cliente->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('cliente_id')
                            <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="create-divider"></div>

                    {{-- SEÇÃO: Produtos --}}
                    <div class="section-label">
                        <i class="bi bi-box-seam"></i> Produtos
                    </div>

                    <div class="field">
                        <label for="descricao_produtos">
                            <i class="bi bi-list-ul"></i>
                            Descrição dos produtos
                        </label>
                        <div class="field-wrap">
                            <textarea id="descricao_produtos" name="descricao_produtos" rows="3"
                                placeholder="Ex: Shampoo Elsève 400ml, Condicionador Pantene..."
                                required>{{ old('descricao_produtos') }}</textarea>
                        </div>
                        @error('descricao_produtos')
                            <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="create-divider"></div>

                    {{-- SEÇÃO: Pagamento --}}
                    <div class="section-label">
                        <i class="bi bi-cash-stack"></i> Pagamento
                    </div>

                    <div class="fields-grid">

                        {{-- Valor --}}
                        <div class="field">
                            <label for="valor_total">
                                <i class="bi bi-currency-dollar"></i>
                                Valor total
                            </label>
                            <div class="field-wrap prefix-wrap">
                                <span class="prefix">R$</span>
                                <input type="number" id="valor_total" name="valor_total" placeholder="0,00" step="0.01"
                                    min="0" value="{{ old('valor_total') }}" required>
                            </div>
                            @error('valor_total')
                                <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Parcelas --}}
                        <div class="field">
                            <label for="qtd_parcelas">
                                <i class="bi bi-calendar3"></i>
                                Parcelas
                            </label>
                            <div class="field-wrap">
                                <input type="number" id="qtd_parcelas" name="qtd_parcelas" placeholder="Ex: 3" min="1"
                                    max="36" value="{{ old('qtd_parcelas') }}" required>
                            </div>
                            <div class="parcela-preview" id="parcela-preview"></div>
                            @error('qtd_parcelas')
                                <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Forma de pagamento --}}
                        <div class="field">
                            <label for="forma_pagamento">
                                <i class="bi bi-credit-card"></i>
                                Forma de pagamento
                            </label>
                            <div class="field-wrap select-wrap">
                                <select name="forma_pagamento" id="forma_pagamento" required>
                                    <option value="">Selecione...</option>

                                    <option value="pix" @selected(old('forma_pagamento') == 'pix')>
                                        Pix
                                    </option>

                                    <option value="dinheiro" @selected(old('forma_pagamento') == 'dinheiro')>
                                        Dinheiro
                                    </option>

                                    <option value="debito" @selected(old('forma_pagamento') == 'debito')>
                                        Cartão Débito
                                    </option>

                                    <option value="credito" @selected(old('forma_pagamento') == 'credito')>
                                        Cartão Crédito
                                    </option>

                                    <option value="crediario" @selected(old('forma_pagamento') == 'crediario')>
                                        Crediário
                                    </option>
                                </select>
                            </div>
                            @error('forma_pagamento')
                                <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Data --}}
                        <div class="field">
                            <label for="data_compra">
                                <i class="bi bi-calendar-event"></i>
                                Data da compra
                            </label>
                            <div class="field-wrap">
                                <input type="date" id="data_compra" name="data_compra"
                                    value="{{ old('data_compra', date('Y-m-d')) }}" required>
                            </div>
                            @error('data_compra')
                                <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="create-divider"></div>

                    {{-- Observações --}}
                    <div class="field" style="margin-bottom:0">
                        <label for="observacoes">
                            <i class="bi bi-chat-left-text"></i>
                            Observações
                            <span class="optional">(opcional)</span>
                        </label>
                        <div class="field-wrap">
                            <textarea id="observacoes" name="observacoes" rows="3"
                                placeholder="Informações adicionais sobre esta compra...">{{ old('observacoes') }}</textarea>
                        </div>
                        @error('observacoes')
                            <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- RODAPÉ --}}
                <div class="create-card-footer">
                    <button type="submit" class="btn-salvar">
                        <i class="bi bi-check-circle"></i>
                        Salvar Compra
                    </button>
                    <a href="{{ route('compras.index') }}" class="btn-cancelar">
                        <i class="bi bi-arrow-left"></i>
                        Voltar
                    </a>
                </div>

            </form>
        </div>

    </div>

@endsection