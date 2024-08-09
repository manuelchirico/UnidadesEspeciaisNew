@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    <div class="container">
        <h4 class="my-4">Receitas Mensais</h4>

        <!-- Botão de filtro por mês -->
        <form method="GET" action="{{ route('receita.index') }}" class="mb-4">
            <div class="form-row">
                <div class="col-md-3">
                    <input type="month" name="month" class="form-control no-border custom-date-input" value="{{ request('month') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filtrar por Mês</button>
                </div>
            </div>
        </form>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped table-light">
                    <!-- Cabeçalho da tabela -->
                    <thead class="thead-light">
                        <tr>
                            <th>Mês</th>
                            <th>Casas</th>
                            <th>Ginásio</th>
                            <th>Campos</th>
                            <th>Total Entrada</th>
                            <th>Saídas</th>
                            <th>Valor Existente</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Corpo da tabela -->
                        @if($receitas->isNotEmpty())
                            @foreach ($receitas as $receita)
                                <tr valign="middle">
                                    <td>{{ $receita->mes }}</td>
                                    <td>{{ $receita->reserva }}</td>
                                    <td>{{ $receita->ginasio }}</td>
                                    <td>{{ $receita->campo }}</td>
                                    <td>{{ $receita->total_entrada }}</td>
                                    <td>{{ $receita->saidas }}</td>
                                    <td>{{ $receita->valor_existente }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="loadEditModal('{{ $receita->mes }}')">Editar</button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Total -->
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $totalCasas }}</strong></td>
                                <td><strong>{{ $totalGinasio }}</strong></td>
                                <td><strong>{{ $totalCampo }}</strong></td>
                                <td><strong>{{ $totalEntrada }}</strong></td>
                                <td><strong>{{ $receitas->sum('saidas') }}</strong></td>
                                <td><strong>{{ $totalCasas + $totalGinasio + $totalCampo - $receitas->sum('saidas') }}</strong></td>
                                <td></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="8">Nenhum registro encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botão de impressão -->
        <div>
            <a href="{{ route('receitas.pdf', ['month' => request('month')]) }}" class="btn btn-secondary">Imprimir PDF</a>
        </div>
    </div>
</div>

<!-- Modal para Edição -->
<div class="modal fade" id="editReceitaModal" tabindex="-1" aria-labelledby="editReceitaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReceitaModalLabel">Editar Saídas para <span id="modalMes"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- O conteúdo da edição será carregado aqui -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function loadEditModal(mes) {
        fetch('{{ route('receitas.edit', ':mes') }}'.replace(':mes', mes))
            .then(response => response.text())
            .then(html => {
                document.getElementById('modalContent').innerHTML = html;
                document.getElementById('modalMes').textContent = mes;
                $('#editReceitaModal').modal('show');
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    }
</script>

@endsection
