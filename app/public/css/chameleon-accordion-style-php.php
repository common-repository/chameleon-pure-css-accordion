<?php
if ( ! defined( 'ABSPATH' ) ){ exit; }
if( !function_exists( 'chameleon_accordion_style_php' ) ) {
	function chameleon_accordion_style_php( $array_items ){
		if( isset( $array_items[0]['height']) ){ 
			$height = esc_attr( $array_items[0]['height'] );
		}else{ 
			$height = (int)45;
		}
		$array_style_atts = $array_items[1];
		wp_enqueue_style( 'chameleon-accordion-style', 'chameleon-accordion-style.css' );
		
		$style_php  ='';
		foreach( $array_style_atts as $key => $style_atts ){
			if( "draft" <> $style_atts[0] ){
				$max_height_read_more	= (int)9999;
				$counter				= (int)$style_atts[4];
				$item_height			= esc_attr( $style_atts[1] );
				if(false == $item_height){
					$item_height		= $height;
				}
				if( $item_height > (int)215  ){
					$max_height = $max_height_read_more;
				}else{
					$max_height = $item_height + 150;
				}
				$style_php .= "
	
				.chameleon-container .chameleon-accordion:hover #accordion-item{$counter}{
					overflow: hidden;
					height: auto;
					max-height: {$max_height}px;
					transition: max-height 1s;
					transition-timing-function: cubic-bezier(0.00, 0.0, 1.00, 1.00);
					transition: all 1s;
					transition-delay: 0.5s;
				}

				.chameleon-container .chameleon-accordion  #accordion-item{$counter}{
					overflow: hidden;
					height: auto;
					max-height: {$item_height}px;
					transition: max-height 6s;
					transition: all 6s; 
					transition-delay: 2s;
				}

				.chameleon-container .chameleon-accordion [id^='chameleon_check_id']:checked ~ #accordion-item{$counter}{
					padding-bottom: 50px;
					height: auto;
					max-height: {$max_height_read_more}px;
					transition: max-height 30s;
					transition: all 30s; 
				}

				";
			}
		}
		wp_add_inline_style( 'chameleon-accordion-style', wp_strip_all_tags( $style_php ) );
	}
}