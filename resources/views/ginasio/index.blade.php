@extends('layouts.app')

@section('content')


@if(session('success'))
    
<div class="alert alert-success" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div class="container" style="margin-top: 70px;">
    <div class="d-flex justify-content-between py-3">
        <div class="h4">Eventos no Ginásio</div>
        <div>
            <button class="btn btn-primary" id="loadCreateModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Novo Evento
            </button>
        </div>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('ginasio.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col-md-3">
                <input type="month" name="month" class="form-control no-border custom-date-input" id="inputDate" value="{{ request('month') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filtrar
                </button>
            </div>
        </div>
    </form>

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-striped table-light">
                <thead class="thead-light">
                    <tr>
                        <th width="30">ID</th>
                        <th>Entidade</th>
                        <th>Nome da Instituição</th>
                        <th>Nome do Ocupante</th>
                        <th>Tipo de Evento</th>
                        <th>Data do Evento</th>
                        <th>Hora de Início</th>
                        <th>Hora de Fim</th>
                        <th>Contacto</th>
                        <th>Responsável</th>
                        <th>Pagamento</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if($ginasios->isNotEmpty())
                    @foreach ($ginasios as $ginasio)
                    <tr valign="middle">
                        <td>{{ $ginasio->id }}</td>
                        <td>{{ $ginasio->entidade }}</td>
                        <td>{{ $ginasio->nome_instituicao }}</td>
                        <td>{{ $ginasio->nome_ocupante }}</td>
                        <td>{{ $ginasio->tipo_evento }}</td>
                        <td>{{ $ginasio->data_evento }}</td>
                        <td>{{ $ginasio->hora_inicio }}</td>
                        <td>{{ $ginasio->hora_fim }}</td>
                        <td>{{ $ginasio->contacto }}</td>
                        <td>{{ $ginasio->responsavel }}</td>
                        <td>{{ $ginasio->pagamento }}</td>
                        <td>
                            <a href="#" onclick="loadEditModal({{ $ginasio->id }})" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <a href="#" onclick="deleteGinasio({{ $ginasio->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> 
                            </a>
                        
                            <form id="ginasio-delete-form-{{ $ginasio->id }}" action="{{ route('ginasio.destroy', $ginasio->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="12">Nenhum registro encontrado</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $ginasios->links() }}
    </div>

    <div>
        <a href="{{ route('ginasio.pdf', ['month' => request('month')]) }}" class="btn btn-secondary mt-3"> 
            <i class="fas fa-download fa-sm text-white-50"></i> Imprimir PDF
        </a>
    </div>
</div>

<div id="modalContainer"></div>

<script>
    document.getElementById('loadCreateModal').addEventListener('click', function() {
        fetch('{{ route('ginasio.create') }}')
            .then(response => response.text())
            .then(html => {
                document.getElementById('modalContainer').innerHTML = html;
                $('#createEventModal').modal('show');
            });
    });

    function loadEditModal(id) {
        fetch('{{ url("ginasio") }}/' + id + '/edit')
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalContainer').innerHTML = `
                    <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEventModalLabel">Editar Dados do Ginásio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editEventForm" method="POST" action="{{ url('ginasio') }}/${id}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="entidade" class="form-label">Entidade:</label>
                                            <input type="text" class="form-control" id="entidade" name="entidade" value="${data.entidade}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="nome_instituicao" class="form-label">Instituição:</label>
                                            <input type="text" class="form-control" id="nome_instituicao" name="nome_instituicao" value="${data.nome_instituicao}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="nome_ocupante" class="form-label">Nome do Ocupante:</label>
                                            <input type="text" class="form-control" id="nome_ocupante" name="nome_ocupante" value="${data.nome_ocupante}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="tipo_evento" class="form-label">Tipo de Evento:</label>
                                            <input type="text" class="form-control" id="tipo_evento" name="tipo_evento" value="${data.tipo_evento}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="data_evento" class="form-label">Data do Evento:</label>
                                            <input type="date" class="form-control" id="data_evento" name="data_evento" value="${data.data_evento}">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="hora_inicio" class="form-label">Hora de Início:</label>
                                                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="${data.hora_inicio}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="hora_fim" class="form-label">Hora de Fim:</label>
                                                    <input type="time" class="form-control" id="hora_fim" name="hora_fim" value="${data.hora_fim}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="contacto" class="form-label">Contacto:</label>
                                                    <input type="text" class="form-control" id="contacto" name="contacto" value="${data.contacto}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="responsavel" class="form-label">Responsável:</label>
                                                    <input type="text" class="form-control" id="responsavel" name="responsavel" value="${data.responsavel}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Atualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#editEventModal').modal('show');
            });
    }

    function deleteGinasio(id) {
        if (confirm('Você tem certeza que deseja apagar este evento?')) {
            document.getElementById('ginasio-delete-form-' + id).submit();
        } 
    }



  

</script>
@endsection
