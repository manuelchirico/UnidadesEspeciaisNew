<!-- resources/views/campos/edit.blade.php -->
<form method="POST" action="{{ route('campos.update', $campo->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="inputDate" class="black-label font-weight-bold">Data</label>
        <input type="date" class="form-control no-border" id="inputDate" name="data_evento" value="{{ $campo->data_evento }}" style="background-color: white; color: black;" required>
    </div>
    <div class="form-group">
        <label for="inputInstitution" class="black-label font-weight-bold">Nome da Instituição</label>
        <input type="text" class="form-control no-border" id="inputInstitution" name="nome_instituicao" value="{{ $campo->nome_instituicao }}" style="background-color: white; color: black;" required>
    </div>
    <div class="form-group">
        <label for="inputStartTime" class="black-label font-weight-bold">Hora de Início</label>
        <input type="time" class="form-control no-border" id="inputStartTime" name="hora_inicio" value="{{ $campo->hora_inicio }}" style="background-color: white; color: black;" required>
    </div>
    <div class="form-group">
        <label for="inputEndTime" class="black-label font-weight-bold">Hora de Fim</label>
        <input type="time" class="form-control no-border" id="inputEndTime" name="hora_fim" value="{{ $campo->hora_fim }}" style="background-color: white; color: black;" required>
    </div>
    <div class="form-group">
        <label for="inputObservation" class="black-label font-weight-bold">Observação</label>
        <input type="text" class="form-control no-border" id="inputObservation" name="observacao" value="{{ $campo->observacao }}" style="background-color: white; color: black;" placeholder="Observação">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar dados</button>
</form>
