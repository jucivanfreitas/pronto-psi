// includes/pages/widgets/scripts_widgets.js


jQuery(document).ready(function($) {
  $('#novoAtendimentoForm').on('submit', function(e) {
      e.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: formData + '&action=salvar_novo_atendimento',
          success: function(response) {
              if (response.success) {
                  alert('Atendimento salvo com sucesso.');
                  location.reload(); // Atualiza a página após salvar
              } else {
                  alert('Erro ao salvar o atendimento.');
              }
          }
      });
  });
});
