<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Clientes Inadimplentes</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #2c2c2c;
            margin: 35px;
            background: #ffffff;
        }

        /* HEADER */
        .header {
            border-bottom: 3px solid #c9847a;
            padding-bottom: 18px;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 30px;
            font-weight: 700;
            color: #c9847a;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 13px;
            color: #777;
            margin-top: 3px;
        }

        .date {
            margin-top: 10px;
            font-size: 12px;
            color: #999;
        }

        /* TITLE */
        h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            border-left: 5px solid #c9847a;
            padding-left: 10px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 6px;
            overflow: hidden;
        }

        thead th {
            background: #c9847a;
            color: #fff;
            padding: 12px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        tbody td {
            padding: 11px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        tbody tr:nth-child(even) {
            background-color: #faf7f6;
        }

        tbody tr:hover {
            background-color: #f3ecea;
        }

        /* SALDO */
        .saldo {
            font-weight: bold;
            color: #d9534f;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* SMALL IMPROVEMENT */
        .container {
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <div class="logo">Cosmetiq</div>
            <div class="subtitle">Sistema de Gestão para Revendedoras</div>
            <div class="date">Emitido em: {{ now()->format('d/m/Y') }}</div>
        </div>

        <h2>Relatório de Clientes Inadimplentes</h2>

        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Valor Total</th>
                    <th>Total Pago</th>
                    <th>Saldo</th>
                </tr>
            </thead>

            <tbody>
                @foreach($compras as $compra)

                    @php
                        $totalPago = $compra->pagamentos->sum('valor_pago');
                        $saldo = $compra->valor_total - $totalPago;
                    @endphp

                    <tr>
                        <td>{{ $compra->cliente->nome }}</td>
                        <td>R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($totalPago, 2, ',', '.') }}</td>
                        <td class="saldo">
                            R$ {{ number_format($saldo, 2, ',', '.') }}
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Relatório gerado automaticamente pelo sistema Cosmetiq.
        </div>

    </div>

</body>

</html>