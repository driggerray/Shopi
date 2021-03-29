<?php

namespace Elementor;

class Shopwise_Product_Carousel_4_Widget extends Widget_Base {
    use Shopwise_Helper;

    public function get_name() {
        return 'shopwise-product-carousel-4';
    }
    public function get_title() {
        return 'Product Carousel 4 (K)';
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
					'type3'	  => esc_html__( 'Type 3', 'shopwise' ),
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
		
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Text', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'View All',
                'pleaceholder' => esc_html__( 'Enter button text here', 'shopwise' ),
            ]
        );
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'shopwise' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'shopwise' )
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
		$target   = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
		
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
			$output .= '<div class="col-12">';
			$output .= '<div class="heading_tab_header">';
			$output .= '<div class="heading_s2">';
			$output .= '<h4>'.esc_html($settings['title']).'</h4>';
			$output .= '</div>';
			$output .= '<div class="view_all">';
			$output .= '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="text_default"><i class="linearicons-power"></i> <span>'.esc_html($settings['btn_title']).'</span></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}
		$output .= '<div class="row">';
		$output .= '<div class="col-md-12">';
		$output .= '<div class="shop_container product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive=\'{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "'.esc_attr($settings['display_item']).'"}}\'>';
			
		if( have_posts() ) : while ( have_posts() ) : the_post();

			$output .= '<div class="item">';
			
			if($settings['product_type'] == 'type3'){
				$output .= shopwise_product_type3();
			}elseif($settings['product_type'] == 'type2'){
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
