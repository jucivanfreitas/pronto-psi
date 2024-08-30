<?php
// includes/pages/cliente.php

global $wpdb;

// Função para buscar a lista de clientes da tabela pronto_psi_clientes
$clientes = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pronto_psi_clientes");

// Função para buscar a lista de nomes completos da tabela wp_bookly_customers
$clientes_disponiveis = $wpdb->get_results("SELECT id, full_name FROM {$wpdb->prefix}bookly_customers");

// URL da página de clientes do Bookly
$bookly_customers_page_url = esc_url(admin_url('admin.php?page=bookly-customers'));

// Incluir os estilos do Bootstrap e Font Awesome
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';

// Incluir o script do Bootstrap e suas dependências
echo '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

// Exibir o título da página
echo '<div class="container mt-5">';
echo '<h2 class="text-center">' . __('Gerenciamento de Clientes Ativos', 'pronto-psi') . '</h2>';

// Formulário de cadastro/atualização de clientes com efeito sanfona
echo '<div id="accordion" class="mt-4">';
echo '<div class="card">';
echo '<div class="card-header" id="headingOne">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
echo __('Cadastro/Atualização de Atendimento', 'pronto-psi');
echo '</button>';
echo '</h5>';
echo '</div>';

echo '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">';
echo '<div class="card-body">';
echo '<form id="formCliente" method="POST" action="">';

echo '<div class="form-group">';
echo '<label for="full_name">' . __('Clientes Cadastrados', 'pronto-psi') . '</label>';
echo '<select class="form-control" name="full_name" id="full_name" required>';
echo '<option value="">' . __('Selecione um cliente', 'pronto-psi') . '</option>';

foreach ($clientes_disponiveis as $cliente_disponivel) {
    echo '<option value="' . esc_attr($cliente_disponivel->id) . '">' . esc_html($cliente_disponivel->full_name) . '</option>';
}

echo '</select>';
echo '</div>';

// (Outros campos do formulário...)

// Botões de ação: Salvar Cliente e Cadastrar Novo Cliente
echo '<div class="d-flex justify-content-between mt-3">';
echo '<button type="submit" class="btn btn-primary btn-sm d-flex align-items-center" style="flex: 1; margin-right: 5px;" name="submit">';
echo '<i class="fas fa-save mr-2"></i>' . __('Salvar Cliente', 'pronto-psi');
echo '</button>';
echo '<button type="button" class="btn btn-success btn-sm d-flex align-items-center" style="flex: 1;" onclick="window.location.href=\'' . $bookly_customers_page_url . '\'">';
echo '<i class="fas fa-user-plus mr-2"></i>' . __('Cadastrar Novo Cliente', 'pronto-psi');
echo '</button>';
echo '</div>';

echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>'; // fim do accordion

// Verificação se o formulário foi submetido
if (isset($_POST['submit'])) {
    $full_name_id = sanitize_text_field($_POST['full_name']);

    // Inserir ou atualizar os dados na tabela pronto_psi_clientes
    $wpdb->replace(
        "{$wpdb->prefix}pronto_psi_clientes",
        [
            'bookly_user_id' => $full_name_id,
            'full_name' => $wpdb->get_var($wpdb->prepare("SELECT full_name FROM {$wpdb->prefix}bookly_customers WHERE id = %d", $full_name_id)),
        ],
        ['%d', '%s']
    );

    // Exibir uma mensagem de confirmação
    echo '<div class="alert alert-success mt-4">' . __('Cliente salvo com sucesso!', 'pronto-psi') . '</div>';

    // Atualizar a listagem de clientes automaticamente
    echo '<script>location.reload();</script>';
}

// Exibir a tabela com a lista de clientes e função de busca
echo '<h3 class="mt-5">' . __('Lista de Clientes', 'pronto-psi') . '</h3>';
echo '<div class="form-group">';
echo '<input type="text" class="form-control" id="searchCliente" placeholder="' . __('Buscar Cliente...', 'pronto-psi') . '">';
echo '</div>';
echo '<table class="table table-bordered table-striped mt-3">';
echo '<thead class="thead-dark">';
echo '<tr><th>' . __('Nome', 'pronto-psi') . '</th><th>' . __('Responsável', 'pronto-psi') . '</th><th>' . __('Plano de Saúde', 'pronto-psi') . '</th><th>' . __('Ações', 'pronto-psi') . '</th></tr>';
echo '</thead>';
echo '<tbody id="clientesTable">';

foreach ($clientes as $cliente) {
    echo '<tr>';
    echo '<td>' . esc_html($cliente->full_name) . '</td>';
    echo '<td>' . esc_html($cliente->responsavel_financeiro) . '</td>';
    echo '<td>' . esc_html($cliente->plano_saude) . '</td>';
    echo '<td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewClienteModal" data-id="' . esc_attr($cliente->id) . '" data-nome="' . esc_attr($cliente->full_name) . '">' . __('Ver Dados Clínicos', 'pronto-psi') . '</button></td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Inclua o modal de informações clínicas
include 'modal/dados-clinicos.php';
?>

<script>
// Função para abrir o modal de dados clínicos
$(document).ready(function() {
    $('#viewClienteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botão que abriu o modal
        var clienteId = button.data('id'); // Extraindo o ID do cliente
        var clienteNome = button.data('nome'); // Extraindo o nome do cliente

        var modal = $(this);
        modal.find('#clienteId').text(clienteId);
        modal.find('#clienteNome').text(clienteNome);
    });
});
</script>
