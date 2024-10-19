<?php
// includes\pages\widgets\functions_widgets.php

// Função para buscar e retornar as informações do paciente via AJAX
function fetch_paciente_info() {
    global $wpdb;

    // Verifica a segurança da requisição AJAX
    check_ajax_referer('fetch_paciente_info_nonce', 'security');

    // Recebe o ID do paciente via POST
    $paciente_id = isset($_POST['paciente_id']) ? intval($_POST['paciente_id']) : 0;

    if ($paciente_id) {
        // Busca as informações do paciente no banco de dados
        $paciente_info = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pronto_psi_clientes WHERE id = %d", $paciente_id));

        if ($paciente_info) {
            // Renderiza as informações do paciente (mesmo conteúdo de exibe_paciente.php)
            ob_start();
            echo '<div class="patient-info">';
            echo '<p><strong>' . __('Nome Completo:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->full_name) . '</p>';
            echo '<p><strong>' . __('Gênero:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->genero) . '</p>';
            echo '<p><strong>' . __('Estado Civil:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->estado_civil) . '</p>';
            echo '<p><strong>' . __('CPF:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->cpf) . '</p>';
            echo '<p><strong>' . __('Cartão SUS:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->cartao_sus) . '</p>';
            echo '<p><strong>' . __('Responsável Financeiro:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->responsavel_financeiro) . '</p>';
            echo '<p><strong>' . __('Plano de Saúde:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->plano_saude) . '</p>';
            echo '<p><strong>' . __('Motivo da Consulta:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->motivo_consulta) . '</p>';
            echo '<p><strong>' . __('Sintomas Relatados:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->sintomas_rel) . '</p>';
            echo '<p><strong>' . __('Diagnóstico:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->diagnostico) . '</p>';
            echo '<p><strong>' . __('Tratamento Anterior:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->tratamento_anterior) . '</p>';
            echo '<p><strong>' . __('Medicações em Uso:', 'pronto-psi') . '</strong> ' . esc_html($paciente_info->medicacoes_uso) . '</p>';
            echo '</div>';
            $html = ob_get_clean();
            wp_send_json_success($html);
        } else {
            wp_send_json_error(__('Paciente não encontrado.', 'pronto-psi'));
        }
    } else {
        wp_send_json_error(__('ID do paciente inválido.', 'pronto-psi'));
    }

    // Termina o script para evitar o retorno de dados desnecessários
    wp_die();
}

// Hook para tratar a requisição AJAX
add_action('wp_ajax_fetch_paciente_info', 'fetch_paciente_info');
add_action('wp_ajax_nopriv_fetch_paciente_info', 'fetch_paciente_info');


function salvar_novo_atendimento() {
    global $wpdb;

    $prontuario_id = intval($_POST['prontuario_id']);
    $data_atendimento = sanitize_text_field($_POST['data_atendimento']);
    $horario_inicio = sanitize_text_field($_POST['horario_inicio']);
    $horario_termino = sanitize_text_field($_POST['horario_termino']);
    $tipo_atendimento = sanitize_text_field($_POST['tipo_atendimento']);
    $resumo_atendimento = sanitize_textarea_field($_POST['resumo_atendimento']);
    $observacoes = sanitize_textarea_field($_POST['observacoes']);
    $pontos_pos_e_melhorias = sanitize_textarea_field($_POST['pontos_pos_e_melhorias']);
    $reacoes_respostas = sanitize_textarea_field($_POST['reacoes_respostas']);

    // Inserindo os dados na tabela
    $wpdb->insert(
        "{$wpdb->prefix}pronto_psi_atendimentos",
        array(
            'prontuario_id' => $prontuario_id,
            'data_atendimento' => $data_atendimento,
            'horario_inicio' => $horario_inicio,
            'horario_termino' => $horario_termino,
            'tipo_atendimento' => $tipo_atendimento,
            'resumo_atendimento' => $resumo_atendimento,
            'observacoes' => $observacoes,
            'pontos_pos_e_melhorias' => $pontos_pos_e_melhorias,
            'reacoes_respostas' => $reacoes_respostas,
        )
    );

    if ($wpdb->insert_id) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_salvar_novo_atendimento', 'salvar_novo_atendimento');

?>
