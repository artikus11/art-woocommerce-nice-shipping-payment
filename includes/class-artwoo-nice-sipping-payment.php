<?php // @codingStandardsIgnoreLine

/**
 * Class AWOOSP
 *
 * Main AWOOSP class, initialized the plugin
 *
 * @class       AWOOSP
 * @version     1.0.0
 * @author      Artem Abramovich
 */
class AWOOSP {

	private static $instance;

	public $front_end;

	public $settings;

	private $required_plugin;


	public function __construct() {

		$this->required_plugin = array();

		$this->load_dependencies();

		$this->init();

	}


	private function load_dependencies() {


		require AWOOSP_PLUGIN_DIR . '/includes/class-awoosp-frontend.php';
		$this->front_end = new AWOOSP_Front_End();

	}


	public function init() {

		add_filter( 'woocommerce_locate_template', [ $this, 'woocommerce_locate_template' ], 10, 3 );

	}


	/**
	 * Instance.
	 *
	 * An global instance of the class. Used to retrieve the instance
	 * to use on other files/plugins/themes.
	 *
	 * @return object Instance of the class.
	 * @since 1.0.0
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) :
			self::$instance = new self();
		endif;

		return self::$instance;

	}


	public function woocommerce_locate_template( $template, $template_name, $template_path ) {

		$_template = $template;

		if ( ! $template_path ) {
			$template_path = WC()->template_path();
		}

		$plugin_path = AWOOSP_PLUGIN_DIR . '/templates/woocommerce/';

		$template = locate_template(

			array(
				$template_path . $template_name,
				$template_name,
			)
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
