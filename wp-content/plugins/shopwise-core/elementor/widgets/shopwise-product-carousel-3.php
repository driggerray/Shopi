<?php

namespace Elementor;

class Shopwise_Product_Carousel_3_Widget extends Widget_Base {
    use Shopwise_Helper;

    public function get_name() {
        return 'shopwise-product-carousel-3';
    }
    public function get_title() {
        return 'Product Carousel 3 (K)';
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
		
		$this->add_control( 'product_type',
			[
				'label' => esc_html__( 'Product Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-column' => esc_html__( 'Select Type', 'shopwise' ),
					'type1'	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'	  => esc_html__( 'Type 2', 'shopwise' ),
				],
			]
		);
		
		$this->add_control( 'title_type',
			[
				'label' => esc_html__( 'Title Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-column' => esc_html__( 'Select Type', 'shopwise' ),
					'type1'	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'	  => esc_html__( 'Type 2', 'shopwise' ),
				],
			]
		);
		
		$this->add_control( 'arrow_type',
			[
				'label' => esc_html__( 'Arrow Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'nav_style4',
				'options' => [
					'select-column' => esc_html__( 'Select Type', 'shopwise' ),
					'nav_style1'	  => esc_html__( 'Nav Style 1', 'shopwise' ),
					'nav_style2'	  => esc_html__( 'Nav Style 2', 'shopwise' ),
					'nav_style3'	  => esc_html__( 'Nav Style 3', 'shopwise' ),
					'nav_style4'	  => esc_html__( 'Nav Style 4', 'shopwise' ),
					'nav_style5'	  => esc_html__( 'Nav Style 5', 'shopwise' ),
				],
			]
		);
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Trending Items',				
            ]
        );
		
        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Subtitle here',
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
			if($settings['title_type'] == 'type2'){
				$output .= '<div class="row justify-content-center">';
				$output .= '<div class="col-md-6">';
				$output .= '<div class="heading_s4 text-center">';
				$output .= '<h2>'.esc_html($settings['title']).'</h2>';
				$output .= '</div>';
				$output .= '<p class="text-center leads">'.esc_html($settings['subtitle']).'</p>';
				$output .= '</div>';
				$output .= '</div>';
			} else {
				$output .= '<div class="row justify-content-center">';
				$output .= '<div class="col-md-6">';
				$output .= '<div class="heading_s3 text-center">';
				$output .= '<h2>'.esc_html($settings['title']).'</h2>';
				$output .= '</div>';
				$output .= '<div class="small_divider clearfix"></div>';
				$output .= '</div>';
				$output .= '</div>';
			}
		}
		$output .= '<div class="row">';
		$output .= '<div class="col-md-12">';
		$output .= '<div class="shop_container product_slider carousel_slider owl-carousel owl-theme '.esc_attr($settings['arrow_type']).'" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive=\'{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}\'>';
			
		if( have_posts() ) : while ( have_posts() ) : the_post();

			$output .= '<div class="item">';
			
			if($settings['product_type'] == 'type2'){
				$output .= shopwise_product_type2();
			} else {
				$output .= shopwise_product_type1();
			}
			
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
