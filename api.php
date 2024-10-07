<?php
// Bloquear o acesso direto ao arquivo
if (!defined('ABSPATH')) exit;

// Função que faz a chamada para a API e atualiza os imóveis
function arbo_api_consumer_update_properties() {
    // Fazer a chamada à API da Arbo Imóveis usando a chave definida no config.php
    $response = wp_remote_get('https://app-integracao.arboimoveis.com/api/imoveis', array(
        'headers' => array(
            'Authorization' => ARBO_API_KEY
        )
    ));

    // Verificar se a chamada foi bem-sucedida
    if (is_wp_error($response)) {
        echo '<div class="error"><p>Erro ao conectar com a API.</p></div>';
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (!empty($data)) {
            // Aqui você pode adicionar o código para salvar ou atualizar os imóveis no banco de dados do WordPress
            echo '<div class="updated"><p>Imóveis atualizados com sucesso!</p></div>';
        } else {
            echo '<div class="error"><p>Nenhum imóvel encontrado.</p></div>';
        }
    }
}

// Função para fazer a chamada à API via AJAX no frontend (se necessário)
function arbo_api_consumer_fetch_properties() {
    // Verificar se a chave da API está definida
    if (!defined('ARBO_API_KEY')) {
        wp_send_json_error('Chave da API não definida.');
        return;
    }

    // Fazer a chamada à API da Arbo Imóveis usando a chave definida no config.php
    $response = wp_remote_get('https://app-integracao.arboimoveis.com/api/imoveis', array(
        'headers' => array(
            'Authorization' => ARBO_API_KEY
        )
    ));

    // Verificar se a chamada foi bem-sucedida
    if (is_wp_error($response)) {
        wp_send_json_error('Erro ao conectar com a API');
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        // Retornar os dados dos imóveis
        if (!empty($data)) {
            wp_send_json_success($data);
        } else {
            wp_send_json_error('Nenhum imóvel encontrado');
        }
    }
}
add_action('wp_ajax_fetch_properties', 'arbo_api_consumer_fetch_properties');
add_action('wp_ajax_nopriv_fetch_properties', 'arbo_api_consumer_fetch_properties');
