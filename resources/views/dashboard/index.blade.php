@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="dashboard-grid">

        {{-- CARD --}}
        <div class="card-dashboard">

            <div class="card-icon">
                <i class="bi bi-people"></i>
            </div>

            <div>

                <span>
                    Clientes
                </span>

                <h2>
                    {{ $totalClientes }}
                </h2>

            </div>

        </div>

        {{-- CARD --}}
        <div class="card-dashboard">

            <div class="card-icon">
                <i class="bi bi-bag"></i>
            </div>

            <div>

                <span>
                    Compras
                </span>

                <h2>
                    {{ $totalCompras }}
                </h2>

            </div>

        </div>

        {{-- CARD --}}
        <div class="card-dashboard">

            <div class="card-icon">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div>

                <span>
                    Total Recebido
                </span>

                <h2>
                    R$ {{ number_format($totalRecebido, 2, ',', '.') }}
                </h2>

            </div>

        </div>

        {{-- CARD --}}
        <div class="card-dashboard">

            <div class="card-icon">
                <i class="bi bi-exclamation-circle"></i>
            </div>

            <div>

                <span>
                    Em Aberto
                </span>

                <h2>
                    R$ {{ number_format($totalAberto, 2, ',', '.') }}
                </h2>

            </div>

        </div>

    </div>

    {{-- TABELAS --}}
    <div class="dashboard-bottom">

        {{-- INADIMPLENTES --}}
        <div class="table-card">

            <div class="table-header">

                <h3>
                    Clientes Pendentes
                </h3>

            </div>

            <table class="custom-table">

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
                                {{ $compra->cliente->nome }}
                            </td>

                            <td>

                                @if($compra->saldo_restante == 0)

                                    <span class="badge-status ativo">
                                        Pago
                                    </span>

                                @elseif($compra->saldo_restante < $compra->valor_total)

                                    <span class="badge-status parcial">
                                        Parcial
                                    </span>

                                @else

                                    <span class="badge-status pendente">
                                        Pendente
                                    </span>

                                @endif

                            </td>

                            <td>

                                R$ {{ number_format($compra->saldo_restante, 2, ',', '.') }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- PAGAMENTOS --}}
        <div class="table-card">

            <div class="table-header">

                <h3>
                    Últimos Pagamentos
                </h3>

            </div>

            <table class="custom-table">

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

                                R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}

                            </td>

                            <td>

                                {{ $pagamento->data_pagamento }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection