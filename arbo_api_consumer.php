<?php
/**
 * Plugin Name: Arbo API Consumer
 * Description: Plugin para consumir imóveis da API da Arbo Imóveis e exibir no frontend.
 * Version: 1.0
 * Author: RD Exclusive
 */

// Bloquear o acesso direto ao arquivo
if (!defined('ABSPATH')) exit;

// Função para registrar o script de JavaScript no frontend
function arbo_api_consumer_enqueue_scripts() {
    wp_enqueue_script('arbo-api-js', plugins_url('assets/js/arbo_api.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('arbo-api-js', 'arbo_api_data', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'arbo_api_consumer_enqueue_scripts');

// Criação da função para chamar a API e retornar os dados
function arbo_api_consumer_fetch_properties() {
    // Substitua pela sua chave da API
    $api_key = 'chave-da-api-aqui';

    // Fazer a chamada para a API da Arbo
    $response = wp_remote_get('https://app-integracao.arboimoveis.com/api/imoveis', array(
        'headers' => array(
            'Authorization' => $api_key
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
