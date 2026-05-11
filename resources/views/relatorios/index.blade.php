@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mb-4">
            <i class="bi bi-graph-up"></i> Relatórios
        </h2>

        <div class="row">

            <!-- Clientes Inadimplentes -->
            <div class="col-md-6 mb-4">
                <a href="{{ route('relatorios.inadimplentes') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100 border-0 report-card">
                        <div class="card-body text-center">

                            <div class="mb-3">
                                <i class="bi bi-exclamation-triangle-fill display-5 text-danger"></i>
                            </div>

                            <h5 class="card-title">Clientes Inadimplentes</h5>
                            <p class="text-muted">
                                Visualize os clientes com pagamentos pendentes.
                            </p>

                        </div>
                    </div>
                </a>
            </div>

            <!-- Pagamentos Recebidos -->
            <div class="col-md-6 mb-4">
                <a href="{{ route('relatorios.pagamentos') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100 border-0 report-card">
                        <div class="card-body text-center">

                            <div class="mb-3">
                                <i class="bi bi-cash-coin display-5 text-success"></i>
                            </div>

                            <h5 class="card-title">Pagamentos Recebidos</h5>
                            <p class="text-muted">
                                Consulte todos os pagamentos já realizados.
                            </p>

                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>

@endsection