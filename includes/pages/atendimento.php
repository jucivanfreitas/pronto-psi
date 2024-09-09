<?php
// includes/pages/atendimento.php

global $wpdb;

// Função para recuperar as informações do paciente
function get_paciente_info($paciente_id) {
    global $wpdb;
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pronto_psi_clientes WHERE id = %d", $paciente_id));
}

// Função para recuperar os atendimentos
function get_atendimentos() {
    global $wpdb;
    return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pronto_psi_atendimentos");
}

// Recupera o ID do paciente do formulário, se estiver definido
$paciente_id = isset($_POST['paciente_id']) ? sanitize_text_field($_POST['paciente_id']) : null;
$paciente_info = $paciente_id ? get_paciente_info($paciente_id) : null;
$atendimentos = get_atendimentos();
?>

<!-- Incluindo Bootstrap CSS e JS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Incluindo CSS personalizado -->
<link href="<?php echo plugins_url('widgets/custom-styles.css', __FILE__); ?>" rel="stylesheet">

<div class="container-fluid mt-5">
    <!-- Título da Página -->
    <div class="text-center mb-4">
        <h2 class="title-highlight"><?php _e('Gerenciamento de Atendimentos', 'pronto-psi'); ?></h2>
    </div>
<hr>
<!-- Seção de Seleção de Paciente -->
<div class="container-fluid mb-12">
    <div class="row justify-content-center">
        <!-- Formulário de Seleção de Paciente -->
        <div class="col-md-3 mb-6 d-flex align-items-center">

            <div class="widget-container p-3 border rounded shadow-sm w-100">

                <form id="paciente-form" method="POST" action="">
                    <?php
                    // Recupera a lista de pacientes da tabela pronto_psi_clientes
                    $pacientes = $wpdb->get_results("SELECT id, full_name FROM {$wpdb->prefix}pronto_psi_clientes");

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
                    render_select_paciente_widget($pacientes, $paciente_id);
                    ?>
                    <button type="submit" class="btn btn-primary"><?php _e('Atualizar', 'pronto-psi'); ?></button>
                </form>
            </div>
        </div>


        <!-- Informações do Paciente -->
        <div class="col-md-8 mb-4">
            <h3 class="section-title text-center"><?php _e('Informações do Paciente', 'pronto-psi'); ?></h3>
            <div class="widget-container p-4 border rounded shadow-sm bg-light">
                <?php
                // Exibe informações do paciente selecionado
                if ($paciente_info) {
                    echo '<div class="patient-info">';
                    echo '<table class="table table-bordered table-striped">';
                    echo '<tbody>';

                    echo '<tr>';
                    echo '<th>' . __('Nome Completo:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->full_name) . '</td>';

                    echo '<th>' . __('CPF:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->cpf) . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th>' . __('Gênero:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->genero) . '</td>';

                    echo '<th>' . __('Estado Civil:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->estado_civil) . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th>' . __('Plano de Saúde:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->plano_saude) . '</td>';

                    echo '<th>' . __('Cartão SUS:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->cartao_sus) . '</td>';
                    echo '</tr>';

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo __('Nenhum paciente selecionado ou paciente não encontrado.', 'pronto-psi');
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <!-- Informação Clínica -->
        <div class="col-md-11 mb-12 mx-auto ">
            <h3 class="section-title text-center"><?php _e('Informação Clínica', 'pronto-psi'); ?></h3>
            <div class="widget-container p-4 border rounded shadow-sm bg-light w-100">
                <?php
                // Exibe informações clínicas do paciente selecionado
                if ($paciente_info) {
                    echo '<div class="patient-info">';
                    echo '<table class="table table-bordered table-striped">';
                    echo '<tbody>';

                    echo '<tr>';
                    echo '<th>' . __('Responsável Financeiro:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->responsavel_financeiro) . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th>' . __('Motivo da Consulta:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->motivo_consulta) . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th>' . __('Sintomas Relatados:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->sintomas_rel) . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th>' . __('Diagnóstico:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->diagnostico) . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th>' . __('Tratamento Anterior:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->tratamento_anterior) . '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th>' . __('Medicações em Uso:', 'pronto-psi') . '</th>';
                    echo '<td>' . esc_html($paciente_info->medicacoes_uso) . '</td>';
                    echo '</tr>';

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo __('Nenhum paciente selecionado ou paciente não encontrado.', 'pronto-psi');
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>


<hr>

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
        <li class="nav-item">
            <a class="nav-link" id="anamnesi-tab" data-toggle="tab" href="#anamnesi" role="tab" aria-controls="anamnesi" aria-selected="false">
                <?php _e('Anamnesi', 'pronto-psi'); ?>
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- Aba de Atendimentos -->
        <div class="tab-pane fade show active" id="atendimentos" role="tabpanel" aria-labelledby="atendimentos-tab">
            <div class="mt-5">
                <h3 class="section-title"><?php _e('Lista de Atendimentos', 'pronto-psi'); ?></h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php _e('Data', 'pronto-psi'); ?></th>
                            <th><?php _e('Descrição', 'pronto-psi'); ?></th>
                            <th><?php _e('Duração', 'pronto-psi'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($atendimentos) : ?>
                            <?php foreach ($atendimentos as $atendimento) : ?>
                                <tr>
                                    <td><?php echo esc_html($atendimento->data_atendimento); ?></td>
                                    <td><?php echo esc_html($atendimento->descricao); ?></td>
                                    <td><?php echo esc_html($atendimento->duracao); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3"><?php _e('Nenhum atendimento encontrado.', 'pronto-psi'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aba Financeiro -->
        <div class="tab-pane fade" id="financeiro" role="tabpanel" aria-labelledby="financeiro-tab">
            <h3 class="section-title mt-4"><?php _e('Informações Financeiras', 'pronto-psi'); ?></h3>
            <!-- Adicione aqui a lógica para exibir informações financeiras -->
        </div>

        <!-- Aba Evolução -->
        <div class="tab-pane fade" id="evolucao" role="tabpanel" aria-labelledby="evolucao-tab">
            <h3 class="section-title mt-4"><?php _e('Evolução do Paciente', 'pronto-psi'); ?></h3>
            <!-- Adicione aqui a lógica para exibir a evolução do paciente -->
        </div>

        <!-- Aba Anamnesi -->
        <div class="tab-pane fade" id="anamnesi" role="tabpanel" aria-labelledby="anamnesi-tab">
            <h3 class="section-title mt-4"><?php _e('Anamnesi', 'pronto-psi'); ?></h3>
            <!-- Adicione aqui a lógica para exibir a anamnesi -->
        </div>
    </div>

</div>

<!-- JavaScript personalizado -->
<script>
jQuery(document).ready(function($) {
    $('#select_paciente').change(function() {
        $('#paciente-form').submit();
    });
});
</script>
