<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Receitas</title>
    <style>
        body {
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
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 100px; /* Ajuste o tamanho da imagem conforme necessário */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Universidade Licungo - Extensão Beira</h1>
        <h1>Departamento de Unidades Especiais</h1>
        <h3>Relatório de Receitas</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mês</th>
                <th>Casas</th>
                <th>Ginásio</th>
                <th>Campos</th>
                <th>Total Entrada</th>
                <th>Saídas</th>
                <th>Valor Existente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receitas as $receita)
                <tr>
                    <td>{{ $receita->mes }}</td>
                    <td>{{ $receita->reserva }}</td>
                    <td>{{ $receita->ginasio }}</td>
                    <td>{{ $receita->campo }}</td>
                    <td>{{ $receita->total_entrada }}</td>
                    <td>{{ $receita->saidas }}</td>
                    <td>{{ $receita->valor_existente }}</td>
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
