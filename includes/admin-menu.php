<?php
// /includes/admin-page.php

function pronto_psi_add_admin_menu()
{
    // Adiciona uma separação personalizada para os "Plug-ins Pessoais"
    global $menu;
    $position = 80; // Posição para a separação personalizada (ajuste conforme necessário)

   // $menu[$position] = array('', 'read', 'separator-plugin-pessoais', 'Atenciosamente', 'wp-menu-separator'); // Adiciona a separação "Plug-ins Pessoais"
    $menu[$position] = array(
    'Nome do Separador', // Título do separador
    'read', // Capability necessária
    'Atenciosamente Psi', // Slug único
    '', // Função
    'wp-menu-separator', // Classe CSS para separador
    'menu-top' // Classe adicional para manter estilo de separador
);

    // Adiciona o menu principal do plugin abaixo da separação
    add_menu_page(
        __('Prontuário Psicologia', 'pronto-psi'),
        __('Pronto Psi', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi',
        'pronto_psi_main_page',
        'dashicons-clipboard',
        $position -1 // Posiciona logo abaixo da separação personalizada
    );

    // Adiciona submenu para Clientes
    add_submenu_page(
        'pronto-psi',
        __('Clientes', 'pronto-psi'),
        __('Clientes', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi-clientes',
        'pronto_psi_clientes_page'
    );

    // Adiciona submenu para Atendimentos
    add_submenu_page(
        'pronto-psi',
        __('Atendimentos', 'pronto-psi'),
        __('Atendimentos', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi-atendimentos',
        'pronto_psi_atendimentos_page'
    );

    // Adiciona submenu para Encaminhamentos
    add_submenu_page(
        'pronto-psi',
        __('Encaminhamentos', 'pronto-psi'),
        __('Encaminhamentos', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi-encaminhamentos',
        'pronto_psi_encaminhamentos_page'
    );

    // Adiciona submenu para Registro de Financeiro
    add_submenu_page(
        'pronto-psi',
        __('Controle Financeiro', 'pronto-psi'),
        __('Financeiro', 'pronto-psi'),
        'edit_others_posts',
        'pronto-psi-financeiro',
        'pronto_psi_financeiro_page'
    );
}

add_action('admin_menu', 'pronto_psi_add_admin_menu');

// Função para adicionar o CSS personalizado
function pronto_psi_custom_menu_style()
{
    echo '<style>
        /* Estilo para o menu principal */
        #toplevel_page_pronto-psi .wp-menu-image::before {
            color: orange !important; /* Cor laranja para o ícone do menu principal */
        }
        #toplevel_page_pronto-psi .wp-menu-name {
            color: orange !important; /* Cor laranja para o texto do menu principal */
        }

        /* Estilos para os submenus */
        #toplevel_page_pronto-psi .wp-submenu a[href="admin.php?page=pronto-psi-clientes"]::before {
            content: "\f110"; /* Ícone personalizado Dashicon para "Clientes" */
            font-family: dashicons;
            margin-right: 8px;
            color: orange; /* Cor laranja para o ícone de Clientes */
        }

        #toplevel_page_pronto-psi .wp-submenu a[href="admin.php?page=pronto-psi-atendimentos"]::before {
            content: "\f119"; /* Ícone personalizado Dashicon para "Atendimentos" */
            font-family: dashicons;
            margin-right: 8px;
            color: orange; /* Cor laranja para o ícone de Atendimentos */
        }

        #toplevel_page_pronto-psi .wp-submenu a[href="admin.php?page=pronto-psi-encaminhamentos"]::before {
            content: "\f163"; /* Ícone personalizado Dashicon para "Encaminhamentos" */
            font-family: dashicons;
            margin-right: 8px;
            color: orange; /* Cor laranja para o ícone de Encaminhamentos */
        }

        #toplevel_page_pronto-psi .wp-submenu a[href="admin.php?page=pronto-psi-financeiro"]::before {
            content: "\f239"; /* Ícone personalizado Dashicon para "Financeiro" */
            font-family: dashicons;
            margin-right: 8px;
            color: orange; /* Cor laranja para o ícone de Financeiro */
        }
    </style>';
}

// Adiciona o CSS personalizado ao admin_head para alterar cor do ícone e nome do menu
add_action('admin_head', 'pronto_psi_custom_menu_style');

// Funções de página
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

function pronto_psi_financeiro_page()
{
    include_once PRONTO_PSI_PLUGIN_DIR . 'includes/pages/financeiro.php';
}
?>
