<?php
// Função para renderizar o formulário de atendimento clínico
function render_novo_atendimento_form($paciente_id) {
    ?>
    <form id="novoAtendimentoForm">
        <input type="hidden" name="prontuario_id" value="<?php echo esc_attr($paciente_id); ?>">

        <div class="form-group">
            <label for="data_atendimento"><?php _e('Data do Atendimento', 'pronto-psi'); ?></label>
            <input type="date" class="form-control" name="data_atendimento" required>
        </div>

        <div class="form-group">
            <label for="horario_inicio"><?php _e('Horário de Início', 'pronto-psi'); ?></label>
            <input type="time" class="form-control" name="horario_inicio" required>
        </div>

        <div class="form-group">
            <label for="horario_termino"><?php _e('Horário de Término', 'pronto-psi'); ?></label>
            <input type="time" class="form-control" name="horario_termino" required>
        </div>

        <div class="form-group">
            <label for="tipo_atendimento"><?php _e('Tipo de Atendimento', 'pronto-psi'); ?></label>
            <input type="text" class="form-control" name="tipo_atendimento" required>
        </div>

        <div class="form-group">
            <label for="resumo_atendimento"><?php _e('Resumo do Atendimento', 'pronto-psi'); ?></label>
            <textarea class="form-control" name="resumo_atendimento"></textarea>
        </div>

        <div class="form-group">
            <label for="observacoes"><?php _e('Observações', 'pronto-psi'); ?></label>
            <textarea class="form-control" name="observacoes"></textarea>
        </div>

        <div class="form-group">
            <label for="pontos_pos_e_melhorias"><?php _e('Pontos Positivos e Melhorias', 'pronto-psi'); ?></label>
            <textarea class="form-control" name="pontos_pos_e_melhorias"></textarea>
        </div>

        <div class="form-group">
            <label for="reacoes_respostas"><?php _e('Reações e Respostas', 'pronto-psi'); ?></label>
            <textarea class="form-control" name="reacoes_respostas"></textarea>
        </div>

        <button type="submit" class="btn btn-primary"><?php _e('Salvar Atendimento', 'pronto-psi'); ?></button>
    </form>
    <?php
}
?>
