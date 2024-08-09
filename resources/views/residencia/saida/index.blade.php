@extends('layouts.app')

@section('content')

<div class="container">
        <div class="d-flex justify-content-between py-3">
          
        </div>

        <div class="filter-container d-flex justify-content-start mr-4" "> 
            <form method="GET" action="{{ route('residencia.saida.index') }}" class="form-inline mb-2">
                <div class="form-group">
                    <h5>Escolha Mes e ano: </h5>
                    <input type="month" name="month" class="form-control custom-date-input" id="inputDate" value="{{ request('month') }}">
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <h5>Lista de Reservas Pagas</h5>
                <table class="table table-striped table-light">
                    <thead class="thead-light">
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
           
    </div>
</div>
</div>

@endsection
