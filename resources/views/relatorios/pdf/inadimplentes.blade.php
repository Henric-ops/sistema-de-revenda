<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>
        Clientes Inadimplentes
    </title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 30px;
        }

        .header {
            border-bottom: 2px solid #c9847a;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #c9847a;
        }

        .subtitle {
            color: #777;
            margin-top: 5px;
        }

        .date {
            margin-top: 10px;
            font-size: 13px;
            color: #999;
        }

        h2 {
            margin-bottom: 20px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background-color: #c9847a;
            color: white;
            padding: 12px;
            text-align: left;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .saldo {
            font-weight: bold;
            color: #d9534f;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>

</head>

<body>

    <div class="header">

        <div class="logo">
            Cosmetiq
        </div>

        <div class="subtitle">
            Sistema de Gestão para Revendedoras
        </div>

        <div class="date">
            Emitido em:
            {{ now()->format('d/m/Y H:i') }}
        </div>

    </div>

    <h2>
        Relatório de Clientes Inadimplentes
    </h2>

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

                    <td>
                        {{ $compra->cliente->nome }}
                    </td>

                    <td>
                        R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                    </td>

                    <td>
                        R$ {{ number_format($totalPago, 2, ',', '.') }}
                    </td>

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

</body>

</html>