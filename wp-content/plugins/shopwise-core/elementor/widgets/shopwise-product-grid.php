<?php

namespace Elementor;

class Shopwise_Product_Grid_Widget extends Widget_Base {
    use Shopwise_Helper;

    public function get_name() {
        return 'shopwise-product-grid';
    }
    public function get_title() {
        return 'Product Grid (K)';
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
		
		$this->add_control(
			'disable_product_view',
			[
				'label' => esc_html__( 'Disable Product View', 'shopwise' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shopwise' ),
				'label_off' => esc_html__( 'No', 'shopwise' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'disable_pagination',
			[
				'label' => esc_html__('Disable Pagination', 'shopwise' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shopwise' ),
				'label_off' => esc_html__( 'No', 'shopwise' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control( 'column',
			[
				'label' => esc_html__( 'Column', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-lg-4',
				'options' => [
					'select-column' => esc_html__( 'Select Column', 'shopwise' ),
					'col-lg-6'	  => esc_html__( '2 Columns', 'shopwise' ),
					'col-lg-4' 	  => esc_html__( '3 Columns', 'shopwise' ),
					'col-lg-3'	  => esc_html__( '4 Columns', 'shopwise' ),
					'col-lg-3'	  => esc_html__( '4 Columns', 'shopwise' ),
				],
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

		$this->add_control(
			'enable_best_selling',
			[
				'label' => esc_html__( 'Enable Best Selling', 'shopwise' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shopwise' ),
				'label_off' => esc_html__( 'No', 'shopwise' ),
				'return_value' => 'yes',
				'default' => '',
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

		if($settings['enable_best_selling']){
			$args['meta_key'] = 'total_sales';
			$args['orderby'] = 'meta_value_num';
		}
	
	query_posts( $args );
		?>
		
		<?php
		
		
		$output .= '<div class="klb-section">';
		$output .= '<div class="container">';
		$output .= '<div class="row">';
		$output .= '<div class="col-lg-12">';
		
		if($settings['disable_product_view'] != 'yes'){
			$output .= '<div class="row align-items-center mb-4 pb-1">';
			$output .= '<div class="col-12">';
			$output .= '<div class="product_header">';
			$output .= '<div class="product_header_right">';
			$output .= '<div class="products_view">';
			$output .= '<a href="javascript:Void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>';
			$output .= '<a href="javascript:Void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}    
			   
		$output .= '<div class="row shop_container">';
		
		if( have_posts() ) : while ( have_posts() ) : the_post();

			$output .= '<div class="'.esc_attr($settings['column']).' col-md-4 col-6">';
			
				if($settings['product_type'] == 'type2'){
					$output .= shopwise_product_type2();
				} else {
					$output .= shopwise_product_type1();
				}
			
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

		$output .= '</div>';

		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';


		echo $output;
	}

}
