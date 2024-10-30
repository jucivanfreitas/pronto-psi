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

<!-- Incluindo os arquivos de modal -->
<?php
include 'modal/modal_atendimento.php';
include 'modal/modal_financeiro.php';
include 'modal/modal_evolucao.php';
include 'modal/modal_anamnese.php';

?>


<!-- Incluindo Bootstrap CSS e JS -->

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery (Necessário para o Bootstrap JS) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Incluindo CSS personalizado -->
<link href="<?php echo plugins_url('widgets/custom-styles.css', __FILE__); ?>" rel="stylesheet">

<div class="container-fluid mt-0">
    <!-- Título da Página -->
    <div class="title-highlight mb-0">
        <h1 class="title-highlight"><?php _e('Gerenciamento de Atendimentos', 'pronto-psi'); ?></h1>
    </div>
</div>
<hr>

<!-- Incluindo Bootstrap CSS -->

<!-- Script jQuery para submissão do formulário via AJAX -->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#formAdicionarAtendimento').on('submit', function(e) {
            e.preventDefault(); // Evita o recarregamento da página

            var formData = $(this).serialize(); // Captura todos os dados do formulário

            $.ajax({
                url: ajaxurl, // URL do admin-ajax.php
                type: 'POST',
                data: {
                    action: 'salvar_atendimento', // Nome da ação
                    formData: formData // Dados do formulário serializados
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.data.message); // Exibe mensagem de sucesso
                    } else {
                        alert(response.data.message); // Exibe mensagem de erro
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erro:', error); // Exibe erro no console
                }
            });
        });
    });
</script>

<!-- Incluindo Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Incluindo jQuery e Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Accordion para exibir as informações -->
<div class="accordion" id="accordionAtendimento">

    <!-- Card 1: Paciente -->
    <div class="col-md-12 mb-4 mx-auto">
        <div class="section-title" id="headingOne">
            <h3 class="section-title text-center d-flex justify-content-center align-items-center">
                <button class="section-title-button" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Paciente
                </button>
            </h3>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionAtendimento">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-4 mx-auto">

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

                            </div> <!-- Fim da linha interna -->
                        </div> <!-- Fim do container-fluid -->
                    </div> <!-- Fim da coluna -->
                </div> <!-- Fim da linha -->
            </div> <!-- Fim do card-body -->
        </div> <!-- Fim do collapseOne -->
    </div> <!-- Fim do Card 1 -->

    <!-- Card 2: Informação Clínica -->
    <div class="col-md-12 mb-4 mx-auto">
        <div class="section-title" id="heading2">
            <h3 class="section-title text-center d-flex justify-content-center align-items-center">
                <button class="section-title-button" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                    Informação Clínica
                </button>
            </h3>
        </div>

        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionAtendimento">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-4 mx-auto">
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
                                echo __('Nenhuma informação clínica disponível para o paciente selecionado.', 'pronto-psi');
                                echo '</div>';
                            }
                            ?>
                        </div> <!-- Fim do widget-container -->
                    </div> <!-- Fim da coluna -->
                </div> <!-- Fim da linha -->
            </div> <!-- Fim do card-body -->
        </div> <!-- Fim do collapseTwo -->
    </div> <!-- Fim do Card 2 -->
   <!-- Card 3: Informação Clínica -->
<div class="col-md-12 mb-4 mx-auto">
    <div class="section-title" id="heading3">
        <h3 class="section-title text-center d-flex justify-content-center align-items-center">
            <button class="section-title-button" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                EVOLUÇÕES
            </button>
        </h3>
    </div>

    <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordionAtendimento">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12 mb-4 mx-auto">
                <div class="mt-3 d-flex">
                    <!-- Botão Adicionar Evolução -->
                    <div class="mr-3">
                        <button class="btn btn-primary" id="btn-adicionar-evolucao">
                            <?php _e('Adicionar Evolução', 'pronto-psi'); ?>
                        </button>
                    </div>

                   <!-- Tabela -->
<div class="flex-grow-1">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><?php _e('Num Prontuário', 'pronto-psi'); ?></th>
                <th><?php _e('Tipo Atendimento', 'pronto-psi'); ?></th>
                <th><?php _e('Resumo da Sessão', 'pronto-psi'); ?></th>
                <th><?php _e('Reações Observadas', 'pronto-psi'); ?></th>
                <th><?php _e('Evolução e Melhorias', 'pronto-psi'); ?></th>
                <th><?php _e('Observação Geral', 'pronto-psi'); ?></th>
                <th><?php _e('Data', 'pronto-psi'); ?></th>
                <th><?php _e('Horário Início', 'pronto-psi'); ?></th>
                <th><?php _e('Horário Término', 'pronto-psi'); ?></th>
                <th><?php _e('Duração', 'pronto-psi'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($paciente_info) : ?>
                <?php
                // Filtra os atendimentos de acordo com o prontuario_id do paciente
                $atendimentos_filtrados = array_filter($atendimentos, function($atendimento) use ($paciente_info) {
                    return $atendimento->prontuario_id == $paciente_info->id;
                });

                // Exibe os atendimentos filtrados
                if (!empty($atendimentos_filtrados)) :
                    foreach ($atendimentos_filtrados as $atendimento) : ?>
                        <tr>
                            <td><?php echo esc_html($atendimento->id); ?></td>
                            <td><?php echo esc_html($atendimento->tipo_atendimento); ?></td>
                            <td><?php echo esc_html($atendimento->resumo_atendimento); ?></td>
                            <td><?php echo esc_html($atendimento->reacoes_respostas); ?></td>
                            <td><?php echo esc_html($atendimento->pontos_pos_e_melhorias); ?></td>
                            <td><?php echo esc_html($atendimento->observacoes); ?></td>
                            <td><?php echo esc_html($atendimento->data_atendimento); ?></td>
                            <td><?php echo esc_html($atendimento->horario_inicio); ?></td>
                            <td><?php echo esc_html($atendimento->horario_termino); ?></td>
                            <td><?php echo esc_html($atendimento->duracao_atendimento); ?></td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="10"><?php _e('Nenhum atendimento encontrado.', 'pronto-psi'); ?></td>
                    </tr>
                <?php endif; ?>
            <?php else : ?>
                <tr>
                    <td colspan="10"><?php _e('Nenhum atendimento encontrado.', 'pronto-psi'); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

                </div>

                </div> <!-- Fim da coluna -->
            </div> <!-- Fim da linha -->
        </div> <!-- Fim do card-body -->
    </div> <!-- Fim do collapse3 -->
</div> <!-- Fim do Card 3 -->


</div> <!-- Fim do accordion -->

<hr>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



<!-- Abas Horizontais -->

<div>
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="evolucao-tab" data-toggle="tab" href="#evolucao" role="tab" aria-controls="evolucao" aria-selected="true">
                <?php _e('Evolução', 'pronto-psi'); ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="atendimentos-tab" data-toggle="tab" href="#atendimentos" role="tab" aria-controls="atendimentos" aria-selected="false">
                <?php _e('Atendimentos', 'pronto-psi'); ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="financeiro-tab" data-toggle="tab" href="#financeiro" role="tab" aria-controls="financeiro" aria-selected="false">
                <?php _e('Financeiro', 'pronto-psi'); ?>
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
        <h3 class="section-title"><?php _e('Últimos Registros de Atendimento', 'pronto-psi'); ?></h3>
                    <button class="btn btn-primary" id="btn-adicionar-evolucao"><?php _e('Adicionar Evolução', 'pronto-psi'); ?></button>
                    <!-- conteudo Aba de Evolução -->

            <hr>



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

    // Função para exibir o modal de adicionar atendimento
    $('#btn-adicionar-atendimento').click(function() {
        var pacienteId = $('#select_paciente').val();
        var pacienteNome = $('#select_paciente option:selected').text();

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Preencher os dados no modal
        $('#modal-paciente-id').text(pacienteId);
        $('#modal-paciente-nome').text(pacienteNome);
        $('#paciente-id-hidden').val(pacienteId);

        // Exibir o modal
        $('#modalAtendimento').modal('show');
    });

    // Submissão do formulário de atendimento via AJAX
    $('#formAdicionarAtendimento').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize(); // Captura os dados do formulário

        $.ajax({
            url: ajaxurl, // URL do WordPress para AJAX
            method: 'POST',
            data: {
                action: 'salvar_atendimento', // Ação para o backend
                formData: formData // Dados do formulário
            },
            success: function(response) {
                if (response.success) {
                    alert('Atendimento salvo com sucesso!');
                    $('#modalAtendimento').modal('hide');
                    location.reload(); // Recarrega a página para atualizar a lista de atendimentos
                } else {
                    alert('Erro ao salvar o atendimento: ' + response.data.message);
                }
            },
            error: function() {
                alert('Erro ao salvar o atendimento. Tente novamente.');
            }
        });
    });

    // Função para adicionar financeiro
    $('#btn-adicionar-financeiro').click(function() {
        var pacienteId = $('#select_paciente').val();
        var pacienteNome = $('#select_paciente option:selected').text();

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
        var pacienteId = $('#select_paciente').val();
        var pacienteNome = $('#select_paciente option:selected').text();

        if (!pacienteId) {
            alert('Por favor, selecione um paciente primeiro.');
            return;
        }

        // Define os valores no modal
        $('#modal-evol-paciente-id').text(pacienteId);
        $('#modal-evol-paciente-nome').text(pacienteNome);
        $('#paciente-evol-id-hidden').val(pacienteId); // Atribuindo o ID do paciente no campo oculto

        // Exibe o modal
        $('#modalEvolucao').modal('show');
    });

    // Função para adicionar anamnese
    $('#btn-adicionar-anamnesi').click(function() {
        var pacienteId = $('#select_paciente').val();
        var pacienteNome = $('#select_paciente option:selected').text();

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

    // Submissão do formulário de evolução via AJAX
    jQuery(document).on('submit', '#formAdicionarEvolucao', function(e) {
        e.preventDefault();

        var dados = {
            action: 'salvar_evolucao',
            prontuario_id: jQuery('#paciente-evol-id-hidden').val(), // Prontuário ID adicionado
            data_atendimento: jQuery('#data_atendimento').val(),
            horario_inicio: jQuery('#horario_inicio').val(),
            horario_termino: jQuery('#horario_termino').val(),
            tipo_atendimento: jQuery('#tipo_atendimento').val(),
            dados_evolucao: jQuery('#resumo_atendimento').val(),
            observacoes: jQuery('#observacoes').val(),
            pontos_pos_e_melhorias: jQuery('#pontos_pos_e_melhorias').val(),
            reacoes_respostas: jQuery('#reacoes_respostas').val()
        };

        jQuery.ajax({
            url: pronto_psi_ajax_object.ajax_url,
            type: 'POST',
            data: dados,
            success: function(response) {
                if (response.success) {
                    alert('Evolução salva com sucesso!');
                    jQuery('#modalEvolucao').modal('hide');
                } else {
                    alert(response.data); // Mensagem de erro do servidor
                }
            }
        });
    });
});
</script>
