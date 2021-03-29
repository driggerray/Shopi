<?php

namespace Elementor;

class Shopwise_Product_Tab_Carousel_Widget extends \Elementor\Widget_Base {
    use Shopwise_Helper;
    public function get_name() {
        return 'shopwise-product-tab-carousel';
    }
    public function get_title() {
        return 'Product Tab Carousel (K)';
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
		
		$this->add_control( 'product_type',
			[
				'label' => esc_html__( 'Product Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
					'type3'		  => esc_html__( 'Type 3', 'shopwise' ),
				],
			]
		);
		
		$this->add_control( 'carousel_type',
			[
				'label' => esc_html__( 'Carousel Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
				],
			]
		);
		
		$this->add_control( 'title_type',
			[
				'label' => esc_html__( 'Title Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
				],
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
                'default' => 5
            ]
        );
		
        $this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Filter Category', 'shopwise' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->shopwise_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
            ]
        );

        // Display Item on Desktop
        $this->add_control( 'display_item',
            [
                'label' => esc_html__( 'Display Item', 'shopwise' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'default' => 4
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$output = '';
		$cat_filter = '';
		$section_title = '';
		

		$section_title .= '<div class="heading_s2">';
		if($settings['title_type'] == 'type2'){
		$section_title .= '<h4>'.esc_html($settings['title']).'</h4>';
		} else {
		$section_title .= '<h2>'.esc_html($settings['title']).'</h2>';
		}
		$section_title .= '</div>';

		
		$include = array();
		$exclude = array();
		
		$portfolio_filters = get_terms(array(
			'taxonomy' => 'product_cat',
			'include' => $settings['cat_filter'],
		));
		
		if($portfolio_filters){ 
			$cat_filter .= '<div class="tab-style2">';
			$cat_filter .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tabmenubar" aria-expanded="false">';
			$cat_filter .= '<span class="ion-android-menu"></span>';
			$cat_filter .= '</button>';
			$cat_filter .= '<ul class="nav nav-tabs justify-content-center justify-content-md-end" id="tabmenubar" role="tablist">';
			
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
				$active = 'active show';
			} else {
				$active = '';
			}
				$output .= '<div class="tab-pane fade '.esc_attr($active).'" id="'.esc_attr($portfolio_filter->slug).'" role="tabpanel" aria-labelledby="'.esc_attr($portfolio_filter->slug).'-tab">';
				
				if($settings['carousel_type'] == 'type2'){
				$output .= '<div class="shop_container product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-dots="true" data-margin="20" data-responsive=\'{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "'.esc_attr($settings['display_item']).'"}}\'>';
				} else {
				$output .= '<div class="shop_container product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive=\'{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "'.esc_attr($settings['display_item']).'"}}\'>';
				}
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
					$imageresize = shopwise_resize( $image_src, 248, 275, true );  


					$output .= '<div class="item">';
					if($settings['product_type'] == 'type3'){
						
						$output .= shopwise_product_type3();
						
					} elseif($settings['product_type'] == 'type2'){
						
						$output .= shopwise_product_type2();

					} else {
						
						$output .= shopwise_product_type1();

					}

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
					<div class="row">
						<div class="col-12">
							<div class="heading_tab_header">
								'.$section_title.'
								'.$cat_filter.'
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="tab_slider">
								'.$output.'
							</div>
						</div>
					</div>
				</div>
			</div>';
	}

}
