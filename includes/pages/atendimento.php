<?php
// includes/pages/atendimento.php

global $wpdb;

// Verifica se o formulário foi submetido com a seleção do paciente
$paciente_id = isset($_POST['paciente_id']) ? sanitize_text_field($_POST['paciente_id']) : null;

// Busca as informações do paciente selecionado, se houver um ID válido
$paciente_info = null;
if ($paciente_id) {
    $paciente_info = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pronto_psi_clientes WHERE id = %d", $paciente_id));
}

// Recupera os atendimentos para exibição
$atendimentos = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pronto_psi_atendimentos");
?>

<!-- Incluindo Bootstrap CSS e JS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Incluindo CSS personalizado -->
<link href="<?php echo plugins_url('widgets/custom-styles.css', __FILE__); ?>" rel="stylesheet">

<div class="container-fluid mt-5">
    <!-- Título da Página -->
    <div class="text-center mb-4">
        <h2 class="title-highlight"><?php _e('Gerenciamento de Atendimentos', 'pronto-psi'); ?></h2>
    </div>

    <!-- Seção de Seleção de Paciente -->
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="section-title text-center"><?php _e('Selecionar Paciente', 'pronto-psi'); ?></h3>
                <div class="widget-container p-3 border rounded shadow-sm">
                    <?php include __DIR__ . '/widgets/Select_Paciente.php'; ?>
                </div>
            </div>
                <div class="col-md-6">
                    <h3 class="section-title text-center"><?php _e('Informações do Paciente', 'pronto-psi'); ?></h3>
                    <div class="widget-container p-3 border rounded shadow-sm">
                        <?php include __DIR__ . '/widgets/exibe_paciente.php'; ?>
                    </div>
                </div>

        </div>
    </div>






    <!-- Abas Horizontais -->
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="atendimentos-tab" data-toggle="tab" href="#atendimentos" role="tab" aria-controls="atendimentos" aria-selected="true">
                <?php _e('Atendimentos', 'pronto-psi'); ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="financeiro-tab" data-toggle="tab" href="#financeiro" role="tab" aria-controls="financeiro" aria-selected="false">
                <?php _e('Financeiro', 'pronto-psi'); ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="evolucao-tab" data-toggle="tab" href="#evolucao" role="tab" aria-controls="evolucao" aria-selected="false">
                <?php _e('Evolução', 'pronto-psi'); ?>
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- Aba de Atendimentos -->
        <div class="tab-pane fade show active" id="atendimentos" role="tabpanel" aria-labelledby="atendimentos-tab">
            <div class="row mt-4">
                <?php if (!empty($paciente_info)) : ?>
                    <div class="col-md-6">
                        <h3 class="section-title"><?php _e('Informações do Paciente', 'pronto-psi'); ?></h3>
                        <div class="border p-3 bg-light rounded">
                            <p><strong><?php _e('Nome:', 'pronto-psi'); ?></strong> <?php echo esc_html($paciente_info->full_name); ?></p>
                            <p><strong><?php _e('Plano de Saúde:', 'pronto-psi'); ?></strong> <?php echo esc_html($paciente_info->plano_saude); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-5">
                <h3 class="section-title"><?php _e('Últimos Registros de Atendimento', 'pronto-psi'); ?></h3>
                <table class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th><?php _e('Data', 'pronto-psi'); ?></th>
                            <th><?php _e('Horário Início', 'pronto-psi'); ?></th>
                            <th><?php _e('Horário Término', 'pronto-psi'); ?></th>
                            <th><?php _e('Tipo de Atendimento', 'pronto-psi'); ?></th>
                            <th><?php _e('Duração', 'pronto-psi'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($atendimentos)) : ?>
                            <?php foreach ($atendimentos as $atendimento) : ?>
                                <tr>
                                    <td><?php echo esc_html($atendimento->data_atendimento); ?></td>
                                    <td><?php echo esc_html($atendimento->horario_inicio); ?></td>
                                    <td><?php echo esc_html($atendimento->horario_termino); ?></td>
                                    <td><?php echo esc_html($atendimento->tipo_atendimento); ?></td>
                                    <td><?php echo esc_html($atendimento->duracao_atendimento); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5"><?php _e('Nenhum atendimento encontrado.', 'pronto-psi'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aba de Financeiro -->
        <div class="tab-pane fade" id="financeiro" role="tabpanel" aria-labelledby="financeiro-tab">
            <div class="container mt-4">
                <h3><?php _e('Financeiro', 'pronto-psi'); ?></h3>
                <p><?php _e('Conteúdo da seção financeira aqui.', 'pronto-psi'); ?></p>
            </div>
        </div>

        <!-- Aba de Evolução -->
        <div class="tab-pane fade" id="evolucao" role="tabpanel" aria-labelledby="evolucao-tab">
            <div class="container mt-4">
                <h3><?php _e('Evolução', 'pronto-psi'); ?></h3>
                <p><?php _e('Conteúdo da seção de evolução aqui.', 'pronto-psi'); ?></p>
            </div>
        </div>
    </div>
</div>






    <!-- Abas Horizontais -->
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="atendimentos-tab" data-toggle="tab" href="#atendimentos" role="tab" aria-controls="atendimentos" aria-selected="true">
                <?php _e('Atendimentos', 'pronto-psi'); ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="financeiro-tab" data-toggle="tab" href="#financeiro" role="tab" aria-controls="financeiro" aria-selected="false">
                <?php _e('Financeiro', 'pronto-psi'); ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="evolucao-tab" data-toggle="tab" href="#evolucao" role="tab" aria-controls="evolucao" aria-selected="false">
                <?php _e('Evolução', 'pronto-psi'); ?>
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- Aba de Atendimentos -->
        <div class="tab-pane fade show active" id="atendimentos" role="tabpanel" aria-labelledby="atendimentos-tab">
            <div class="row mt-4">
                <?php if (!empty($paciente_info)) : ?>
                    <div class="col-md-6">
                        <h3 class="section-title"><?php _e('Informações do Paciente', 'pronto-psi'); ?></h3>
                        <div class="border p-3 bg-light rounded">
                            <p><strong><?php _e('Nome:', 'pronto-psi'); ?></strong> <?php echo esc_html($paciente_info->full_name); ?></p>
                            <p><strong><?php _e('Plano de Saúde:', 'pronto-psi'); ?></strong> <?php echo esc_html($paciente_info->plano_saude); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-5">
                <h3 class="section-title"><?php _e('Últimos Registros de Atendimento', 'pronto-psi'); ?></h3>
                <table class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th><?php _e('Data', 'pronto-psi'); ?></th>
                            <th><?php _e('Horário Início', 'pronto-psi'); ?></th>
                            <th><?php _e('Horário Término', 'pronto-psi'); ?></th>
                            <th><?php _e('Tipo de Atendimento', 'pronto-psi'); ?></th>
                            <th><?php _e('Duração', 'pronto-psi'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($atendimentos)) : ?>
                            <?php foreach ($atendimentos as $atendimento) : ?>
                                <tr>
                                    <td><?php echo esc_html($atendimento->data_atendimento); ?></td>
                                    <td><?php echo esc_html($atendimento->horario_inicio); ?></td>
                                    <td><?php echo esc_html($atendimento->horario_termino); ?></td>
                                    <td><?php echo esc_html($atendimento->tipo_atendimento); ?></td>
                                    <td><?php echo esc_html($atendimento->duracao_atendimento); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5"><?php _e('Nenhum atendimento encontrado.', 'pronto-psi'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aba de Financeiro -->
        <div class="tab-pane fade" id="financeiro" role="tabpanel" aria-labelledby="financeiro-tab">
            <div class="container mt-4">
                <h3><?php _e('Financeiro', 'pronto-psi'); ?></h3>
                <p><?php _e('Conteúdo da seção financeira aqui.', 'pronto-psi'); ?></p>
            </div>
        </div>

        <!-- Aba de Evolução -->
        <div class="tab-pane fade" id="evolucao" role="tabpanel" aria-labelledby="evolucao-tab">
            <div class="container mt-4">
                <h3><?php _e('Evolução', 'pronto-psi'); ?></h3>
                <p><?php _e('Conteúdo da seção de evolução aqui.', 'pronto-psi'); ?></p>
            </div>
        </div>
    </div>
</div>
