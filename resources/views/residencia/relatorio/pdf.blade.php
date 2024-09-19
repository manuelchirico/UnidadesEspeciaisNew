<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Reservas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        .header {
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="header">
        <h2>Universidadde licungo-extensão Beira </h2>
        <h2>Departamento de Unidade Especiais</h2>
        <h3>Relatório de Reservas</h3>
    </div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Ocupante</th>
            <th>Casa a Ocupar</th>
            <th>Data de Entrada</th>
            <th>Data de Saída</th>
            <th>Contacto</th>
            <th>Número de Dias</th>
            <th>Valor Total</th>
            <th>Pagamento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservas as $reserva)
        <tr>
            <td>{{ $reserva->id }}</td>
            <td>{{ $reserva->nome_ocupante }}</td>
            <td>{{ $reserva->casa_a_ocupar }}</td>
            <td>{{ $reserva->data_entrada }}</td>
            <td>{{ $reserva->data_saida }}</td>
            <td>{{ $reserva->contacto }}</td>
            <td>{{ $reserva->numero_dias }}</td>
            <td>{{ $reserva->valor_total }}</td>
            <td>{{ $reserva->pagamento }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="footer" style="text-align: center; margin-top: 40px;">
    <p>Beira, aos {{ date('d') }} de {{ date('F') }} de {{ date('Y') }} <h5>
    Impresso às {{ date('H:i') }} </h5></p>
</div>
</body>
</html>
