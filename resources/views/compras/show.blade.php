@extends('layouts.app')

@section('title', 'Detalhes da Compra')

@section('content')

    @php

        $totalPago = $compra->pagamentos->sum('valor_pago');

        $saldo = $compra->valor_total - $totalPago;

    @endphp

    {{-- HEADER --}}
    <div class="profile-header">

        <div>

            <h2>
                Compra #{{ $compra->id }}
            </h2>

            <p>
                Cliente: {{ $compra->cliente->nome }}
            </p>

        </div>

        <div class="header-actions">

            <a href="{{ route('compras.edit', $compra->id) }}" class="btn-primary-custom">

                <i class="bi bi-pencil"></i>

                Editar

            </a>

            <a href="{{ route('compras.index') }}" class="btn-secondary-custom">

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

        </div>

    </div>

    {{-- INFO CARDS --}}
    <div class="info-grid">

        <div class="info-card">

            <span>
                Valor Total
            </span>

            <h3>

                R$

                {{ number_format($compra->valor_total, 2, ',', '.') }}

            </h3>

        </div>

        <div class="info-card">

            <span>
                Total Pago
            </span>

            <h3>

                R$

                {{ number_format($totalPago, 2, ',', '.') }}

            </h3>

        </div>

        <div class="info-card">

            <span>
                Saldo Restante
            </span>

            <h3>

                R$

                {{ number_format($saldo, 2, ',', '.') }}

            </h3>

        </div>

    </div>

    {{-- STATUS --}}
    <div class="table-card mb-4">

        <h3>
            Status da Compra
        </h3>

        <br>

        @if($compra->status == 'pago')

            <span class="badge-status ativo">
                Pago
            </span>

        @elseif($compra->status == 'parcial')

            <span class="badge-status parcial">
                Parcial
            </span>

        @else

            <span class="badge-status pendente">
                Pendente
            </span>

        @endif

    </div>

    {{-- FORM PAGAMENTO --}}
    <div class="table-card mb-4">

        <div class="table-header">

            <h3>
                Registrar Pagamento
            </h3>

        </div>

        <form action="{{ route('pagamentos.store') }}" method="POST" class="custom-form">

            @csrf

            <input type="hidden" name="compra_id" value="{{ $compra->id }}">

            <div class="form-group">

                <label>
                    Valor Pago
                </label>

                <input type="number" step="0.01" name="valor_pago" placeholder="0,00">

            </div>

            <div class="form-group">

                <label>
                    Método de Pagamento
                </label>

                <select name="metodo_pagamento">

                    <option value="Pix">
                        Pix
                    </option>

                    <option value="Dinheiro">
                        Dinheiro
                    </option>

                    <option value="Cartão">
                        Cartão
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>
                    Data do Pagamento
                </label>

                <input type="date" name="data_pagamento">

            </div>

            <button type="submit" class="btn-primary-custom">

                <i class="bi bi-cash"></i>

                Registrar Pagamento

            </button>

        </form>

    </div>

    {{-- HISTÓRICO --}}
    <div class="table-card">

        <div class="table-header">

            <h3>
                Histórico de Pagamentos
            </h3>

        </div>

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Valor</th>

                    <th>Método</th>

                    <th>Data</th>

                    <th></th>

                </tr>

            </thead>

            <tbody>

                @foreach($compra->pagamentos as $pagamento)

                    <tr>

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

                        <td>

                            <form action="{{ route('pagamentos.destroy', $pagamento->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-action delete">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endsection