<?php

namespace Art\AWNSP;

/**
 * Class Core
 *
 * Main Core class, initialized the plugin
 *
 * @class       Core
 * @version     1.0.3
 * @author      Artem Abramovich
 */
class Main {

	/**
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private static ?Main $instance = null;

	/**
	 * @var \Art\AWNSP\Front
	 */
	protected Front $front;

	/**
	 * @var \Art\AWNSP\Templater
	 */
	protected Templater $template;

	protected string $suffix;


	public function __construct() {

		$this->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$this->load_dependencies();

		$this->init_hooks();

	}


	private function load_dependencies(): void {

		require AWNSP_PLUGIN_DIR . '/classes/class-front.php';
		require AWNSP_PLUGIN_DIR . '/classes/class-templater.php';
		require AWNSP_PLUGIN_DIR . '/classes/class-enqueue.php';
		require AWNSP_PLUGIN_DIR . '/classes/class-requirements.php';

	}


	public function init_hooks(): void {

		( new Requirements( $this ) )->init_hooks();
		( new Enqueue( $this ) )->init_hooks();
		( new Front( $this ) )->init_hooks();

		$this->template = new Templater();
	}


	/**
	 * Instance.
	 * A global instance of the class. Used to retrieve the instance
	 * to use on other files/plugins/themes.
	 *
	 * @return object Instance of the class.
	 * @since 1.0.0
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;

	}


	/**
	 * @return string
	 */
	public function get_suffix(): string {

		return $this->suffix;
	}


	/**
	 * @param $template_name
	 *
	 * @return string
	 */
	public function get_template( $template_name ): string {

		return $this->template->get_template( $template_name );
	}


	public function woocommerce_locate_template( $template, $template_name, $template_path ) {

		$_template = $template;

		if ( ! $template_path ) {
			$template_path = WC()->template_path();
		}

		$plugin_path = AWNSP_PLUGIN_DIR . '/templates/woocommerce/';

		$template = locate_template(

			[
				$template_path . $template_name,
				$template_name,
			]
		);

		if ( ! $template && file_exists( $plugin_path . $template_name ) ) {
			$template = $plugin_path . $template_name;
		}

		if ( ! $template ) {
			$template = $_template;
		}

		return $template;
	}

}
