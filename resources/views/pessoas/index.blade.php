@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="my-4">Lista de Funcionarios</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">
            <i class="fas fa-plus"></i> Novo Usuário
        </button>
    </div>
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-striped table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Contacto</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa->nome }}</td>
                            <td>{{ $pessoa->email }}</td>
                            <td>{{ $pessoa->contacto }}</td>
                            <td>{{ $pessoa->tipo }}</td>
                            <td>
                                <form action="{{ route('pessoas.destroy', $pessoa->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i   class="fas fa-trash"></i</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Registro -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Registrar Novo Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pessoas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="contacto">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contacto" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="admin">Admin</option>
                            <option value="funcionario">Funcionario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
    });
</script>
@endsection
