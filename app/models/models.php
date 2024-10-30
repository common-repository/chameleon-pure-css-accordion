<?php
if ( ! defined( 'ABSPATH' ) ){ exit; }
if ( !function_exists( 'chameleon_query_taxonomies' ) ) {
	function chameleon_query_taxonomies( $id ){
		preg_match_all( '/(\d+)/s', $id, $pockets );
		$pockets = $pockets[0];
		foreach( $pockets as $key => $pocket ){
			$count_id[]  = '%d';
		}
		$ids_placeholders = implode( ', ', $count_id );
		$sql_id = esc_sql( $pockets );
		global $wpdb;
		if( !is_front_page() ){
			$current_id = esc_sql( get_the_ID() );
		}else{ 
			$current_id = esc_sql( (int)1 ); 
		}
		$prepare_taxonomies = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE ID !=$current_id AND ID IN (SELECT object_id FROM $wpdb->term_relationships WHERE object_id !=$current_id AND term_taxonomy_id IN ($ids_placeholders)) ORDER BY post_modified DESC ", $sql_id );
		$query_taxonomies   = $wpdb->get_results( $prepare_taxonomies, ARRAY_A );
		if( 0 < count( $query_taxonomies )  ){ 
			$wpdb->flush();
			return $query_taxonomies;
		}else{
			return;
		}
	}
}

if ( !function_exists( 'chameleon_shortcode_searcher' ) ) {
	function chameleon_shortcode_searcher( $item, $has_shortcode, $chameleon_shortcode, $chameleon_post_content ){
		if( has_shortcode( $chameleon_post_content, $has_shortcode ) ){
			$pattern = get_shortcode_regex();
			if( preg_match_all( '/'. $pattern .'/s', $chameleon_post_content, $matches )
			&& array_key_exists( 2, $matches )
			&& in_array( $has_shortcode, $matches[2] )
			){
				foreach ( $matches[3] as $match ){
					if( preg_match( '/item=\D(\d+)/s', $match, $pocket_item ) ){
						$item_num = $pocket_item[1];
						if( $item_num == $item ){
							if(  preg_match( $chameleon_shortcode, $match, $pocket ) ){
								$chameleon_item_option = $pocket[1];
							}
						}
					}
				}
			}
			if( isset( $chameleon_item_option ) )return $chameleon_item_option;
		}else{ return false; }
	}
}
if ( !function_exists( 'chameleon_kit_shortcode_items' ) ) {
	function chameleon_kit_shortcode_items( $array_atts, $query_taxonomy ){
		static $counter = 0; 
		if( isset($array_atts['limit'])){ $limit = esc_attr( (int) ( $array_atts['limit'] ) ); }
		$read_more = stripos( $query_taxonomy['post_content'],'<!--more-->' );
		
		$item = esc_attr( (int) ( $array_atts['item'] ) );
		$chameleon_kit_shortcode_item_num = '/item=\D(\d+)/s';
		$chameleon_kit_item_num = chameleon_shortcode_searcher( $item, "chameleon_kit", $chameleon_kit_shortcode_item_num,  $query_taxonomy['post_content'] );
		
		if( $chameleon_kit_item_num == $item || ( 'draft' == $query_taxonomy['post_status'] && $chameleon_kit_item_num == $item ) ) {  
			$chameleon_kit_shortcode_order_num   = '/order=\D(\d+)/s';
			$chameleon_kit_shortcode_order_last  = '/order=\D(last)/s';	
			$chameleon_kit_shortcode_item_height = '/height=\D(\d+)/s';
			$shortcode_num = $item;
			$item_order_num  = chameleon_shortcode_searcher( $item, "chameleon_kit", $chameleon_kit_shortcode_order_num,   $query_taxonomy['post_content'] );
			$item_order_last = chameleon_shortcode_searcher( $item, "chameleon_kit", $chameleon_kit_shortcode_order_last,  $query_taxonomy['post_content'] );
			$item_height     = chameleon_shortcode_searcher( $item, "chameleon_kit", $chameleon_kit_shortcode_item_height, $query_taxonomy['post_content'] );
			
			if( isset( $item_order_num ) ){ 
				$array_orders = $item_order_num; 
			}elseif( isset( $item_order_last ) ){
				$array_orders = $item_order_last; 
			}else{ 
				$array_orders = "unordered"; 
			}
		}else{
			$shortcode_num = false;
			if( 'draft' == $query_taxonomy['post_status'] ){
				$shortcode_num = "draft";
			}
			if( !isset( $item_height ) ){   $item_height   = false; }
			if( !isset( $array_orders ) ){ 
				if( !isset( $limit ) || '' == $limit ){
			
					$array_orders  = 'unordered';
				
				}else if( 0 == $limit ){
			
					$array_orders  = 'deleted';
				
				}else if( 0 < $limit ){ 
			
					$array_orders  = "limited";
				}
			}
		}
		$shortcode_items = array( $shortcode_num, $item_height, $read_more, $array_orders, ++$counter, $query_taxonomy['ID'] );
		
		return $shortcode_items;
	}
}

if ( !function_exists( 'chameleon_get_items' ) ) {
	function chameleon_get_items( $array_atts ){
		$id = esc_attr( $array_atts['id'] ); $item = esc_attr( (int) ( $array_atts['item'] ) );
		$query_taxonomies = chameleon_query_taxonomies( $id );
		if( 0 < count($query_taxonomies)){							
			$posts_counter = 0;	$limited_item_counter = 0;
			$ordered[]="";   unset( $ordered[0] );
			$unordered[]=""; unset( $unordered[0] );
			foreach( $query_taxonomies as $query_taxonomy ){
				if($query_taxonomy['post_status'] == 'trash' || 0 == strlen($query_taxonomy['post_content']) ){
					//return false; 
				}else{
					$shortcode_items = chameleon_kit_shortcode_items( $array_atts, $query_taxonomy );
					$items_order_array = $shortcode_items[3];
					if( 'deleted' <> $items_order_array ){

						$counter = $shortcode_items[4];
				
						if( 'unordered'	== $items_order_array ){ 
						
							++$posts_counter; 										$unordered_item_flag = 1; 
							$unordered[$counter] = $shortcode_items;
							
						}elseif( 'limited'	== $items_order_array ){
							$limit = esc_attr( (int) ( $array_atts['limit'] ) );
							if( $posts_counter < $limit ){
								++$posts_counter;									++$limited_item_counter; 
								$limited[$counter] = $shortcode_items;
							}
						}elseif( 'last' == $items_order_array ){
							
							++$posts_counter; 										$last_item_flag 	= 1; 
							$last = $shortcode_items;
						}else{
							if( !array_key_exists( $items_order_array, $ordered ) ){
								++$posts_counter; 									$ordered_item_flag 	= 1; 
								$ordered[$items_order_array] = $shortcode_items;
							}else{ 
								++$posts_counter;									$ordered_item_flag 	= 1;
								$ordered[$items_order_array + 1] = $shortcode_items;
							}
						}
						
						if( isset( $limit ) && $posts_counter > $limit && 0 < $limited_item_counter ){
								
							array_pop( $limited ); 			--$posts_counter;		--$limited_item_counter;
						}
					}	
				} 
			}
			
			if( 0 < $limited_item_counter ){
				if( isset( $unordered_item_flag ) ){
					$unordered_array = $limited + $unordered;
				}
				else{
					$unordered_array = $limited;
				}
			}else{	$unordered_array = $unordered; }

			if( isset( $unordered_array ) ){
				foreach( $unordered_array as $key => $get_order ){
					
					$ordered[chameleon_first_free_key( $ordered )] = $get_order;
					
					$ordered_item_flag = 1;
				}
			}
			
			if( isset( $last_item_flag ) ){
				if( isset( $ordered_item_flag ) ){
					array_push( $ordered, $last );
					$ordered_item_flag = 1;
				}else{ $ordered[] = $last;	$ordered_item_flag = 1; }
			}
			
			ksort( $ordered );
			if( isset( $ordered_item_flag ) ) {
				return $ordered; 
			}else{ return false; } 
		}else{ return false; } 
	}
}

if( !function_exists( 'chameleon_first_free_key' ) ){
	function chameleon_first_free_key( $ordered_item ){
		$i = 1;
		while( isset( $ordered_item[$i] ) ) $i++;
		return $i;
	}
}