<?php
// includes/pages/modal/dados-clinicos.php

// Adiciona os estilos e scripts necessários para o modal
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Modal de Dados Clínicos -->
<div class="modal fade" id="viewClienteModal" tabindex="-1" role="dialog" aria-labelledby="viewClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewClienteModalLabel">
                    Cadastro Clínico do Paciente: <span id="modalClienteNome"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <!-- Formulário de Edição -->
                <form id="formDadosClinicos">
                    <!-- Linha para campos de gênero e estado civil -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="genero"><?php _e('Gênero:', 'pronto-psi'); ?></label>
                                <input type="text" class="form-control" id="genero" name="genero" placeholder="<?php _e('Informe o gênero do paciente', 'pronto-psi'); ?>" title="<?php _e('Por favor, insira o gênero do paciente', 'pronto-psi'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado_civil"><?php _e('Estado Civil:', 'pronto-psi'); ?></label>
                                <input type="text" class="form-control" id="estado_civil" name="estado_civil" placeholder="<?php _e('Informe o estado civil do paciente', 'pronto-psi'); ?>" title="<?php _e('Por favor, insira o estado civil do paciente', 'pronto-psi'); ?>">
                            </div>
                        </div>
                    </div>
                    <!-- Linha para campos de CPF e Cartão SUS -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf"><?php _e('CPF:', 'pronto-psi'); ?></label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="<?php _e('Informe o CPF do paciente', 'pronto-psi'); ?>" title="<?php _e('Por favor, insira o CPF do paciente', 'pronto-psi'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cartao_sus"><?php _e('Cartão SUS:', 'pronto-psi'); ?></label>
                                <input type="text" class="form-control" id="cartao_sus" name="cartao_sus" placeholder="<?php _e('Informe o número do Cartão SUS', 'pronto-psi'); ?>" title="<?php _e('Por favor, insira o número do Cartão SUS', 'pronto-psi'); ?>">
                            </div>
                        </div>
                    </div>
                    <!-- Linha para campos de responsável financeiro e plano de saúde -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsavel_financeiro"><?php _e('Responsável Financeiro:', 'pronto-psi'); ?></label>
                                <input type="text" class="form-control" id="responsavel_financeiro" name="responsavel_financeiro" placeholder="<?php _e('Informe o responsável financeiro', 'pronto-psi'); ?>" title="<?php _e('Por favor, insira o responsável financeiro', 'pronto-psi'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="plano_saude"><?php _e('Plano de Saúde:', 'pronto-psi'); ?></label>
                                <input type="text" class="form-control" id="plano_saude" name="plano_saude" placeholder="<?php _e('Informe o plano de saúde', 'pronto-psi'); ?>" title="<?php _e('Por favor, insira o plano de saúde', 'pronto-psi'); ?>">
                            </div>
                        </div>
                    </div>
                    <!-- Campo de motivo da consulta -->
                    <div class="form-group">
                        <label for="motivo_consulta"><?php _e('Motivo da Consulta:', 'pronto-psi'); ?></label>
                        <textarea class="form-control" id="motivo_consulta" name="motivo_consulta" placeholder="<?php _e('Descreva o motivo da consulta', 'pronto-psi'); ?>" title="<?php _e('Descreva o motivo da consulta do paciente', 'pronto-psi'); ?>"></textarea>
                    </div>
                    <!-- Campo de sintomas relatados -->
                    <div class="form-group">
                        <label for="sintomas_rel"><?php _e('Sintomas Relatados:', 'pronto-psi'); ?></label>
                        <textarea class="form-control" id="sintomas_rel" name="sintomas_rel" placeholder="<?php _e('Descreva os sintomas relatados', 'pronto-psi'); ?>" title="<?php _e('Descreva os sintomas relatados pelo paciente', 'pronto-psi'); ?>"></textarea>
                    </div>
                    <!-- Campo de diagnóstico -->
                    <div class="form-group">
                        <label for="diagnostico"><?php _e('Diagnóstico:', 'pronto-psi'); ?></label>
                        <textarea class="form-control" id="diagnostico" name="diagnostico" placeholder="<?php _e('Descreva o diagnóstico', 'pronto-psi'); ?>" title="<?php _e('Descreva o diagnóstico fornecido ao paciente', 'pronto-psi'); ?>"></textarea>
                    </div>
                    <!-- Campo de tratamento anterior -->
                    <div class="form-group">
                        <label for="tratamento_anterior"><?php _e('Tratamento Anterior:', 'pronto-psi'); ?></label>
                        <textarea class="form-control" id="tratamento_anterior" name="tratamento_anterior" placeholder="<?php _e('Descreva o tratamento anterior', 'pronto-psi'); ?>" title="<?php _e('Descreva o tratamento anterior do paciente', 'pronto-psi'); ?>"></textarea>
                    </div>
                    <!-- Campo de medicações em uso -->
                    <div class="form-group">
                        <label for="medicacoes_uso"><?php _e('Medicações em Uso:', 'pronto-psi'); ?></label>
                        <textarea class="form-control" id="medicacoes_uso" name="medicacoes_uso" placeholder="<?php _e('Descreva as medicações em uso', 'pronto-psi'); ?>" title="<?php _e('Descreva as medicações que o paciente está usando atualmente', 'pronto-psi'); ?>"></textarea>
                    </div>
                    <!-- Campo oculto para ID do cliente -->
                    <input type="hidden" id="clienteId" name="cliente_id">
                    <!-- Botões do modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Fechar', 'pronto-psi'); ?></button>
                        <button type="submit" form="formDadosClinicos" class="btn btn-primary"><?php _e('Salvar Dados', 'pronto-psi'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var formChanged = false;

    // Detecta mudanças no formulário
    $('#formDadosClinicos input, #formDadosClinicos textarea').on('change', function() {
        formChanged = true;
    });

    // Exibe os dados do cliente ao abrir o modal
    $('#viewClienteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botão que abriu o modal
        var clienteId = button.data('id'); // Extraindo o ID do cliente
        var clienteNome = button.data('nome'); // Extraindo o nome do cliente

        var modal = $(this);
        modal.find('#modalClienteNome').text(clienteNome);
        modal.find('#clienteId').val(clienteId);

        // Recuperar os dados do cliente do servidor
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_cliente_data',
                cliente_id: clienteId
            },
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    $('#genero').val(data.genero);
                    $('#estado_civil').val(data.estado_civil);
                    $('#cpf').val(data.cpf);
                    $('#cartao_sus').val(data.cartao_sus);
                    $('#responsavel_financeiro').val(data.responsavel_financeiro);
                    $('#plano_saude').val(data.plano_saude);
                    $('#motivo_consulta').val(data.motivo_consulta);
                    $('#sintomas_rel').val(data.sintomas_rel);
                    $('#diagnostico').val(data.diagnostico);
                    $('#tratamento_anterior').val(data.tratamento_anterior);
                    $('#medicacoes_uso').val(data.medicacoes_uso);
                } else {
                    alert('Erro ao recuperar os dados.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                alert('Erro ao recuperar os dados. Verifique o console para detalhes.');
            }
        });
    });

    // Envia os dados do formulário via AJAX
    $('#formDadosClinicos').on('submit', function(e) {
        e.preventDefault();

        if (!formChanged) {
            alert('Nenhuma alteração foi feita.');
            return;
        }

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: $(this).serialize() + '&action=update_cliente_data',
            success: function(response) {
                if (response.success) {
                    alert(response.data);
                    $('#viewClienteModal').modal('hide');
                    // Atualize a página que chamou o modal
                    location.reload(); // Ou atualize a área específica da página
                } else {
                    alert('Erro: ' + response.data);
                }
                formChanged = false;
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                alert('Erro ao salvar os dados. Verifique o console para detalhes.');
            }
        });
    });
});
</script>
