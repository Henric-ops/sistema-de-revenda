@extends('layouts.app')

@section('title', 'Clientes Inadimplentes')

@section('content')

    <div class="page-header">

        <div>

            <h2>
                Clientes Inadimplentes
            </h2>

            <p>
                Controle de clientes com pendências financeiras.
            </p>

        </div>

    </div>

    <div class="table-card">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Cliente</th>

                    <th>Valor Total</th>

                    <th>Total Pago</th>

                    <th>Saldo</th>

                    <th>Status</th>

                    <th></th>

                </tr>

            </thead>

            <tbody>

                @foreach($compras as $compra)

                    @php

                        $totalPago = $compra->pagamentos->sum('valor_pago');

                        $saldo = $compra->valor_total - $totalPago;

                    @endphp

                    <tr>

                        <td>

                            <strong>
                                {{ $compra->cliente->nome }}
                            </strong>

                        </td>

                        <td>

                            R$

                            {{ number_format($compra->valor_total, 2, ',', '.') }}

                        </td>

                        <td>

                            R$

                            {{ number_format($totalPago, 2, ',', '.') }}

                        </td>

                        <td>

                            <strong>

                                R$

                                {{ number_format($saldo, 2, ',', '.') }}

                            </strong>

                        </td>

                        <td>

                            @if($compra->status == 'parcial')

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

                            <a href="{{ route('compras.show', $compra->id) }}" class="btn-action view">

                                <i class="bi bi-eye"></i>

                            </a>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endsection