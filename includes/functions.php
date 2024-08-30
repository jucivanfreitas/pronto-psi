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
        bookly_user_id BIGINT(20) NOT NULL UNIQUE,  /* ID do cliente da tabela wp_bookly_customers */
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
        PRIMARY KEY  (id)
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
        PRIMARY KEY  (id),
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
        PRIMARY KEY  (id),
        FOREIGN KEY (atendimento_id) REFERENCES {$wpdb->prefix}pronto_psi_atendimentos(id)
            ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB $charset_collate;";

    // Executa o SQL para criar ou atualizar as tabelas no banco de dados
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

/**
 * Verifica a versão do plug-in e atualiza o banco de dados se necessário.
 */
function pronto_psi_check_version() {
    $current_version = get_option('pronto_psi_version');

    if ($current_version !== PRONTO_PSI_VERSION) {
        pronto_psi_update_tables();
        update_option('pronto_psi_version', PRONTO_PSI_VERSION);
    }
}

// Aciona a verificação de versão ao inicializar o plug-in
add_action('plugins_loaded', 'pronto_psi_check_version');



?>
