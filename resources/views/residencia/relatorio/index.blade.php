@extends('layouts.app')

@section('content')

<div class="container">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="container">
        <div class="container" style="margin-top: 70px;">
        <div class="d-flex justify-content-between py-3">
            <div>
                <h4>Lista de Reservas</h4>
            </div>
            <div class="form-inline">
                <!-- Formulário de filtro -->
                <form method="GET" action="{{ route('residencia.relatorio.filtradas') }}">
                    <!-- Combobox para selecionar o estado do pagamento -->
                    <select class="form-control mr-2" name="pagamento">
                        <option value="">Todos</option>
                        <option value="pendente">Pendente</option>
                        <option value="pago">Pago</option>
                    </select>
                    <!-- Entrada para selecionar data -->
                    <input type="date" class="form-control mr-2" name="data">
                    <!-- Botão de filtrar -->
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
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

                <!-- Formulário para imprimir relatório -->
                <form method="GET" action="{{ route('residencia.relatorio.pdf') }}">
                    <!-- Incluir os parâmetros de filtro -->
                    <input type="hidden" name="pagamento" value="{{ request('pagamento') }}">
                    <input type="hidden" name="data" value="{{ request('data') }}">
                    <!-- Botão de imprimir -->
                    <button type="submit" class="btn btn-success mt-3">Imprimir</button>
                </form>
                
            </div>
        </div>
    </div>
    </div>
</div>

@endsection
