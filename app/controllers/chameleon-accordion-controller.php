<?php
if ( ! defined( 'ABSPATH' ) ){ exit; }

if ( !function_exists( 'chameleon_accordion_controller' ) ) {
	function chameleon_accordion_controller( $array_atts ){
			include_once( plugin_dir_path( __DIR__ ) . '/models/models.php' );
			$array_orders = chameleon_get_items( $array_atts );
			if( false == ($array_orders)  ){
				return;
			}else{
				$array_items = array($array_atts, $array_orders );
				return $array_items;
			}
	}
}

if ( !function_exists( 'chameleon_accordion_html' ) ) {
	function chameleon_accordion_html( $array_atts ){
		if( isset( $array_atts ) ){
			$array_items = chameleon_accordion_controller( $array_atts );
			if( false == ( $array_items ) ){ 
				return false;
			}else{
				include_once ( plugin_dir_path( __DIR__ ) . '/public/css/chameleon-accordion-style-php.php' );
				include_once ( plugin_dir_path( __DIR__ ) . '/views/chameleon-accordion-show-html.php' );
				$accordion_style = chameleon_accordion_style_php( $array_items );
				$accordion_html  = chameleon_accordion_show_html( $array_items );
				return $accordion_html;
			}
		}else{ return false; }
	}
}