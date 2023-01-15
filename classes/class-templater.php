<?php

namespace Art\AWNSP;

class Templater {

	/**
	 * @return string
	 */
	public function plugin_url(): string {

		return untrailingslashit( plugins_url( '/', AWNSP_PLUGIN_FILE ) );
	}


	/**
	 * @return string
	 */
	public function plugin_path(): string {

		return untrailingslashit( AWNSP_PLUGIN_DIR );
	}


	/**
	 * @return string
	 */
	public function template_path(): string {

		return apply_filters( 'awnsp_template_path', 'art-woocommerce-nice-shipping-payment/' );
	}


	/**
	 * @param  string $template_name
	 *
	 * @return string
	 */
	public function get_template( string $template_name ): string {

		$template_path = locate_template( sprintf( '%s%s', $this->template_path(), $template_name ) );

		if ( ! $template_path ) {
			$template_path = sprintf( '%s/templates/%s', $this->plugin_path(), $template_name );
		}

		return apply_filters( 'awnsp_locate_template', $template_path );
	}
}