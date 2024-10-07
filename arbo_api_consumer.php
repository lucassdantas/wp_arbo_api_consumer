<?php
/**
 * Plugin Name: Arbo API Consumer
 * Description: Plugin para consumir imóveis da API da Arbo Imóveis e exibir no frontend.
 * Version: 1.0
 * Author: RD Exclusive
 * Author URI: https://github.com/lucassdantas/wp_arbo_api_consumer
 */

// Bloquear o acesso direto ao arquivo
if (!defined('ABSPATH')) exit;

// Incluir o arquivo de configuração onde está a chave da API
require_once plugin_dir_path(__FILE__) . 'config.php';

// Incluir o arquivo com as funções da API
require_once plugin_dir_path(__FILE__) . 'api.php';

// Incluir o arquivo com as funções da página administrativa
require_once plugin_dir_path(__FILE__) . 'admin.php';
