

<div class="container" style="margin-top: 10px;">
    <!-- Cabeçalho do Formulário -->
    <h4 class="text-center mb-4">Registrar Evento</h4>

    <!-- Formulário -->
    <form method="POST" action="{{ url('/campos') }}">
        @csrf
        <div class="form-group">
            <label for="inputDate" class="black-label font-weight-bold">Data Evento</label>
            <input type="date" class="form-control no-border custom-date-input" id="inputDate" name="data_evento" required>
        </div>
        
        <div class="form-group">
            <label for="inputInstitution" class="black-label font-weight-bold">Nome da Instituição</label>
            <input type="text" class="form-control no-border" id="inputInstitution" name="nome_instituicao" style="background-color: white; color: black;" placeholder="Nome da Instituição" required>
        </div>
        
        <div class="form-group">
            <label for="inputStartTime" class="black-label font-weight-bold">Hora de Início</label>
            <input type="time" class="form-control no-border custom-time-input" id="inputStartTime" name="hora_inicio" required>
        </div>
        
        <div class="form-group">
            <label for="inputEndTime" class="black-label font-weight-bold">Hora de Fim</label>
            <input type="time" class="form-control no-border custom-time-input" id="inputEndTime" name="hora_fim" required>
        </div>
        
        <div class="form-group">
            <label for="inputObservation" class="black-label font-weight-bold">Observação</label>
            <input type="text" class="form-control no-border" id="inputObservation" name="observacao" style="background-color: white; color: black;" placeholder="Observação">
        </div>
        
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" required>
            <label class="form-check-label black-label font-weight-bold" for="gridCheck">
                Concordo com os termos e condições
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Registrar Entrada</button>
    </form>
</div>
