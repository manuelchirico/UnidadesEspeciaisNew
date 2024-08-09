<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Pagamento e Atualizacao</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('residencia.entradas.update', $reserva->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nome_ocupante">Nome do Ocupante</label>
                        <input type="text" class="form-control" id="nome_ocupante" name="nome_ocupante" value="{{ $reserva->nome_ocupante }}" required>
                    </div>
                    <div class="form-group">
                        <label for="casa_a_ocupar">Casa a Ocupar</label>
                        <select class="form-control" id="casa_a_ocupar" name="casa_a_ocupar" required>
                            <option value="Casa de Hospede" {{ $reserva->casa_a_ocupar == 'Casa de Hospede' ? 'selected' : '' }}>Casa de Hospede</option>
                            <option value="Suite" {{ $reserva->casa_a_ocupar == 'Suite' ? 'selected' : '' }}>Suite</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_entrada">Data de Entrada</label>
                        <input type="date" class="form-control" id="data_entrada" name="data_entrada" value="{{ $reserva->data_entrada }}" required>
                    </div>
                    <div class="form-group">
                        <label for="data_saida">Data de Saída</label>
                        <input type="date" class="form-control" id="data_saida" name="data_saida" value="{{ $reserva->data_saida }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contacto">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contacto" value="{{ $reserva->contacto }}" required>
                    </div>
                    <div class="form-group">
                        <label for="pagamento">Pagamento</label>
                        <select class="form-control" id="pagamento" name="pagamento" required>
                            <option value="pendente" {{ $reserva->pagamento == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="pago" {{ $reserva->pagamento == 'pago' ? 'selected' : '' }}>Pago</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-update"></i> Atualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
