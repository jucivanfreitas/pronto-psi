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

<!-- Modal de Adicionar Atendimento -->
<div class="modal fade" id="modalAtendimento" tabindex="-1" role="dialog" aria-labelledby="modalAtendimentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAtendimentoLabel"><?php _e('Adicionar Atendimento', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-paciente-id"></span></p>
                <!-- Aqui você pode adicionar mais campos para capturar dados do atendimento -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Atendimento', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Adicionar Atendimento -->
<div class="modal fade" id="modalAtendimento2" tabindex="-1" role="dialog" aria-labelledby="modalAtendimentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAtendimentoLabel"><?php _e('Adicionar Atendimento2', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-paciente-id"></span></p>
                <!-- Aqui você pode adicionar mais campos para capturar dados do atendimento -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Atendimento', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Adicionar Financeiro -->
<div class="modal fade" id="modalFinanceiro" tabindex="-1" role="dialog" aria-labelledby="modalFinanceiroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFinanceiroLabel"><?php _e('Adicionar Financeiro', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-financeiro-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-financeiro-paciente-id"></span></p>
                <!-- Campos adicionais para o financeiro -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Financeiro', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Adicionar Evolução -->
<div class="modal fade" id="modalEvolucao" tabindex="-1" role="dialog" aria-labelledby="modalEvolucaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvolucaoLabel"><?php _e('Adicionar Evolução', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-evol-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-evol-paciente-id"></span></p>
                <!-- Aqui você pode adicionar mais campos relacionados à evolução -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Evolução', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Adicionar Anamnese -->
<div class="modal fade" id="modalAnamnese" tabindex="-1" role="dialog" aria-labelledby="modalAnamneseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAnamneseLabel"><?php _e('Adicionar Anamnese', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php _e('Paciente Selecionado:', 'pronto-psi'); ?> <span id="modal-anamn-paciente-nome"></span></p>
                <p><?php _e('ID do Paciente:', 'pronto-psi'); ?> <span id="modal-anamn-paciente-id"></span></p>
                <!-- Aqui você pode adicionar mais campos relacionados à anamnese -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                <button type="button" class="btn btn-primary"><?php _e('Salvar Anamnese', 'pronto-psi'); ?></button>
            </div>
        </div>
    </div>
</div>

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
                <?php _e('Anamnese', 'pronto-psi'); ?>
            </a>
        </li>
    </ul>

    <!-- Conteúdo das Abas -->
    <div class="tab-content" id="myTabContent">
        <!-- Aba Atendimentos -->
        <div class="tab-pane fade show active" id="atendimentos" role="tabpanel" aria-labelledby="atendimentos-tab">
            <h4 class="tab-title"><?php _e('Atendimentos', 'pronto-psi'); ?></h4>
            <button class="btn btn-primary" id="btn-adicionar-atendimento"><?php _e('Adicionar Atendimento', 'pronto-psi'); ?></button>
        </div>

        <!-- Aba Financeiro -->
        <div class="tab-pane fade" id="financeiro" role="tabpanel" aria-labelledby="financeiro-tab">
            <h4 class="tab-title"><?php _e('Financeiro', 'pronto-psi'); ?></h4>
            <button class="btn btn-primary" id="btn-adicionar-financeiro"><?php _e('Adicionar Financeiro', 'pronto-psi'); ?></button>


        </div>

        <!-- Aba Evolução -->
        <div class="tab-pane fade" id="evolucao" role="tabpanel" aria-labelledby="evolucao-tab">
            <h4 class="tab-title"><?php _e('Evolução', 'pronto-psi'); ?></h4>
            <button class="btn btn-primary" id="btn-adicionar-evolucao"><?php _e('Adicionar Evolução', 'pronto-psi'); ?></button>
        </div>

        <!-- Aba Anamnese -->
        <div class="tab-pane fade" id="anamnesi" role="tabpanel" aria-labelledby="anamnesi-tab">

            <button class="btn btn-primary" id="btn-adicionar-anamnesi"><?php _e('Adicionar Anamnese', 'pronto-psi'); ?></button>

        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Submissão do formulário ao mudar o paciente
    $('#select_paciente').on('change', function() {
        $('#paciente-form').submit();
    });

    // Função para adicionar atendimento
    $('#btn-adicionar-atendimento').click(function() {
        var pacienteId = $('#select_paciente').val(); // Recupera o ID do paciente selecionado
        var pacienteNome = $('#select_paciente option:selected').text(); // Recupera o nome do paciente selecionado

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Define os valores no modal
        $('#modal-paciente-id').text(pacienteId);
        $('#modal-paciente-nome').text(pacienteNome);

        // Exibe o modal
        $('#modalAtendimento').modal('show');
    });


    // Função para adicionar financeiro
    $('#btn-adicionar-financeiro').click(function() {
        var pacienteId = $('#select_paciente').val(); // Recupera o ID do paciente selecionado
        var pacienteNome = $('#select_paciente option:selected').text(); // Recupera o nome do paciente selecionado

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Define os valores no modal
        $('#modal-financeiro-paciente-id').text(pacienteId);
        $('#modal-financeiro-paciente-nome').text(pacienteNome);

        // Exibe o modal
        $('#modalFinanceiro').modal('show');
    });

    // Função para adicionar evolução
    $('#btn-adicionar-evolucao').click(function() {
        var pacienteId = $('#select_paciente').val(); // Recupera o ID do paciente selecionado
        var pacienteNome = $('#select_paciente option:selected').text(); // Recupera o nome do paciente selecionado

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Define os valores no modal
        $('#modal-evol-paciente-id').text(pacienteId);
        $('#modal-evol-paciente-nome').text(pacienteNome);

        // Exibe o modal
        $('#modalEvolucao').modal('show');
    });

    // Função para adicionar anamnese
    $('#btn-adicionar-anamnesi').click(function() {
        var pacienteId = $('#select_paciente').val(); // Recupera o ID do paciente selecionado
        var pacienteNome = $('#select_paciente option:selected').text(); // Recupera o nome do paciente selecionado

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Define os valores no modal
        $('#modal-anamn-paciente-id').text(pacienteId);
        $('#modal-anamn-paciente-nome').text(pacienteNome);

        // Exibe o modal
        $('#modalAnamnese').modal('show');
    });
});
</script>
