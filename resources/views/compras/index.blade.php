@extends('layouts.app')

@section('title', 'Compras')

@section('content')

    <div class="page-header">

        <div>

            <h2>
                Compras
            </h2>

            <p>
                Gerencie todas as compras realizadas.
            </p>

        </div>

        <a href="{{ route('compras.create') }}" class="btn-primary-custom">

            <i class="bi bi-plus-circle"></i>

            Nova Compra

        </a>

    </div>

    <div class="table-card">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Cliente</th>

                    <th>Valor</th>

                    <th>Parcelas</th>

                    <th>Status</th>

                    <th>Data</th>

                    <th>Ações</th>

                </tr>

            </thead>

            <tbody>

                @foreach($compras as $compra)

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

                            {{ $compra->qtd_parcelas }}x

                        </td>

                        <td>

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

                        </td>

                        <td>

                            {{ $compra->data_compra }}

                        </td>

                        <td>

                            <div class="actions">

                                <a href="{{ route('compras.show', $compra->id) }}" class="btn-action view">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a href="{{ route('compras.edit', $compra->id) }}" class="btn-action edit">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form action="{{ route('compras.destroy', $compra->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-action delete">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endsection