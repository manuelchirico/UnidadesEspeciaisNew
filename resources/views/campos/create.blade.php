<div class="container" style="margin-top: 10px;">
    <h4 class="text-center mb-4">Registrar Evento</h4>

    <form method="POST" action="{{ url('/campos') }}">
        @csrf
        <div class="form-group">
            <label for="inputDate" class="black-label font-weight-bold">Data Evento</label>
            <input type="date" class="form-control no-border custom-date-input" id="inputDate" name="data_evento" required>
        </div>
        
        <div class="form-group">
            <label for="inputInstitution" class="black-label font-weight-bold">Nome da Instituição</label>
            <input type="text" class="form-control no-border" id="inputInstitution" name="nome_instituicao" placeholder="Nome da Instituição" required>
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
            <input type="text" class="form-control no-border" id="inputObservation" name="observacao" placeholder="Observação">
        </div>
        
        <div class="d-flex justify-content-between">
            <!-- Botão Registrar -->
            <button type="submit" class="btn btn-primary">Registrar Entrada</button>
            
            <!-- Botão Fechar personalizado -->
            
        </div>
    </form>
</div>
