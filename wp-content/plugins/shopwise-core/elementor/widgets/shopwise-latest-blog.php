<?php

namespace Elementor;

class Shopwise_Latest_Blog_Widget extends Widget_Base {
    use Shopwise_Helper;

    public function get_name() {
        return 'shopwise-latest-blog';
    }
    public function get_title() {
        return 'Lateste Posts (K)';
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
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'box_type',
			[
				'label' => esc_html__( 'Box Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'blog_style1',
				'options' => [
					'select-type' => esc_html__( 'Select a type', 'shopwise' ),
					'blog_style1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'blog_style2'	  => esc_html__( 'Type 2', 'shopwise' ),
				],
			]
		);
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Latest News',				
            ]
        );
		
        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Subtitle here',

            ]
        );
				
        $this->add_control( 'post_count',
            [
                'label' => esc_html__( 'Posts Per Page', 'shopwise' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 3
            ]
        );
		
       $this->add_control( 'excerpt_size',
            [
                'label' => esc_html__( 'Excerpt Size', 'shopwise' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 15
            ]
        );
		
        $this->add_control( 'category_filter',
            [
                'label' => esc_html__( 'Category', 'naturally' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->shopwise_get_categories(),
                'description' => 'Select Category(s)',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'post_filter',
            [
                'label' => esc_html__( 'Specific Post(s)', 'naturally' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->shopwise_get_posts(),
                'description' => 'Select Specific Post(s)',
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
			'post_type' => 'post',
			'posts_per_page' => $settings['post_count'],
			'order'          => 'DESC',
			'post_status'    => 'publish',
			'paged' 			=> $paged,
            'post__in'       => $settings['post_filter'],
            'order'          => $settings['order'],
			'orderby'        => $settings['orderby'],
            'category__in'     => $settings['category_filter'],
		);
	
	query_posts( $args );
	
		
		$output .= '<div class="klb-section">';
		$output .= '<div class="container">';
		
		if($settings['title']){
		$output .= '<div class="row justify-content-center">';
		$output .= '<div class="col-lg-6 col-md-8">';
		$output .= '<div class="heading_s1 text-center">';
		$output .= '<h2>'.esc_html($settings['title']).'</h2>';
		$output .= '</div>';
		$output .= '<p class="leads text-center">'.esc_html($settings['subtitle']).'</p>';
		$output .= '</div>';
		$output .= '</div>';
		}
		
		$output .= '<div class="row">';
		
		$count = 1;
		if( have_posts() ) : while ( have_posts() ) : the_post();
			global $product;
			global $post;
			global $woocommerce;
			
			$id = get_the_ID();
			$allproduct = wc_get_product( get_the_ID() );
			
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0];
			$imageresize = shopwise_resize( $image_src, 260, 170, true, true, true );
			
			$output .= '<div class="col-lg-4 col-md-6">';
			$output .= '<div class="blog_post '.esc_attr($settings['box_type']).' box_shadow1">';
			$output .= '<div class="blog_img">';
			$output .= '<a href="'.get_permalink().'">';
			$output .= '<img src="'.esc_url($image_src).'" alt="blog_small_img1">';
			$output .= '</a>';
			$output .= '</div>';
			$output .= '<div class="blog_content bg-white">';
			$output .= '<div class="blog_text">';
			$output .= '<h5 class="blog_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
			$output .= '<ul class="list_none blog_meta">';
			$output .= '<li><a href="'.get_permalink().'"><i class="ti-calendar"></i> '.get_the_date('j M Y').'</a></li>';
			$output .= '<li><a href="'.get_permalink().'"><i class="ti-comments"></i> '.get_comments_number().'</a></li>';
			$output .= '</ul>';
			$output .= '<p>'.shopwise_limit_words(get_the_excerpt(), $settings['excerpt_size']).'</p>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

		endwhile;
		
		
		ob_start();
		get_template_part( 'post-format/pagination' );
		$output .= '<div class="col-12">'. ob_get_clean().'</div>';

		wp_reset_query();
		endif;
		

		$output .= '</div>';
		$output .= '</div>';

		
		echo $output;
	}

}
