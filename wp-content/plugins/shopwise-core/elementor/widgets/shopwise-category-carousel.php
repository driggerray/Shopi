<?php

namespace Elementor;

class Shopwise_Category_Carousel_Widget extends Widget_Base {
    use Shopwise_Helper;
	
    public function get_name() {
        return 'shopwise-category-carousel';
    }
    public function get_title() {
        return 'Category Carousel (K)';
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
		
		$this->add_control( 'carousel_type',
			[
				'label' => esc_html__( 'Carousel Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'select-type',
				'options' => [
					'select-type' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
				],
			]
		);
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Top Categories',				
            ]
        );

        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'There are many variations of passages of Lorem',				
            ]
        );
		
        $this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Exclude Category', 'shopwise' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->shopwise_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'default' => 'all',
                'label_block' => true,
            ]
        );

        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Text', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'View All',
                'pleaceholder' => esc_html__( 'Enter button text here', 'shopwise' ),
				'condition' => ['carousel_type' => array('select-type','type1')]
            ]
        );
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'shopwise' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'shopwise' ),
				'condition' => ['carousel_type' => array('select-type','type1')]
            ]
        );
		
		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';

		if($settings['cat_filter']){
			$terms = get_terms( array(
				'taxonomy' => 'product_cat',
				'hide_empty' => true,
				'parent'    => 0,
				'exclude'   => $settings['cat_filter'],
			) );
		} else {
			$terms = get_terms( array(
				'taxonomy' => 'product_cat',
				'hide_empty' => true,
				'parent'    => 0,
			) );
		}
	

		echo '<div class="klb-section">';
		echo '<div class="container">';
		
		if($settings['carousel_type'] == 'type2'){
			echo '<div class="row justify-content-center">';
			echo '<div class="col-md-6">';
			echo '<div class="heading_s4 text-center">';
			echo '<h2>'.esc_html($settings['title']).'</h2>';
			echo '</div>';
			echo '<p class="text-center leads">'.esc_html($settings['subtitle']).'</p>';
			echo '</div>';
			echo '</div>';
			
			echo '<div class="row align-items-center">';
			echo '<div class="col-12">';
			echo '<div class="cat_slider cat_style1 mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive=\'{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "4"}, "768":{"items": "5"}, "991":{"items": "6"}, "1199":{"items": "7"}}\'>';
                    
			foreach ( $terms as $term ) {
				$term_data = get_option('taxonomy_'.$term->term_id);
				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
		
				echo '<div class="item">';
				echo '<div class="categories_box">';
				echo '<a href="'.esc_url(get_term_link( $term )).'">';
				if($image){
				echo '<img src="'.esc_url($image).'" alt="cat_img1"/>';
				}
				echo '<span>'.$term->name.'</span>';
				echo '</a>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';

		} else {
			echo '<div class="row">';
			echo '<div class="col-12">';
			echo '<div class="cat_overlap radius_all_5">';
			echo '<div class="row align-items-center">';
			echo '<div class="col-lg-3 col-md-4">';
			echo '<div class="text-center text-md-left">';
			echo '<h4>'.esc_html($settings['title']).'</h4>';
			echo '<p class="mb-2">'.esc_html($settings['subtitle']).'</p>';
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="btn btn-line-fill btn-sm">'.esc_html($settings['btn_title']).'</a>';
			echo '</div>';
			echo '</div>';
							
			echo '<div class="col-lg-9 col-md-8">';
			echo '<div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive=\'{"0":{"items": "1"}, "380":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "4"}}\'>';
								   
			foreach ( $terms as $term ) {
				$term_data = get_option('taxonomy_'.$term->term_id);
				
				echo '<div class="item">';
				echo '<div class="categories_box">';
				echo '<a href="'.esc_url(get_term_link( $term )).'">';
				echo '<i class="'.esc_attr($term_data['product_cat_icon']).'"></i>';
				echo '<span>'.$term->name.'</span>';
				echo '</a>';
				echo '</div>';
				echo '</div>';
			}
			
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';

		}
		
		echo '</div>';
		echo '</div>';
		
	}

}
