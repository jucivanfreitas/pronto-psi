<?php
// includes/pages/cliente.php
global $wpdb;

// Função para buscar a lista de clientes da tabela pronto_psi_clientes
$clientes = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pronto_psi_clientes");

// Função para buscar a lista de nomes completos da tabela wp_bookly_customers
$clientes_disponiveis = $wpdb->get_results("SELECT id, full_name FROM {$wpdb->prefix}bookly_customers");

// Incluir os estilos do Bootstrap
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';

// Incluir o script do Bootstrap para a sanfona funcionar
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

// Exibir o título da página
echo '<div class="container mt-5">';
echo '<h2 class="text-center">' . __('Gerenciamento de Clientes', 'pronto-psi') . '</h2>';

// Formulário de cadastro/atualização de clientes com efeito sanfona
echo '<div id="accordion" class="mt-4">';
echo '<div class="card">';
echo '<div class="card-header" id="headingOne">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
echo __('Adicionar Cliente', 'pronto-psi');
echo '</button>';
echo '</h5>';
echo '</div>';

echo '<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">';
echo '<div class="card-body">';
echo '<form id="formCliente" method="POST" action="">';

echo '<div class="form-group">';
echo '<label for="full_name">' . __('Nome Completo', 'pronto-psi') . '</label>';
echo '<select class="form-control" name="full_name" id="full_name" required>';
echo '<option value="">' . __('Selecione um cliente', 'pronto-psi') . '</option>';

foreach ($clientes_disponiveis as $cliente_disponivel) {
    echo '<option value="' . esc_attr($cliente_disponivel->id) . '">' . esc_html($cliente_disponivel->full_name) . '</option>';
}

echo '</select>';
echo '</div>';

// (Outros campos do formulário...)

echo '<button type="submit" class="btn btn-primary" name="submit">' . __('Salvar Cliente', 'pronto-psi') . '</button>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>'; // fim do accordion

// Verificação se o formulário foi submetido
if (isset($_POST['submit'])) {
    // Obter os dados do formulário
    $full_name_id = sanitize_text_field($_POST['full_name']);
    // (Outros dados do formulário...)

    // Inserir ou atualizar os dados na tabela pronto_psi_clientes
    $wpdb->replace(
        "{$wpdb->prefix}pronto_psi_clientes",
        [
            'bookly_user_id' => $full_name_id,
            'full_name' => $wpdb->get_var($wpdb->prepare("SELECT full_name FROM {$wpdb->prefix}bookly_customers WHERE id = %d", $full_name_id)),
            // (Outros dados do formulário...)
        ],
        ['%d', '%s', /* Outros tipos de dados... */]
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
    echo '<td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewClienteModal" data-id="' . esc_attr($cliente->id) . '">' . __('Ver Dados Clínicos', 'pronto-psi') . '</button></td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Botão para cadastrar novo cliente
echo '<button class="btn btn-success mt-4" data-toggle="modal" data-target="#cadastrarClienteModal">' . __('Cadastrar Novo Cliente', 'pronto-psi') . '</button>';

// Modal para cadastrar novo cliente
echo '<div class="modal fade" id="cadastrarClienteModal" tabindex="-1" aria-labelledby="cadastrarClienteModalLabel" aria-hidden="true">';
echo '<div class="modal-dialog">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="cadastrarClienteModalLabel">' . __('Cadastrar Novo Cliente', 'pronto-psi') . '</h5>';
echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
echo '<span aria-hidden="true">&times;</span>';
echo '</button>';
echo '</div>';
echo '<div class="modal-body">';
echo '<form id="formCadastrarCliente" method="POST" action="">';

echo '<div class="form-group">';
echo '<label for="new_full_name">' . __('Nome Completo', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" name="new_full_name" id="new_full_name" required>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="new_phone">' . __('Telefone', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" name="new_phone" id="new_phone" required pattern="^\+\d{1,3}\d{10,12}$" title="+5561982516181">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="new_email">' . __('E-mail', 'pronto-psi') . '</label>';
echo '<input type="email" class="form-control" name="new_email" id="new_email" required>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="new_birthday">' . __('Data de Nascimento', 'pronto-psi') . '</label>';
echo '<input type="date" class="form-control" name="new_birthday" id="new_birthday" required>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="new_country">' . __('País', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" name="new_country" id="new_country" required>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="new_state">' . __('Estado', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" name="new_state" id="new_state" required>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="new_city">' . __('Cidade', 'pronto-psi') . '</label>';
echo '<input type="text" class="form-control" name="new_city" id="new_city" required>';
echo '</div>';

echo '<button type="submit" class="btn btn-primary" name="submit_new_cliente">' . __('Cadastrar Cliente', 'pronto-psi') . '</button>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>'; // Fim do modal cadastrar cliente

// Verificação se o formulário de novo cliente foi submetido
if (isset($_POST['submit_new_cliente'])) {
    // Obter os dados do formulário
    $new_full_name = sanitize_text_field($_POST['new_full_name']);
    $new_phone = sanitize_text_field($_POST['new_phone']);
    $new_email = sanitize_email($_POST['new_email']);
    $new_birthday = sanitize_text_field($_POST['new_birthday']);
    $new_country = sanitize_text_field($_POST['new_country']);
    $new_state = sanitize_text_field($_POST['new_state']);
    $new_city = sanitize_text_field($_POST['new_city']);

    // Dividir o nome completo em first_name e last_name
    $names = explode(' ', $new_full_name);
    $first_name = $names[0];
    $last_name = isset($names[1]) ? $names[count($names) - 1] : '';

    // Inserir o novo cliente na tabela wp_bookly_customers
    $wpdb->insert(
        "{$wpdb->prefix}bookly_customers",
        [
            'full_name' => $new_full_name,
            'phone' => $new_phone,
            'email' => $new_email,
            'birthdate' => $new_birthday,
            'country' => $new_country,
            'state' => $new_state,
            'city' => $new_city,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ],
        ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']
    );

    // Exibir uma mensagem de confirmação
    echo '<div class="alert alert-success mt-4">' . __('Novo cliente cadastrado com sucesso!', 'pronto-psi') . '</div>';

    // Atualizar a listagem de clientes automaticamente
    echo '<script>location.reload();</script>';
}

echo '</div>'; // fim da div container
?>
