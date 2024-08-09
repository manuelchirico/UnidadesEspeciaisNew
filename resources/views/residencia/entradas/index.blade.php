@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="container" style="margin-top: 70px;">
        <div class="d-flex justify-content-between py-3">
            <div class="h4"> </div>
            <div>
                <button class="btn btn-primary" id="loadCreateModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Nova Entrada
                </button>
            </div>
        </div>

        <!-- Formulário de Filtro -->
        <div class="filter-container d-flex justify-content-start mr-4" style="z-index: 1000; margin-top: 50px;">
            <form method="GET" action="{{ route('residencia.entradas.list') }}" class="form-inline mb-2">
                <div class="form-group">
                    <input type="month" name="month" class="form-control custom-date-input" id="inputDate" value="{{ request('month') }}">
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <h5>Lista de Reservas</h5>
                <table class="table table-striped table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nome do Ocupante</th>
                            <th>Casa a Ocupar</th>
                            <th>Data de Entrada</th>
                            <th>Data de Saída</th>
                            <th>Contacto</th>
                            <th>Número de Dias</th>
                            <th>Valor Total</th>
                            <th>Pagamento</th>
                            <th>Ações</th>
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
                            <td>
                                <a href="#" class="btn btn-primary btn-sm" onclick="loadEditModal({{ $reserva->id }})"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('residencia.entradas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $reservas->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Contêiner para os modais -->
<div id="modalContainer"></div>

@endsection

@section('scripts')
<script>
    document.getElementById('loadCreateModal').addEventListener('click', function() {
        fetch('{{ route('residencia.entradas.create') }}')
            .then(response => response.text())
            .then(html => {
                document.getElementById('modalContainer').innerHTML = html;
                $('#createEventModal').modal('show');
            });
    });

    function loadEditModal(id) {
        fetch('{{ url('residencia/entradas') }}/' + id + '/edit')
            .then(response => response.text())
            .then(html => {
                document.getElementById('modalContainer').innerHTML = html;
                $('#editEventModal').modal('show');
            });
    }
</script>
@endsection
