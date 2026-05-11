@extends('layouts.app')

@section('title', 'Pagamentos Recebidos')

@section('content')

    <div class="page-header">

        <div>

            <h2>
                Pagamentos Recebidos
            </h2>

            <p>
                Histórico completo de pagamentos realizados.
            </p>

        </div>

    </div>

    <div class="table-card">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Cliente</th>

                    <th>Valor</th>

                    <th>Método</th>

                    <th>Data</th>

                </tr>

            </thead>

            <tbody>

                @foreach($pagamentos as $pagamento)

                    <tr>

                        <td>

                            <strong>

                                {{ $pagamento->compra->cliente->nome }}

                            </strong>

                        </td>

                        <td>

                            R$

                            {{ number_format($pagamento->valor_pago, 2, ',', '.') }}

                        </td>

                        <td>

                            {{ $pagamento->metodo_pagamento }}

                        </td>

                        <td>

                            {{ $pagamento->data_pagamento }}

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endsection