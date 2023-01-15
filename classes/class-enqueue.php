<?php
/**
 * Файл обработки скриптов и стилей
 *
 * @see     https://wpruse.ru
 * @package art-woocommerce-fast-order/classes
 * @version 1.0.0
 */

namespace Art\AWNSP;

class Enqueue {

	protected Main $main;


	public function __construct( $main ) {

		$this->main = $main;

	}


	public function init_hooks(): void {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_script_style' ], 100 );

	}


	/**
	 * Подключаем нужные стили и скрипты
	 */
	public function enqueue_script_style(): void {

		if ( is_cart() || is_checkout() ) {

			wp_enqueue_style(
				'awnsp-styles',
				AWNSP_PLUGIN_URI . 'assets/css/awnsp-styles' . $this->main->get_suffix() . '.css',
				[],
				AWNSP_PLUGIN_VER
			);

		}

	}

}
