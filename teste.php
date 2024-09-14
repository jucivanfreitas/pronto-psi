jQuery(document).ready(function($) {
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
                alert(response.message);
                if (response.success) {
                    $('#modalAtendimento').modal('hide');
                    location.reload(); // Recarrega a página para atualizar a lista de atendimentos
                }
            },
            error: function() {
                alert('Erro ao salvar o atendimento. Tente novamente.');
            }
        });
    });
});
