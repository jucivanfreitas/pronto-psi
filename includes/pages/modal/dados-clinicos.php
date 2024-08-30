<?php
// includes/pages/modal/dados-clinicos.php

// Adicionar os estilos e scripts necessários para o modal
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
echo '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

// Modal de Dados Clínicos
echo '<div class="modal fade" id="viewClienteModal" tabindex="-1" role="dialog" aria-labelledby="viewClienteModalLabel" aria-hidden="true">';
echo '<div class="modal-dialog" role="document">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="viewClienteModalLabel">' . __('Dados Clínicos do Paciente:', 'pronto-psi') . ' <span id="modalClienteNome"></span></h5>';
echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
echo '<span aria-hidden="true">&times;</span>';
echo '</button>';
echo '</div>';
echo '<div class="modal-body">';

// Formulário de edição
echo '<form id="formDadosClinicos">';
echo '<div class="form-group">';
echo '<label for="genero">' . __('Gênero:', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" id="genero" name="genero">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="estado_civil">' . __('Estado Civil:', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" id="estado_civil" name="estado_civil">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="cpf">' . __('CPF:', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" id="cpf" name="cpf">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="cartao_sus">' . __('Cartão SUS:', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" id="cartao_sus" name="cartao_sus">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="responsavel_financeiro">' . __('Responsável Financeiro:', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" id="responsavel_financeiro" name="responsavel_financeiro">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="plano_saude">' . __('Plano de Saúde:', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" id="plano_saude" name="plano_saude">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="motivo_consulta">' . __('Motivo da Consulta:', 'pronto-psi') . '</label>';
echo '<textarea class="form-control" id="motivo_consulta" name="motivo_consulta"></textarea>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="sintomas_rel">' . __('Sintomas Relatados:', 'pronto-psi') . '</label>';
echo '<textarea class="form-control" id="sintomas_rel" name="sintomas_rel"></textarea>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="diagnostico">' . __('Diagnóstico:', 'pronto-psi') . '</label>';
echo '<textarea class="form-control" id="diagnostico" name="diagnostico"></textarea>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="tratamento_anterior">' . __('Tratamento Anterior:', 'pronto-psi') . '</label>';
echo '<textarea class="form-control" id="tratamento_anterior" name="tratamento_anterior"></textarea>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="medicacoes_uso">' . __('Medicações em Uso:', 'pronto-psi') . '</label>';
echo '<textarea class="form-control" id="medicacoes_uso" name="medicacoes_uso"></textarea>';
echo '</div>';

echo '<input type="hidden" id="clienteId" name="cliente_id">';
echo '<button type="submit" class="btn btn-primary">' . __('Salvar Dados', 'pronto-psi') . '</button>';
echo '</form>';

echo '</div>';
echo '<div class="modal-footer">';
echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">' . __('Fechar', 'pronto-psi') . '</button>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

?>

<script>
// Script para manipular o modal
$(document).ready(function() {
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
                var data = JSON.parse(response);
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
            }
        });
    });

    // Enviar os dados do formulário via AJAX
    $('#formDadosClinicos').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: $(this).serialize() + '&action=update_cliente_data',
            success: function(response) {
                alert('Dados atualizados com sucesso!');
            }
        });
    });
});
</script>
