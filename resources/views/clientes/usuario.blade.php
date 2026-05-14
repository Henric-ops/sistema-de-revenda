@extends('layouts.app')

@section('title', 'Criar Acesso')

@push('styles')
    <style>
        .access-wrapper {
            max-width: 520px;
            margin: 0 auto;
        }

        .access-header {
            margin-bottom: 22px;
        }

        .access-header h3 {
            font-size: 20px;
            font-weight: 800;
            color: #2a1a10;
            margin: 0 0 6px;
        }

        .access-header strong {
            color: #9c4a30;
        }

        .access-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 18px rgba(156, 74, 48, .06);
            overflow: hidden;
        }

        .access-body {
            padding: 28px;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #4a3020;
            margin-bottom: 8px;
        }

        .field-wrap input {
            width: 100%;
            padding: 13px 16px;
            border-radius: 14px;
            border: 1.5px solid #ede0d4;
            background: #fdf9f6;
            font-size: 15px;
            color: #2a1a10;
            transition: .2s;
        }

        .field-wrap input:focus {
            outline: none;
            border-color: #9c4a30;
            background: white;
            box-shadow: 0 0 0 4px rgba(156, 74, 48, .1);
        }

        .access-footer {
            padding: 18px 28px;
            background: #fdf8f4;
            border-top: 1px solid #f5ebe0;
            display: flex;
            justify-content: flex-end;
        }

        .btn-access {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: white;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: .2s;
            box-shadow: 0 4px 14px rgba(156, 74, 48, .25);
        }

        .btn-access:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(156, 74, 48, .3);
        }
    </style>
@endpush

@section('content')

    <div class="access-wrapper">

        <div class="access-header">
            <h3>
                Criar acesso para: <strong>{{ $cliente->nome }}</strong>
            </h3>
        </div>

        <div class="access-card">

            <form action="{{ route('clientes.usuario.salvar', $cliente->id) }}" method="POST">
                @csrf

                <div class="access-body">

                    {{-- E-mail --}}
                    <div class="field">
                        <label for="email">
                            <i class="bi bi-envelope"></i>
                            E-mail
                        </label>
                        <div class="field-wrap">
                            <input type="email" name="email" id="email" placeholder="cliente@email.com" required>
                        </div>
                    </div>

                    {{-- Senha --}}
                    <div class="field">
                        <label for="password">
                            <i class="bi bi-lock"></i>
                            Senha
                        </label>
                        <div class="field-wrap">
                            <input type="password" name="password" id="password" placeholder="Digite uma senha" required>
                        </div>
                    </div>

                </div>

                <div class="access-footer">
                    <button type="submit" class="btn-access">
                        <i class="bi bi-check-circle"></i>
                        Criar acesso
                    </button>
                </div>

            </form>

        </div>

    </div>

@endsection