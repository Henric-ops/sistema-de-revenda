@extends('layouts.app')

@section('title', 'Novo Cliente')

@push('styles')
    <style>
        /* ── LAYOUT ──────────────────────────────────────── */
        .create-wrapper {
            max-width: 620px;
        }

        /* ── HEADER ──────────────────────────────────────── */
        .create-header {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 32px;
        }

        .create-header-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 6px 16px rgba(156, 74, 48, .25);
        }

        .create-header-text h2 {
            font-size: 22px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0 0 4px;
        }

        .create-header-text p {
            font-size: 13px;
            color: #b09080;
            margin: 0;
            font-weight: 500;
        }

        /* ── CARD DO FORM ────────────────────────────────── */
        .create-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 18px rgba(156, 74, 48, .06);
            overflow: hidden;
        }

        .create-card-body {
            padding: 32px;
        }

        /* ── CAMPOS ──────────────────────────────────────── */
        .field {
            margin-bottom: 22px;
        }

        .field:last-of-type {
            margin-bottom: 0;
        }

        .field label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #4a3020;
            margin-bottom: 9px;
        }

        .field label i {
            font-size: 14px;
            color: #c0a898;
        }

        .field-wrap {
            position: relative;
        }

        .field-wrap input,
        .field-wrap textarea {
            width: 100%;
            padding: 13px 16px;
            border-radius: 14px;
            border: 1.5px solid #ede0d4;
            background: #fdf9f6;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            color: #2a1a10;
            transition: border-color .2s, box-shadow .2s, background .2s;
            resize: none;
        }

        .field-wrap input::placeholder,
        .field-wrap textarea::placeholder {
            color: #d0b8a8;
        }

        .field-wrap input:focus,
        .field-wrap textarea:focus {
            outline: none;
            border-color: #9c4a30;
            background: white;
            box-shadow: 0 0 0 4px rgba(156, 74, 48, .1);
        }

        /* Contador de caracteres */
        .field-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 6px;
        }

        .char-count {
            font-size: 11px;
            color: #c0a898;
            font-weight: 600;
        }

        /* Máscara de celular — hint */
        .field-hint {
            font-size: 11px;
            color: #c0a898;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        .field-hint i {
            font-size: 11px;
        }

        /* Erros de validação */
        .field-error {
            font-size: 12px;
            color: #d94b4b;
            margin-top: 6px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .field-wrap input.is-invalid,
        .field-wrap textarea.is-invalid {
            border-color: #d94b4b;
            background: #fff8f8;
        }

        /* Divisor entre seções */
        .create-divider {
            height: 1px;
            background: #f5ebe0;
            margin: 24px 0;
        }

        /* ── RODAPÉ / AÇÕES ──────────────────────────────── */
        .create-card-footer {
            padding: 24px 32px;
            background: #fdf8f4;
            border-top: 1px solid #f5ebe0;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-salvar {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 13px 28px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(156, 74, 48, .25);
        }

        .btn-salvar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(156, 74, 48, .3);
        }

        .btn-salvar:active {
            transform: translateY(0);
        }

        .btn-cancelar {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 13px 22px;
            border-radius: 14px;
            border: 1.5px solid #ede0d4;
            background: white;
            color: #8a7060;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .2s, color .2s, background .2s;
        }

        .btn-cancelar:hover {
            border-color: #9c4a30;
            color: #9c4a30;
            background: #fdf4f0;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')

    <div class="create-wrapper">

        {{-- HEADER --}}
        <div class="create-header">
            <div class="create-header-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <div class="create-header-text">
                <h2>Novo Cliente</h2>
                <p>Cadastre um novo cliente no sistema.</p>
            </div>
        </div>

        {{-- CARD --}}
        <div class="create-card">

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('clientes.store') }}" method="POST" id="form-cliente">
                @csrf

                <div class="create-card-body">

                    {{-- Nome --}}
                    <div class="field">
                        <label for="nome">
                            <i class="bi bi-person"></i>
                            Nome completo
                        </label>
                        <div class="field-wrap">
                            <input type="text" id="nome" name="nome" placeholder="Ex: Maria da Silva"
                                value="{{ old('nome') }}" maxlength="100" required>
                        </div>
                        @error('nome')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Celular --}}
                    <div class="field">
                        <label for="celular">
                            <i class="bi bi-telephone"></i>
                            Celular
                        </label>
                        <div class="field-wrap">
                            <input type="text" id="celular" name="celular" placeholder="(55) 99999-9999"
                                value="{{ old('celular') }}" maxlength="16" required>
                        </div>

                        <div class="field-hint">
                            <i class="bi bi-info-circle"></i>
                            Será usado como login do cliente no sistema
                        </div>

                        @error('celular')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="create-divider"></div>

                    {{-- Observações --}}
                    <div class="field">
                        <label for="observacoes">
                            <i class="bi bi-chat-left-text"></i>
                            Observações
                            <span style="font-weight:400; color:#c0a898; font-size:12px;">(opcional)</span>
                        </label>

                        <div class="field-wrap">
                            <textarea id="observacoes" name="observacoes" rows="4"
                                placeholder="Anote informações relevantes sobre este cliente..."
                                maxlength="500">{{ old('observacoes') }}</textarea>
                        </div>

                        <div class="field-footer">
                            <span class="char-count" id="char-count">0 / 500</span>
                        </div>

                        @error('observacoes')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- RODAPÉ --}}
                <div class="create-card-footer">
                    <button type="submit" class="btn-salvar">
                        <i class="bi bi-check-circle"></i>
                        Salvar Cliente
                    </button>

                    <a href="{{ route('clientes.index') }}" class="btn-cancelar">
                        <i class="bi bi-arrow-left"></i>
                        Voltar
                    </a>
                </div>

            </form>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        // Máscara de celular
        const celularInput = document.getElementById('celular');

        celularInput.addEventListener('input', (e) => {
            let v = e.target.value.replace(/\D/g, '').slice(0, 11);
            if (v.length > 10) {
                v = v.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
            } else if (v.length > 6) {
                v = v.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
            } else if (v.length > 2) {
                v = v.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
            } else if (v.length > 0) {
                v = v.replace(/^(\d*)$/, '($1');
            }
            e.target.value = v;
        });

        // Contador de caracteres da textarea
        const textarea = document.getElementById('observacoes');
        const charCount = document.getElementById('char-count');

        function atualizarContador() {
            const len = textarea.value.length;
            charCount.textContent = `${len} / 500`;
            charCount.style.color = len > 450 ? '#d94b4b' : '#c0a898';
        }

        textarea.addEventListener('input', atualizarContador);
        atualizarContador(); // inicializa com old() se houver
    </script>
@endpush