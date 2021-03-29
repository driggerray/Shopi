<?php

/*************************************************
## Styles and Scripts
*************************************************/ 
define('KLB_INDEX_JS', plugin_dir_url( __FILE__ )  . '/js');
define('KLB_INDEX_CSS', plugin_dir_url( __FILE__ )  . '/css');

function klb_scripts() {
     wp_register_script( 'jquery-socialshare',    KLB_INDEX_JS . '/jquery-socialshare.js', array('jquery'), '1.0', true);
     wp_register_script( 'klb-social-share', 	  KLB_INDEX_JS . '/custom/social_share.js', array('jquery'), '1.0', true);
     wp_register_script( 'klb-widget-product-categories', 	  plugins_url( 'widgets/js/widget-product-categories.js', __FILE__ ), true );
}
add_action( 'wp_enqueue_scripts', 'klb_scripts' );

/*----------------------------
  Single Share
 ----------------------------*/
add_action( 'woocommerce_single_product_summary', 'shopwise_social_share', 70);
function shopwise_social_share(){
	$socialshare = get_theme_mod( 'shopwise_shop_social_share', '0' );

	if($socialshare == '1'){
	wp_enqueue_script('jquery-socialshare');
	wp_enqueue_script('klb-social-share');
	
	  echo '<div class="social shop-social social-container product_share">
				<span>'.esc_html__('Share:','shopwise').'</span>
				<ul class="social_icons">
				<li><a href="#" class="facebook" aria-label="'.esc_attr__('Share this page with Facebook','shopwise').'" role="button"><i class="ion-social-facebook"></i></a></li>
				<li><a href="#" class="twitter" aria-label="'.esc_attr__('Share this page with Twitter','shopwise').'"><i class="ion-social-twitter"></i></a></li>
				<li><a href="#" href="#" class="pinterest" aria-label="'.esc_attr__('Share this page with Pinterest','shopwise').'"><i class="ion-social-pinterest"></i></a></li>
				<li><a href="#" class="linkedin" aria-label="'.esc_attr__('Share this page with Linkedin','shopwise').'"><i class="ion-social-linkedin"></i></a></li>
				<li><a href="#" class="tumblr" aria-label="'.esc_attr__('Share this page with Tumblr','shopwise').'"><i class="ion-social-tumblr"></i></a></li>
				</ul>
			</div>';
	}
}