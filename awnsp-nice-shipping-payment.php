<?php
/**
 * Plugin Name: Art WooCommerce Nice Shipping Payment
 * Plugin URI: wpruse.ru
 * Text Domain: art-woocommerce-nice-shipping-payment
 * Domain Path: /languages
 * Description: Плагин для WooCommerce, позволяет оформить методы оплаты и доставки
 * Version: 1.0.3
 * Author: Artem Abramovich
 * Author URI: https://wpruse.ru/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt Text Domain: Domain Path:
 *
 * WC requires at least: 5.2.0
 * WC tested up to: 6.1
 *
 * RequiresWP: 5.5
 * RequiresPHP: 7.4
 *
 * Copyright Artem Abramovich
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$plugin_data = get_file_data(
	__FILE__,
	[
		'ver'  => 'Version',
		'name' => 'Plugin Name',
	]
);

const AWNSP_PLUGIN_DIR = __DIR__;
define( 'AWNSP_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
define( 'AWNSP_PLUGIN_FILE', plugin_basename( __FILE__ ) );

define( 'AWNSP_PLUGIN_VER', $plugin_data['ver'] );
define( 'AWNSP_PLUGIN_NAME', $plugin_data['name'] );

require __DIR__ . '/classes/class-main.php';

/**
 *
 * @return object AWOOC_Partners class object.
 * @since 1.0.0
 *
 */
if ( ! function_exists( 'awnsp' ) ) {

	function awnsp() {

		return \Art\AWNSP\Main::instance();
	}
}

awnsp();
