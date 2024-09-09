<?php
// includes/pages/widgets/exibe_paciente.php

global $wpdb;

// Recupera o ID do paciente selecionado através do formulário
$paciente_id = isset($_POST['paciente_id']) ? sanitize_text_field($_POST['paciente_id']) : null;

// Busca as informações do paciente na tabela, se houver um ID válido
$paciente_info = null;
if ($paciente_id) {
    $paciente_info = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pronto_psi_clientes WHERE id = %d", $paciente_id));
}

// Verifica se o paciente foi encontrado
if ($paciente_info) {
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
} else {
    echo '<p>' . __('Nenhum paciente selecionado ou paciente não encontrado.', 'pronto-psi') . '</p>';
}

// Função para buscar e retornar as informações do paciente via AJAX
function fetch_paciente_info() {
    global $wpdb;

    // Recebe o ID do paciente via POST
    $paciente_id = isset($_POST['paciente_id']) ? intval($_POST['paciente_id']) : 0;

    if ($paciente_id) {
        // Busca as informações do paciente no banco de dados
        $paciente_info = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pronto_psi_clientes WHERE id = %d", $paciente_id));

        if ($paciente_info) {
            // Renderiza as informações do paciente (pode usar a mesma lógica de exibe_paciente.php)
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
        } else {
            echo '<p>' . __('Paciente não encontrado.', 'pronto-psi') . '</p>';
        }
    } else {
        echo '<p>' . __('ID do paciente inválido.', 'pronto-psi') . '</p>';
    }

    // Termina o script para evitar o retorno de dados desnecessários
    wp_die();
}

// Hook para tratar a requisição AJAX
add_action('wp_ajax_fetch_paciente_info', 'fetch_paciente_info');
add_action('wp_ajax_nopriv_fetch_paciente_info', 'fetch_paciente_info');
?>