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

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('plugins_loaded', 'pronto_psi_update_tables');

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

add_action('wp_ajax_salvar_evolucao', 'salvar_evolucao');
add_action('wp_ajax_nopriv_salvar_evolucao', 'salvar_evolucao'); // Caso precise que usuários não logados também possam acessar

function salvar_evolucao() {
    global $wpdb;

    // Verifique se os campos obrigatórios estão presentes
    if (!isset($_POST['dados_evolucao']) || !isset($_POST['prontuario_id'])) {
        wp_send_json_error('Dados obrigatórios de evolução não foram fornecidos.');
        return;
    }

    // Sanitização dos campos do formulário
    $dados_evolucao = sanitize_text_field($_POST['dados_evolucao']);
    $prontuario_id = sanitize_text_field($_POST['prontuario_id']);
    $data_atendimento = sanitize_text_field($_POST['data_atendimento']);
    $horario_inicio = sanitize_text_field($_POST['horario_inicio']);
    $horario_termino = sanitize_text_field($_POST['horario_termino']);
    $tipo_atendimento = sanitize_text_field($_POST['tipo_atendimento']);
    $observacoes = sanitize_text_field($_POST['observacoes']);
    $pontos_pos_e_melhorias = sanitize_text_field($_POST['pontos_pos_e_melhorias']);
    $reacoes_respostas = sanitize_text_field($_POST['reacoes_respostas']);
    $resumo_atendimento = sanitize_text_field($_POST['resumo_atendimento']); // Adicionar a coleta deste campo

    // Calcula a duração do atendimento
    $inicio = DateTime::createFromFormat('H:i', $horario_inicio);
    $termino = DateTime::createFromFormat('H:i', $horario_termino);
    if ($inicio && $termino) {
        $duracao_atendimento = $inicio->diff($termino)->format('%H:%I');
    } else {
        wp_send_json_error('Horário de início ou término inválido.');
        return;
    }

    // Validação adicional (se necessário)
    // Validação adicional (exibir qual campo está faltando)
if (empty($dados_evolucao)) {
    wp_send_json_error('O campo "Evolução" é obrigatório.');
    return;
}

if (empty($prontuario_id)) {
    wp_send_json_error('O campo "Prontuário ID" é obrigatório.');
    return;
}

if (empty($data_atendimento)) {
    wp_send_json_error('O campo "Data do Atendimento" é obrigatório.');
    return;
}

if (empty($horario_inicio)) {
    wp_send_json_error('O campo "Horário de Início" é obrigatório.');
    return;
}

if (empty($horario_termino)) {
    wp_send_json_error('O campo "Horário de Término" é obrigatório.');
    return;
}

if (empty($tipo_atendimento)) {
    wp_send_json_error('O campo "Tipo de Atendimento" é obrigatório.');
    return;
}


    // Inserção no banco de dados
    $result = $wpdb->insert(
        $wpdb->prefix . 'pronto_psi_atendimentos',
        array(
            'prontuario_id' => $prontuario_id,
            'data_atendimento' => $data_atendimento,
            'horario_inicio' => $horario_inicio,
            'horario_termino' => $horario_termino,
            'tipo_atendimento' => $tipo_atendimento,
            'duracao_atendimento' => $duracao_atendimento,
            'resumo_atendimento' => $resumo_atendimento, // Garantindo que o campo está sendo utilizado
            'observacoes' => $observacoes,
            'pontos_pos_e_melhorias' => $pontos_pos_e_melhorias,
            'reacoes_respostas' => $reacoes_respostas
        )
    );

    if ($result) {
        wp_send_json_success('Evolução salva com sucesso.');
    } else {
        error_log('Erro ao salvar evolução: ' . $wpdb->last_error); // Registrar o erro no log para depuração
        wp_send_json_error('Erro ao salvar a evolução.');
    }

    wp_die(); // Finaliza a execução do script
}



?>
