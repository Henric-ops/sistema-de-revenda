@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')

    <div class="form-container">

        <div class="form-header">

            <h2>
                Editar Cliente
            </h2>

            <p>
                Atualize as informações do cliente.
            </p>

        </div>

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="custom-form">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label>
                    Nome
                </label>

                <input type="text" name="nome" value="{{ $cliente->nome }}" placeholder="Digite o nome">

            </div>

            <div class="form-group">

                <label>
                    Celular
                </label>

                <input type="text" name="celular" value="{{ $cliente->celular }}" placeholder="(55) 99999-9999">

            </div>

            <div class="form-group">

                <label>
                    Observações
                </label>

                <textarea name="observacoes" rows="5" placeholder="Observações...">{{ $cliente->observacoes }}</textarea>

            </div>

            <div class="form-actions">

                <button type="submit" class="btn-primary-custom">

                    <i class="bi bi-check-circle"></i>

                    Atualizar Cliente

                </button>

                <a href="{{ route('clientes.index') }}" class="btn-secondary-custom">

                    <i class="bi bi-x-circle"></i>

                    Cancelar

                </a>

            </div>

        </form>

    </div>

@endsection