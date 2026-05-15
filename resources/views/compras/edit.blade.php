@extends('layouts.app')

@section('title', 'Editar Compra')

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

    .fields-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .fields-grid .field-full {
        grid-column: 1 / -1;
    }

    .field {
        margin-bottom: 18px;
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

    .field-wrap input,
    .field-wrap textarea,
    .field-wrap select {
        width: 100%;
        padding: 13px 16px;
        border-radius: 14px;
        border: 1.5px solid #ede0d4;
        background: #fdf9f6;
        font-size: 15px;
        color: #2a1a10;
        transition: .2s;
        appearance: none;
        resize: none;
    }

    .field-wrap input:focus,
    .field-wrap textarea:focus,
    .field-wrap select:focus {
        outline: none;
        border-color: #9c4a30;
        background: white;
        box-shadow: 0 0 0 4px rgba(156, 74, 48, .1);
    }

    .field-error {
        font-size: 12px;
        color: #d94b4b;
        margin-top: 6px;
        font-weight: 600;
    }

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
    transition: border-color .2s, color .2s, background .2s, transform .2s;
}

.btn-cancelar:hover {
    border-color: #9c4a30;
    color: #9c4a30;
    background: #fdf4f0;
    text-decoration: none;
    transform: translateY(-2px);
}

.btn-cancelar:active {
    transform: translateY(0);
}
    @media (max-width: 600px) {
        .fields-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

<div class="create-wrapper">

    <div class="create-header">
        <div class="create-header-icon">
            <i class="bi bi-pencil-square"></i>
        </div>
        <div class="create-header-text">
            <h2>Editar Compra</h2>
            <p>Atualize as informações da compra.</p>
        </div>
    </div>

    <div class="create-card">

        <form action="{{ route('compras.update', $compra->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="create-card-body">

                {{-- CLIENTE --}}
                <div class="field field-full">
                    <label>Cliente</label>
                    <div class="field-wrap">
                        <select name="cliente_id" required>
                            <option value="">Escolha um cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    @selected(old('cliente_id', $compra->cliente_id) == $cliente->id)>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="create-divider"></div>

                {{-- PRODUTOS --}}
                <div class="field field-full">
                    <label>Descrição dos produtos</label>
                    <div class="field-wrap">
                        <textarea name="descricao_produtos" rows="3">{{ old('descricao_produtos', $compra->descricao_produtos) }}</textarea>
                    </div>
                </div>

                <div class="create-divider"></div>

                {{-- PAGAMENTO --}}
                <div class="fields-grid">

                    <div class="field">
                        <label>Valor total</label>
                        <div class="field-wrap">
                            <input type="number" id="valor_total" name="valor_total"
                                value="{{ old('valor_total', $compra->valor_total) }}"
                                onchange="calcularParcela()">
                        </div>
                    </div>

                    <div class="field">
                        <label>Forma de pagamento</label>
                        <div class="field-wrap">
                            <select name="forma_pagamento" onchange="calcularParcela()">
                                <option value="">Selecione...</option>
                                <option value="pix" @selected($compra->forma_pagamento=='pix')>Pix</option>
                                <option value="dinheiro" @selected($compra->forma_pagamento=='dinheiro')>Dinheiro</option>
                                <option value="debito" @selected($compra->forma_pagamento=='debito')>Débito</option>
                                <option value="credito" @selected($compra->forma_pagamento=='credito')>Crédito</option>
                                <option value="crediario" @selected($compra->forma_pagamento=='crediario')>Crediário</option>
                            </select>
                        </div>
                    </div>

                    {{-- ✅ CORRIGIDO: PARCELAS --}}
                    <div class="field">
                        <label>Quantidade de parcelas</label>
                        <div class="field-wrap">
                            <input type="number" id="qtd_parcelas" name="qtd_parcelas"
                                value="{{ old('qtd_parcelas', $compra->qtd_parcelas) }}"
                                onchange="calcularParcela()">
                        </div>
                        <div class="parcela-preview" id="parcela-preview"></div>
                    </div>

                    {{-- ✅ CORRIGIDO: DATA --}}
                    <div class="field">
                        <label>Data da compra</label>
                        <div class="field-wrap">
                            <input type="date" name="data_compra"
                                value="{{ old('data_compra', $compra->data_compra) }}">
                        </div>
                    </div>

                </div>

                <div class="create-divider"></div>

                {{-- OBS --}}
                <div class="field field-full">
                    <label>Observações</label>
                    <div class="field-wrap">
                        <textarea name="observacoes">{{ old('observacoes', $compra->observacoes) }}</textarea>
                    </div>
                </div>

            </div>

            <div class="create-card-footer">
                <button class="btn-salvar">Atualizar</button>
                <a href="{{ route('compras.index') }}" class="btn-cancelar">Voltar</a>
            </div>

        </form>

    </div>
</div>

<script>
function calcularParcela() {
    const valor = parseFloat(document.getElementById('valor_total').value) || 0;
    const qtd = parseInt(document.getElementById('qtd_parcelas').value) || 0;
    const preview = document.getElementById('parcela-preview');

    if (valor > 0 && qtd > 0) {
        preview.innerHTML = `${qtd}x de R$ ${(valor/qtd).toFixed(2).replace('.', ',')}`;
    } else {
        preview.innerHTML = '';
    }
}
</script>

@endsection