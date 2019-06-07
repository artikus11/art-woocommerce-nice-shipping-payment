<?php
/**
 * Plugin Name: Art WooCommerce Nice Shipping Payment
 * Plugin URI: wpruse.ru
 * Text Domain: art-woocommerce-nice-shipping-payment
 * Domain Path: /languages
 * Description: Плагин для WooCommerce, позволяет оформить методы оплаты и доставки
 * Version: 1.0.2
 * Author: Artem Abramovich
 * Author URI: https://wpruse.ru/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt Text Domain: Domain Path:
 *
 * WC requires at least: 3.3.0
 * WC tested up to: 3.6
 *
 * Copyright Artem Abramovich
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$plugin_data = get_file_data(
	__FILE__,
	array(
		'ver'  => 'Version',
		'name' => 'Plugin Name',
	)
);

define( 'AWOOSP_PLUGIN_DIR', __DIR__ );
define( 'AWOOSP_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
define( 'AWOOSP_PLUGIN_FILE', plugin_basename( __FILE__ ) );

define( 'AWOOSP_PLUGIN_VER', $plugin_data['ver'] );
define( 'AWOOSP_PLUGIN_NAME', $plugin_data['name'] );

require __DIR__ . '/includes/class-artwoo-nice-sipping-payment.php';

/**
 * The main function responsible for returning the AWOOSP object.
 *
 * Use this function like you would a global variable, except without needing to declare the global.
 *
 * Example: <?php awoosp()->method_name(); ?>
 *
 * @return object AWOOC_Partners class object.
 * @since 1.0.0
 *
 */
if ( ! function_exists( 'awoosp' ) ) {

	function awoosp() {

		return AWOOSP::instance();
	}
}

$GLOBALS['awoosp'] = awoosp();
