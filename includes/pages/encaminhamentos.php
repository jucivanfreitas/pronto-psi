<?php

global $wpdb;

$encaminhamentos = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pronto_psi_encaminhamentos");

echo '<h2>' . __('Gerenciamento de Encaminhamentos', 'pronto-psi') . '</h2>';
echo '<table>';
echo '<tr><th>Data</th><th>Tipo</th><th>Profissional</th><th>Status</th></tr>';

foreach ($encaminhamentos as $encaminhamento) {
    echo '<tr>';
    echo '<td>' . esc_html($encaminhamento->data_encaminhamento) . '</td>';
    echo '<td>' . esc_html($encaminhamento->tipo_encaminhamento) . '</td>';
    echo '<td>' . esc_html($encaminhamento->profissional) . '</td>';
    echo '<td>' . esc_html($encaminhamento->status_encaminhamento) . '</td>';
    echo '</tr>';
}

echo '</table>';
