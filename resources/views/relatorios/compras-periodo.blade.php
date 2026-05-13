@extends('layouts.app')

@section('title', 'Compras por Período')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Compras por Período</h2>
            <p class="text-muted mb-0">
                Relatório financeiro de compras.
            </p>
        </div>
    </div>

    <form method="GET" action="{{ route('relatorios.compras-periodo') }}" class="card p-4 mb-4 border-0 shadow-sm">

        <div class="row g-3 align-items-end">

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    Período
                </label>

                <select name="periodo" id="periodo" class="form-select">

                    <option value="">Selecione</option>

                    <option value="hoje" {{ request('periodo') == 'hoje' ? 'selected' : '' }}>
                        Hoje
                    </option>

                    <option value="semana" {{ request('periodo') == 'semana' ? 'selected' : '' }}>
                        Semana
                    </option>

                    <option value="mes" {{ request('periodo') == 'mes' ? 'selected' : '' }}>
                        Mês
                    </option>

                    <option value="personalizado" {{ request('periodo') == 'personalizado' ? 'selected' : '' }}>
                        Personalizado
                    </option>

                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    Data Inicial
                </label>

                <input type="date" name="data_inicio" class="form-control" value="{{ request('data_inicio') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    Data Final
                </label>

                <input type="date" name="data_fim" class="form-control" value="{{ request('data_fim') }}">
            </div>

            <div class="col-md-3">
                <button class="btn btn-dark w-100">
                    <i class="bi bi-search"></i>
                    Filtrar
                </button>
            </div>

        </div>

    </form>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <small class="text-muted">
                    Total Vendido
                </small>

                <h3 class="fw-bold text-dark mt-2">
                    R$ {{ number_format($totalVendido, 2, ',', '.') }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <small class="text-muted">
                    Total Pago
                </small>

                <h3 class="fw-bold text-success mt-2">
                    R$ {{ number_format($totalPago, 2, ',', '.') }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <small class="text-muted">
                    Total Pendente
                </small>

                <h3 class="fw-bold text-danger mt-2">
                    R$ {{ number_format($totalPendente, 2, ',', '.') }}
                </h3>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Data</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($compras as $compra)

                        <tr>

                            <td>
                                {{ $compra->cliente->nome }}
                            </td>

                            <td>
                                R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                            </td>

                            <td>

                                @if($compra->status == 'pago')

                                    <span class="badge bg-success">
                                        Pago
                                    </span>

                                @elseif($compra->status == 'parcialmente_pago')

                                    <span class="badge bg-primary">
                                        Parcial
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Pendente
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-4">
                                Nenhuma compra encontrada.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection