<?php
if ( ! defined( 'ABSPATH' ) ){ exit; }

if ( !function_exists( 'chameleon_accordion_show_html' ) ){
	function chameleon_accordion_show_html( $array_items ){
		$array_atts = $array_items[0];
		$array_order_items = $array_items[1];
		if( isset($array_atts['tag']) ){
			$tag = esc_attr( $array_atts['tag'] );
		}else{
			$tag = 'p';
		}
		$chameleon_accordion = '';
				
		foreach( $array_order_items as $key => $items ){
			if( isset( $items[5] ) && 0 < $items[5] ){
				$post_args = get_post($items[5]); 
				$item_height = esc_attr( $items[1] );
				$counter = $items[4];
				$read_more = $items[2];
				if( "draft" <> $items[0]){
					$chameleon_accordion .= '
					<div class = "chameleon-accordion" >';
						$post_title = '
						<'.$tag.' class = "widget-title" >'.sprintf( __( '%s' ), $post_args->post_title ).'</'.$tag.'>';
						if( false == $item_height || (int)215 > $item_height){
							$chameleon_accordion .= '
							<input type = "checkbox" id = "chameleon_check_id'.$counter.'" ><label for = "chameleon_check_id'.$counter.'" ></label>';
						}
						$chameleon_accordion .= '
							<div class = "accordion-item" id = "accordion-item'.$counter.'"  >';
							if( $post_args->post_status == 'publish' ){
								$post_title = '
								<a class="widget-title" href = "'.esc_url( get_permalink( $post_args->ID ) ).'" >'.$post_title.'</a>';
								$chameleon_accordion .= $post_title;
							}else{
							
								$chameleon_accordion .= '<a>'.$post_title.'</a>'; 
							} 
							if( $post_args->post_status == 'publish' && ( 0 < $read_more ) ){
								$chameleon_accordion .= do_shortcode( substr_replace( $post_args->post_content,'<center>'.'
								<a class = "more-link"  href = "'.esc_url( get_permalink( $post_args->ID ) ).'" > &#8674; '.sprintf( __( 'Continue reading %s' ).' &#8672; ', '
									<span class = "screen-reader-text" >' . $post_args->post_title . '</span>' ).'
								</a></center>', $read_more ,strlen( $post_args->post_content ) ) );
							}else{
							
								$chameleon_accordion .= do_shortcode( $post_args->post_content );
							}
								$chameleon_accordion .= '
							</div>
					</div>';
				}
			}
		}
		if( 0 < strlen( $chameleon_accordion ) ){ 
			$out = '<div class="chameleon-container" >';
			if( isset( $array_atts['title'] ) ){
				$out .= "
				<h3 class='widget-title' >".sprintf( __( '%s' ), esc_attr( $array_atts['title'] ) )."</h3>";
			}
			$out .= $chameleon_accordion.'</div>';
				wp_reset_postdata();
			if( isset( $post_args ) && 0 < count( $post_args ) ){
				wp_enqueue_style( 'chameleon-accordion-style' );
				return $out;
			}else{ return false; }
		}else{ return false; }
	}
}