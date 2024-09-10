<!-- Modal de Adicionar Financeiro -->
<div class="modal fade" id="modalFinanceiro" tabindex="-1" role="dialog" aria-labelledby="modalFinanceiroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFinanceiroLabel"><?php _e('Adicionar Financeiro', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-financeiro-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-financeiro-paciente-id"></span></p>
                <!-- Campos adicionais para o financeiro
                -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Financeiro', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="financeiro" role="tabpanel" aria-labelledby="financeiro-tab">
            <h4 class="tab-title"><?php _e('Financeiro', 'pronto-psi'); ?></h4>
            <button class="btn btn-primary" id="btn-adicionar-financeiro"><?php _e('Adicionar Financeiro', 'pronto-psi'); ?></button>


        </div>

        <script>
jQuery(document).ready(function($) {
    // Submissão do formulário ao mudar o paciente
    $('#select_paciente').on('change', function() {
        $('#paciente-form').submit();
    });

    // Função para adicionar financeiro
    $('#btn-adicionar-financeiro').click(function() {
        var pacienteId = $('#select_paciente').val(); // Recupera o ID do paciente selecionado
        var pacienteNome = $('#select_paciente option:selected').text(); // Recupera o nome do paciente selecionado

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Define os valores no modal
        $('#modal-financeiro-paciente-nome').text(pacienteId);
        $('#modal-financeiro-paciente-nome').text(pacienteNome);

        // Exibe o modal
        $('#modalFinanceiro').modal('show');
    });
