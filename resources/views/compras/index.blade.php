@extends('layouts.app')

@section('title', 'Compras')

@push('styles')
    <style>
        .compras-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .compras-header-text h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            color: #2a1a10;
        }

        .compras-header-text p {
            margin: 4px 0 0;
            color: #a78976;
            font-size: 14px;
        }

        .compras-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid #f1e6dc;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(156, 74, 48, .06);
        }

        .compras-toolbar {
            padding: 24px;
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
            border-bottom: 1px solid #f4ece4;
        }

        .compras-search {
            position: relative;
            flex: 1;
            min-width: 240px;
        }

        .compras-search i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #c0a898;
        }

        .compras-search input {
            width: 100%;
            height: 48px;
            border-radius: 14px;
            border: 1px solid #efe2d7;
            background: #faf6f2;
            padding: 0 16px 0 42px;
            font-size: 14px;
            transition: .2s;
        }

        .compras-search input:focus {
            outline: none;
            border-color: #9c4a30;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(156, 74, 48, .08);
        }

        .filter-select,
        .form-date {
            height: 48px;
            border-radius: 14px;
            border: 1px solid #efe2d7;
            background: #faf6f2;
            padding: 0 14px;
            font-size: 14px;
            color: #2a1a10;
        }

        .filter-select:focus,
        .form-date:focus {
            outline: none;
            border-color: #9c4a30;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(156, 74, 48, .08);
        }

        .btn-buscar {
            height: 48px;
            border: none;
            border-radius: 14px;
            padding: 0 22px;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
        }

        .btn-buscar:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(156, 74, 48, .18);
        }

        .btn-limpar {
            height: 48px;
            padding: 0 18px;
            border-radius: 14px;
            border: 1px solid #efe2d7;
            background: #fff;
            color: #9c4a30;
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
        }

        .btn-limpar:hover {
            background: #faf4ef;
        }

        .compras-count {
            margin-left: auto;
            font-size: 13px;
            color: #a78976;
            font-weight: 700;
        }

        .compras-count span {
            color: #9c4a30;
        }

        .compras-table {
            width: 100%;
            border-collapse: collapse;
        }

        .compras-table thead {
            background: #fcf8f5;
        }

        .compras-table th {
            padding: 18px 20px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            color: #b09080;
            letter-spacing: .8px;
        }

        .compras-table td {
            padding: 18px 20px;
            border-top: 1px solid #faf2eb;
        }

        .compras-table tbody tr {
            transition: .2s;
        }

        .compras-table tbody tr:hover {
            background: #fdf8f5;
        }

        .cliente-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cliente-avatar {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, #fde8d8, #fac8a8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #9c4a30;
        }

        .cliente-nome {
            font-weight: 700;
            color: #2a1a10;
        }

        .valor-cell {
            font-weight: 800;
            color: #2a1a10;
        }

        .parcelas-cell {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f6efe8;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            color: #7a5040;
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-pill::before {
            content: '';
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-pill.pago {
            background: #e8fff0;
            color: #1a8a50;
        }

        .badge-pill.parcialmente_pago {
            background: #edf4ff;
            color: #2d6cdf;
        }

        .badge-pill.pendente {
            background: #fff8e8;
            color: #b07800;
        }

        .acoes-cell {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-ic {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: .2s;
        }

        .btn-ic:hover {
            transform: translateY(-2px);
        }

        .btn-ic.view {
            background: #edf5ff;
            color: #3a7bfd;
        }

        .btn-ic.edit {
            background: #fff7e8;
            color: #d69b00;
        }

        .btn-ic.delete {
            background: #ffeaea;
            color: #d94b4b;
        }

        .compras-empty {
            padding: 70px 20px;
            text-align: center;
            color: #c0a898;
        }

        .compras-empty i {
            font-size: 44px;
            display: block;
            margin-bottom: 12px;
        }

        @media(max-width:900px) {

            .compras-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .compras-count {
                margin-left: 0;
            }

            .compras-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

        }
    </style>
@endpush

@section('content')

    <div class="compras-header">

        <div class="compras-header-text">
            <h2>Compras</h2>
            <p>Gerencie todas as compras realizadas.</p>
        </div>

        <a href="{{ route('compras.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i>
            Nova Compra
        </a>

    </div>

    <div class="compras-card">

        <form method="GET" action="{{ route('compras.index') }}" class="compras-toolbar">

            {{-- BUSCA --}}
            <div class="compras-search">
                <i class="bi bi-search"></i>

                <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar cliente...">
            </div>

            {{-- STATUS --}}
            <select name="status" class="filter-select">

                <option value="todos">
                    Todos Status
                </option>

                <option value="pago" @selected(request('status') == 'pago')>
                    Pago
                </option>

                <option value="parcialmente_pago" @selected(request('status') == 'parcialmente_pago')>
                    Parcial
                </option>

                <option value="pendente" @selected(request('status') == 'pendente')>
                    Pendente
                </option>

            </select>

         
            {{-- PERÍODO --}}
            <select name="periodo" class="filter-select" id="periodo-select">

                <option value="">
                    Período
                </option>

                <option value="hoje" @selected(request('periodo') == 'hoje')>
                    Hoje
                </option>

                <option value="semana" @selected(request('periodo') == 'semana')>
                    Semana
                </option>

                <option value="mes" @selected(request('periodo') == 'mes')>
                    Mês
                </option>

                

            </select>

            {{-- DATAS --}}
            <div id="datas-personalizadas"
                style="display: {{ request('periodo') == 'personalizado' ? 'flex' : 'none' }}; gap:10px;">

                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}" class="form-date">

                <input type="date" name="data_fim" value="{{ request('data_fim') }}" class="form-date">

            </div>

            {{-- BOTÕES --}}
            <button type="submit" class="btn-buscar">
                <i class="bi bi-search"></i>
                Buscar
            </button>

            <a href="{{ route('compras.index') }}" class="btn-limpar">
                <i class="bi bi-x-circle"></i>
                Limpar
            </a>

            {{-- TOTAL --}}
            <span class="compras-count">
                <span>{{ $compras->total() }}</span> compras
            </span>

        </form>

        @if($compras->count())

            <table class="compras-table">

                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>Parcelas</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($compras as $compra)

                        <tr>

                            <td>

                                <div class="cliente-cell">

                                    <div class="cliente-avatar">
                                        {{ strtoupper(substr($compra->cliente->nome, 0, 1)) }}
                                    </div>

                                    <div class="cliente-nome">
                                        {{ $compra->cliente->nome }}
                                    </div>

                                </div>

                            </td>

                            <td>
                                <span class="valor-cell">
                                    R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                                </span>
                            </td>

                            <td>

                                <span class="parcelas-cell">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $compra->qtd_parcelas }}x
                                </span>

                            </td>

                            <td>

                                <span class="badge-pill {{ $compra->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $compra->status)) }}
                                </span>

                            </td>

                            <td>

                                @php
                                    $data = \Carbon\Carbon::parse($compra->data_compra);
                                @endphp

                                {{ $data->format('d/m/Y') }}

                            </td>

                            <td>

                                <div class="acoes-cell">

                                    <a href="{{ route('compras.show', $compra->id) }}" class="btn-ic view">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn-ic edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST"
                                        onsubmit="return confirm('Deseja excluir esta compra?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-ic delete">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <div style="padding:24px">
                {{ $compras->appends(request()->query())->links() }}
            </div>

        @else

            <div class="compras-empty">
                <i class="bi bi-bag"></i>
                <p>Nenhuma compra encontrada.</p>
            </div>

        @endif

    </div>

    @push('scripts')
        <script>

            const periodoSelect = document.getElementById('periodo-select');
            const datasPersonalizadas = document.getElementById('datas-personalizadas');

            periodoSelect.addEventListener('change', function () {

                datasPersonalizadas.style.display =
                    this.value === 'personalizado'
                        ? 'flex'
                        : 'none';

            });

        </script>
    @endpush

@endsection