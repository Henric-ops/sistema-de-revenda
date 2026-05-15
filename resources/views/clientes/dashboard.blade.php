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
            transform: translateY(-6px);
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

        .cliente-card.card-comprado {
            color: #3a6fd8;
        }

        .cliente-card.card-pago {
            color: #1a7a4a;
        }

        .cliente-card.card-pendente {
            color: #b07800;
        }

        /* ── SEÇÕES ──────────────────────────────────────────── */
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

        /* ── CARDS DE COMPRA ─────────────────────────────────── */
        .compras-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .compra-card {
            background: white;
            border-radius: 18px;
            border: 1px solid #f0e6dc;
            box-shadow: 0 4px 14px rgba(156, 74, 48, 0.05);
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .compra-card:hover {
            box-shadow: 0 8px 24px rgba(156, 74, 48, 0.1);
        }

        /* Cabeçalho clicável do card */
        .compra-card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            cursor: pointer;
            user-select: none;
            transition: background 0.15s;
        }

        .compra-card-header:hover {
            background: #fdf8f5;
        }

        .compra-card-num {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #fde8d8, #fac8a8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 15px;
            color: #9c4a30;
            flex-shrink: 0;
        }

        .compra-card-info {
            flex: 1;
            min-width: 0;
        }

        .compra-card-title {
            font-size: 15px;
            font-weight: 700;
            color: #2a1a10;
            margin-bottom: 3px;
        }

        .compra-card-date {
            font-size: 12px;
            color: #b09080;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .compra-card-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }

        .compra-card-valor {
            text-align: right;
        }

        .compra-card-valor-num {
            font-size: 17px;
            font-weight: 800;
            color: #2a1a10;
        }

        .compra-card-valor-label {
            font-size: 11px;
            color: #b09080;
            font-weight: 600;
        }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
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

        /* Chevron */
        .compra-chevron {
            color: #c0a898;
            font-size: 14px;
            transition: transform 0.25s ease;
        }

        .compra-card.is-open .compra-chevron {
            transform: rotate(180deg);
        }

        /* Corpo expansível */
        .compra-card-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }

        .compra-card.is-open .compra-card-body {
            max-height: 400px;
        }

        .compra-card-body-inner {
            padding: 0 24px 22px;
            border-top: 1px solid #f5ebe0;
        }

        /* Barra de progresso */
        .progresso-wrap {
            margin-bottom: 18px;
            padding-top: 18px;
        }

        .progresso-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .progresso-label {
            font-size: 12px;
            font-weight: 700;
            color: #8a7060;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .progresso-pct {
            font-size: 13px;
            font-weight: 800;
            color: #2a1a10;
        }

        .progresso-bar-track {
            height: 8px;
            background: #f5ebe0;
            border-radius: 99px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progresso-bar-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, #9c4a30, #c4693a);
            transition: width 0.7s ease;
        }

        .progresso-bar-fill.completo {
            background: linear-gradient(90deg, #1a7a4a, #28a865);
        }

        .progresso-valores {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #b09080;
            font-weight: 600;
        }

        .progresso-valores span:last-child {
            color: #9c4a30;
            font-weight: 700;
        }

        /* Descrição dos produtos */
        .produtos-wrap {
            background: #fdf8f5;
            border-radius: 12px;
            padding: 14px 16px;
            border: 1px solid #f0e6dc;
        }

        .produtos-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #b09080;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .produtos-text {
            font-size: 14px;
            color: #4a3020;
            line-height: 1.6;
            white-space: pre-line;
            margin: 0;
        }

        /* ── TABELA DE PAGAMENTOS ────────────────────────────── */
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

        .metodo-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f6efe8;
            color: #7a5040;
            padding: 5px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ── EMPTY STATE ─────────────────────────────────────── */
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

        @media (max-width: 768px) {
            .cliente-cards {
                grid-template-columns: 1fr;
            }

            .compra-card-right {
                flex-direction: column;
                align-items: flex-end;
                gap: 8px;
            }

            .cliente-section-count {
                display: none;
            }

            .cliente-table-container {
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')

    {{-- CARDS DE RESUMO --}}
    <div class="cliente-cards">

        <div class="cliente-card card-comprado">
            <div class="cliente-card-header">
                <div class="cliente-card-label">Total Comprado</div>
                <div class="cliente-card-icon"><i class="bi bi-bag"></i></div>
            </div>
            <div class="cliente-card-value">R$ {{ number_format($totalComprado, 2, ',', '.') }}</div>
            <div class="cliente-card-subtitle">Desde o primeiro pedido</div>
        </div>

        <div class="cliente-card card-pago">
            <div class="cliente-card-header">
                <div class="cliente-card-label">Total Pago</div>
                <div class="cliente-card-icon"><i class="bi bi-check-circle"></i></div>
            </div>
            <div class="cliente-card-value">R$ {{ number_format($totalPago, 2, ',', '.') }}</div>
            <div class="cliente-card-subtitle">Já quitado</div>
        </div>

        <div class="cliente-card card-pendente">
            <div class="cliente-card-header">
                <div class="cliente-card-label">Saldo Pendente</div>
                <div class="cliente-card-icon"><i class="bi bi-hourglass-split"></i></div>
            </div>
            <div class="cliente-card-value">R$ {{ number_format($saldoPendente, 2, ',', '.') }}</div>
            <div class="cliente-card-subtitle">A ser pago</div>
        </div>

    </div>

    {{-- COMPRAS --}}
    <div class="cliente-section">

        <div class="cliente-section-header">
            <div class="cliente-section-icon"><i class="bi bi-cart-check"></i></div>
            <h2 class="cliente-section-title">Minhas Compras</h2>
            <span class="cliente-section-count">{{ $compras->count() }} compra(s)</span>
        </div>

        @if($compras->count() > 0)

            <div class="compras-grid">
                @foreach($compras as $compra)
                    @php
                        $pago = $compra->pagamentos->sum('valor_pago');
                        $saldo = $compra->valor_total - $pago;
                        $pct = $compra->valor_total > 0
                            ? min(100, round(($pago / $compra->valor_total) * 100))
                            : 0;
                    @endphp

                    <div class="compra-card" id="compra-{{ $compra->id }}">

                        {{-- CABEÇALHO CLICÁVEL --}}
                        <div class="compra-card-header" onclick="toggleCompra('compra-{{ $compra->id }}')">

                            <div class="compra-card-num">#{{ $compra->id }}</div>

                            <div class="compra-card-info">
                                <div class="compra-card-title">
                                    {{ $compra->descricao_produtos
                        ? \Illuminate\Support\Str::limit($compra->descricao_produtos, 50)
                        : 'Compra #' . $compra->id }}
                                </div>
                                <div class="compra-card-date">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}
                                    &nbsp;·&nbsp;
                                    <i class="bi bi-grid-3x3-gap"></i>
                                    {{ $compra->qtd_parcelas }}x
                                </div>
                            </div>

                            <div class="compra-card-right">
                                <div class="compra-card-valor">
                                    <div class="compra-card-valor-num">
                                        R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                                    </div>
                                    <div class="compra-card-valor-label">valor total</div>
                                </div>

                                @if($compra->status == 'pago')
                                    <span class="status-badge status-pago">Pago</span>
                                @elseif($compra->status == 'parcial')
                                    <span class="status-badge status-parcial">Parcial</span>
                                @else
                                    <span class="status-badge status-pendente">Pendente</span>
                                @endif

                                <i class="bi bi-chevron-down compra-chevron"></i>
                            </div>
                        </div>

                        {{-- CORPO EXPANSÍVEL --}}
                        <div class="compra-card-body">
                            <div class="compra-card-body-inner">

                                {{-- BARRA DE PROGRESSO --}}
                                <div class="progresso-wrap">
                                    <div class="progresso-top">
                                        <span class="progresso-label">
                                            <i class="bi bi-bar-chart-line"></i>
                                            Progresso do pagamento
                                        </span>
                                        <span class="progresso-pct">{{ $pct }}%</span>
                                    </div>
                                    <div class="progresso-bar-track">
                                        <div class="progresso-bar-fill {{ $pct >= 100 ? 'completo' : '' }}"
                                            style="width: {{ $pct }}%"></div>
                                    </div>
                                    <div class="progresso-valores">
                                        <span>Pago: R$ {{ number_format($pago, 2, ',', '.') }}</span>
                                        <span>Restante: R$ {{ number_format($saldo, 2, ',', '.') }}</span>
                                    </div>
                                </div>

                                {{-- DESCRIÇÃO DOS PRODUTOS --}}
                                @if($compra->descricao_produtos)
                                    <div class="produtos-wrap">
                                        <div class="produtos-label">
                                            <i class="bi bi-box-seam"></i>
                                            Produtos
                                        </div>
                                        <p class="produtos-text">{{ $compra->descricao_produtos }}</p>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        @else
            <div class="cliente-empty">
                <div class="cliente-empty-icon"><i class="bi bi-inbox"></i></div>
                <div class="cliente-empty-title">Nenhuma compra registrada</div>
                <div class="cliente-empty-text">Você não possui compras no momento.</div>
            </div>
        @endif

    </div>

    {{-- PAGAMENTOS --}}
    <div class="cliente-section">

        <div class="cliente-section-header">
            <div class="cliente-section-icon"><i class="bi bi-credit-card"></i></div>
            <h2 class="cliente-section-title">Meus Pagamentos</h2>
            <span class="cliente-section-count">{{ $pagamentos->count() }} pagamento(s)</span>
        </div>

        @if($pagamentos->count() > 0)

            <div class="cliente-table-container">
                <table class="cliente-table">
                    <thead>
                        <tr>
                            <th>Data</th>
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
                                <td style="color:#8a7060; font-size:13px;">
                                    #{{ $pagamento->compra->id }}
                                    &nbsp;·&nbsp;
                                    {{ \Carbon\Carbon::parse($pagamento->compra->data_compra)->format('d/m/Y') }}
                                </td>
                                <td>
                                    <strong style="color:#1a7a4a;">
                                        R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}
                                    </strong>
                                </td>
                                <td>
                                    <span class="metodo-badge">
                                        @if($pagamento->metodo_pagamento == 'dinheiro')
                                            <i class="bi bi-cash-coin"></i> Dinheiro
                                        @elseif($pagamento->metodo_pagamento == 'transferencia')
                                            <i class="bi bi-bank"></i> Transferência
                                        @elseif($pagamento->metodo_pagamento == 'pix')
                                            <i class="bi bi-qr-code"></i> PIX
                                        @elseif($pagamento->metodo_pagamento == 'credito')
                                            <i class="bi bi-credit-card"></i> Crédito
                                        @elseif($pagamento->metodo_pagamento == 'debito')
                                            <i class="bi bi-credit-card-2-back"></i> Débito
                                        @elseif($pagamento->metodo_pagamento == 'boleto')
                                            <i class="bi bi-upc-scan"></i> Boleto
                                        @else
                                            <i class="bi bi-three-dots"></i> {{ $pagamento->metodo_pagamento }}
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
                <div class="cliente-empty-icon"><i class="bi bi-inbox"></i></div>
                <div class="cliente-empty-title">Nenhum pagamento registrado</div>
                <div class="cliente-empty-text">Seus pagamentos aparecerão aqui.</div>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        function toggleCompra(id) {
            const card = document.getElementById(id);
            card.classList.toggle('is-open');
        }
    </script>
@endpush