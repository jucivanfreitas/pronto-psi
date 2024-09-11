<!-- Modal de Adicionar Evolução -->
<div class="modal fade" id="modalEvolucao" tabindex="-1" role="dialog" aria-labelledby="modalEvolucaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvolucaoLabel"><?php _e('Adicionar Evolução', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-evol-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-evol-paciente-id"></span></p>
                <!-- Aqui você pode adicionar mais campos relacionados à evolução -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Evolução', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>
