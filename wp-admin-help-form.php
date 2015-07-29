<?php
/*
Plugin Name: WP Admin Help Form
Plugin URI: http://realbigplugins.com
Description: Adds a simple contact form to the wp-admin contextual help menu.
Version: 0.1
Author: Kyle Maurer
Author URI: http://kyleblog.net
License: GPL2
*/

/**
 * Class WP_Admin_Help_Form
 */
class WP_Admin_Help_Form {

	/**
	 * Initialize all the things
	 */
	public function __construct() {
		add_action( 'current_screen', array( $this, 'add_help_tab' ) );
	}

	/**
	* Adds new tab to contextual help menu
	*/
	public function add_help_tab() {
		$screen = get_current_screen();
		$screen->add_help_tab( array(
				'id'       => 'support',
				'title'    => 'Support',
				'content'  => '',
				'callback' => array( $this, 'display' ),
			)
		);
	}

	/**
	 * Display the contents of the new tab
	 */
	public function display() {
		echo 'Form will go here.';
	}

}
$wp_admin_help_form = new WP_Admin_Help_Form();