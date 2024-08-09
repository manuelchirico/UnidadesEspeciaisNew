<!DOCTYPE html>
<html>
<head>
    <title>Eventos no Ginásio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
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
        .header img {
            width: 150px;
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
    <img src="{{ url('unilicungo/up.png') }}" alt="Logo">
    <h2>Universidadde licungo -<h1>extensão Beira </h1></h2>
        <h3>Departamento de Unidade Especiais</h3>
        <h3>Departamento de Aluguer de Ginásio</h3>
        <h3>Eventos @if($month) de {{ date('m/Y', strtotime($month)) }} @endif</h3>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
               
                <th>Nome da Instituição</th>
                <th>Nome do Ocupante</th>
                <th>Tipo de Evento</th>
                <th>Data do Evento</th>
                <th>Hora de Início</th>
                <th>Hora de Fim</th>
                <th>Contacto</th>
                
                <th>Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ginasios as $ginasio)
            <tr>
                <td>{{ $ginasio->id }}</td>
              
                <td>{{ $ginasio->nome_instituicao }}</td>
                <td>{{ $ginasio->nome_ocupante }}</td>
                <td>{{ $ginasio->tipo_evento }}</td>
                <td>{{ $ginasio->data_evento }}</td>
                <td>{{ $ginasio->hora_inicio }}</td>
                <td>{{ $ginasio->hora_fim }}</td>
                <td>{{ $ginasio->contacto }}</td>
              
                <td>{{ $ginasio->pagamento }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
