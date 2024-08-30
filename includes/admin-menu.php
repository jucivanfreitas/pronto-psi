<?php

function pronto_psi_add_admin_menu()
{
    add_menu_page(
        __('Prontuário Psicologia', 'pronto-psi'),
        __('Pronto Psi', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi',
        'pronto_psi_main_page',
        'dashicons-clipboard',
        6
    );

    add_submenu_page(
        'pronto-psi',
        __('Clientes', 'pronto-psi'),
        __('Clientes', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi-clientes',
        'pronto_psi_clientes_page'
    );

    add_submenu_page(
        'pronto-psi',
        __('Atendimentos', 'pronto-psi'),
        __('Atendimentos', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi-atendimentos',
        'pronto_psi_atendimentos_page'
    );

    add_submenu_page(
        'pronto-psi',
        __('Encaminhamentos', 'pronto-psi'),
        __('Encaminhamentos', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi-encaminhamentos',
        'pronto_psi_encaminhamentos_page'
    );
}

add_action('admin_menu', 'pronto_psi_add_admin_menu');

function pronto_psi_main_page()
{
    echo '<h1>' . __('Prontuário Psicologia', 'pronto-psi') . '</h1>';
}

function pronto_psi_clientes_page()
{
    include_once PRONTO_PSI_PLUGIN_DIR . 'includes/pages/cliente.php';
}

function pronto_psi_atendimentos_page()
{
    include_once PRONTO_PSI_PLUGIN_DIR . 'includes/pages/atendimento.php';
}

function pronto_psi_encaminhamentos_page()
{
    include_once PRONTO_PSI_PLUGIN_DIR . 'includes/pages/encaminhamentos.php';
}
