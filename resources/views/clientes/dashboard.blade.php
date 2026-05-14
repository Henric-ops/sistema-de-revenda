@extends('layouts.cliente')

@section('title')
    <i class="bi bi-speedometer2" style="font-size: 28px; color: #9c4a30;"></i>
    Meu Dashboard
@endsection

@push('header-subtitle')
    <p>Acompanhe suas compras, pagamentos e saldo</p>
@endpush

@push('styles')
    <style>
        /* ── CARDS DE RESUMO ─────────────────────────────────── */
        .cliente-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 35px;
        }

        .cliente-card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #f5ebe0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cliente-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(156, 74, 48, 0.12);
        }

        .cliente-card::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            opacity: 0.08;
            background: currentColor;
        }

        .cliente-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .cliente-card-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            opacity: 0.7;
        }

        .cliente-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: rgba(156, 74, 48, 0.1);
        }

        .cliente-card-value {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
            margin-bottom: 4px;
            position: relative;
            z-index: 1;
        }

        .cliente-card-subtitle {
            font-size: 12px;
            opacity: 0.6;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        /* Variantes de cor */
        .cliente-card.card-comprado {
            color: #3a6fd8;
        }

        .cliente-card.card-pago {
            color: #1a7a4a;
        }

        .cliente-card.card-pendente {
            color: #b07800;
        }

        /* ── SEÇÕES ─────────────────────────────────────── */
        .cliente-section {
            margin-bottom: 35px;
        }

        .cliente-section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f5ebe0;
        }

        .cliente-section-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .cliente-section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0;
        }

        .cliente-section-count {
            margin-left: auto;
            font-size: 12px;
            background: #faf0ea;
            color: #9c4a30;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 20px;
        }

        /* ── TABELAS ─────────────────────────────────────── */
        .cliente-table-container {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #f5ebe0;
            overflow: hidden;
        }

        .cliente-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .cliente-table thead tr {
            border-bottom: 2px solid #f5ebe0;
        }

        .cliente-table th {
            text-align: left;
            padding: 16px 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #b09080;
        }

        .cliente-table th:first-child {
            padding-left: 0;
        }

        .cliente-table tbody tr {
            border-bottom: 1px solid #faf4ee;
            transition: background 0.15s;
        }

        .cliente-table tbody tr:last-child {
            border-bottom: none;
        }

        .cliente-table tbody tr:hover {
            background: #fdf8f5;
        }

        .cliente-table td {
            padding: 14px 12px;
            color: #2a1a10;
            font-size: 14px;
        }

        .cliente-table td:first-child {
            padding-left: 0;
        }

        /* STATUS BADGE */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pago {
            background: #f0faf5;
            color: #1a7a4a;
        }

        .status-pendente {
            background: #fff5f0;
            color: #9c4a30;
        }

        .status-parcial {
            background: #fffbf0;
            color: #b07800;
        }

        /* EMPTY STATE */
        .cliente-empty {
            background: white;
            border-radius: 18px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #f5ebe0;
        }

        .cliente-empty-icon {
            font-size: 48px;
            color: #e8c4a0;
            margin-bottom: 16px;
        }

        .cliente-empty-title {
            font-size: 18px;
            font-weight: 600;
            color: #2a1a10;
            margin-bottom: 8px;
        }

        .cliente-empty-text {
            color: #8a7060;
            font-size: 14px;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .cliente-cards {
                grid-template-columns: 1fr;
            }

            .cliente-table-container {
                overflow-x: auto;
            }

            .cliente-table {
                min-width: 100%;
            }

            .cliente-section-count {
                display: none;
            }
        }
    </style>
@endpush

@section('content')

    {{-- CARDS DE RESUMO --}}
    <div class="cliente-cards">

        {{-- Total Comprado --}}
        <div class="cliente-card card-comprado">
            <div class="cliente-card-header">
                <div>
                    <div class="cliente-card-label">Total Comprado</div>
                </div>
                <div class="cliente-card-icon">
                    <i class="bi bi-bag"></i>
                </div>
            </div>
            <div class="cliente-card-value">
                R$ {{ number_format($totalComprado, 2, ',', '.') }}
            </div>
            <div class="cliente-card-subtitle">Desde o primeiro pedido</div>
        </div>

        {{-- Total Pago --}}
        <div class="cliente-card card-pago">
            <div class="cliente-card-header">
                <div>
                    <div class="cliente-card-label">Total Pago</div>
                </div>
                <div class="cliente-card-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
            <div class="cliente-card-value">
                R$ {{ number_format($totalPago, 2, ',', '.') }}
            </div>
            <div class="cliente-card-subtitle">Já quitado</div>
        </div>

        {{-- Saldo Pendente --}}
        <div class="cliente-card card-pendente">
            <div class="cliente-card-header">
                <div>
                    <div class="cliente-card-label">Saldo Pendente</div>
                </div>
                <div class="cliente-card-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="cliente-card-value">
                R$ {{ number_format($saldoPendente, 2, ',', '.') }}
            </div>
            <div class="cliente-card-subtitle">A ser pago</div>
        </div>

    </div>

    {{-- COMPRAS --}}
    <div class="cliente-section">

        <div class="cliente-section-header">
            <div class="cliente-section-icon">
                <i class="bi bi-cart-check"></i>
            </div>
            <h2 class="cliente-section-title">Minhas Compras</h2>
            <span class="cliente-section-count">{{ $compras->count() }} compra(s)</span>
        </div>

        @if($compras->count() > 0)

            <div class="cliente-table-container">
                <table class="cliente-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Valor Total</th>
                            <th>Saldo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                            <tr>
                                <td>
                                    <strong>
                                        {{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y') }}
                                    </strong>
                                </td>
                                <td>
                                    R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                                </td>
                                <td>
                                    R$ {{ number_format($compra->saldo_restante, 2, ',', '.') }}
                                </td>
                                <td>
                                    @if($compra->status == 'pago')
                                        <span class="status-badge status-pago">
                                            <i class="bi bi-check-circle"></i> Pago
                                        </span>
                                    @elseif($compra->status == 'parcial')
                                        <span class="status-badge status-parcial">
                                            <i class="bi bi-hourglass-split"></i> Parcial
                                        </span>
                                    @else
                                        <span class="status-badge status-pendente">
                                            <i class="bi bi-clock"></i> Pendente
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else

            <div class="cliente-empty">
                <div class="cliente-empty-icon">
                    <i class="bi bi-inbox"></i>
                </div>
                <div class="cliente-empty-title">Nenhuma compra registrada</div>
                <div class="cliente-empty-text">Você não possui compras no momento. Suas futuras compras aparecerão aqui.</div>
            </div>

        @endif

    </div>

    {{-- PAGAMENTOS --}}
    <div class="cliente-section">

        <div class="cliente-section-header">
            <div class="cliente-section-icon">
                <i class="bi bi-credit-card"></i>
            </div>
            <h2 class="cliente-section-title">Meus Pagamentos</h2>
            <span class="cliente-section-count">{{ $pagamentos->count() }} pagamento(s)</span>
        </div>

        @if($pagamentos->count() > 0)

            <div class="cliente-table-container">
                <table class="cliente-table">
                    <thead>
                        <tr>
                            <th>Data do Pagamento</th>
                            <th>Compra</th>
                            <th>Valor Pago</th>
                            <th>Método</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagamentos as $pagamento)
                            <tr>
                                <td>
                                    <strong>
                                        {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}
                                    </strong>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($pagamento->compra->created_at)->format('d/m/Y') }}
                                </td>
                                <td>
                                    <strong>R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <span style="color: #8a7060; font-size: 13px;">
                                        @if($pagamento->metodo_pagamento == 'dinheiro')
                                            <i class="bi bi-cash-coin"></i> Dinheiro
                                        @elseif($pagamento->metodo_pagamento == 'transferencia')
                                            <i class="bi bi-bank"></i> Transferência
                                        @elseif($pagamento->metodo_pagamento == 'pix')
                                            <i class="bi bi-credit-card"></i> PIX
                                        @else
                                            {{ $pagamento->metodo_pagamento }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else

            <div class="cliente-empty">
                <div class="cliente-empty-icon">
                    <i class="bi bi-inbox"></i>
                </div>
                <div class="cliente-empty-title">Nenhum pagamento registrado</div>
                <div class="cliente-empty-text">Você não realizou pagamentos ainda. Seus pagamentos aparecerão aqui.</div>
            </div>

        @endif

    </div>

@endsection