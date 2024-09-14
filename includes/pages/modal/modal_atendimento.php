<!-- Modal de Adicionar Atendimento -->
<div class="modal fade" id="modalAtendimento" tabindex="-1" role="dialog" aria-labelledby="modalAtendimentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAtendimentoLabel"><?php _e('Paciente: ', 'pronto-psi'); ?>
                <span id="modal-paciente-id" class="paciente-id">
                </span> <p class="modal-title"  id="modal-paciente-nome"></p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAdicionarAtendimento">
                <div class="modal-body">

                    <!-- Exibição do ID do Paciente e título aprimorado -->

                    <h5 class="atendimento-title"><?php _e('Adicionar Atendimento', 'pronto-psi'); ?></h5>


                    <input type="hidden" id="paciente-id-hidden" name="prontuario_id" />


                    <!-- Campos do atendimento -->
                    <div class="form-group">
                        <label for="data_atendimento"><?php _e('Data do Atendimento', 'pronto-psi'); ?></label>
                        <input type="date" id="data_atendimento" name="data_atendimento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_inicio"><?php _e('Horário de Início', 'pronto-psi'); ?></label>
                        <input type="time" id="horario_inicio" name="horario_inicio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_termino"><?php _e('Horário de Término', 'pronto-psi'); ?></label>
                        <input type="time" id="horario_termino" name="horario_termino" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_atendimento"><?php _e('Tipo de Atendimento', 'pronto-psi'); ?></label>
                        <input type="text" id="tipo_atendimento" name="tipo_atendimento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="resumo_atendimento"><?php _e('Resumo do Atendimento', 'pronto-psi'); ?></label>
                        <textarea id="resumo_atendimento" name="resumo_atendimento" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="observacoes"><?php _e('Observações', 'pronto-psi'); ?></label>
                        <textarea id="observacoes" name="observacoes" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pontos_pos_e_melhorias"><?php _e('Pontos Positivos e Melhorias', 'pronto-psi'); ?></label>
                        <textarea id="pontos_pos_e_melhorias" name="pontos_pos_e_melhorias" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reacoes_respostas"><?php _e('Reações e Respostas', 'pronto-psi'); ?></label>
                        <textarea id="reacoes_respostas" name="reacoes_respostas" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php _e('Salvar Atendimento', 'pronto-psi'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
