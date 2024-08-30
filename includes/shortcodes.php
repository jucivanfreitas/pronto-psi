<?php
// /includes/shortcodes.php
function pronto_psi_shortcode_prontuario() {
    ob_start();
    pronto_psi_prontuario_page(); // Reutilizar a função da página de administração
    return ob_get_clean();
}
add_shortcode('pronto_psi_prontuario', 'pronto_psi_shortcode_prontuario');
