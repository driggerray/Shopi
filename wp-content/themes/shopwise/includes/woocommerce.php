<?php

/*************************************************
## Woocommerce 
*************************************************/

if ( class_exists( 'woocommerce' ) ) {
add_theme_support( 'woocommerce' );
add_image_size('shopwise-woo-product', 450, 450, true);

// Remove woocommerce defauly styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// hide default shop title anasayfadaki title gizlemek için
add_filter('woocommerce_show_page_title', 'shopwise_override_page_title');
function shopwise_override_page_title() {
return false;
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); /*remove result count above products*/
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); //remove rating
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title',10);

add_action( 'woocommerce_before_shop_loop_item', 'shopwise_shop_thumbnail', 10);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'shopwise_related_products', 20);

function shopwise_related_products(){
    woocommerce_related_products( array('posts_per_page' => 5));
}


/*----------------------------
  Single Featured List
 ----------------------------*/

add_action( 'woocommerce_single_product_summary', 'shopwise_featured_list', 25);
function shopwise_featured_list(){
	$featured = get_theme_mod( 'shopwise_featured_listem' );
	$output = '';
	
	if( !empty( $featured ) ) {
        $output .= '<div class="product_sort_info">';
        $output .= '<ul>';
		foreach($featured as $f){			
			$output .= '<li><i class="'.esc_attr($f["featured_icon"]).'"></i>'.esc_html($f["featured_text"]).'</li>';
		}
	
		$output .= '</ul></div>';
	}
	
	echo shopwise_sanitize_data($output);
}


/*----------------------------
  Product Type 1
 ----------------------------*/
function shopwise_product_type1(){
	global $product;
	global $post;
	global $woocommerce;
	
	$output = '';
	
	$id = get_the_ID();
	$allproduct = wc_get_product( get_the_ID() );
	
	$att=get_post_thumbnail_id();
	$image_src = wp_get_attachment_image_src( $att, 'full' );
	$image_src = $image_src[0];

	$cart_url = wc_get_cart_url();
	$price = $allproduct->get_price_html();
	$weight = $product->get_weight();
	$stock_status = $product->get_stock_status();
	$stock_text = $product->get_availability();
	$rating = wc_get_rating_html($product->get_average_rating());
	$ratingcount = $product->get_review_count();
	$wishlist = get_theme_mod( 'shopwise_wishlist_button', '0' );
	$compare = get_theme_mod( 'shopwise_compare_button', '0' );
	$quickview = get_theme_mod( 'shopwise_quick_view_button', '0' );
	
	$output .= '<div class="product">';
	if( $product->get_sale_price() && $product->get_regular_price() ) {
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
	if($quickview == '1'){
	$output .= '<li><a href="'.$product->get_id().'" class="button detail-bnt"><i class="icon-magnifier-add"></i></a></li>';
	}
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
	if($quickview == '1'){
	$output .= '<li><a href="'.$product->get_id().'" class="button detail-bnt"><i class="icon-magnifier-add"></i></a></li>';
	}
	if($wishlist == '1'){
	$output .= '<li>'.do_shortcode('[ti_wishlists_addtowishlist]').'</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}

/*----------------------------
  Product Type 2
 ----------------------------*/
function shopwise_product_type2(){
	global $product;
	global $post;
	global $woocommerce;

	$output = '';

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
	$quickview = get_theme_mod( 'shopwise_quick_view_button', '0' );
			
	$output .= '<div class="klb-product2 product_box text-center">';
	$output .= '<div class="product_img">';
	$output .= '<a href="'.get_permalink().'">';
	$output .= '<img src="'.esc_url($image_src).'" alt="product_img1">';
	$output .= '</a>';
	$output .= '<div class="product_action_box">';
	$output .= '<ul class="list_none pr_action_btn">';
	if($compare == '1'){
	$output .= '<li>'.do_shortcode('[yith_compare_button]').'</li>';
	}
	if($quickview == '1'){
	$output .= '<li><a href="'.$product->get_id().'" class="button detail-bnt"><i class="icon-magnifier-add"></i></a></li>';
	}
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
	if($quickview == '1'){
	$output .= '<li><a href="'.$product->get_id().'" class="button detail-bnt"><i class="icon-magnifier-add"></i></a></li>';
	}
	if($wishlist == '1'){
	$output .= '<li>'.do_shortcode('[ti_wishlists_addtowishlist]').'</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';
	
	$output .= '<div class="add-to-cart">';
	$output .= shopwise_add_to_cart_button();
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}


/*----------------------------
  Product Type 3
 ----------------------------*/
function shopwise_product_type3(){
	global $product;
	global $post;
	global $woocommerce;

	$output = '';

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
	$quickview = get_theme_mod( 'shopwise_quick_view_button', '0' );
	$product_image_ids = $product->get_gallery_image_ids();

	$output .= '<div class="klb-product3 product_wrap">';
	$output .= '<div class="product_img">';
	$output .= '<a href="shop-product-detail.html">';
	$output .= '<img src="'.esc_url($image_src).'" alt="product_img1">';
	
	if($product_image_ids){
		$gallery_count = 1;
		foreach( $product_image_ids as $product_image_id ){
			if($gallery_count == 1){
				$image_url = wp_get_attachment_url( $product_image_id );
				$output .= '<img class="product_hover_img" src="'.esc_url($image_url).'" alt="el_hover_img1">';
			}
			$gallery_count++;
		}
	}
	$output .= '</a>';
	$output .= '<div class="product_action_box">';
	$output .= '<ul class="list_none pr_action_btn">';
	$output .= '<li class="add-to-cart">'.shopwise_add_to_cart_button().'</li>';
	if($compare == '1'){
	$output .= '<li>'.do_shortcode('[yith_compare_button]').'</li>';
	}
	if($quickview == '1'){
	$output .= '<li><a href="'.$product->get_id().'" class="button detail-bnt"><i class="icon-magnifier-add"></i></a></li>';
	}
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
	if($quickview == '1'){
	$output .= '<li><a href="'.$product->get_id().'" class="button detail-bnt"><i class="icon-magnifier-add"></i></a></li>';
	}
	if($wishlist == '1'){
	$output .= '<li>'.do_shortcode('[ti_wishlists_addtowishlist]').'</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}


/*----------------------------
  Add my owns
 ----------------------------*/
function shopwise_shop_thumbnail () {
	

	if(get_theme_mod('shopwise_product_type') == 'type3'){
		
		echo shopwise_product_type3();

	}elseif(get_theme_mod('shopwise_product_type') == 'type2'){
		
		echo shopwise_product_type2();
		
	} else {
		
		echo shopwise_product_type1();
		
	}

}

/*************************************************
## Woocommerce Cart Text
*************************************************/

//add to cart button
function shopwise_add_to_cart_button(){
	global $product;
	$output = '';

	ob_start();
	woocommerce_template_loop_add_to_cart();
	$output .= ob_get_clean();

	if(!empty($output)){
		$pos = strpos($output, ">");
		
		if ($pos !== false) {
		    $output = substr_replace($output,">", $pos , strlen(1));
		}
	}
	
	if($product->get_type() == 'variable' && empty($output)){
		$output = "<a class='btn btn-primary add-to-cart cart-hover' href='".get_permalink($product->id)."'>".esc_html__('Select options','shopwise')."</a>";
	}

	if($product->get_type() == 'simple'){
		$output .= "";
	} else {
		$btclass  = "single_bt";
	}
	
	if($output) return "$output";
}



/*************************************************
## Woo Cart Ajax
*************************************************/ 

add_filter('woocommerce_add_to_cart_fragments', 'shopwise_header_add_to_cart_fragment');
function shopwise_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	
	<span class="cart_count"> <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'shopwise'), $woocommerce->cart->cart_contents_count);?> </span>
	

	<?php
	$fragments['span.cart_count'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {

    ob_start();
    ?>

    <div class="fl-mini-cart-content">
        <?php woocommerce_mini_cart(); ?>
    </div>

    <?php $fragments['div.fl-mini-cart-content'] = ob_get_clean();

    return $fragments;

} );

/*************************************************
## Shopwise Woo Search Form
*************************************************/ 

add_filter( 'get_product_search_form' , 'shopwise_custom_product_searchform' );

function shopwise_custom_product_searchform( $form ) {

	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
				<div class="control-group">
                  <input type="text" class="search-field" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search','shopwise').'">
                  <button type="submit" class="search-button"> </button>
                  <input type="hidden" name="post_type" value="product" />
				</div>
              </form>';

	return $form;
}


function shopwise_search_modal_form() {

	$form = '<form role="search" method="get" id="woosearchform" action="' . esc_url( home_url( '/'  ) ) . '">
				<input type="text" class="form-control" id="search_input" name="s" value="' . get_search_query() . '"  placeholder="'.esc_attr__('Search','shopwise').'">
				<button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
				<input type="hidden" name="post_type" value="product" />
			</form>';

	return $form;
}

function shopwise_category_search_form() {

	$terms = get_terms( array(
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent'    => 0,
	) );

	$form = '';

	$form .= '<form role="search" method="get" id="woocatform" action="' . esc_url( home_url( '/'  ) ) . '">';
	$form .= '<div class="input-group">';
	$form .= '<div class="input-group-prepend">';
	$form .= '<div class="custom_select">';
	$form .= '<select name="product_cat" class="first_null">';
	$form .= '<option value="">'.esc_html__('All Category','shopwise').'</option>';
	foreach ( $terms as $term ) {
		if($term->count >= 1){
			$form .= '<option value="'.$term->slug.'">'.$term->name.'</option>';
		}
	}
	$form .= '</select>';
	$form .= '</div>';
	$form .= '</div>';
	$form .= '<input  type="text" class="form-control" name="s" value="' . get_search_query() . '" placeholder="'.esc_attr__('Search','shopwise').'" >';
	$form .= '<input type="hidden" name="post_type" value="product" />';
	$form .= '<button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>';
	$form .= '</div>';
	$form .= '</form>';

	return $form;
}

function shopwise_category_search_form2() {

	$terms = get_terms( array(
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent'    => 0,
	) );

	$form = '';

	$form .= '<form role="search" method="get" id="woocatform" action="' . esc_url( home_url( '/'  ) ) . '">';
	$form .= '<div class="input-group">';
	$form .= '<div class="input-group-prepend">';
	$form .= '<div class="custom_select">';
	$form .= '<select name="product_cat" class="first_null">';
	$form .= '<option value="">'.esc_html__('All Category','shopwise').'</option>';
	foreach ( $terms as $term ) {
		if($term->count >= 1){
			$form .= '<option value="'.$term->slug.'">'.$term->name.'</option>';
		}
	}
	$form .= '</select>';
	$form .= '</div>';
	$form .= '</div>';
	$form .= '<input  type="text" class="form-control" name="s" value="' . get_search_query() . '" placeholder="'.esc_attr__('Search','shopwise').'" >';
	$form .= '<input type="hidden" name="post_type" value="product" />';
	$form .= '<button type="submit" class="search_btn2"><i class="fa fa-search"></i></button>';
	$form .= '</div>';
	$form .= '</form>';

	return $form;
}

function shopwise_category_search_form3() {

	$terms = get_terms( array(
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent'    => 0,
	) );

	$form = '';

	$form .= '<form role="search" method="get" id="woocatform" action="' . esc_url( home_url( '/'  ) ) . '">';
	$form .= '<div class="input-group">';
	$form .= '<div class="input-group-prepend">';
	$form .= '<div class="custom_select">';
	$form .= '<select name="product_cat" class="first_null">';
	$form .= '<option value="">'.esc_html__('All Category','shopwise').'</option>';
	foreach ( $terms as $term ) {
		if($term->count >= 1){
			$form .= '<option value="'.$term->slug.'">'.$term->name.'</option>';
		}
	}
	$form .= '</select>';
	$form .= '</div>';
	$form .= '</div>';
	$form .= '<input  type="text" class="form-control" name="s" value="' . get_search_query() . '" placeholder="'.esc_attr__('Search','shopwise').'" >';
	$form .= '<input type="hidden" name="post_type" value="product" />';
	$form .= '<button type="submit" class="search_btn3">'.esc_html__('Search','shopwise').'</button>';
	$form .= '</div>';
	$form .= '</form>';

	return $form;
}


/*************************************************
## Shopwise Gallery Thumbnail Size
*************************************************/ 
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 90,
        'height' => 54,
        'crop' => 0,
    );
} );


/*************************************************
## Quick View Scripts
*************************************************/ 

function shopwise_quick_view_scripts() {
  wp_enqueue_script( 'shopwise-quick-ajax', get_template_directory_uri() . '/assets/js/custom/quick_ajax.js', array('jquery'), '1.0.0', true );
  wp_localize_script( 'shopwise-quick-ajax', 'MyAjax', array(
    'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
    'security' => wp_create_nonce( 'shopwise-special-string' )
  ));
}
add_action( 'wp_enqueue_scripts', 'shopwise_quick_view_scripts' );

/*************************************************
## Quick View CallBack
*************************************************/ 

add_action( 'wp_ajax_nopriv_quick_view', 'shopwise_quick_view_callback' );
add_action( 'wp_ajax_quick_view', 'shopwise_quick_view_callback' );
function shopwise_quick_view_callback() {
	check_ajax_referer( 'shopwise-special-string', 'security' );

	global $wpdb,$post; // this is how you get access to the database
	$id = intval( $_POST['id'] );
	$loop = new WP_Query( array(
		'post_type' => 'product',
		'p' => $id,
	  )
	);
	
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$product = new WC_Product(get_the_ID());
	
	$rating = wc_get_rating_html($product->get_average_rating());
	$price = $product->get_price_html();
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
	$product_image_ids = $product->get_gallery_attachment_ids();
	$featured = get_theme_mod( 'shopwise_featured_listem' );

	$output = '';
 
			
		$output .= '<div class="ajax_quick_view">';
		$output .= '<div class="row">';
		if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0];
			$output .= '<div class="col-lg-6 col-md-6 mb-4 mb-md-0">';
			$output .= '<div class="product-image">';
			$output .= '<div class="product_img_box">';
			$output .= '<img id="product_img" src="'.esc_url($image_src).'" data-zoom-image="'.esc_url($image_src).'" alt="product_img1" />';
			$output .= '</div>';
			if($product_image_ids){
				$output .= '<div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">';
				
				$output .= '<div class="item">';
				$output .= '<a href="#" class="product_gallery_item active" data-image="'.esc_url($image_src).'" data-zoom-image="'.esc_url($image_src).'" title="'.the_title_attribute( 'echo=0' ).'">';
				$output .= '<img src="'.esc_url($image_src).'" alt="product_small_img1" />';
				$output .= '</a>';
				$output .= '</div>';
				
				foreach( $product_image_ids as $product_image_id ){
					$image_url = wp_get_attachment_url( $product_image_id );
						
					$output .= '<div class="item">';
					$output .= '<a href="#" class="product_gallery_item" data-image="'.esc_url($image_url).'" data-zoom-image="'.esc_url($image_url).'" title="'.the_title_attribute( 'echo=0' ).'">';
					$output .= '<img src="'.esc_url($image_url).'" alt="product_small_img1" />';
					$output .= '</a>';
					$output .= '</div>';
				}
				$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '</div>';
		}
		
		$output .= '<div class="col-lg-6 col-md-6">';
		$output .= '<div class="pr_detail">';
		$output .= '<div class="product_description">';
		$output .= '<h4 class="product_title"><a href="'.get_permalink().'" title="'.the_title_attribute( 'echo=0' ).'">'.get_the_title().'</a></h4>';
		$output .= '<div class="product_price">';
		$output .= $price;
		$output .= '</div>';
		$output .= '<div class="rating_wrap">';
		$output .= $rating;
		if($ratingcount){
		$output .= '<span class="rating_num">('.$review_count.')</span>';
		}
		$output .= '</div>';
		$output .= '<div class="pr_desc">';
		$output .= '<p>'.get_the_excerpt().'</p>';
		$output .= '</div>';
		if( !empty( $featured ) ) {
			$output .= '<div class="product_sort_info">';
			$output .= '<ul>';
			foreach($featured as $f){			
				$output .= '<li><i class="'.esc_attr($f["featured_icon"]).'"></i>'.esc_html($f["featured_text"]).'</li>';
			}
		
			$output .= '</ul></div>';
		}
		$output .= '</div>';
		$output .= '<hr />';
		$output .= '<div class="cart_extra">';
		$output .= '<div class="cart_btn">';
		ob_start();
		woocommerce_template_single_add_to_cart();
		$output .= ob_get_clean();
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<hr />';
		ob_start();
		woocommerce_template_single_meta();
		$output .= ob_get_clean();
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';



		endwhile; 
		wp_reset_postdata();

	 	$output_escaped = $output;
	 	echo $output_escaped;
		
		wp_die();

}


} // is woocommerce activated

?>