<?php

		if( have_posts() ) : while ( have_posts() ) : the_post();
			global $product;
			global $post;
			global $woocommerce;
			
			$id = get_the_ID();
			$allproduct = wc_get_product( get_the_ID() );
			
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0];
			$imageresize = shopwise_resize( $image_src, 304, 173, true, true, true );

			$cart_url = wc_get_cart_url();
			$price = $allproduct->get_price_html();
			$weight = $product->get_weight();
			$stock_status = $product->get_stock_status();
			$stock_text = $product->get_availability();
			$rating = wc_get_rating_html($product->get_average_rating());
			$ratingcount = $product->get_review_count();
			$wishlist = get_theme_mod( 'shopwise_wishlist_button', '0' );
			$compare = get_theme_mod( 'shopwise_compare_button', '0' );
			$quickview = get_theme_mod( 'shopwise_quick_view_button', '0' );

			$output .= '<div class="'.esc_attr($settings['column']).' col-md-4 col-6">';
			
			$output .= '<div class="klb-product2 product_box text-center">';
			$output .= '<div class="product_img">';
			$output .= '<a href="'.get_permalink().'">';
			$output .= '<img src="'.esc_url($image_src).'" alt="product_img1">';
			$output .= '</a>';
			$output .= '<div class="product_action_box">';
			$output .= '<ul class="list_none pr_action_btn">';
			if($compare == '1'){
			$output .= '<li>'.do_shortcode('[yith_compare_button]').'</li>';
			}
			if($quickview == '1'){
			$output .= '<li><a href="#" class="button detail-bnt" id="'.$product->get_id().'"><i class="icon-magnifier-add"></i></a></li>';
			}
			if($wishlist == '1'){
			$output .= '<li>'.do_shortcode('[ti_wishlists_addtowishlist]').'</li>';
			}
			$output .= '</ul>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="product_info">';
			$output .= '<h6 class="product_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h6>';
			$output .= '<div class="product_price">';
			$output .= $price;
			$output .= '</div>';
			$output .= '<div class="rating_wrap">';
			$output .= $rating;
			if($ratingcount){
			$output .= '<span class="rating_num">('.esc_html($ratingcount).')</span>';
			}
			$output .= '</div>';
			$output .= '<div class="pr_desc">';
			$output .= '<p>'.get_the_excerpt().'</p>';
			$output .= '</div>';
			$output .= '<div class="add-to-cart">';
			$output .= shopwise_add_to_cart_button();
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			
			$output .= '</div>';


		endwhile;
		$output .= '</div>';
		if($settings['disable_pagination'] != 'yes'){
			$output .= '<div class="row">';
			$output .= '<div class="col-12">';
			
			ob_start();
			get_template_part( 'post-format/pagination' );
			$output .= '<div class="col-md-12">'. ob_get_clean().'</div>';

			$output .= '</div>';
			$output .= '</div>';
		}
		wp_reset_query();
		endif;