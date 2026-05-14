@extends('layouts.app')

@section('title', 'Detalhes da Compra')

@push('styles')
<style>
    /* ── HEADER ──────────────────────────────────────── */
    .show-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .show-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .show-header-icon {
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
        box-shadow: 0 6px 16px rgba(156,74,48,.25);
    }

    .show-header-text h2 {
        font-size: 22px;
        font-weight: 700;
        color: #2a1a10;
        margin: 0 0 4px;
    }

    .show-header-text p {
        font-size: 13px;
        color: #b09080;
        margin: 0;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .show-header-actions {
        display: flex;
        gap: 10px;
    }

    .btn-editar {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(135deg, #9c4a30, #c4693a);
        color: white;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: transform .2s, box-shadow .2s;
        box-shadow: 0 4px 12px rgba(156,74,48,.22);
    }

    .btn-editar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(156,74,48,.28);
        text-decoration: none;
        color: white;
    }

    .btn-voltar {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 18px;
        border-radius: 12px;
        border: 1.5px solid #ede0d4;
        background: white;
        color: #8a7060;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: border-color .2s, color .2s, background .2s;
    }

    .btn-voltar:hover {
        border-color: #9c4a30;
        color: #9c4a30;
        background: #fdf4f0;
        text-decoration: none;
    }

    /* ── CARDS DE INFO ───────────────────────────────── */
    .info-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .info-card-custom {
        background: white;
        border-radius: 18px;
        padding: 22px 24px;
        border: 1px solid #f5ebe0;
        box-shadow: 0 4px 14px rgba(156,74,48,.05);
        position: relative;
        overflow: hidden;
        transition: transform .2s, box-shadow .2s;
    }

    .info-card-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(156,74,48,.09);
    }

    .info-card-custom::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
    }

    .info-card-custom.card-total::before  { background: linear-gradient(90deg, #9c4a30, #c4693a); }
    .info-card-custom.card-pago::before   { background: linear-gradient(90deg, #1a8a50, #28a865); }
    .info-card-custom.card-saldo::before  { background: linear-gradient(90deg, #b07800, #d4a000); }

    .info-card-custom .card-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        color: #b09080;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-card-custom .card-value {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -.5px;
        line-height: 1;
    }

    .info-card-custom.card-total  .card-value { color: #9c4a30; }
    .info-card-custom.card-pago   .card-value { color: #1a8a50; }
    .info-card-custom.card-saldo  .card-value { color: #b07800; }

    /* ── BARRA DE PROGRESSO ──────────────────────────── */
    .progress-card {
        background: white;
        border-radius: 18px;
        padding: 22px 24px;
        border: 1px solid #f5ebe0;
        box-shadow: 0 4px 14px rgba(156,74,48,.05);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .progress-card-left { flex: 1; }

    .progress-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .progress-top span {
        font-size: 13px;
        font-weight: 600;
        color: #8a7060;
    }

    .progress-top strong {
        font-size: 14px;
        font-weight: 800;
        color: #2a1a10;
    }

    .progress-bar-wrap {
        height: 10px;
        background: #f5ebe0;
        border-radius: 99px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, #9c4a30, #c4693a);
        transition: width .6s ease;
    }

    .progress-bar-fill.completo { background: linear-gradient(90deg, #1a8a50, #28a865); }

    .progress-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .progress-badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .progress-badge.pago     { background: #e8fff0; color: #1a8a50; }
    .progress-badge.parcial  { background: #eef4ff; color: #3a6fd8; }
    .progress-badge.pendente { background: #fff8e8; color: #b07800; }

    /* ── LAYOUT PRINCIPAL ────────────────────────────── */
    .show-grid {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 20px;
        align-items: start;
    }

    /* ── FORM DE PAGAMENTO ───────────────────────────── */
    .pagamento-card {
        background: white;
        border-radius: 22px;
        border: 1px solid #f5ebe0;
        box-shadow: 0 4px 18px rgba(156,74,48,.06);
        overflow: hidden;
        position: sticky;
        top: 20px;
    }

    .pagamento-card-header {
        padding: 22px 26px 18px;
        border-bottom: 1px solid #f5ebe0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pagamento-card-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #e8fdf0, #c8f0d8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #1a8a50;
    }

    .pagamento-card-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #2a1a10;
        margin: 0;
    }

    .pagamento-card-body { padding: 22px 26px; }

    .field { margin-bottom: 18px; }
    .field:last-of-type { margin-bottom: 0; }

    .field label {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        font-weight: 700;
        color: #4a3020;
        margin-bottom: 8px;
    }

    .field label i { font-size: 13px; color: #c0a898; }

    .field-wrap { position: relative; }

    .field-wrap input,
    .field-wrap select {
        width: 100%;
        padding: 12px 16px;
        border-radius: 13px;
        border: 1.5px solid #ede0d4;
        background: #fdf9f6;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        color: #2a1a10;
        transition: border-color .2s, box-shadow .2s, background .2s;
        appearance: none;
        -webkit-appearance: none;
    }

    .field-wrap input::placeholder { color: #d0b8a8; }

    .field-wrap input:focus,
    .field-wrap select:focus {
        outline: none;
        border-color: #9c4a30;
        background: white;
        box-shadow: 0 0 0 4px rgba(156,74,48,.1);
    }

    .field-wrap.select-wrap::after {
        content: '\F282';
        font-family: 'Bootstrap-Icons';
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #c0a898;
        pointer-events: none;
        font-size: 13px;
    }

    .field-wrap.prefix-wrap .prefix {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 13px;
        font-weight: 700;
        color: #b09080;
        pointer-events: none;
    }

    .field-wrap.prefix-wrap input { padding-left: 36px; }

    .pagamento-card-footer {
        padding: 18px 26px;
        background: #fdf8f4;
        border-top: 1px solid #f5ebe0;
    }

    .btn-registrar {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 14px;
        border-radius: 14px;
        border: none;
        background: linear-gradient(135deg, #1a7a4a, #28a865);
        color: white;
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: transform .2s, box-shadow .2s;
        box-shadow: 0 4px 14px rgba(26,138,80,.25);
    }

    .btn-registrar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26,138,80,.3);
    }

    .btn-registrar:active { transform: translateY(0); }

    /* ── HISTÓRICO ───────────────────────────────────── */
    .historico-card {
        background: white;
        border-radius: 22px;
        border: 1px solid #f5ebe0;
        box-shadow: 0 4px 18px rgba(156,74,48,.06);
        overflow: hidden;
    }

    .historico-header {
        padding: 22px 26px 18px;
        border-bottom: 1px solid #f5ebe0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .historico-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .historico-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #fde8d8, #fac8a8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #9c4a30;
    }

    .historico-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #2a1a10;
        margin: 0;
    }

    .historico-count {
        font-size: 12px;
        background: #faf0ea;
        color: #9c4a30;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    /* Lista de pagamentos */
    .pagamentos-list { padding: 8px 0; }

    .pagamento-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 26px;
        border-bottom: 1px solid #faf4ee;
        transition: background .15s;
        gap: 12px;
    }

    .pagamento-item:last-child { border-bottom: none; }
    .pagamento-item:hover { background: #fdf8f5; }

    .pagamento-item-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .pagamento-item-dot {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #e8fdf0, #c8f0d8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: #1a8a50;
        flex-shrink: 0;
    }

    .pagamento-item-info { line-height: 1.3; }

    .pagamento-item-valor {
        font-size: 16px;
        font-weight: 800;
        color: #1a8a50;
    }

    .pagamento-item-meta {
        font-size: 12px;
        color: #b09080;
        font-weight: 500;
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .pagamento-item-meta i { font-size: 11px; }

    .btn-del {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        border: none;
        background: #ffeaea;
        color: #d94b4b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        cursor: pointer;
        transition: background .2s, transform .2s;
        flex-shrink: 0;
    }

    .btn-del:hover {
        background: #d94b4b;
        color: white;
        transform: scale(1.05);
    }

    /* Vazio */
    .historico-empty {
        text-align: center;
        padding: 40px 20px;
        color: #c0a898;
    }

    .historico-empty i {
        font-size: 36px;
        display: block;
        margin-bottom: 10px;
        opacity: .5;
    }

    .historico-empty p { font-size: 14px; margin: 0; }

    @media (max-width: 900px) {
        .info-cards { grid-template-columns: 1fr 1fr; }
        .show-grid  { grid-template-columns: 1fr; }
        .pagamento-card { position: static; }
    }

    @media (max-width: 560px) {
        .info-cards { grid-template-columns: 1fr; }
        .show-header { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')

@php
    $totalPago  = $compra->pagamentos->sum('valor_pago');
    $saldo      = $compra->valor_total - $totalPago;
    $pct        = $compra->valor_total > 0
                    ? min(100, round(($totalPago / $compra->valor_total) * 100))
                    : 0;
@endphp

{{-- HEADER --}}
<div class="show-header">
    <div class="show-header-left">
        <div class="show-header-icon">
            <i class="bi bi-bag-check-fill"></i>
        </div>
        <div class="show-header-text">
            <h2>Compra #{{ $compra->id }}</h2>
            <p>
                <i class="bi bi-person"></i>
                {{ $compra->cliente->nome }}
            </p>
        </div>
    </div>
    <div class="show-header-actions">
        <a href="{{ route('compras.edit', $compra->id) }}" class="btn-editar">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('compras.index') }}" class="btn-voltar">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

{{-- CARDS DE INFO --}}
<div class="info-cards">
    <div class="info-card-custom card-total">
        <div class="card-label"><i class="bi bi-receipt"></i> Valor Total</div>
        <div class="card-value">R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</div>
    </div>
    <div class="info-card-custom card-pago">
        <div class="card-label"><i class="bi bi-check-circle"></i> Total Pago</div>
        <div class="card-value">R$ {{ number_format($totalPago, 2, ',', '.') }}</div>
    </div>
    <div class="info-card-custom card-saldo">
        <div class="card-label"><i class="bi bi-hourglass-split"></i> Saldo Restante</div>
        <div class="card-value">R$ {{ number_format($saldo, 2, ',', '.') }}</div>
    </div>
</div>

{{-- BARRA DE PROGRESSO --}}
<div class="progress-card">
    <div class="progress-card-left">
        <div class="progress-top">
            <span>Progresso do pagamento</span>
            <strong>{{ $pct }}%</strong>
        </div>
        <div class="progress-bar-wrap">
            <div class="progress-bar-fill {{ $pct >= 100 ? 'completo' : '' }}"
                 style="width: {{ $pct }}%"></div>
        </div>
    </div>
    @if($compra->status == 'pago')
        <span class="progress-badge pago">Pago</span>
    @elseif($compra->status == 'parcial')
        <span class="progress-badge parcial">Parcial</span>
    @else
        <span class="progress-badge pendente">Pendente</span>
    @endif
</div>

{{-- GRID: FORM + HISTÓRICO --}}
<div class="show-grid">

    {{-- FORM DE PAGAMENTO --}}
    <div class="pagamento-card">
        <div class="pagamento-card-header">
            <div class="pagamento-card-header-icon">
                <i class="bi bi-cash-coin"></i>
            </div>
            <h3>Registrar Pagamento</h3>
        </div>

        <form action="{{ route('pagamentos.store') }}" method="POST">
            @csrf
            <input type="hidden" name="compra_id" value="{{ $compra->id }}">

            <div class="pagamento-card-body">

                <div class="field">
                    <label for="valor_pago">
                        <i class="bi bi-currency-dollar"></i>
                        Valor pago
                    </label>
                    <div class="field-wrap prefix-wrap">
                        <span class="prefix">R$</span>
                        <input type="number" id="valor_pago" name="valor_pago"
                            step="0.01" min="0.01"
                            placeholder="0,00" required>
                    </div>
                </div>

                <div class="field">
                    <label for="metodo_pagamento">
                        <i class="bi bi-credit-card"></i>
                        Método
                    </label>
                    <div class="field-wrap select-wrap">
                        <select name="metodo_pagamento" id="metodo_pagamento">
                            <option value="pix">Pix</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="credito">Cartão de Crédito</option>
                                <option value="debito">Cartão de Débito</option>
                                <option value="boleto">Boleto</option>
                                <option value="transferencia">Transferência</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label for="data_pagamento">
                        <i class="bi bi-calendar-event"></i>
                        Data do pagamento
                    </label>
                    <div class="field-wrap">
                        <input type="date" id="data_pagamento" name="data_pagamento"
                            value="{{ date('Y-m-d') }}" required >
                    </div>
                </div>

            </div>

            <div class="pagamento-card-footer">
                <button type="submit" class="btn-registrar">
                    <i class="bi bi-check-circle"></i>
                    Registrar Pagamento
                </button>
            </div>
        </form>
    </div>

    {{-- HISTÓRICO --}}
    <div class="historico-card">
        <div class="historico-header">
            <div class="historico-header-left">
                <div class="historico-header-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h3>Histórico de Pagamentos</h3>
            </div>
            <span class="historico-count">{{ $compra->pagamentos->count() }} registros</span>
        </div>

        @if($compra->pagamentos->count() > 0)
            <div class="pagamentos-list">
                @foreach($compra->pagamentos as $pagamento)
                    @php $dataPag = \Carbon\Carbon::parse($pagamento->data_pagamento); @endphp
                    <div class="pagamento-item">
                        <div class="pagamento-item-left">
                            <div class="pagamento-item-dot">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="pagamento-item-info">
                                <div class="pagamento-item-valor">
                                    R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}
                                </div>
                                <div class="pagamento-item-meta">
                                    <i class="bi bi-credit-card"></i>
                                    {{ $pagamento->metodo_pagamento }}
                                    &nbsp;·&nbsp;
                                    <i class="bi bi-calendar3"></i>
                                    {{ $dataPag->format('d/m/Y') }}
                                    &nbsp;·&nbsp;
                                    {{ $dataPag->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pagamentos.destroy', $pagamento->id) }}" method="POST"
                            onsubmit="return confirm('Remover este pagamento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-del" title="Remover pagamento">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="historico-empty">
                <i class="bi bi-inbox"></i>
                <p>Nenhum pagamento registrado ainda.</p>
            </div>
        @endif
    </div>

</div>

@endsection