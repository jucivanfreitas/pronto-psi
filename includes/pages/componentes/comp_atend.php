<?php
// comp_atend.php

// Função para renderizar o acordeão
function render_atendimento_accordion($paciente_info, $pacientes, $paciente_id) {
?>
    <!-- Incluindo Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Incluindo jQuery e Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Accordion para exibir as informações -->
    <div class="accordion" id="accordionExample">

        <!-- Card 1: Paciente -->
        <div class="col-md-12 mb-4 mx-auto">
            <div class="section-title" id="headingOne">
                <h3 class="section-title text-center d-flex justify-content-center align-items-center">
                    <button class="section-title-button" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Paciente
                    </button>
                </h3>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                                                <div class="form-group">
                                                    <label for="select_paciente"><?php _e('Selecionar Paciente', 'pronto-psi'); ?></label>
                                                    <select id="select_paciente" class="form-control" name="paciente_id" required>
                                                        <option value=""><?php _e('Selecione um paciente', 'pronto-psi'); ?></option>
                                                        <?php foreach ($pacientes as $paciente): ?>
                                                            <option value="<?php echo esc_attr($paciente->id); ?>" <?php echo ($paciente_id == $paciente->id) ? 'selected' : ''; ?>>
                                                                <?php echo esc_html($paciente->full_name); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary"><?php _e('Atualizar', 'pronto-psi'); ?></button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Informações do Paciente -->
                                    <div class="col-md-8 mb-4">
                                        <div class="widget-container p-4 border rounded shadow-sm bg-light">
                                            <?php if ($paciente_info): ?>
                                                <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th><?php _e('Nome Completo:', 'pronto-psi'); ?></th>
                                                            <td><?php echo esc_html($paciente_info->full_name); ?></td>
                                                            <th><?php _e('CPF:', 'pronto-psi'); ?></th>
                                                            <td><?php echo esc_html($paciente_info->cpf); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php _e('Gênero:', 'pronto-psi'); ?></th>
                                                            <td><?php echo esc_html($paciente_info->genero); ?></td>
                                                            <th><?php _e('Estado Civil:', 'pronto-psi'); ?></th>
                                                            <td><?php echo esc_html($paciente_info->estado_civil); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php _e('Plano de Saúde:', 'pronto-psi'); ?></th>
                                                            <td><?php echo esc_html($paciente_info->plano_saude); ?></td>
                                                            <th><?php _e('Cartão SUS:', 'pronto-psi'); ?></th>
                                                            <td><?php echo esc_html($paciente_info->cartao_sus); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <div class="alert alert-warning" role="alert">
                                                    <?php _e('Nenhum paciente selecionado ou paciente não encontrado.', 'pronto-psi'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Informação Clínica -->
        <div class="col-md-12 mb-4 mx-auto">
            <div class="section-title" id="headingTwo">
                <h3 class="section-title text-center d-flex justify-content-center align-items-center">
                    <button class="section-title-button" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Informação Clínica
                    </button>
                </h3>
            </div>

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="widget-container p-4 border rounded shadow-sm bg-light w-100">
                        <!-- Informações clínicas do paciente -->
                        <?php if ($paciente_info): ?>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th><?php _e('Responsável Financeiro:', 'pronto-psi'); ?></th>
                                        <td><?php echo esc_html($paciente_info->responsavel_financeiro); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php _e('Motivo da Consulta:', 'pronto-psi'); ?></th>
                                        <td><?php echo esc_html($paciente_info->motivo_consulta); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php _e('Sintomas Relatados:', 'pronto-psi'); ?></th>
                                        <td><?php echo esc_html($paciente_info->sintomas_rel); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php _e('Diagnóstico:', 'pronto-psi'); ?></th>
                                        <td><?php echo esc_html($paciente_info->diagnostico); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
}
?>
