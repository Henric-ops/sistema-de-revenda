@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <style>
        /* ── CARDS ─────────────────────────────────────── */
        .dash-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .dash-card {
            border-radius: 22px;
            padding: 26px 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            overflow: hidden;
            transition: transform .25s ease, box-shadow .25s ease;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .07);
        }

        .dash-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .11);
        }

        /* Detalhe decorativo de fundo */
        .dash-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            opacity: .12;
            background: currentColor;
        }

        /* Variantes de cor */
        .dash-card.card-clientes {
            background: linear-gradient(135deg, #fff5f0, #fde8d8);
            color: #9c4a30;
        }

        .dash-card.card-compras {
            background: linear-gradient(135deg, #f0f5ff, #deeaff);
            color: #3a6fd8;
        }

        .dash-card.card-recebido {
            background: linear-gradient(135deg, #f0faf5, #d4f2e2);
            color: #1a7a4a;
        }

        .dash-card.card-aberto {
            background: linear-gradient(135deg, #fffbf0, #fdedc8);
            color: #b07800;
        }

        .dash-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dash-card-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            opacity: .7;
        }

        .dash-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
        }

        .dash-card-value {
            font-size: 34px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
            color: inherit;
        }

        .dash-card-sub {
            font-size: 12px;
            opacity: .6;
            font-weight: 500;
            margin-top: 2px;
        }

        /* ── TABELAS ────────────────────────────────────── */
        .dash-tables {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .dash-table-card {
            background: white;
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .06);
            border: 1px solid #f5ebe0;
            transition: box-shadow .25s ease;
        }

        .dash-table-card:hover {
            box-shadow: 0 10px 30px rgba(156, 74, 48, .08);
        }

        .dash-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f5ebe0;
        }

        .dash-table-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dash-table-title-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
        }

        .dash-table-title h3 {
            font-size: 16px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0;
        }

        .dash-table-count {
            font-size: 12px;
            background: #faf0ea;
            color: #9c4a30;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .dash-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dash-table thead tr {
            border-bottom: 1px solid #f5ebe0;
        }

        .dash-table th {
            text-align: left;
            padding: 0 12px 12px 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #b09080;
        }

        .dash-table th:first-child {
            padding-left: 0;
        }

        .dash-table tbody tr {
            border-bottom: 1px solid #faf4ee;
            transition: background .15s;
        }

        .dash-table tbody tr:last-child {
            border-bottom: none;
        }

        .dash-table tbody tr:hover {
            background: #fdf8f5;
        }

        .dash-table td {
            padding: 14px 12px;
            font-size: 14px;
            color: #2a1a10;
            vertical-align: middle;
        }

        .dash-table td:first-child {
            padding-left: 0;
        }

        /* Avatar da inicial do cliente */
        .client-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .client-avatar {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, #fde8d8, #fac8a8);
            color: #9c4a30;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .client-name {
            font-weight: 600;
            font-size: 14px;
        }

        /* Badges */
        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-pill.pago {
            background: #e8fff0;
            color: #1a8a50;
        }

        .badge-pill.parcial {
            background: #eef4ff;
            color: #3a6fd8;
        }

        .badge-pill.pendente {
            background: #fff8e8;
            color: #b07800;
        }

        /* Valor destaque nas tabelas */
        .valor-cell {
            font-weight: 700;
            font-size: 15px;
            color: #2a1a10;
        }

        .valor-cell.negativo {
            color: #c0392b;
        }

        .valor-cell.positivo {
            color: #1a7a4a;
        }

        /* Data formatada */
        .data-cell {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .data-cell .dia {
            font-weight: 700;
            font-size: 14px;
        }

        .data-cell .ano {
            font-size: 11px;
            color: #b09080;
        }

        /* Vazio */
        .dash-empty {
            text-align: center;
            padding: 30px 0;
            color: #c0a898;
            font-size: 14px;
        }

        .dash-empty i {
            font-size: 32px;
            display: block;
            margin-bottom: 8px;
            opacity: .5;
        }

        @media (max-width: 1200px) {
            .dash-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dash-cards {
                grid-template-columns: 1fr;
            }

            .dash-tables {
                grid-template-columns: 1fr;
            }

            .dash-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ── CARDS ─────────────────────────────────────── --}}
    <div class="dash-cards">

        {{-- Clientes --}}
        <div class="dash-card card-clientes">
            <div class="dash-card-top">
                <span class="dash-card-label">Clientes</span>
                <div class="dash-card-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div>
                <div class="dash-card-value">{{ $totalClientes }}</div>
                <div class="dash-card-sub">cadastrados no sistema</div>
            </div>
        </div>

        {{-- Compras --}}
        <div class="dash-card card-compras">
            <div class="dash-card-top">
                <span class="dash-card-label">Compras</span>
                <div class="dash-card-icon">
                    <i class="bi bi-bag-fill"></i>
                </div>
            </div>
            <div>
                <div class="dash-card-value">{{ $totalCompras }}</div>
                <div class="dash-card-sub">pedidos registrados</div>
            </div>
        </div>

        {{-- Total Recebido --}}
        <div class="dash-card card-recebido">
            <div class="dash-card-top">
                <span class="dash-card-label">Total Recebido</span>
                <div class="dash-card-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
            <div>
                <div class="dash-card-value">R$ {{ number_format($totalRecebido, 2, ',', '.') }}</div>
                <div class="dash-card-sub">já confirmados</div>
            </div>
        </div>

        {{-- Em Aberto --}}
        <div class="dash-card card-aberto">
            <div class="dash-card-top">
                <span class="dash-card-label">Em Aberto</span>
                <div class="dash-card-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div>
                <div class="dash-card-value">R$ {{ number_format($totalAberto, 2, ',', '.') }}</div>
                <div class="dash-card-sub">aguardando pagamento</div>
            </div>
        </div>

    </div>

    {{-- ── TABELAS ─────────────────────────────────── --}}
    <div class="dash-tables">

        {{-- Clientes Pendentes --}}
        <div class="dash-table-card">
            <div class="dash-table-header">
                <div class="dash-table-title">
                    <div class="dash-table-title-dot"></div>
                    <h3>Clientes Pendentes</h3>
                </div>
                <span class="dash-table-count">{{ count($inadimplentes) }} registros</span>
            </div>

            @if(count($inadimplentes) > 0)
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Valor Restante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inadimplentes as $compra)
                            <tr>
                                <td>
                                    <div class="client-cell">
                                        <div class="client-avatar">
                                            {{ strtoupper(substr($compra->cliente->nome, 0, 1)) }}
                                        </div>
                                        <span class="client-name">{{ $compra->cliente->nome }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($compra->saldo_restante == 0)
                                        <span class="badge-pill pago">Pago</span>
                                    @elseif($compra->saldo_restante < $compra->valor_total)
                                        <span class="badge-pill parcial">Parcial</span>
                                    @else
                                        <span class="badge-pill pendente">Pendente</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="valor-cell {{ $compra->saldo_restante > 0 ? 'negativo' : '' }}">
                                        R$ {{ number_format($compra->saldo_restante, 2, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="dash-empty">
                    <i class="bi bi-check-circle"></i>
                    Nenhum cliente pendente
                </div>
            @endif
        </div>

        {{-- Últimos Pagamentos --}}
        <div class="dash-table-card">
            <div class="dash-table-header">
                <div class="dash-table-title">
                    <div class="dash-table-title-dot"></div>
                    <h3>Últimos Pagamentos</h3>
                </div>
                <span class="dash-table-count">{{ count($ultimosPagamentos) }} registros</span>
            </div>

            @if(count($ultimosPagamentos) > 0)
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Valor</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ultimosPagamentos as $pagamento)
                            <tr>
                                <td>
                                    <span class="valor-cell positivo">
                                        R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $data = \Carbon\Carbon::parse($pagamento->data_pagamento);
                                    @endphp
                                    <div class="data-cell">
                                        <span class="dia">{{ $data->format('d/m/Y') }}</span>
                                        <span class="ano">{{ $data->diffForHumans() }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="dash-empty">
                    <i class="bi bi-credit-card"></i>
                    Nenhum pagamento registrado
                </div>
            @endif
        </div>

    </div>

@endsection