<?php

namespace Elementor;

class Shopwise_Product_Carousel_2_Widget extends Widget_Base {
    use Shopwise_Helper;

    public function get_name() {
        return 'shopwise-product-carousel-2';
    }
    public function get_title() {
        return 'Product Carousel 2 (K)';
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
				'label' => esc_html__( 'Content', 'shopwise' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
                'default' => 'Featured Products',				
            ]
        );
		
		$this->add_control( 'title_tag',
			[
				'label' => esc_html__( 'Title Tag', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'select-column' => esc_html__( 'Select Type', 'shopwise' ),
					'h1'	  => esc_html__( 'H1', 'shopwise' ),
					'h2'	  => esc_html__( 'H2', 'shopwise' ),
					'h3'	  => esc_html__( 'H3', 'shopwise' ),
					'h4'	  => esc_html__( 'H4', 'shopwise' ),
					'h5'	  => esc_html__( 'H5', 'shopwise' ),
					'h6'	  => esc_html__( 'H6', 'shopwise' ),
				],
			]
		);
		
		$this->add_control(
			'due_date',
			[
				'label' => __( 'Due Date', 'plugin-domain' ),
				'type' => Controls_Manager::DATE_TIME,
				'condition' => ['title_type' => 'type2']
			]
		);
		
        // Posts Per Page
        $this->add_control( 'post_count',
            [
                'label' => esc_html__( 'Posts Per Page', 'shopwise' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'product', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 10
            ]
        );
		
        $this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Filter Category', 'shopwise' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->shopwise_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'default' => 'all',
                'label_block' => true,
            ]
        );
		
        $this->add_control( 'post_include_filter',
            [
                'label' => esc_html__( 'Include Post', 'shopwise' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->shopwise_cpt_get_post_title('product'),
                'description' => 'Select Post(s) to Include',
                'label_block' => true,
            ]
        );
		
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'shopwise' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'shopwise' ),
                    'DESC' => esc_html__( 'Descending', 'shopwise' )
                ],
                'default' => 'DESC'
            ]
        );
		
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'shopwise' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'shopwise' ),
                    'menu_order' => esc_html__( 'Menu Order', 'shopwise' ),
                    'rand' => esc_html__( 'Random', 'shopwise' ),
                    'date' => esc_html__( 'Date', 'shopwise' ),
                    'title' => esc_html__( 'Title', 'shopwise' ),
                ],
                'default' => 'date',
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$output = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
	
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $settings['post_count'],
			'order'          => 'DESC',
			'post_status'    => 'publish',
			'paged' 			=> $paged,
            'post__in'       => $settings['post_include_filter'],
            'order'          => $settings['order'],
			'orderby'        => $settings['orderby']
		);
	
		if($settings['cat_filter']){
			$args['tax_query'][] = array(
				'taxonomy' 	=> 'product_cat',
				'field' 	=> 'term_id',
				'terms' 	=> $settings['cat_filter']
			);
		}
	
	query_posts( $args );
		?>
		
		<?php
		
		$output .= '<div class="klb-section">';
		$output .= '<div class="container">';
		$output .= '<div class="row">';
		$output .= '<div class="col-md-12">';
		$output .= '<div class="heading_tab_header">';
		$output .= '<div class="heading_s2">';
		$output .= '<'.esc_attr($settings['title_tag']).'>'.esc_html($settings['title']).'</'.esc_attr($settings['title_tag']).'>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="row">';
		$output .= '<div class="col-md-12">';
		$output .= '<div class="product_slider product_list carousel_slider owl-carousel owl-theme nav_style3" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive=\'{"0":{"items": "1"}, "767":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "3"}}\'>';
		
		$i = 1;
		$count = 0;
		if( have_posts() ) : while ( have_posts() ) : the_post();
			global $product;
			global $post,$wp_query;
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

			if($i == 1 || $count % 3 == 0){
			$output .= '<div class="item">';
			}
			$output .= '<div class="product">';
			$output .= '<div class="product_img">';
			$output .= '<a href="'.get_permalink().'">';
			$output .= '<img src="'.esc_url($image_src).'" alt="product_img1">';
			$output .= '</a>';
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
			$output .= '</div>';
			$output .= '</div>';
			if($i % 3 == 0 || ($wp_query->current_post +1) == ($wp_query->post_count)){
			$output .= '</div>';
			}

			$i++;
			$count++;
		endwhile;
		wp_reset_query();
		endif;
		
		
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';


		
		echo $output;
	}

}
