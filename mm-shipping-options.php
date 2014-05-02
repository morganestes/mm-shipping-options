<?php
/*
Plugin Name: Custom Shipping Options for MemberMouse
Version: 0.1.0
Description: Adds a filter to the MemberMouse WordPress plugin to show/hide shipping options on a checkout form.
Author: Morgan Estes
Author URI: http://www.morganestes.com
Plugin URI: https://github.com/morganestes/mm-shipping-options
Text Domain: mm-shipping-options
Domain Path: /languages
*/

/*
 Custom Shipping Options for MemberMouse
 Copyright (C) 2014  Morgan W. Estes (morganestes)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License along
 with this program; if not, write to the Free Software Foundation, Inc.,
 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

class MorganEstes_MemberMouse {

	public $is_mm_active = false;
	private $version = '1.0.0';

	/**
	 * Class constructor used to run actions.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		//register_activation_hook( __FILE__, array( $this, 'activate' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
	}

	/**
	 * Plugin initializer.
	 *
	 * @uses init()
	 */
	public function init() {
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
		wp_register_script( 'mm-shipping-options-filter', plugins_url( 'mm-shipping-options.js', __FILE__ ), array( 'jquery' ), $this->version, true );
	}

	protected function activate() {
		if ( false == is_plugin_active( 'membermouse/index.php' ) ) {
			$this->is_mm_active = false;
			add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		}
	}

	/**
	 * Add our JavaScript files to the front end.
	 */
	public function add_scripts() {
		// Only add our JS if the mm-fso query exists
		if ( $this->get_shipping_from_query() ) {
			wp_enqueue_script( 'mm-shipping-options-filter' );
		}
	}

	/**
	 * Add our custom vars to the query_vars filter.
	 *
	 * @param $vars Added by the filter.
	 *
	 * @return array
	 */
	public function add_query_vars( $vars ) {
		$vars[] = 'mm-fso';

		return $vars;
	}

	/**
	 * Checks the query string for our custom parameter and gives it to us.
	 *
	 * @return bool|string False if query string parameter isn't there; shipping options if it is.
	 */
	public function get_shipping_from_query() {
		global $wp_query;
		if ( isset( $wp_query->query_vars['mm-fso'] ) ) {
			return $shipping = urldecode( $wp_query->query_vars['mm-fso'] );
		}

		return false;
	}

	/**
	 * Show a warning notice if this plugin is activated without MemberMouse Platform.
	 */
	public function admin_notice() {
		?>
		<div class="error">
			<p><?php _e( 'MemberMouse Platform plugin must be installed and activated before you can use Custom Shipping Options for MemberMouse.', 'mm-shipping-options' ); ?></p>
		</div>
	<?php
	}

}

$mm_cso = new MorganEstes_MemberMouse();
