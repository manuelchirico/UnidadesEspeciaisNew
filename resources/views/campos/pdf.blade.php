<!DOCTYPE html>
<html>
<head>
    <title>Eventos: Campos</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: right;
        }
        th {
            background-color: #f8f9fa;
            color: #343a40;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
    
</head>
<body>
<div class="header">
    <h1>Universidade Licungo - Extensão Beira</h1>
    <h1>Departamento de Unidades Especiais</h1>
    <h2>Relatório de Aluguer de Campo - Beira</h2>
    <h3>Eventos @if($month) de {{ date('m/Y', strtotime($month)) }} @endif</h3>
</div>

    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Nome da Instituição</th>
                <th>Hora de Início</th>
                <th>Hora de Fim</th>
                <th>Observação</th>
                <th>Tempo Total (horas)</th>
                <th>Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campos as $campo)
            <tr>
                <td>{{ $campo->id }}</td>
                <td>{{ $campo->data_evento }}</td>
                <td>{{ $campo->nome_instituicao }}</td>
                <td>{{ $campo->hora_inicio }}</td>
                <td>{{ $campo->hora_fim }}</td>
                <td>{{ $campo->observacao }}</td>
                <td>{{ number_format($campo->tempo_total, 2) }}</td>
                <td>{{ number_format($campo->pagamento, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer" style="text-align: center; margin-top: 40px;">
    <p>Beira, aos {{ date('d') }} de {{ date('F') }} de {{ date('Y') }}
    Impresso às {{ date('H:i') }}</p>
</div>

</body>
</html>
