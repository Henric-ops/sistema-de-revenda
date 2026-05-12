@extends('layouts.app')

@section('title', 'Clientes')

@section('content')


    <div class="page-header">

        <div>

            <h2>
                Lista de Clientes
            </h2>

            <p>
                Gerencie todos os clientes cadastrados.
            </p>

        </div>

        <a href="{{ route('clientes.create') }}" class="btn-primary-custom">

            <i class="bi bi-plus-circle"></i>

            Novo Cliente

        </a>

    </div>

    <div class="table-card">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Nome</th>

                    <th>Celular</th>

                    <th>Status</th>

                    <th>Ações</th>

                </tr>

            </thead>

            <tbody>

                @foreach($clientes as $cliente)

                            <tr>

                                <td>

                                    <strong>
                                        {{ $cliente->nome }}
                                    </strong>

                                </td>

                                <td>

                                    {{ $cliente->celular }}

                                </td>

                                <td>

                                    @if($cliente->ativo)

                                        <span class="badge-status ativo">
                                            Ativo
                                        </span>

                                    @else

                                        <span class="badge-status inativo">
                                            Inativo
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="actions">
                                        <button type="button" class="btn-action whatsapp" onclick="cobrarWhatsApp(
                        '{{ $cliente->celular }}',
                        '{{ $cliente->nome }}',
                        '{{ number_format(
                        $cliente->compras->sum('saldo_restante'),
                        2,
                        ',',
                        '.'
                    ) }}'
                    )">
                                            <i class="bi bi-whatsapp"></i>
                                        </button>

                                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn-action view">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-action edit">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">

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