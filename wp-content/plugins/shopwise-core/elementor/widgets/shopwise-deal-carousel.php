<?php

namespace Elementor;

class Shopwise_Deal_Carousel_Widget extends Widget_Base {
    use Shopwise_Helper;

    public function get_name() {
        return 'shopwise-deal-carousel';
    }
    public function get_title() {
        return 'Deal Carousel (K)';
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
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Deal of The Day',				
            ]
        );
		
        // Posts Per Page
        $this->add_control( 'post_count',
            [
                'label' => esc_html__( 'Posts Per Page', 'shopwise' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'product', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 6
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
		if($settings['title']){
			$output .= '<div class="row">';
			$output .= '<div class="col-md-12">';
			$output .= '<div class="heading_tab_header">';
			$output .= '<div class="heading_s2">';
			$output .= '<h4>'.esc_html($settings['title']).'</h4>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}
		$output .= '<div class="row">';
		$output .= '<div class="col-md-12">';
		$output .= '<div class="product_slider carousel_slider owl-carousel owl-theme nav_style3" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive=\'{"0":{"items": "1"}, "650":{"items": "2"}, "1199":{"items": "2"}}\'>';
			
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
			$managestock = $product->managing_stock();
			$stock_text = $product->get_availability();
			$rating = wc_get_rating_html($product->get_average_rating());
			$ratingcount = $product->get_review_count();
			$wishlist = get_theme_mod( 'shopwise_wishlist_button', '0' );
			$compare = get_theme_mod( 'shopwise_compare_button', '0' );
			$sale_price_dates_to    = ( $date = get_post_meta( $id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
			$total_sales = $product->get_total_sales();
			$stock_quantity = $product->get_stock_quantity();

			if($managestock) {
            $percentage = floor($total_sales / (($total_sales + $stock_quantity) / 100)); // yuvarlama
			}

			$output .= '<div class="item">';
			$output .= '<div class="deal_wrap">';
			$output .= '<div class="product_img">';
			$output .= '<a href="'.get_permalink().'" title="'.the_title_attribute( 'echo=0' ).'">';
			$output .= '<img src="'.esc_url($image_src).'" alt="'.the_title_attribute( 'echo=0' ).'">';
			$output .= '</a>';
			$output .= '</div>';
			$output .= '<div class="deal_content">';
			$output .= '<div class="product_info">';
			$output .= '<h5 class="product_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
			$output .= '<div class="product_price">';
			$output .= $price;
			$output .= '</div>';
			$output .= '</div>';
			
			if($managestock) {
			$output .= '<div class="deal_progress">';
			$output .= '<span class="stock-sold">'.esc_html__('Already Sold:','shopwise').' <strong>'.esc_html($total_sales).'</strong></span>';
			$output .= '<span class="stock-available">'.esc_html__('Available:','shopwise').' <strong>'.esc_html($stock_quantity).'</strong></span>';
			$output .= '<div class="progress">';
			$output .= '<div class="progress-bar" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%"> '.$percentage.'% </div>';
			$output .= '</div>';
			$output .= '</div>';
			}
			
			if($sale_price_dates_to){
			$output .= '<div class="countdown_time countdown_style4 mb-4" data-time="'.esc_attr($sale_price_dates_to).'"></div>';
			}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

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
