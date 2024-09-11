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
