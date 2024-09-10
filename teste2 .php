<!-- Modal de Adicionar Atendimento -->
<div class="modal fade" id="modalAtendimento" tabindex="-1" role="dialog" aria-labelledby="modalAtendimentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAtendimentoLabel"><?php _e('Adicionar Atendimento', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-paciente-id"></span></p>
                <!-- Aqui você pode adicionar mais campos para capturar dados do atendimento -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Atendimento', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Aba Atendimentos -->
<div class="tab-pane fade show active" id="atendimentos" role="tabpanel" aria-labelledby="atendimentos-tab">
            <h4 class="tab-title"><?php _e('Atendimentos', 'pronto-psi'); ?></h4>
            <button class="btn btn-primary" id="btn-adicionar-atendimento"><?php _e('Adicionar Atendimento', 'pronto-psi'); ?></button>


        </div>

        <script>
jQuery(document).ready(function($) {
    // Submissão do formulário ao mudar o paciente
    $('#select_paciente').on('change', function() {
        $('#paciente-form').submit();
    });

    // Função para adicionar atendimento
    $('#btn-adicionar-atendimento').click(function() {
        var pacienteId = $('#select_paciente').val(); // Recupera o ID do paciente selecionado
        var pacienteNome = $('#select_paciente option:selected').text(); // Recupera o nome do paciente selecionado

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Define os valores no modal
        $('#modal-paciente-id').text(pacienteId);
        $('#modal-paciente-nome').text(pacienteNome);

        // Exibe o modal
        $('#modalAtendimento').modal('show');
    });
  });
</script>
