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
                <!-- Campos adicionais para o financeiro -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Financeiro', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>
