@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    <div class="d-flex justify-content-between py-3">
        <div class="h4">Eventos</div>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEventModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Novo Evento
            </button>
        </div>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('campos.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col-md-3">
                <input type="month" name="month" class="form-control no-border custom-date-input" id="inputDate" value="{{ request('month') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-light">
            <thead class="thead-light">
                <tr>
                    <th width="30">#</th>
                    <th>Data</th>
                    <th>Nome da Instituição</th>
                    <th>Hora de Início</th>
                    <th>Hora de Fim</th>
                    <th>Observação</th>
                    <th>Tempo Total (horas)</th>
                    <th>Pagamento</th>
                    <th width="150">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if($campos->isNotEmpty())
                @foreach ($campos as $campo)
                <tr valign="middle">
                    <td>{{ $campo->id }}</td>
                    <td>{{ $campo->data_evento }}</td>
                    <td>{{ $campo->nome_instituicao }}</td>
                    <td>{{ $campo->hora_inicio }}</td>
                    <td>{{ $campo->hora_fim }}</td>
                    <td>{{ $campo->observacao }}</td>
                    <td>{{ number_format($campo->tempo_total, 2) }}</td>
                    <td>{{ number_format($campo->pagamento, 2, ',', '.') }}</td>
                    <td>
                    <a href="#" onclick="editCampo({{ $campo->id }})" class="btn btn-primary btn-sm"> <i class="fas fa-edit fa-sm text-white-50"></i></a>

                        <a href="#" onclick="deleteCampo({{ $campo->id }})" class="btn btn-danger btn-sm">  <i class="fas fa-trash fa-sm text-white-50"></i></a>

                        <form id="campo-delete-action-{{ $campo->id }}" action="{{ route('campos.destroy', $campo->id) }}" method="post" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9">Nenhum registro encontrado</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <a href="{{ route('campos.pdf', ['month' => request('month')]) }}" class="btn btn-secondary"> <i class="fas fa-download fa-sm text-white-50"></i> Imprimir PDF</a>
        </div>
        <div>
            {{ $campos->links() }}
        </div>
    </div>
</div>

<!-- Modal de Criação de Evento -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Novo Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- O conteúdo será carregado dinamicamente aqui -->
                <div id="modalContent">Carregando...</div>
            </div>
        </div>
    </div>
</div>




<!-- Modal de Edição de Estudante -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Editar Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- O conteúdo será carregado dinamicamente aqui -->
                <div id="modalEditContent">Carregando...</div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = new bootstrap.Modal(document.getElementById('createEventModal'));

    document.querySelector('[data-bs-toggle="modal"]').addEventListener('click', function () {
        fetch('{{ route('campos.create') }}')
            .then(response => response.text())
            .then(html => {
                document.querySelector('#createEventModal .modal-body').innerHTML = html;
                modal.show();
            })
            .catch(error => {
                console.error('Error loading modal content:', error);
                document.querySelector('#createEventModal .modal-body').innerHTML = 'Erro ao carregar o conteúdo.';
            });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var editModal = new bootstrap.Modal(document.getElementById('editEventModal'));

    window.editCampo = function(id) {
        fetch('/campos/' + id + '/edit')
            .then(response => response.text())
            .then(html => {
                document.querySelector('#editEventModal .modal-body').innerHTML = html;
                editModal.show();
            })
            .catch(error => {
                console.error('Error loading modal content:', error);
                document.querySelector('#editEventModal .modal-body').innerHTML = 'Erro ao carregar o conteúdo.';
            });
    };
});

function deleteCampo(id) {
    if (confirm('Você tem certeza que deseja apagar este evento?')) {
        document.getElementById('campo-delete-action-' + id).submit();
    }
}
</script>
@endsection
