<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>
        Relatório de Pagamentos
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

        .valor {
            font-weight: bold;
            color: #28a745;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .total-box {
            margin-top: 25px;
            text-align: right;
        }

        .total-box h3 {
            color: #c9847a;
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
        Relatório de Pagamentos Recebidos
    </h2>

    <table>

        <thead>

            <tr>

                <th>Cliente</th>

                <th>Valor</th>

                <th>Método</th>

                <th>Data</th>

            </tr>

        </thead>

        <tbody>

            @foreach($pagamentos as $pagamento)

                <tr>

                    <td>
                        {{ $pagamento->compra->cliente->nome }}
                    </td>

                    <td class="valor">
                        R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}
                    </td>

                    <td>
                        {{ $pagamento->metodo_pagamento }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="total-box">

        <h3>
            Total Recebido:
            R$ {{ number_format($pagamentos->sum('valor_pago'), 2, ',', '.') }}
        </h3>

    </div>

    <div class="footer">

        Relatório gerado automaticamente pelo sistema Cosmetiq.

    </div>

</body>

</html>