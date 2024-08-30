<?php

global $wpdb;

$atendimentos = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pronto_psi_atendimentos");

echo '<h2>' . __('Gerenciamento de Atendimentos', 'pronto-psi') . '</h2>';
echo '<table>';
echo '<tr><th>Data</th><th>Horário Início</th><th>Horário Término</th><th>Tipo de Atendimento</th><th>Duração</th></tr>';

foreach ($atendimentos as $atendimento) {
    echo '<tr>';
    echo '<td>' . esc_html($atendimento->data_atendimento) . '</td>';
    echo '<td>' . esc_html($atendimento->horario_inicio) . '</td>';
    echo '<td>' . esc_html($atendimento->horario_termino) . '</td>';
    echo '<td>' . esc_html($atendimento->tipo_atendimento) . '</td>';
    echo '<td>' . esc_html($atendimento->duracao_atendimento) . '</td>';
    echo '</tr>';
}

echo '</table>';
