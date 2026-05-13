@extends('layouts.app')

@section('title', 'Relatórios')

@push('styles')
    <style>
        /* ── HEADER ─────────────────────────────────────── */
        .relatorios-header {
            margin-bottom: 28px;
        }

        .relatorios-header h2 {
            font-size: 22px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0 0 4px;
        }

        .relatorios-header p {
            font-size: 13px;
            color: #b09080;
            margin: 0;
            font-weight: 500;
        }

        /* ── GRID ────────────────────────────────────────── */
        .relatorios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 20px;
        }

        /* ── CARD ────────────────────────────────────────── */
        .relatorio-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 18px rgba(156, 74, 48, .06);
            padding: 32px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            gap: 24px;
            position: relative;
            overflow: hidden;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .relatorio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(156, 74, 48, .1);
            text-decoration: none;
        }

        /* Detalhe decorativo de fundo */
        .relatorio-card::after {
            content: '';
            position: absolute;
            bottom: -40px;
            right: -40px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            opacity: .05;
            transition: opacity .3s;
        }

        .relatorio-card:hover::after {
            opacity: .1;
        }

        .relatorio-card.danger::after {
            background: #dc3545;
        }

        .relatorio-card.success::after {
            background: #1a8a50;
        }

        /* Topo: ícone + tag */
        .relatorio-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .relatorio-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }

        .relatorio-icon.danger {
            background: #fdeaea;
            color: #dc3545;
        }

        .relatorio-icon.success {
            background: #e8fdf0;
            color: #1a8a50;
        }

        .relatorio-tag {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .relatorio-tag.danger {
            background: #fdeaea;
            color: #dc3545;
        }

        .relatorio-tag.success {
            background: #e8fdf0;
            color: #1a8a50;
        }

        /* Texto */
        .relatorio-body h3 {
            font-size: 20px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0 0 8px;
        }

        .relatorio-body p {
            font-size: 14px;
            color: #8a7060;
            line-height: 1.6;
            margin: 0;
        }

        /* Rodapé do card */
        .relatorio-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid #f5ebe0;
        }

        .relatorio-info {
            font-size: 12px;
            color: #b09080;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .relatorio-info i {
            font-size: 13px;
        }

        .relatorio-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            transition: transform .2s, box-shadow .2s;
            color: white;
        }

        .relatorio-card:hover .relatorio-btn {
            transform: translateX(3px);
        }

        .relatorio-btn.danger {
            background: linear-gradient(135deg, #e53935, #ef5350);
            box-shadow: 0 4px 12px rgba(229, 57, 53, .25);
        }

        .relatorio-btn.success {
            background: linear-gradient(135deg, #1a8a50, #28a865);
            box-shadow: 0 4px 12px rgba(26, 138, 80, .25);
        }

        @media (max-width: 768px) {
            .relatorios-grid {
                grid-template-columns: 1fr;
            }

            .relatorio-card {
                padding: 24px;
            }
        }
    </style>
@endpush

@section('content')

    {{-- HEADER --}}
    <div class="relatorios-header">
        <h2>Central de Relatórios</h2>
        <p>Gere relatórios financeiros e acompanhe o desempenho da revenda.</p>
    </div>

    {{-- GRID --}}
    <div class="relatorios-grid">

        {{-- INADIMPLENTES --}}
        <a href="{{ route('relatorios.inadimplentes.pdf') }}" class="relatorio-card danger">

            <div class="relatorio-card-top">
                <div class="relatorio-icon danger">
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <span class="relatorio-tag danger">Financeiro</span>
            </div>

            <div class="relatorio-body">
                <h3>Clientes Inadimplentes</h3>
                <p>Relatório completo com clientes que possuem pagamentos pendentes ou parcialmente pagos.</p>
            </div>

            <div class="relatorio-footer">
                <span class="relatorio-btn danger">
                    Gerar PDF
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>

        </a>

        {{-- PAGAMENTOS --}}
        <a href="{{ route('relatorios.pagamentos.pdf') }}" class="relatorio-card success">

            <div class="relatorio-card-top">
                <div class="relatorio-icon success">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <span class="relatorio-tag success">Financeiro</span>
            </div>

            <div class="relatorio-body">
                <h3>Pagamentos Recebidos</h3>
                <p>Histórico financeiro com todos os pagamentos confirmados registrados no sistema.</p>
            </div>

            <div class="relatorio-footer">
               
                <span class="relatorio-btn success">
                    Gerar PDF
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>

        </a>

    </div>

@endsection