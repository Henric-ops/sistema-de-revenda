@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')

    <div class="page-header">

        <div>

            <h2>
                Central de Relatórios
            </h2>

            <p>
                Gere relatórios financeiros e acompanhe o desempenho da revenda.
            </p>

        </div>

    </div>

    <div class="reports-grid">

        {{-- RELATÓRIO INADIMPLENTES --}}
        <a href="{{ route('relatorios.inadimplentes.pdf') }}" class="report-card-custom text-decoration-none">

            <div class="report-icon danger">

                <i class="bi bi-exclamation-circle-fill"></i>

            </div>

            <div class="report-content">

                <h3>
                    Clientes Inadimplentes
                </h3>

                <p>
                    Relatório completo com clientes que possuem pagamentos pendentes.
                </p>

                <span class="report-action">

                    <i class="bi bi-file-earmark-pdf"></i>

                    Gerar PDF

                </span>

            </div>

        </a>

        {{-- RELATÓRIO PAGAMENTOS --}}
        <a href="{{ route('relatorios.pagamentos.pdf') }}" class="report-card-custom text-decoration-none">

            <div class="report-icon success">

                <i class="bi bi-cash-coin"></i>

            </div>

            <div class="report-content">

                <h3>
                    Pagamentos Recebidos
                </h3>

                <p>
                    Histórico financeiro com todos os pagamentos registrados no sistema.
                </p>

                <span class="report-action">

                    <i class="bi bi-file-earmark-pdf"></i>

                    Gerar PDF

                </span>

            </div>

        </a>

    </div>

@endsection