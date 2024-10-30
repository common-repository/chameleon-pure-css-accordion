<?php 
/*

Plugin Name: Chameleon Pure CSS Accordion
Author: V. Taran
Author uri: http://alterbid.com
Description:  Add any posts to the accordion by categories and tags / CSS only, without javascript code
Version: 1.0 

*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( !class_exists( 'Chameleon_accordion_main_class' ) ) {
	class Chameleon_accordion_main_class {

		public function __construct(){
			add_action('init',array(&$this,'chameleon_accordion_init_shortcodes'));
			// Enable shortcodes in text widgets
			add_filter( 'widget_text', 'shortcode_unautop' );
			add_filter( 'widget_text','do_shortcode' );
			add_action( 'wp_enqueue_scripts',array( &$this,'Chameleon_accordion_script' ) );
		}
		function chameleon_accordion_init_shortcodes() {
			include_once ( plugin_dir_path( __FILE__ ).'/app/views/shortcodes.php' );
		}
		function Chameleon_accordion_script(){
			wp_register_style( 'chameleon-accordion-style', PLUGINS_URL( 'app/public/css/chameleon-accordion-style.css', __FILE__ ) );
		}
	}
	new Chameleon_accordion_main_class();
}