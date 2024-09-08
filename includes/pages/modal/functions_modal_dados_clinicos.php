<?php
// includes\pages\modal\functions_modal_dados_clinicos.php

/**
 * Verifica a versão do plug-in e atualiza o banco de dados se necessário.
 *
 */


// Se a ação puder ser executada por usuários não autenticados

function pronto_psi_check_version() {
    $current_version = get_option('pronto_psi_version');

    if ($current_version !== PRONTO_PSI_VERSION) {
        pronto_psi_update_tables();
        update_option('pronto_psi_version', PRONTO_PSI_VERSION);
    }
}

// Aciona a verificação de versão ao inicializar o plug-in
add_action('plugins_loaded', 'pronto_psi_check_version');


// Função para salvar os dados do formulário
function update_cliente_data() {
    // Verifica se todos os dados foram enviados corretamente
    if (!isset($_POST['cliente_id'])) {
        wp_send_json_error('ID do cliente não encontrado.');
    }

    // Sanitiza e valida os campos recebidos do formulário
    $cliente_id = intval($_POST['cliente_id']);
    $genero = sanitize_text_field($_POST['genero']);
    $estado_civil = sanitize_text_field($_POST['estado_civil']);
    $cpf = sanitize_text_field($_POST['cpf']);
    $cartao_sus = sanitize_text_field($_POST['cartao_sus']);
    $responsavel_financeiro = sanitize_text_field($_POST['responsavel_financeiro']);
    $plano_saude = sanitize_text_field($_POST['plano_saude']);
    $motivo_consulta = sanitize_textarea_field($_POST['motivo_consulta']);
    $sintomas_rel = sanitize_textarea_field($_POST['sintomas_rel']);
    $diagnostico = sanitize_textarea_field($_POST['diagnostico']);
    $tratamento_anterior = sanitize_textarea_field($_POST['tratamento_anterior']);
    $medicacoes_uso = sanitize_textarea_field($_POST['medicacoes_uso']);

    global $wpdb;
    $table_name = $wpdb->prefix . 'pronto_psi_clientes'; // Ajuste o nome da tabela conforme necessário

    // Atualiza os dados do cliente na tabela
    $update = $wpdb->update(
        $table_name,
        array(
            'genero' => $genero,
            'estado_civil' => $estado_civil,
            'cpf' => $cpf,
            'cartao_sus' => $cartao_sus,
            'responsavel_financeiro' => $responsavel_financeiro,
            'plano_saude' => $plano_saude,
            'motivo_consulta' => $motivo_consulta,
            'sintomas_rel' => $sintomas_rel,
            'diagnostico' => $diagnostico,
            'tratamento_anterior' => $tratamento_anterior,
            'medicacoes_uso' => $medicacoes_uso,
        ),
        array('id' => $cliente_id),
        array(
            '%s', '%s', '%s', '%s', '%s', '%s',
            '%s', '%s', '%s', '%s', '%s'
        ),
        array('%d')
    );

    // Verifica se a atualização foi bem-sucedida
    if ($update !== false) {
        wp_send_json_success('Dados salvos com sucesso.');
    } else {
        wp_send_json_error('Erro ao salvar os dados.');
    }
}


add_action('wp_ajax_update_cliente_data', 'update_cliente_data');
add_action('wp_ajax_nopriv_update_cliente_data', 'update_cliente_data');

add_action('wp_ajax_get_cliente_data', 'get_cliente_data_handler');
add_action('wp_ajax_nopriv_get_cliente_data', 'get_cliente_data_handler');

function get_cliente_data_handler() {
    // Certifique-se de que o ID do cliente foi passado corretamente
    if (!isset($_POST['cliente_id'])) {
        wp_send_json_error('ID do cliente não fornecido.');
    }

    global $wpdb;
    $cliente_id = intval($_POST['cliente_id']);

    // Consulta os dados do cliente
    $cliente = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}pronto_psi_clientes WHERE id = %d",
        $cliente_id
    ));

    if ($cliente) {
        // Retorna os dados do cliente
        wp_send_json_success($cliente);
    } else {
        // Erro se não encontrar o cliente
        wp_send_json_error('Cliente não encontrado.');
    }
}


?>
