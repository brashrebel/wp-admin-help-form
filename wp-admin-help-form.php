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
class WP_Admin_Help_Form
{
	public $tabs = array(
		// The assoc key represents the ID
		// It is NOT allowed to contain spaces
		 'SendEmail' => array(
		 	 'title'   => 'Send E-Mail to Admin'
		 	,'content' => ''
		 )
	);

	static public function init()
	{
		$class = __CLASS__ ;
		new $class;
	}

	public function __construct()
	{
		add_action( "load-{$GLOBALS['pagenow']}", array( $this, 'add_tabs' ), 1 );
	}

	public function add_tabs()
	{
    global $current_user;
    get_currentuserinfo();
		foreach ( $this->tabs as $id => $data )
		{
			get_current_screen()->add_help_tab( array(
				 'id'       => $id
				,'title'    => __( $data['title'], 'some_textdomain' )
				// Use the content only if you want to add something
				// static on every help tab. Example: Another title inside the tab
				,'content'  => '<p>Logged in as: '. $current_user->user_email .'</p>'
				,'callback' => array( $this, 'display' )
			) );
		}
	}

	public function display( $screen, $tab )
	    {
	    	printf(
			 '<p>Form Can Go Here</p>'
			,__(
	    			 $tab['callback'][0]->tabs[ $tab['id'] ]['content']
				,'dmb_textdomain'
			 )
		);
	}
}
// Always add help tabs during "load-{$GLOBALS['pagenow'}".
// There're some edge cases, as for example on reading options screen, your
// Help Tabs get loaded before the built in tabs. This seems to be a core error.
add_action( 'current_screen', array( 'WP_Admin_Help_Form', 'init' ) );
