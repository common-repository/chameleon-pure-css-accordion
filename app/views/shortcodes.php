<?php
if ( ! defined( 'ABSPATH' ) ){ exit; }
function chameleonitem_shortcode($atts, $content) {
    $atts = shortcode_atts(
		array(
			'item'  => '',
			'height'=> '',
			'order' => '',
		),
		$atts,
		'chameleon_kit'
	);
	// Attributes in var
	if ( !empty( $atts['item'] ) )	  { $item_num    = sanitize_key( $atts['item'] ); } else{ return false; } 
	if ( !empty( $atts['height'] ) )  { $item_height = sanitize_html_class( $atts['height'] ); }
	if ( !empty( $atts['order'] ) )   { $order 	     = sanitize_key( $atts['order'] ); }
}
add_shortcode( 'chameleon_kit', 'chameleonitem_shortcode' );
function chameleonaccordion_shortcode( $atts, $content ) {
	// Attributes
	$null = (int)(-1);
	$atts = shortcode_atts(
		array(
			'item'   => '',
			'title'  => '',
			'tag'    => '',
			'id'     => '',
			'height' => '',
			'limit'  => $null,
		),
		$atts,
		'chameleon_accordion'
	);
	// Attributes in var
	if ( !empty( $atts['item'] ) )	 { $array_atts['item']   = sanitize_key( $atts['item'] ); } 		else{ return false; }
	if ( !empty( $atts['id'] ) )	 { $array_atts['id']     = sanitize_text_field( $atts['id'] ); }    else{ return false; }
	if ( !empty( $atts['height'] ) ) { $array_atts['height'] = sanitize_html_class( $atts['height'] ); }
	if ( $null<( $atts['limit'] ) )  { $array_atts['limit']  = sanitize_key( $atts['limit'] ); }
	if ( !empty( $atts['title'] ) )	 { $array_atts['title']  = sanitize_text_field( $atts['title'] ); }
	if ( !empty( $atts['tag'] ) )    { $array_atts['tag'] 	 = sanitize_html_class( $atts['tag'] ); }
	
	if( 0 < strlen( $array_atts['id'] ) && 0 < strlen( $array_atts['item'] ) ){
		include( plugin_dir_path( __DIR__ ) . '/controllers/chameleon-accordion-controller.php' );
		
		$accordion_html = chameleon_accordion_html( $array_atts );
		if( 0 < count( $accordion_html ) ){
			return $accordion_html;
		}else{ return; }
	}else{ return; }
	
}
add_shortcode( 'chameleon_accordion', 'chameleonaccordion_shortcode', 96 );