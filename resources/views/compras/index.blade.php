@extends('layouts.app')

@section('title', 'Compras')

@push('styles')
    <style>
        /* ── HEADER ─────────────────────────────────────── */
        .compras-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .compras-header-text h2 {
            font-size: 22px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0 0 4px;
        }

        .compras-header-text p {
            font-size: 13px;
            color: #b09080;
            margin: 0;
            font-weight: 500;
        }

        /* ── CARD ────────────────────────────────────────── */
        .compras-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 18px rgba(156, 74, 48, .06);
            overflow: hidden;
        }

        /* ── TOOLBAR ─────────────────────────────────────── */
        .compras-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 28px;
            border-bottom: 1px solid #f5ebe0;
            gap: 16px;
            flex-wrap: wrap;
        }

        .compras-search {
            position: relative;
            flex: 1;
            max-width: 300px;
        }

        .compras-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #c0a898;
            font-size: 15px;
        }

        .compras-search input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border-radius: 12px;
            border: 1px solid #f0e8dc;
            background: #faf6f2;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            color: #2a1a10;
            transition: .2s;
        }

        .compras-search input:focus {
            outline: none;
            border-color: #9c4a30;
            background: white;
            box-shadow: 0 0 0 3px rgba(156, 74, 48, .1);
        }

        .compras-search input::placeholder {
            color: #c0a898;
        }

        /* Filtros de status */
        .compras-filters {
            display: flex;
            gap: 8px;
        }

        .filter-btn {
            padding: 8px 14px;
            border-radius: 20px;
            border: 1px solid #f0e8dc;
            background: #faf6f2;
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: #b09080;
            cursor: pointer;
            transition: .2s;
        }

        .filter-btn:hover {
            border-color: #9c4a30;
            color: #9c4a30;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: white;
            border-color: transparent;
            box-shadow: 0 2px 8px rgba(156, 74, 48, .2);
        }

        .compras-count {
            font-size: 13px;
            color: #b09080;
            font-weight: 600;
            white-space: nowrap;
        }

        .compras-count span {
            color: #9c4a30;
            font-weight: 800;
        }

        /* ── TABELA ──────────────────────────────────────── */
        .compras-table {
            width: 100%;
            border-collapse: collapse;
        }

        .compras-table thead tr {
            background: #fdf8f4;
            border-bottom: 1px solid #f5ebe0;
        }

        .compras-table th {
            padding: 13px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #b09080;
            white-space: nowrap;
        }

        .compras-table tbody tr {
            border-bottom: 1px solid #faf4ee;
            transition: background .15s;
        }

        .compras-table tbody tr:last-child {
            border-bottom: none;
        }

        .compras-table tbody tr:hover {
            background: #fdf8f5;
        }

        .compras-table tbody tr.hidden-row {
            display: none;
        }

        .compras-table td {
            padding: 15px 20px;
            vertical-align: middle;
            font-size: 14px;
            color: #2a1a10;
        }

        /* Cliente cell */
        .cliente-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cliente-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #fde8d8, #fac8a8);
            color: #9c4a30;
            font-size: 14px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cliente-nome {
            font-weight: 700;
            font-size: 14px;
        }

        /* Valor */
        .valor-cell {
            font-weight: 800;
            font-size: 15px;
            color: #2a1a10;
        }

        /* Parcelas */
        .parcelas-cell {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f5efe8;
            color: #7a5040;
            font-weight: 700;
            font-size: 13px;
            padding: 5px 12px;
            border-radius: 20px;
        }

        /* Badges */
        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-pill.pago {
            background: #e8fff0;
            color: #1a8a50;
        }

        .badge-pill.parcial {
            background: #eef4ff;
            color: #3a6fd8;
        }

        .badge-pill.pendente {
            background: #fff8e8;
            color: #b07800;
        }

        /* Data */
        .data-cell {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .data-cell .dia {
            font-weight: 700;
            font-size: 14px;
        }

        .data-cell .rel {
            font-size: 11px;
            color: #b09080;
        }

        /* Ações */
        .acoes-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-ic {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            text-decoration: none;
            flex-shrink: 0;
        }

        .btn-ic:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
        }

        .btn-ic.view {
            background: #edf5ff;
            color: #3a7bfd;
        }

        .btn-ic.view:hover {
            background: #3a7bfd;
            color: white;
        }

        .btn-ic.edit {
            background: #fff8e8;
            color: #d69b00;
        }

        .btn-ic.edit:hover {
            background: #d69b00;
            color: white;
        }

        .btn-ic.delete {
            background: #ffeaea;
            color: #d94b4b;
        }

        .btn-ic.delete:hover {
            background: #d94b4b;
            color: white;
        }

        .acoes-divider {
            width: 1px;
            height: 24px;
            background: #f0e8dc;
            margin: 0 2px;
        }

        /* Vazio */
        .compras-empty {
            text-align: center;
            padding: 60px 20px;
            color: #c0a898;
        }

        .compras-empty i {
            font-size: 40px;
            display: block;
            margin-bottom: 12px;
            opacity: .5;
        }

        .compras-empty p {
            font-size: 15px;
            margin: 0;
        }

        @media (max-width: 768px) {
            .compras-toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .compras-search {
                max-width: 100%;
                width: 100%;
            }

            .compras-filters {
                flex-wrap: wrap;
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

    {{-- HEADER --}}
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

    {{-- CARD --}}
    <div class="compras-card">

        {{-- TOOLBAR --}}
        <div class="compras-toolbar">

            <div class="compras-search">
                <i class="bi bi-search"></i>
                <input type="text" id="busca-compra" placeholder="Buscar por cliente…">
            </div>

            <div class="compras-filters">
                <button class="filter-btn active" data-status="todos">Todos</button>
                <button class="filter-btn" data-status="pago">Pagos</button>
                <button class="filter-btn" data-status="parcial">Parcial</button>
                <button class="filter-btn" data-status="pendente">Pendentes</button>
            </div>

            <span class="compras-count">
                <span id="total-visivel">{{ $compras->count() }}</span> compras
            </span>

        </div>

        {{-- TABELA --}}
        @if($compras->count() > 0)
            <table class="compras-table" id="tabela-compras">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor Total</th>
                        <th>Parcelas</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compras as $compra)
                        <tr data-busca="{{ strtolower($compra->cliente->nome) }}" data-status="{{ $compra->status }}">

                            {{-- Cliente --}}
                            <td>
                                <div class="cliente-cell">
                                    <div class="cliente-avatar">
                                        {{ strtoupper(substr($compra->cliente->nome, 0, 1)) }}
                                    </div>
                                    <span class="cliente-nome">{{ $compra->cliente->nome }}</span>
                                </div>
                            </td>

                            {{-- Valor --}}
                            <td>
                                <span class="valor-cell">
                                    R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                                </span>
                            </td>

                            {{-- Parcelas --}}
                            <td>
                                <span class="parcelas-cell">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $compra->qtd_parcelas }}x
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($compra->status == 'pago')
                                    <span class="badge-pill pago">Pago</span>
                                @elseif($compra->status == 'parcial')
                                    <span class="badge-pill parcial">Parcial</span>
                                @else
                                    <span class="badge-pill pendente">Pendente</span>
                                @endif
                            </td>

                            {{-- Data --}}
                            <td>
                                @php $data = \Carbon\Carbon::parse($compra->data_compra); @endphp
                                <div class="data-cell">
                                    <span class="dia">{{ $data->format('d/m/Y') }}</span>
                                    <span class="rel">{{ $data->diffForHumans() }}</span>
                                </div>
                            </td>

                            {{-- Ações --}}
                            <td>
                                <div class="acoes-cell">

                                    <a href="{{ route('compras.show', $compra->id) }}" class="btn-ic view" title="Ver detalhes">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn-ic edit" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <div class="acoes-divider"></div>

                                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST"
                                        onsubmit="return confirm('Excluir esta compra de {{ $compra->cliente->nome }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-ic delete" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="compras-empty">
                <i class="bi bi-bag"></i>
                <p>Nenhuma compra registrada ainda.</p>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        const buscaInput = document.getElementById('busca-compra');
        const filterBtns = document.querySelectorAll('.filter-btn');
        const rows = document.querySelectorAll('#tabela-compras tbody tr');
        const counter = document.getElementById('total-visivel');

        let filtroAtivo = 'todos';

        function aplicarFiltros() {
            const q = buscaInput.value.toLowerCase().trim();
            let visivel = 0;

            rows.forEach(row => {
                const busca = (row.dataset.busca || '').toLowerCase();
                const status = row.dataset.status || '';

                const bateBusca = busca.includes(q);
                const bateStatus = filtroAtivo === 'todos' || status === filtroAtivo;

                const mostrar = bateBusca && bateStatus;
                row.classList.toggle('hidden-row', !mostrar);
                if (mostrar) visivel++;
            });

            counter.textContent = visivel;
        }

        buscaInput.addEventListener('input', aplicarFiltros);

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                filtroAtivo = btn.dataset.status;
                aplicarFiltros();
            });
        });
    </script>
@endpush