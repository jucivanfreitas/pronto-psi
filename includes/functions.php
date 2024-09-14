<?php
// includes/functions.php

/**
 * Cria ou atualiza as tabelas necessárias no banco de dados.
 */
function pronto_psi_update_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // Tabela para informações dos clientes
    $table_name = $wpdb->prefix . 'pronto_psi_clientes';
    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        bookly_user_id BIGINT(20) UNSIGNED NOT NULL,  /* ID do cliente da tabela wp_bookly_customers */
        full_name VARCHAR(128) NOT NULL,
        genero VARCHAR(20) DEFAULT NULL,
        estado_civil VARCHAR(20) DEFAULT NULL,
        cpf VARCHAR(14) NOT NULL,
        cartao_sus VARCHAR(20) DEFAULT NULL,
        responsavel_financeiro VARCHAR(128) DEFAULT NULL,
        plano_saude VARCHAR(128) DEFAULT NULL,
        motivo_consulta TEXT DEFAULT NULL,
        sintomas_rel TEXT DEFAULT NULL,
        diagnostico TEXT DEFAULT NULL,
        tratamento_anterior TEXT DEFAULT NULL,
        medicacoes_uso TEXT DEFAULT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY bookly_user_id (bookly_user_id),
        CONSTRAINT fk_bookly_user_id FOREIGN KEY (bookly_user_id) REFERENCES {$wpdb->prefix}bookly_customers(id)
            ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB $charset_collate;";

    // Tabela para dados de atendimentos
    $table_name = $wpdb->prefix . 'pronto_psi_atendimentos';
    $sql .= "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        prontuario_id INT(11) NOT NULL,
        data_atendimento DATE NOT NULL,
        horario_inicio TIME NOT NULL,
        horario_termino TIME NOT NULL,
        tipo_atendimento VARCHAR(20) NOT NULL,
        duracao_atendimento TIME NOT NULL,
        resumo_atendimento TEXT DEFAULT NULL,
        observacoes TEXT DEFAULT NULL,
        pontos_pos_e_melhorias TEXT DEFAULT NULL,
        reacoes_respostas TEXT DEFAULT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (prontuario_id) REFERENCES {$wpdb->prefix}pronto_psi_clientes(id)
            ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB $charset_collate;";

    // Tabela para encaminhamentos
    $table_name = $wpdb->prefix . 'pronto_psi_encaminhamentos';
    $sql .= "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        atendimento_id INT(11) NOT NULL,
        tipo_encaminhamento VARCHAR(128) NOT NULL,
        data_encaminhamento DATE NOT NULL,
        profissional VARCHAR(128) NOT NULL,
        motivo_encaminhamento TEXT DEFAULT NULL,
        status_encaminhamento VARCHAR(20) DEFAULT NULL,
        observacoes TEXT DEFAULT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (atendimento_id) REFERENCES {$wpdb->prefix}pronto_psi_atendimentos(id)
            ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB $charset_collate;";

add_action('after_setup_theme', 'pronto_psi_update_tables');

/**
 * Enfileira o jQuery e define o ajaxurl no JavaScript
 */
function pronto_psi_enqueue_scripts() {
    wp_enqueue_script('jquery');
    ?>
    <script type="text/javascript">
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php
}
add_action('wp_enqueue_scripts', 'pronto_psi_enqueue_scripts');

?>
