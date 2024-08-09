<form action="{{ route('receitas.update', $receita->mes) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="saidas">Valor de Saídas</label>
        <input type="number" step="0.01" class="form-control" id="saidas" name="saidas" value="{{ $receita->saidas }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
