@extends('layouts.app')

@section('title', 'Novo Cliente')

@section('content')

    <div class="form-container">

        <div class="form-header">

            <h2>
                Novo Cliente
            </h2>

            <p>
                Cadastre um novo cliente no sistema.
            </p>

        </div>

        <form action="{{ route('clientes.store') }}" method="POST" class="custom-form">

            @csrf

            <div class="form-group">

                <label>
                    Nome
                </label>

                <input type="text" name="nome" placeholder="Digite o nome">

            </div>

            <div class="form-group">

                <label>
                    Celular
                </label>

                <input type="text" name="celular" placeholder="(55) 99999-9999">

            </div>

            <div class="form-group">

                <label>
                    Observações
                </label>

                <textarea name="observacoes" rows="5" placeholder="Observações sobre o cliente..."></textarea>

            </div>

            <div class="form-actions">

                <button type="submit" class="btn-primary-custom">

                    <i class="bi bi-check-circle"></i>

                    Salvar Cliente

                </button>

                <a href="{{ route('clientes.index') }}" class="btn-secondary-custom">

                    <i class="bi bi-x-circle"></i>

                    Cancelar

                </a>

            </div>

        </form>

    </div>

@endsection