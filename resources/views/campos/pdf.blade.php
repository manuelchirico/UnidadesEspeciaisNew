<!DOCTYPE html>
<html>
<head>
    <title>Eventos: Campos </title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: right;
        }
        th {
            background-color: #f8f9fa;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
      
        .header h1, .header h2 {
            margin: 5px 0;
        }
        .header h1 {
            font-weight: bold;
        }
        .header {
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('unilicungo/up.png') }}" alt="Logo">
        <h1>Universidadde licungo -<h1>extensão Beira </h1></h1>
        <h1>Departamento de Unidade Especiais</h1>
        <h2>Relatorio de Aluguer de Campo-Beira</h2>
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
</body>
</html>
