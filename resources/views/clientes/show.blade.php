@extends('layouts.app')

@section('title', 'Perfil do Cliente')

@section('content')

    <div class="profile-header">

        <div>

            <h2>
                {{ $cliente->nome }}
            </h2>

            <p>
                {{ $cliente->celular }}
            </p>

        </div>

        <div class="header-actions">

            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-primary-custom">

                <i class="bi bi-pencil"></i>

                Editar

            </a>

            <a href="{{ route('clientes.index') }}" class="btn-secondary-custom">

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

        </div>

    </div>

    {{-- INFO --}}
    <div class="info-grid">

        <div class="info-card">

            <span>
                Compras
            </span>

            <h3>
                {{ $cliente->compras->count() }}
            </h3>

        </div>

        <div class="info-card">

            <span>
                Total Comprado
            </span>

            <h3>

                R$

                {{ number_format($cliente->compras->sum('valor_total'), 2, ',', '.') }}

            </h3>

        </div>

        <div class="info-card">

            <span>
                Total Pago
            </span>

            <h3>

                R$

                {{ number_format(
        $cliente->compras->flatMap->pagamentos->sum('valor_pago'),
        2,
        ',',
        '.'
    ) }}

            </h3>

        </div>

    </div>

    {{-- OBSERVAÇÕES --}}
    @if($cliente->observacoes)

        <div class="table-card">

            <h3>
                Observações
            </h3>

            <p>
                {{ $cliente->observacoes }}
            </p>

        </div>

    @endif

    {{-- HISTÓRICO --}}
    <div class="table-card">

        <div class="table-header">

            <h3>
                Histórico de Compras
            </h3>

        </div>

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Data</th>

                    <th>Valor</th>

                    <th>Status</th>

                    <th>Ação</th>

                </tr>

            </thead>

            <tbody>

                @foreach($cliente->compras as $compra)

                    <tr>

                        <td>
                            {{ $compra->data_compra }}
                        </td>

                        <td>

                            R$

                            {{ number_format($compra->valor_total, 2, ',', '.') }}

                        </td>

                        <td>

                            <span class="badge-status pendente">

                                {{ $compra->status }}

                            </span>

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