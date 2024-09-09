<?php
// includes/pages/widgets/functions_widgets.php

// Função AJAX para buscar informações do paciente
function fetch_paciente_info() {
    // Verifica se o usuário tem permissões necessárias
    if (!isset($_POST['paciente_id'])) {
        wp_send_json_error(__('ID do paciente inválido.', 'pronto-psi'));
    }

    $paciente_id = intval($_POST['paciente_id']);
    $paciente_info = fetch_patient_info($paciente_id);

    if ($paciente_info) {
        ob_start();
        display_patient_info($paciente_info);
        $html = ob_get_clean();
        wp_send_json_success($html);
    } else {
        wp_send_json_error(__('Paciente não encontrado.', 'pronto-psi'));
    }
}

add_action('wp_ajax_fetch_paciente_info', 'fetch_paciente_info');
add_action('wp_ajax_nopriv_fetch_paciente_info', 'fetch_paciente_info');
?>
