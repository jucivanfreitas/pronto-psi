

<?php
// includes\pages\modal\functions_modal_atendimento.php
add_action('wp_ajax_salvar_atendimento', 'salvar_atendimento');
function salvar_atendimento() {
    global $wpdb;

    // Verifica se os dados foram enviados corretamente
    if (!isset($_POST['formData'])) {
        wp_send_json_error(array('message' => 'Dados não enviados corretamente.'));
        wp_die();
    }

    // Converte os dados do formulário em um array
    parse_str($_POST['formData'], $dados_atendimento);

    // Captura os valores do array
    $paciente_id = intval($dados_atendimento['prontuario_id']);
    $data_atendimento = sanitize_text_field($dados_atendimento['data_atendimento']);
    $horario_inicio = sanitize_text_field($dados_atendimento['horario_inicio']);
    $horario_termino = sanitize_text_field($dados_atendimento['horario_termino']);
    $tipo_atendimento = sanitize_text_field($dados_atendimento['tipo_atendimento']);
    $resumo_atendimento = sanitize_textarea_field($dados_atendimento['resumo_atendimento']);
    $observacoes = sanitize_textarea_field($dados_atendimento['observacoes']);
    $pontos_melhorias = sanitize_textarea_field($dados_atendimento['pontos_pos_e_melhorias']);
    $reacoes_respostas = sanitize_textarea_field($dados_atendimento['reacoes_respostas']);

    // Insere os dados no banco de dados
    $tabela_atendimentos = $wpdb->prefix . 'pronto_psi_atendimentos';
    $dados_insercao = array(
        'prontuario_id' => $paciente_id,
        'data_atendimento' => $data_atendimento,
        'horario_inicio' => $horario_inicio,
        'horario_termino' => $horario_termino,
        'tipo_atendimento' => $tipo_atendimento,
        'resumo_atendimento' => $resumo_atendimento,
        'observacoes' => $observacoes,
        'pontos_pos_e_melhorias' => $pontos_melhorias,
        'reacoes_respostas' => $reacoes_respostas,
    );

    $result = $wpdb->insert($tabela_atendimentos, $dados_insercao);

    if ($result) {
        wp_send_json_success(array('message' => __('Atendimento salvo com sucesso.', 'pronto-psi')));
    } else {
        wp_send_json_error(array('message' => __('Erro ao salvar o atendimento.', 'pronto-psi')));
    }

    wp_die(); // Finaliza a execução do AJAX
}
?>
