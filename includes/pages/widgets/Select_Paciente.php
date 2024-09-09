<?php
// includes/pages/widgets/Select_Paciente.php

global $wpdb;

// Recupera a lista de pacientes da tabela pronto_psi_clientes
$pacientes = $wpdb->get_results("SELECT id, full_name FROM {$wpdb->prefix}pronto_psi_clientes");

// Verificação de erros
if (empty($pacientes)) {
    echo '<p>' . __('Nenhum paciente encontrado.', 'pronto-psi') . '</p>';
}

// Função para renderizar o widget de seleção de paciente
function render_select_paciente_widget($pacientes, $selected_paciente_id = null) {
    echo '<div class="form-group">';
    echo '<label for="select_paciente">' . __('Selecionar Paciente', 'pronto-psi') . '</label>';
    echo '<select id="select_paciente" class="form-control" name="paciente_id" required>';
    echo '<option value="">' . __('Selecione um paciente', 'pronto-psi') . '</option>';

    foreach ($pacientes as $paciente) {
        // Verifica se há um paciente pré-selecionado
        $selected = ($selected_paciente_id == $paciente->id) ? 'selected' : '';
        echo '<option value="' . esc_attr($paciente->id) . '" ' . $selected . '>' . esc_html($paciente->full_name) . '</option>';
    }

    echo '</select>';
    echo '</div>';
}

// Renderiza o widget com o paciente selecionado (se houver)
render_select_paciente_widget($pacientes);
?>
