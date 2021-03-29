<?php
/**
 * functions.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.4.4
 * 
 */

/*************************************************
## Admin style and scripts  
*************************************************/ 

function shopwise_admin_styles() {
     wp_enqueue_style('shopwise-klbtheme',    get_template_directory_uri() .'/assets/css/admin/klbtheme.css');
	 wp_enqueue_script('shopwise-init', 	  get_template_directory_uri() .'/assets/js/init.js', array('jquery','media-upload','thickbox'));
}
add_action('admin_enqueue_scripts', 'shopwise_admin_styles');

 /*************************************************
## Shopwise Fonts
*************************************************/
function shopwise_fonts_url_roboto() {
        $fonts_url = '';
	
		$roboto = _x( 'on', 'Roboto font: on or off', 'shopwise' );		

		if ( 'off' !== $roboto ) {
		$font_families = array();

		if ( 'off' !== $roboto ) {
		$font_families[] = 'Roboto:100,300,400,500,700,900';
		}
		
		$query_args = array( 
		'family' => rawurldecode( implode( '|', $font_families ) ), 
		'subset' => rawurldecode( 'latin,latin-ext' ), 
		); 
		 
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}
 
return esc_url_raw( $fonts_url );
}

function shopwise_fonts_url_poppins() {
        $fonts_url = '';
	
		$poppins = _x( 'on', 'Poppins font: on or off', 'shopwise' );	

		if ( 'off' !== $poppins ) {
		$font_families = array();

		if ( 'off' !== $poppins ) {
		$font_families[] = 'Poppins:200,300,400,500,600,700,800,900';
		}
		
		$query_args = array( 
		'family' => rawurldecode( implode( '|', $font_families ) ), 
		'subset' => rawurldecode( 'latin,latin-ext' ), 
		); 
		 
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}
 
return esc_url_raw( $fonts_url );
}

/*************************************************
## Styles and Scripts
*************************************************/ 
define('SHOPWISE_INDEX_ASSETS', get_template_directory_uri()  . '/assets/');

function shopwise_scripts() {
	
     if ( is_admin_bar_showing() ) {
       wp_enqueue_style( 'shopwise-klbtheme', SHOPWISE_INDEX_ASSETS . '/css/admin/klbtheme.css', false, '1.0');    
     }	
	 
     if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	 
     wp_enqueue_style( 'animate', 					SHOPWISE_INDEX_ASSETS  . '/css/animate.css', false, '1.0');	
     wp_enqueue_style( 'bootstrap', 				SHOPWISE_INDEX_ASSETS  . '/bootstrap/css/bootstrap.min.css', false, '1.0');
	 wp_style_add_data( 'bootstrap', 'rtl', 'replace' );
     wp_enqueue_style( 'fontawesome-all',    		SHOPWISE_INDEX_ASSETS  . '/css/all.min.css', false, '1.0');
     wp_enqueue_style( 'ionicons',    				SHOPWISE_INDEX_ASSETS  . '/css/ionicons.min.css', false, '1.0');
     wp_enqueue_style( 'themify-icons', 			SHOPWISE_INDEX_ASSETS  . '/css/themify-icons.css', false, '1.0');	
     wp_enqueue_style( 'linearicons', 				SHOPWISE_INDEX_ASSETS  . '/css/linearicons.css', false, '1.0');	
     wp_enqueue_style( 'flaticon', 					SHOPWISE_INDEX_ASSETS  . '/css/flaticon.css', false, '1.0');
     wp_enqueue_style( 'simple-line-icons', 		SHOPWISE_INDEX_ASSETS  . '/css/simple-line-icons.css', false, '1.0');
     wp_enqueue_style( 'owl-carousel', 				SHOPWISE_INDEX_ASSETS  . '/owlcarousel/css/owl.carousel.min.css', false, '1.0');
     wp_enqueue_style( 'owl-theme', 				SHOPWISE_INDEX_ASSETS  . '/owlcarousel/css/owl.theme.css', false, '1.0');
     wp_enqueue_style( 'owl-theme-default', 		SHOPWISE_INDEX_ASSETS  . '/owlcarousel/css/owl.theme.default.min.css', false, '1.0');
     wp_enqueue_style( 'magnific-popup', 			SHOPWISE_INDEX_ASSETS  . '/css/magnific-popup.css', false, '1.0');
     wp_enqueue_style( 'slick', 					SHOPWISE_INDEX_ASSETS  . '/css/slick.css', false, '1.0');
     wp_enqueue_style( 'slick-theme', 				SHOPWISE_INDEX_ASSETS  . '/css/slick-theme.css', false, '1.0');
     wp_enqueue_style( 'shopwise-custom', 			SHOPWISE_INDEX_ASSETS  . '/css/custom.css', false, '1.0');
	 wp_style_add_data( 'shopwise-custom', 'rtl', 'replace' );
     wp_enqueue_style( 'shopwise-responsive', 		SHOPWISE_INDEX_ASSETS  . '/css/responsive.css', false, '1.0');
	 wp_style_add_data( 'shopwise-responsive', 'rtl', 'replace' );
     wp_enqueue_style( 'shopwise-font-roboto',  	shopwise_fonts_url_roboto(), array(), null );
     wp_enqueue_style( 'shopwise-font-poppins',  	shopwise_fonts_url_poppins(), array(), null );
  	 wp_enqueue_style( 'shopwise-style',            get_stylesheet_uri() ); 
	 wp_style_add_data( 'shopwise-style', 'rtl', 'replace' );

	 $mapkey = get_theme_mod('shopwise_mapapi');

	 wp_enqueue_script( 'jquery-ui-position' );
     wp_enqueue_script( 'popper',     	 				SHOPWISE_INDEX_ASSETS . '/js/popper.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'bootstrap',     	 			SHOPWISE_INDEX_ASSETS . '/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'owl-carousel',    	    		SHOPWISE_INDEX_ASSETS . '/owlcarousel/js/owl.carousel.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'magnific-popup',    	    	SHOPWISE_INDEX_ASSETS . '/js/magnific-popup.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'waypoints',    	    		SHOPWISE_INDEX_ASSETS . '/js/waypoints.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'parallax',    	    			SHOPWISE_INDEX_ASSETS . '/js/parallax.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'jquery-countdown',    			SHOPWISE_INDEX_ASSETS . '/js/jquery.countdown.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'hoverparallax',    			SHOPWISE_INDEX_ASSETS . '/js/hoverparallax.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'isotope',    					SHOPWISE_INDEX_ASSETS . '/js/isotope.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'jquery-appear',    			SHOPWISE_INDEX_ASSETS . '/js/jquery.appear.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'jquery-dd',    				SHOPWISE_INDEX_ASSETS . '/js/jquery.dd.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'slick',    					SHOPWISE_INDEX_ASSETS . '/js/slick.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'jquery-elevatezoom',    		SHOPWISE_INDEX_ASSETS . '/js/jquery.elevatezoom.js', array('jquery'), '1.0', true);
 	 wp_register_script( 'shopwise-sidebar-menu',    	SHOPWISE_INDEX_ASSETS . '/js/custom/sidebar_menu.js', array('jquery'), '1.0', true);
     wp_register_script( 'jquery-cookie',    			SHOPWISE_INDEX_ASSETS . '/js/jquery.cookie.min.js', array('jquery'), '1.0', true);
     wp_register_script( 'shopwise-subscribe-popup',    SHOPWISE_INDEX_ASSETS . '/js/custom/subscribe_popup.js', array('jquery'), '1.0', true);
     wp_register_script( 'shopwise-plus-minus',    		SHOPWISE_INDEX_ASSETS . '/js/custom/plus_minus.js', array('jquery'), '1.0', true);
     wp_register_script( 'shopwise-carousel-slider',  	SHOPWISE_INDEX_ASSETS . '/js/custom/carousel_slider.js', array('jquery'), '1.0', true);
	 wp_register_script( 'shopwise-googlemap',      	'//maps.googleapis.com/maps/api/js?key='. $mapkey .'', array('jquery'), '1.0', true);
     wp_enqueue_script( 'shopwise-scripts',     		SHOPWISE_INDEX_ASSETS . '/js/scripts.js', array('jquery'), '1.0', true);


    }
add_action( 'wp_enqueue_scripts', 'shopwise_scripts' );

/*************************************************
## Theme Setup
*************************************************/ 

if ( ! isset( $content_width ) ) $content_width = 960;

function shopwise_theme_setup() {
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array('gallery', 'audio', 'video'));
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'woocommerce', array('gallery_thumbnail_image_width' => 99,'thumbnail_image_width' => 90,) );
	load_theme_textdomain( 'shopwise', get_template_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'shopwise_theme_setup' );


/*************************************************
## Include the TGM_Plugin_Activation class.
*************************************************/ 

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'shopwise_register_required_plugins' );

function shopwise_register_required_plugins() {

	$url = 'http://klbtheme.com/shopwise/plugins/';
	$mainurl = 'http://klbtheme.com/plugins/';

	$plugins = array(
		
        array(
            'name'                  => esc_html__('Meta Box','shopwise'),
            'slug'                  => 'meta-box',
        ),

        array(
            'name'                  => esc_html__('Contact Form 7','shopwise'),
            'slug'                  => 'contact-form-7',
        ),

        array(
            'name'                  => esc_html__('WooCommerce','shopwise'),
            'slug'                  => 'woocommerce',
        ),
		
		array(
            'name'                  => esc_html__('WooCommerce Wishlist','shopwise'),
            'slug'                  => 'ti-woocommerce-wishlist',
        ),

		array(
            'name'                  => esc_html__('WooCommerce Compare','shopwise'),
            'slug'                  => 'yith-woocommerce-compare',
        ),
		
        array(
            'name'                  => esc_html__('Kirki','shopwise'),
            'slug'                  => 'kirki',
        ),
		
        array(
            'name'                  => esc_html__('Elementor','shopwise'),
            'slug'                  => 'elementor',
        ),
		
		array(
            'name'                  => esc_html__('MailChimp Subscribe','shopwise'),
            'slug'                  => 'mailchimp-for-wp',
        ),
		
		array(
            'name'                  => esc_html__('Variation Swatches','shopwise'),
            'slug'                  => 'woo-variation-swatches',
        ),
		
        array(
            'name'                  => esc_html__('Mega Main Menu','shopwise'),
            'slug'                  => 'mega_main_menu',
            'source'                => $url . 'mega-main-menu.zip',
            'required'              => false,
            'version'               => '2.2.1',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
		
        array(
            'name'                  => esc_html__('Shopwise Core','shopwise'),
            'slug'                  => 'shopwise-core',
            'source'                => $url . 'shopwise-core.zip',
            'required'              => false,
            'version'               => '1.0.5',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
		
        array(
            'name'                  => esc_html__('Revolution Slider','shopwise'),
            'slug'                  => 'revslider',
            'source'                => $mainurl . 'revslider.zip',
            'required'              => false,
            'version'               => '6.3.1',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => esc_html__('Envato Market','shopwise'),
            'slug'                  => 'envato-market',
            'source'                => $mainurl . 'envato-market.zip',
            'required'              => true,
            'version'               => '2.0.5',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),


	);

	$config = array(
		'id'           => 'shopwise',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/*************************************************
## Shopwise Register Menu 
*************************************************/

function shopwise_register_menus() {
	register_nav_menus( array( 'main-menu' 	   => esc_html__('Primary Navigation Menu','shopwise')) );
	$sidebarmenu = get_theme_mod('shopwise_header_sidebar_menu','0');
	if($sidebarmenu == '1'){
	register_nav_menus( array( 'klb-sidebar-menu'  => esc_html__('Klb Sidebar Menu','shopwise')) );
	}
	$topheader = get_theme_mod('shopwise_top_header','0');
	if($topheader == '1'){
		register_nav_menus( array( 'top-right-menu' => esc_html__('Top Right Menu','shopwise')) );
		register_nav_menus( array( 'top-left-menu' => esc_html__('Top Left Menu','shopwise')) );
	}
}
add_action('init', 'shopwise_register_menus');

/*************************************************
## Shopwise Menu
*************************************************/ 
class shopwise_description_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<div class="dropdown-menu"><ul>' . "\n";
	}

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
      function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {
           
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';
		   
		   $classes = empty( $object->classes ) ? array() : (array) $object->classes;
           $icon_class = $classes[0];
		   $classes = array_slice($classes,1);
		   
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		   
		   if ( $args->has_children ) {
		   $class_names = 'class="dropdown '.esc_attr($icon_class).' '. esc_attr( $class_names ) . '"';
		   } else {
		   $class_names = 'class="'.esc_attr($icon_class).' '. esc_attr( $class_names ) . '"';
		   }
			
			$output .= $indent . '<li ' . $value . $class_names .'>';

			$datahover = str_replace(' ','',$object->title);

			if ( $args->has_children ) {
				if($object->menu_item_parent == 0){
					$attributes = ! empty( $object->url ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" href="'   . esc_attr( $object->url ) .'"' : '';
				} else {
					$attributes = ! empty( $object->url ) ? ' class="dropdown-item menu-link dropdown-toggler" href="'   . esc_attr( $object->url ) .'"' : '';
				}
			} else {
				if($object->menu_item_parent == 0){
				$attributes = ! empty( $object->url ) ? ' class="nav-link nav_item" href="'   . esc_attr( $object->url ) .'"' : '';
				} else {
				$attributes = ! empty( $object->url ) ? ' class="dropdown-item nav-link nav_item" href="'   . esc_attr( $object->url ) .'"' : '';
				}
			}
				
			$object_output = $args->before;

			$object_output .= '<a'. $attributes .'  >';
			$object_output .= $args->link_before .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
	        $object_output .= $args->link_after;
			$object_output .= '</a>';


			$object_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );            	              	
      }
}

add_filter('nav_menu_css_class' , 'shopwise_nav_class' , 10 , 2);
function shopwise_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active';
     }
     return $classes;
}

/*************************************************
## Shopwise Sidebar Menu
*************************************************/ 
class shopwise_sidebar_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<div class="dropdown-menu"><ul>' . "\n";
	}

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
      function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {
           
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';
		   
		   $classes = empty( $object->classes ) ? array() : (array) $object->classes;
           $icon_class = $classes[0];
		   $classes = array_slice($classes,1);
		   
		   
		   
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		   
		   if ( $args->has_children ) {
		   $class_names = 'class="'. esc_attr( $class_names ) . '"';
		   } else {
		   $class_names = 'class="'. esc_attr( $class_names ) . '"';
		   }
			
			$output .= $indent . '<li ' . $value . $class_names .'>';

			$datahover = str_replace(' ','',$object->title);

			if ( $args->has_children ) {
			$attributes = ! empty( $object->url ) ? ' class="dropdown-item nav-link dropdown-toggler" data-toggle="dropdown" href="'   . esc_attr( $object->url ) .'"' : '';	
			} else {
				if($object->menu_item_parent == 0){
				$attributes = ! empty( $object->url ) ? ' class="dropdown-item nav-link nav_item" href="'   . esc_attr( $object->url ) .'"' : '';
				} else {
				$attributes = ! empty( $object->url ) ? ' class="dropdown-item nav-link nav_item" href="'   . esc_attr( $object->url ) .'"' : '';
				}
			}
				
			$object_output = $args->before;

			$object_output .= '<a'. $attributes .'  ><span>';
			$object_output .= $args->link_before .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
	        $object_output .= $args->link_after;
			$object_output .= '</span></a>';


			$object_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );            	              	
      }
}

/*************************************************
## Excerpt More
*************************************************/ 

function shopwise_excerpt_more($more) {
  global $post;
  return '<div class="read-more"><a class="btn btn-fill-out" href="'. esc_url(get_permalink($post->ID)) . '">' . esc_html__('Read More', 'shopwise') . '</a></div>';
  }
 add_filter('excerpt_more', 'shopwise_excerpt_more');
 
/*************************************************
## Word Limiter
*************************************************/ 
function shopwise_limit_words($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

/*************************************************
## Widgets
*************************************************/ 

function shopwise_widgets_init() {
	register_sidebar( array(
	  'name' => esc_html__( 'Blog Sidebar', 'shopwise' ),
	  'id' => 'blog-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Blog page.','shopwise' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h5 class="widget_title">',
	  'after_title'   => '</h5>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Shop Sidebar', 'shopwise' ),
	  'id' => 'shop-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Shop.','shopwise' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => ' <h5 class="widget_title">',
	  'after_title'   => '</h5>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer First Column', 'shopwise' ),
	  'id' => 'footer-1',
	  'description'   => esc_html__( 'These are widgets for the Footer.','shopwise' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h6 class="widget_title">',
	  'after_title'   => '</h6>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Second Column', 'shopwise' ),
	  'id' => 'footer-2',
	  'description'   => esc_html__( 'These are widgets for the Footer.','shopwise' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h6 class="widget_title">',
	  'after_title'   => '</h6>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Third Column', 'shopwise' ),
	  'id' => 'footer-3',
	  'description'   => esc_html__( 'These are widgets for the Footer.','shopwise' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h6 class="widget_title">',
	  'after_title'   => '</h6>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Fourth Column', 'shopwise' ),
	  'id' => 'footer-4',
	  'description'   => esc_html__( 'These are widgets for the Footer.','shopwise' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h6 class="widget_title">',
	  'after_title'   => '</h6>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Fifth Column', 'shopwise' ),
	  'id' => 'footer-5',
	  'description'   => esc_html__( 'These are widgets for the Footer.','shopwise' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h6 class="widget_title">',
	  'after_title'   => '</h6>'
	) );


}
add_action( 'widgets_init', 'shopwise_widgets_init' );
 
/*************************************************
## Shopwise Comment
*************************************************/

if ( ! function_exists( 'shopwise_comment' ) ) :
 function shopwise_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
   case 'pingback' :
   case 'trackback' :
  ?>

   <article class="post pingback">
   <p><?php esc_html_e( 'Pingback:', 'shopwise' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'shopwise' ), ' ' ); ?></p>
  <?php
    break;
   default :
  ?>
  
	<li class="comment_info">
		<div class="d-flex">
			<div class="comment_user">
				<img src="<?php echo get_avatar_url( $comment, 80 ); ?>" alt="<?php comment_author(); ?>">
			</div>
			<div class="comment_content">
				<div class="d-flex">
					<div class="meta_data">
						<h6 class="autohr"><?php comment_author(); ?></h6>
						<div class="comment-time"><?php comment_date(); ?></div>
					</div>
					<div class="ml-auto">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
				</div>
				<div class="klb-post">
					<?php comment_text(); ?> 
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'shopwise' ); ?></em>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</li>

  <?php
    break;
  endswitch;
 }
endif;

/*************************************************
## Shopwise Comment Placeholder
 *************************************************/

add_filter( 'comment_form_default_fields', 'shopwise_comment_placeholders' );
function shopwise_comment_placeholders( $fields ){
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'.esc_attr__('Name * ','shopwise').'"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input',
        '<input placeholder="'.esc_attr__('Email *','shopwise').'"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input',
        '<input placeholder="'.esc_attr__('Website','shopwise').'"',
        $fields['url']
    );
    return $fields;
}

add_filter( 'comment_form_defaults', 'shopwise_textarea_placeholder' );
function shopwise_textarea_placeholder( $fields ){

    $fields['comment_field'] = str_replace(
        '<textarea',
        '<textarea placeholder="'.esc_attr__('Comment','shopwise').'"',
        $fields['comment_field']
    );
    return $fields;
}


/*************************************************
## Shopwise Widget Count Filter
 *************************************************/

function shopwise_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="catcount">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return shopwise_sanitize_data($links);
}
add_filter('wp_list_categories', 'shopwise_cat_count_span');
 
function shopwise_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="catcount">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return shopwise_sanitize_data($links);
}
add_filter( 'get_archives_link', 'shopwise_archive_count_span' );


/*************************************************
## Pingback url auto-discovery header for single posts, pages, or attachments
 *************************************************/
function shopwise_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'shopwise_pingback_header' );

/************************************************************
## DATA CONTROL FROM PAGE METABOX OR ELEMENTOR PAGE SETTINGS
*************************************************************/
function shopwise_page_settings( $opt_id){
	
	if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
		// Get the current post id
		$post_id = get_the_ID();

		// Get the page settings manager
		$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

		// Get the settings model for current post
		$page_settings_model = $page_settings_manager->get_model( $post_id );

		// Retrieve the color we added before
		$output = $page_settings_model->get_settings( 'shopwise_elementor_'.$opt_id );
		
		return $output;
	}
}

/*************************************************
## Shopwise Theme options
*************************************************/

	require_once get_template_directory() . '/includes/metaboxes.php';
	require_once get_template_directory() . '/includes/woocommerce.php';
	require_once get_template_directory() . '/includes/sanitize.php';
	require_once get_template_directory() . '/includes/merlin/setup-wizard.php';
