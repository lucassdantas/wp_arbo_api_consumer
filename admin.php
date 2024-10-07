<?php
// Bloquear o acesso direto ao arquivo
if (!defined('ABSPATH')) exit;

// Função para registrar a página do menu no admin
function arbo_api_consumer_admin_menu() {
    add_menu_page(
        'Arbo API Consumer',        // Título da página
        'Arbo API',                 // Nome do menu
        'manage_options',           // Capacidade necessária
        'arbo-api-consumer',        // Slug da página
        'arbo_api_consumer_admin_page', // Função callback para renderizar a página
        'dashicons-admin-site',     // Ícone do menu
        20                          // Posição do menu
    );
}
add_action('admin_menu', 'arbo_api_consumer_admin_menu');

// Função que renderiza a página de administração
function arbo_api_consumer_admin_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Arbo API Consumer', 'textdomain'); ?></h1>
        <p><?php esc_html_e('Clique no botão abaixo para atualizar os imóveis importados da API.', 'textdomain'); ?></p>
        
        <form method="post" action="">
            <?php submit_button('Atualizar Imóveis', 'primary', 'arbo_update_properties'); ?>
        </form>
        
        <?php
        // Verificar se o botão foi clicado
        if (isset($_POST['arbo_update_properties'])) {
            // Chamar a função para atualizar os imóveis
            arbo_api_consumer_update_properties();
        }
        ?>
    </div>
    <?php
}
