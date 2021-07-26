<?php

/**
 * Plugin Name:       SET Cambios y Noticias
 * Plugin URI:        https://appsytecnologia.com
 * Description:       trae la cotizacion del día y las noticias recientes de la pagina del www.set.gov.py.
 * Version:           0.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            William Wright
 * Author URI:        https://appsytecnologia.com/perfil/william-wright
 */
if (!defined('ABSPATH')) {
 exit;
}
//Simple HTML DOM scraper
require_once(plugin_dir_path(__FILE__) . '/includes/simple_html_dom.php');
//Scripts
require_once(plugin_dir_path(__FILE__) . '/includes/set-cambios-scripts.php');
//Class
require_once(plugin_dir_path(__FILE__) . '/includes/set-cambios-class.php');

//Gegister Widget
function register_set_cambios()
{
  register_widget('Set_Cambios_Widget');
}
//Hook function
add_action( 'widgets_init', 'register_set_cambios');