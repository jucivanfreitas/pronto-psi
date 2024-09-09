jQuery(document).ready(function($) {
  console.log('Pronto Psi admin script loaded.');
});
jQuery(document).ready(function($) {
  $('#select_paciente').change(function() {
      var paciente_id = $(this).val();

      $.ajax({
          url: ajaxurl, // URL do AJAX no WordPress
          type: 'POST',
          data: {
              action: 'fetch_paciente_info',
              paciente_id: paciente_id
          },
          success: function(response) {
              if (response.success) {
                  $('#paciente-info').html(response.data);
              } else {
                  $('#paciente-info').html('<p>' + response.data + '</p>');
              }
          }
      });
  });
});
