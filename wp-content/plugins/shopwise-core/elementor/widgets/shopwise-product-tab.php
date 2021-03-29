<?php

namespace Elementor;

class Shopwise_Product_Tab_Widget extends \Elementor\Widget_Base {
    use Shopwise_Helper;
    public function get_name() {
        return 'shopwise-product-tab';
    }
    public function get_title() {
        return 'Product Tab (K)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'shopwise' ];
    }

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Products', 'shopwise' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Exclusive Products',				
            ]
        );
		
        // Posts Per Page
        $this->add_control( 'post_count',
            [
                'label' => esc_html__( 'Posts Per Page', 'shopwise' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'product', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 4
            ]
        );
		
        $this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Filter Category', 'shopwise' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->shopwise_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
				'label_block' => true,
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$output = '';
		$cat_filter = '';
		$section_title = '';
		
		$section_title .= '<div class="row justify-content-center">';
		$section_title .= '<div class="col-md-6">';
		$section_title .= '<div class="heading_s1 text-center">';
		$section_title .= '<h2>'.esc_html($settings['title']).'</h2>';
		$section_title .= '</div>';
		$section_title .= '</div>';
		$section_title .= '</div>';
		
		$include = array();
		$exclude = array();
		
		$portfolio_filters = get_terms(array(
			'taxonomy' => 'product_cat',
			'include' => $settings['cat_filter'],
		));
		
		if($portfolio_filters){
			$cat_filter .= '<div class="tab-style1">';
			$cat_filter .= '<ul class="nav nav-tabs justify-content-center" role="tablist">';
			
			$number = 0;
			foreach($portfolio_filters as $portfolio_filter){
				if($number == 0){
					$filteractive = 'active';
				} else {
					$filteractive = '';
				}
				
				$cat_filter .= '<li class="nav-item">';
				$cat_filter .= '<a class="nav-link '.esc_attr($filteractive).'" id="'.esc_attr($portfolio_filter->slug).'-tab" data-toggle="pill" href="#'.esc_attr($portfolio_filter->slug).'" role="tab" aria-controls="'.esc_attr($portfolio_filter->slug).'" aria-selected="true">';
				$cat_filter .= esc_html($portfolio_filter->name);
				$cat_filter .= '</a>';
				$cat_filter .= '</li>';
				
				$number++;
			}
			$cat_filter .= '</ul>';
			$cat_filter .= '</div>';

		}
		
		$count = '';
		foreach($portfolio_filters as $portfolio_filter){
			if($count == 0){
				$active = 'show active';
			} else {
				$active = '';
			}
			
			
			
				$output .= '<div class="tab-pane fade '.esc_attr($active).'" id="'.esc_attr($portfolio_filter->slug).'" role="tabpanel" aria-labelledby="'.esc_attr($portfolio_filter->slug).'-tab">';
				$output .= '<div class="row shop_container">';
				$posts = get_posts(
					array(
						'post_type' => 'product',
						'numberposts' => $settings['post_count'],
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => $portfolio_filter->slug,
								'operator' => 'IN',
							)
						 )
					)
				);
				
				foreach ( $posts as $post_object ) {
					setup_postdata( $GLOBALS['post'] =& $post_object );

					$id = get_the_ID();
					global $product;
					global $post;
					global $woocommerce;
					
					$rating = wc_get_rating_html($product->get_average_rating()); //get rating
					$ratingcount = $product->get_review_count(); //get rating
					

					$cart_url = wc_get_cart_url();
					$price = $product->get_price_html();
					$sale_price_dates_to    = ( $date = get_post_meta( $id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
					$stock_status = $product->get_stock_status();
					$stock_text = $product->get_availability();
					$weight = $product->get_weight();
					$wishlist = get_theme_mod( 'shopwise_wishlist_button', '0' );
					$compare = get_theme_mod( 'shopwise_compare_button', '0' );

					$att=get_post_thumbnail_id();
					$image_src = wp_get_attachment_image_src( $att, 'full' );
					$image_src = $image_src[0];
					$imageresize = shopwise_resize( $image_src, 150, 80, true );  


					$output .= '<div class="col-lg-3 col-md-4 col-6">';
					$output .= '<div class="product">';
					if ( $product->is_on_sale() && $product->is_type( 'variable' ) ) {
					$output .= '<span class="pr_flash bg-success">-'.ceil(100 - ($product->get_variation_sale_price( 'max' ) / $product->get_variation_regular_price( 'min' )) * 100).'%</span>';
					} elseif( $product->is_on_sale() && !$product->is_type( 'grouped' ) ) {
					$output .= '<span class="pr_flash bg-success">-'.ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100).'%</span>';
					}
					$output .= '<div class="product_img">';
					$output .= '<a href="'.get_permalink().'">';
					$output .= '<img src="'.esc_url($image_src).'" alt="product_img1">';
					$output .= '</a>';
					$output .= '<div class="product_action_box">';
					$output .= '<ul class="list_none pr_action_btn">';
					$output .= '<li class="add-to-cart">'.shopwise_add_to_cart_button().'</li>';
					if($compare == '1'){
					$output .= '<li>'.do_shortcode('[yith_compare_button]').'</li>';
					}
					$output .= '<li><a href="'.$product->get_id().'" class="button detail-bnt"><i class="icon-magnifier-add"></i></a></li>';
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
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					
				}
			
				wp_reset_postdata();
				
				$output .= '</div>';
				$output .= '</div>';
				$count++;

		}
		wp_reset_query();
		
	  echo  '<div class="klb-section">
				 <div class="container">
					'.$section_title.'
					<div class="row">
						<div class="col-12">
							'.$cat_filter.'
							<div class="tab-content">
								'.$output.'
							</div>
						</div>
					</div>
				</div>
			</div>';
	}

}
