<?php
// /pronto-psi.php
/**
 * Plugin Name: Prontuários Psicologia
 * Plugin URI:  https://www.datavisio.store
 * Description: Prontuário para profissionais de saúde em psicologia. Organize e gerencie prontuários clínicos com facilidade, aproveitando as funcionalidades avançadas do WordPress.
 * Version:     1.0.30
 * Author:      Jucivan Freitas
 * Author URI:  https://www.datavisio.store
 * Text Domain: pronto-psi
 * Domain Path: /languages
 *
 * Requires at least: 5.7
 * Requires PHP:      7.4
 * Tested up to:      8.2
 * License:          GPL-2.0+
 * License URI:      https://opensource.org/licenses/GPL-2.0
 *
 * Este plugin adiciona uma solução abrangente para o gerenciamento de registros de pacientes, incluindo informações demográficas, dados clínicos e histórico médico.
 *
 * == Descrição ==
 *
 * O plugin "Prontuários Psicologia" foi desenvolvido para psicólogos e profissionais de saúde para gerenciar registros de pacientes de forma eficaz. Inclui recursos como:
 * - Perfis detalhados de pacientes
 * - Gestão de histórico clínico
 * - Rastreamento de medicações
 * - Gerenciamento de planos de saúde
 *
 * Foi construído com as melhores práticas em mente e garante compatibilidade com as versões mais recentes do WordPress e PHP.
 *
 * == Instalação ==
 * 1. Faça o upload dos arquivos do plugin para o diretório `/wp-content/plugins/pronto-psi`, ou instale o plugin diretamente através da tela de plugins do WordPress.
 * 2. Ative o plugin através da tela de 'Plugins' no WordPress.
 * 3. Navegue até as configurações do plugin para configurá-lo de acordo com suas necessidades.
 *
 * == Changelog ==
 * =1.0.23=
 * aDCIONANDO PAGINA DE ATENDIMENTO PARA receber auto seleção oriundo da pagina de clientes
 * adicionando conteudo na pagina atendimento
 * 1.0.30 modal atendimento estruturado e funcional
 *
 * 1.0.29 modilarizando modais
 *
 * 1.0.27 implementandio modal adicionar atencimento
 *
 * = 1.0.22 =
 * * localizando o menu do plugin dentro do painel worpresse adicionado cores, ajustando apresentação do menu
 *
 * = 1.0.21 =
 * * inserindo filtros na view cliente
 *
 *  * = 1.0.20 =
 * * adicionando funcionalidade na function para o modal dados clinicos

 *
 *
 * = 1.0.17 =
 * * Adicionada funcionalidade para atualizar dados clínicos via AJAX.
 * * Melhorado o design e a funcionalidade do modal.
 * * Corrigidos diversos bugs relacionados ao manuseio de formulários.
 *
 * = 1.0.15 =
 * * Lançamento inicial com funcionalidades básicas para gerenciar registros de pacientes.
 *
 * == Perguntas Frequentes ==
 * = Como acessar as configurações do plugin? =
 * Navegue até a seção "Prontuários Psicologia" no menu de administração do WordPress.
 *
 * = O que fazer se encontrar um bug? =
 * Entre em contato com nossa equipe de suporte através do site ou envie uma questão na nossa página do GitHub.
 *
 * == Agradecimentos ==
 * - Este plugin utiliza o Bootstrap para seus componentes de interface.
 * - Agradecimentos especiais à comunidade WordPress pelo apoio e contribuições.
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
            define('PRONTO_PSI_VERSION', '1.0.12');
            define('PRONTO_PSI_PLUGIN_DIR', plugin_dir_path(__FILE__));
            define('PRONTO_PSI_PLUGIN_URL', plugin_dir_url(__FILE__));
        }

        /**
         * Inclui os arquivos necessários para o funcionamento do plug-in.
         */
        private function includes()
        {
            require_once PRONTO_PSI_PLUGIN_DIR . 'includes/functions.php';
            require_once PRONTO_PSI_PLUGIN_DIR . 'includes/pages/modal/functions_modal_dados_clinicos.php';
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
