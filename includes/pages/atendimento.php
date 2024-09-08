<?php
// includes/pages/atendimento.php

global $wpdb;

// Busca os clientes da tabela pronto_psi_clientes para o campo de seleção
$clientes = $wpdb->get_results("SELECT id, full_name FROM {$wpdb->prefix}pronto_psi_clientes");

// Exibe o título da página
echo '<h2 class="text-primary">' . __('Gerenciamento de Atendimentos', 'pronto-psi') . '</h2>';

// Campo de seleção do paciente
echo '<div class="card mb-4">';
echo '<div class="card-header bg-primary text-white">';
echo '<i class="fas fa-user"></i> ' . __('Selecione o Paciente:', 'pronto-psi');
echo '</div>';
echo '<div class="card-body">';
echo '<form id="select-patient-form">';
echo '<div class="form-group">';
echo '<label for="cliente_id" class="form-label">' . __('Pacientes', 'pronto-psi') . '</label>';
echo '<select class="form-control" name="cliente_id" id="cliente_id" required>';
echo '<option value="">' . __('Selecione um paciente', 'pronto-psi') . '</option>';

foreach ($clientes as $cliente) {
    echo '<option value="' . esc_attr($cliente->id) . '">' . esc_html($cliente->full_name) . '</option>';
}

echo '</select>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '</div>';

// Widget para exibir informações do paciente selecionado
echo '<div id="patient-info-widget" class="card border-info mb-4 d-none">'; // Inicia escondido
echo '<div class="card-header bg-info text-white"><i class="fas fa-user-md"></i> ' . __('Informações Clínicas do Paciente', 'pronto-psi') . '</div>';
echo '<div class="card-body" id="patient-info-content">';
// O conteúdo será carregado via AJAX
echo '</div>';
echo '</div>';

// Widget para exibir atendimentos do paciente selecionado
echo '<div id="patient-appointments-widget" class="card border-secondary mb-4 d-none">'; // Inicia escondido
echo '<div class="card-header bg-secondary text-white"><i class="fas fa-calendar-check"></i> ' . __('Atendimentos do Paciente', 'pronto-psi') . '</div>';
echo '<div class="card-body" id="patient-appointments-content">';
// O conteúdo será carregado via AJAX
echo '</div>';
echo '</div>';
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectPatientForm = document.getElementById('select-patient-form');
    const clienteSelect = document.getElementById('cliente_id');
    const patientInfoWidget = document.getElementById('patient-info-widget');
    const patientInfoContent = document.getElementById('patient-info-content');
    const patientAppointmentsWidget = document.getElementById('patient-appointments-widget');
    const patientAppointmentsContent = document.getElementById('patient-appointments-content');

    clienteSelect.addEventListener('change', function() {
        const clienteId = this.value;

        if (clienteId) {
            // Faz a requisição AJAX para buscar as informações do paciente
            fetchPatientInfo(clienteId);
            fetchPatientAppointments(clienteId);
        } else {
            // Esconde os widgets se não houver seleção
            patientInfoWidget.classList.add('d-none');
            patientAppointmentsWidget.classList.add('d-none');
        }
    });

    function fetchPatientInfo(clienteId) {
        fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=fetch_patient_info&cliente_id=' + clienteId)
            .then(response => response.text())
            .then(data => {
                patientInfoContent.innerHTML = data;
                patientInfoWidget.classList.remove('d-none'); // Mostra o widget
            })
            .catch(error => console.error('Erro ao carregar informações do paciente:', error));
    }

    function fetchPatientAppointments(clienteId) {
        fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=fetch_patient_appointments&cliente_id=' + clienteId)
            .then(response => response.text())
            .then(data => {
                patientAppointmentsContent.innerHTML = data;
                patientAppointmentsWidget.classList.remove('d-none'); // Mostra o widget
            })
            .catch(error => console.error('Erro ao carregar atendimentos do paciente:', error));
    }
});
</script>
