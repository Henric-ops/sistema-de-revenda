@extends('layouts.app')

@section('title', 'Perfil do Cliente')

@push('styles')
    <style>
        /* ── HEADER ──────────────────────────────────────── */
        .show-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .show-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .show-header-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, #6366a1, #7c80b8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 6px 16px rgba(99, 102, 161, .25);
        }

        .show-header-text h2 {
            font-size: 22px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0 0 4px;
        }

        .show-header-text p {
            font-size: 13px;
            color: #b09080;
            margin: 0;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .show-header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-editar {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #6366a1, #7c80b8);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 12px rgba(99, 102, 161, .22);
        }

        .btn-editar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(99, 102, 161, .28);
            text-decoration: none;
            color: white;
        }

        .btn-voltar {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 18px;
            border-radius: 12px;
            border: 1.5px solid #ede0d4;
            background: white;
            color: #8a7060;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: border-color .2s, color .2s, background .2s;
        }

        .btn-voltar:hover {
            border-color: #6366a1;
            color: #6366a1;
            background: #faf5fa;
            text-decoration: none;
        }

        /* ── CARDS DE INFO ───────────────────────────────── */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .info-card-custom {
            background: white;
            border-radius: 18px;
            padding: 22px 24px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 14px rgba(99, 102, 161, .05);
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .info-card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(99, 102, 161, .09);
        }

        .info-card-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .info-card-custom.card-compras::before {
            background: linear-gradient(90deg, #6366a1, #7c80b8);
        }

        .info-card-custom.card-total::before {
            background: linear-gradient(90deg, #1a8a50, #28a865);
        }

        .info-card-custom.card-pago::before {
            background: linear-gradient(90deg, #9c4a30, #c4693a);
        }

        .info-card-custom .card-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #b09080;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-card-custom .card-label i {
            font-size: 12px;
            color: #6366a1;
        }

        .info-card-custom .card-value {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -.5px;
            line-height: 1;
        }

        .info-card-custom.card-compras .card-value {
            color: #6366a1;
        }

        .info-card-custom.card-total .card-value {
            color: #1a8a50;
        }

        .info-card-custom.card-pago .card-value {
            color: #9c4a30;
        }

        /* ── CARD DE INFORMAÇÕES ─────────────────────────── */
        .info-section {
            background: white;
            border-radius: 18px;
            padding: 22px 24px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 14px rgba(99, 102, 161, .05);
            margin-bottom: 20px;
        }

        .info-section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f5ebe0;
        }

        .info-section-header i {
            font-size: 18px;
            color: #6366a1;
        }

        .info-section-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0;
        }

        .info-content {
            font-size: 14px;
            color: #4a3020;
            line-height: 1.6;
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .contact-item-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ede8f5, #dcd5e8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #6366a1;
            flex-shrink: 0;
        }

        .contact-item-text {
            flex: 1;
        }

        .contact-item-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #b09080;
            margin-bottom: 3px;
        }

        .contact-item-value {
            font-size: 14px;
            font-weight: 600;
            color: #2a1a10;
        }

        /* ── HISTÓRICO ───────────────────────────────────── */
        .historico-card {
            background: white;
            border-radius: 18px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 14px rgba(99, 102, 161, .05);
            overflow: hidden;
        }

        .historico-header {
            padding: 22px 24px 18px;
            border-bottom: 1px solid #f5ebe0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .historico-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .historico-header-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ede8f5, #dcd5e8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #6366a1;
        }

        .historico-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0;
        }

        .historico-count {
            font-size: 12px;
            background: #f0edfa;
            color: #6366a1;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
        }

        /* ── LISTA DE COMPRAS ────────────────────────────── */
        .compras-list {
            padding: 8px 0;
        }

        .compra-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-bottom: 1px solid #faf4ee;
            transition: background .15s;
            gap: 12px;
        }

        .compra-item:last-child {
            border-bottom: none;
        }

        .compra-item:hover {
            background: #fdf8f5;
        }

        .compra-item-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 1;
        }

        .compra-item-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ede8f5, #dcd5e8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #6366a1;
            flex-shrink: 0;
        }

        .compra-item-info {
            line-height: 1.3;
            flex: 1;
        }

        .compra-item-data {
            font-size: 14px;
            font-weight: 600;
            color: #2a1a10;
        }

        .compra-item-meta {
            font-size: 12px;
            color: #b09080;
            font-weight: 500;
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .compra-item-meta i {
            font-size: 11px;
        }

        .compra-item-valor {
            font-size: 15px;
            font-weight: 800;
            color: #1a8a50;
            min-width: 90px;
            text-align: right;
        }

        .compra-item-status {
            min-width: 80px;
        }

        .badge-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-status.pendente {
            background: #fff8e8;
            color: #b07800;
        }

        .badge-status.pago {
            background: #e8fff0;
            color: #1a8a50;
        }

        .badge-status.parcial {
            background: #eef4ff;
            color: #3a6fd8;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            border: none;
            background: transparent;
            color: #6366a1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .2s, color .2s;
            text-decoration: none;
        }

        .btn-action:hover {
            background: #f0edfa;
            color: #6366a1;
            text-decoration: none;
        }

        .empty-state {
            text-align: center;
            padding: 32px 24px;
            color: #b09080;
        }

        .empty-state i {
            font-size: 32px;
            color: #c0a898;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        .empty-state p {
            margin: 0;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .info-cards {
                grid-template-columns: 1fr;
            }

            .show-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .show-header-actions {
                width: 100%;
            }

            .show-header-actions a {
                flex: 1;
                justify-content: center;
            }

            .contact-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- HEADER --}}
    <div class="show-header">
        <div class="show-header-left">
            <div class="show-header-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="show-header-text">
                <h2>{{ $cliente->nome }}</h2>
                <p><i class="bi bi-telephone"></i> {{ $cliente->celular }}</p>
            </div>
        </div>
        <div class="show-header-actions">
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-editar">
                <i class="bi bi-pencil"></i>
                Editar
            </a>
            <a href="{{ route('clientes.index') }}" class="btn-voltar">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>

    {{-- INFO CARDS --}}
    <div class="info-cards">
        <div class="info-card-custom card-compras">
            <div class="card-label">
                <i class="bi bi-bag-check"></i>
                Compras
            </div>
            <div class="card-value">{{ $cliente->compras->count() }}</div>
        </div>

        <div class="info-card-custom card-total">
            <div class="card-label">
                <i class="bi bi-graph-up"></i>
                Total Comprado
            </div>
            <div class="card-value">R$ {{ number_format($cliente->compras->sum('valor_total'), 2, ',', '.') }}</div>
        </div>

        <div class="info-card-custom card-pago">
            <div class="card-label">
                <i class="bi bi-check-circle"></i>
                Total Pago
            </div>
            <div class="card-value">R$
                {{ number_format($cliente->compras->flatMap->pagamentos->sum('valor_pago'), 2, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- OBSERVAÇÕES --}}
    @if($cliente->observacoes)
        <div class="info-section">
            <div class="info-section-header">
                <i class="bi bi-sticky"></i>
                <h3>Observações</h3>
            </div>
            <div class="info-content">
                {{ $cliente->observacoes }}
            </div>
        </div>
    @endif

    {{-- HISTÓRICO DE COMPRAS --}}
    <div class="historico-card">
        <div class="historico-header">
            <div class="historico-header-left">
                <div class="historico-header-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <h3>Histórico de Compras</h3>
            </div>
            <span class="historico-count">{{ $cliente->compras->count() }}</span>
        </div>

        @if($cliente->compras->count() > 0)
                <div class="compras-list">
                    @foreach($cliente->compras->sortByDesc('data_compra') as $compra)
                            <div class="compra-item">
                                <div class="compra-item-left">
                                    <div class="compra-item-icon">
                                        <i class="bi bi-bag"></i>
                                    </div>
                                    <div class="compra-item-info">
                                        <div class="compra-item-data">
                                            Compra #{{ $compra->id }}
                                        </div>
                                        <div class="compra-item-meta">
                                            <i class="bi bi-calendar-event"></i>
                                            {{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}
                                        </div>

                                        {{-- ADICIONE ISTO --}}
                                        @if($compra->descricao_produtos)
                                            <div
                                                style="font-size:12px; color:#6a5040; margin-top:4px; display:flex; align-items:flex-start; gap:5px;">
                                                <i class="bi bi-box-seam" style="font-size:11px; margin-top:2px; flex-shrink:0;"></i>
                                                <span style="line-height:1.4;">{{ Str::limit($compra->descricao_produtos, 80) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="compra-item-valor">
                                R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                            </div>
                            <div class="compra-item-status">
                                <span class="badge-status {{ strtolower($compra->status) }}">
                                    {{ $compra->status }}
                                </span>
                            </div>
                            <a href="{{ route('compras.show', $compra->id) }}" class="btn-action">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>
                    @endforeach
            </div>
        @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Nenhuma compra registrada</p>
        </div>
    @endif
    </div>

@endsection