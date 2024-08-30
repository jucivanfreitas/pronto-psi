<?php
// /pronto-psi.php
/**
 * Plugin Name: Prontuários Psicologia
 * Plugin URI:  https://www.datavisio.store
 * Description: Prontuário para profissionais de saúde em psicologia.
 * Version:     1.0.15
 * Author:      Jucivan Freitas
 * Versão estável anterior 1.0.14
 * Author URI:  https://www.datavisio.store
 * Text Domain: pronto-psi
 */

defined('ABSPATH') || exit;

if (!class_exists('ProntoPsi')) {
    class ProntoPsi
    {
        /**
         * Constructor - Inicializa o plug-in.
         */
        public function __construct()
        {
            $this->define_constants();
            $this->includes();
            $this->init_hooks();
        }

        /**
         * Define as constantes utilizadas no plug-in.
         */
        private function define_constants()
        {
            define('PRONTO_PSI_VERSION', '1.0.11');
            define('PRONTO_PSI_PLUGIN_DIR', plugin_dir_path(__FILE__));
            define('PRONTO_PSI_PLUGIN_URL', plugin_dir_url(__FILE__));
        }

        /**
         * Inclui os arquivos necessários para o funcionamento do plug-in.
         */
        private function includes()
        {
            require_once PRONTO_PSI_PLUGIN_DIR . 'includes/functions.php';
            require_once PRONTO_PSI_PLUGIN_DIR . 'includes/admin-menu.php';
            require_once PRONTO_PSI_PLUGIN_DIR . 'includes/shortcodes.php';
        }

        /**
         * Inicializa os hooks necessários para o funcionamento do plug-in.
         */
        private function init_hooks()
        {
            // Adiciona os scripts e estilos para a área administrativa.
            add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

            // Adiciona os scripts e estilos para a área pública.
            add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        }

        /**
         * Enfileira os scripts e estilos para a área administrativa.
         */
        public function enqueue_admin_scripts()
        {
            wp_enqueue_style('pronto-psi-admin-style', PRONTO_PSI_PLUGIN_URL . 'assets/css/admin-style.css', [], PRONTO_PSI_VERSION);
            wp_enqueue_script('pronto-psi-admin-script', PRONTO_PSI_PLUGIN_URL . 'assets/js/admin-script.js', ['jquery'], PRONTO_PSI_VERSION, true);
        }

        /**
         * Enfileira os scripts e estilos para a área pública.
         */
        public function enqueue_scripts()
        {
            wp_enqueue_style('pronto-psi-style', PRONTO_PSI_PLUGIN_URL . 'assets/css/style.css', [], PRONTO_PSI_VERSION);
            wp_enqueue_script('pronto-psi-script', PRONTO_PSI_PLUGIN_URL . 'assets/js/script.js', ['jquery'], PRONTO_PSI_VERSION, true);
        }
    }

    new ProntoPsi();
}
?>
