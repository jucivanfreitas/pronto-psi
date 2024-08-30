<?php
function pronto_psi_prontuario_page() {
    global $wpdb;

    // Lógica para listar, adicionar, editar prontuários
    // Exemplo de consulta para listar os prontuários:
    $prontuarios = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pronto_psi_prontuarios");

    echo '<h2>Prontuários</h2>';
    echo '<table>';
    echo '<tr><th>Nome Completo</th><th>CPF</th><th>Plano de Saúde</th><th>Ações</th></tr>';
    foreach ($prontuarios as $prontuario) {
        $customer_name = $wpdb->get_var("SELECT full_name FROM {$wpdb->prefix}bookly_customers WHERE id = {$prontuario->customer_id}");
        echo "<tr>
                <td>{$customer_name}</td>
                <td>{$prontuario->cpf}</td>
                <td>{$prontuario->plano_saude}</td>
                <td><a href='#'>Editar</a> | <a href='#'>Excluir</a></td>
              </tr>";
    }
    echo '</table>';
}
