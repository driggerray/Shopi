<?php

namespace Elementor;

class Shopwise_Product_List_Widget extends Widget_Base {
    use Shopwise_Helper;

    public function get_name() {
        return 'shopwise-product-list';
    }
    public function get_title() {
        return 'Product list (K)';
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
		$output .= '<div class="row">';
		$output .= '<div class="col-lg-12">';
			
		$output .= '<div class="row align-items-center mb-4 pb-1">';
		$output .= '<div class="col-12">';
		$output .= '<div class="product_header">';
		$output .= '<div class="product_header_right">';
		$output .= '<div class="products_view">';
		$output .= '<a href="javascript:Void(0);" class="shorting_icon grid"><i class="ti-view-grid"></i></a>';
		$output .= '<a href="javascript:Void(0);" class="shorting_icon list active"><i class="ti-layout-list-thumb"></i></a>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
               
			   
		$output .= '<div class="row shop_container list">';

	
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

			$output .= '<div class="col-md-4 col-6">';
			$output .= '<div class="product">';
			if( $product->is_on_sale() && !$product->is_type( 'grouped' ) ) {
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
			$output .= '<div class="list_product_action_box">';
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
			$output .= '</div>';
			$output .= '</div>';


		endwhile;
		$output .= '</div>';
		$output .= '<div class="row">';
		$output .= '<div class="col-12">';
		
		ob_start();
		get_template_part( 'post-format/pagination' );
		$output .= '<div class="col-md-12">'. ob_get_clean().'</div>';

		$output .= '</div>';
		$output .= '</div>';
		wp_reset_query();
		endif;
		
		

		$output .= '</div>';

		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';



		
		echo $output;
	}

}
