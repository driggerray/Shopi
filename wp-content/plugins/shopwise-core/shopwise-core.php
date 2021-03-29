<?php
/**
* Plugin Name: Shopwise Core
* Description: Premium & Advanced Essential Elements for Elementor
* Plugin URI:  http://themeforest.net/user/KlbTheme
* Version:     1.0.7
* Author:      KlbTheme
* Author URI:  http://themeforest.net/user/KlbTheme
*/


/*
* Exit if accessed directly.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

final class Shopwise_Elementor_Addons
{
    /**
    * Plugin Version
    *
    * @since 1.0
    *
    * @var string The plugin version.
    */
    const VERSION = '1.0.0';

    /**
    * Minimum Elementor Version
    *
    * @since 1.0
    *
    * @var string Minimum Elementor version required to run the plugin.
    */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
    * Minimum PHP Version
    *
    * @since 1.0
    *
    * @var string Minimum PHP version required to run the plugin.
    */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
    * Instance
    *
    * @since 1.0
    *
    * @access private
    * @static
    *
    * @var Shopwise_Elementor_Addons The single instance of the class.
    */
    private static $_instance = null;

    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.0
    *
    * @access public
    * @static
    *
    * @return Shopwise_Elementor_Addons An instance of the class.
    */
    public static function instance()
    {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
    * Constructor
    *
    * @since 1.0
    *
    * @access public
    */
    public function __construct()
    {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
    * Load Textdomain
    *
    * Load plugin localization files.
    *
    * Fired by `init` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function i18n()
    {
        load_plugin_textdomain( 'shopwise-elementor' );
    }
	
   /**
    * Initialize the plugin
    *
    * Load the plugin only after Elementor (and other plugins) are loaded.
    * Checks for basic plugin requirements, if one check fail don't continue,
    * if all check have passed load the files required to run the plugin.
    *
    * Fired by `plugins_loaded` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function init()
    {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'shopwise_admin_notice_missing_main_plugin' ] );
            return;
        }
        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'shopwise_admin_notice_minimum_elementor_version' ] );
            return;
        }
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'shopwise_admin_notice_minimum_php_version' ] );
            return;
        }
		
		// Categories registered
        add_action( 'elementor/elements/categories_registered', [ $this, 'shopwise_add_widget_category' ] );

        /* Customizer Kirki */
        require_once( __DIR__ . '/inc/customizer.php' );

        /* Style php */
        require_once( __DIR__ . '/inc/style.php' );
		
		/* Aq Resizer Image Resize */
        require_once( __DIR__ . '/inc/aq_resizer.php' );
		
		/* Breadcrumb */
        require_once( __DIR__ . '/inc/breadcrumb.php' );

		/* Post view for popular posts widget */
        require_once( __DIR__ . '/inc/post_view.php' );
		
        /* Popular Posts Widget */
        require_once( __DIR__ . '/widgets/widget-popular-posts.php' );
		
		/* Contact Box Widget */
        require_once( __DIR__ . '/widgets/widget-contact.php' );
	
		/* Footer About Widget */
        require_once( __DIR__ . '/widgets/widget-footer-about.php' );

		/* Single Banner Widget */
        require_once( __DIR__ . '/widgets/widget-single-banner.php' );
		
		/* Single Banner Widget 2 */
        require_once( __DIR__ . '/widgets/widget-single-banner-2.php' );
		
		/* Single Banner Widget 3 */
        require_once( __DIR__ . '/widgets/widget-single-banner-3.php' );
		
		/* Product Status Widget */
		require_once('widgets/widget-product-status.php');

		/* Product Categories Widget */
		require_once('widgets/widget-product-categories.php');

		/* Product Cat Icon */
        require_once( __DIR__ . '/taxonomy/product_cat.php' );
		
		/* Init Include */
        require_once( __DIR__ . '/init.php' );

        /* Custom plugin helper functions */
        require_once( __DIR__ . '/elementor/classes/class-helpers-functions.php' );
		
        /* Custom plugin helper functions */
        require_once( __DIR__ . '/elementor/classes/class-customizing-page-settings.php' );
		

		
        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
		
        // Register Widget Scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );
		
        // Widgets registered
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    }
	
    /**
    * Register Widgets Category
    *
    */
    public function shopwise_add_widget_category( $elements_manager )
    {
        $elements_manager->add_category( 'shopwise', ['title' => esc_html__( 'Shopwise Core', 'shopwise' )]);
    }	
	
    /**
    * Init Widgets
    *
    * Include widgets files and register them
    *
    * @since 1.0
    *
    * @access public
    */
    public function init_widgets()
    {
		
			// Breadcrumb
            require_once( __DIR__ . '/elementor/widgets/shopwise-breadcrumb.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Breadcrumb_Widget() );
			
			// Home Slider
            require_once( __DIR__ . '/elementor/widgets/shopwise-home-slider.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Home_Slider_Widget() );
			
			// Home Slider 2
            require_once( __DIR__ . '/elementor/widgets/shopwise-home-slider-2.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Home_Slider_2_Widget() );
			
			// Home Full Slider
            require_once( __DIR__ . '/elementor/widgets/shopwise-home-full-slider.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Home_Full_Slider_Widget() );
			
			// Single Banner
            require_once( __DIR__ . '/elementor/widgets/shopwise-single-banner.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Single_Banner_Widget() );
			
			// Product Tab
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-tab.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Tab_Widget() );
			
			// Product Tab Carousel
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-tab-carousel.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Tab_Carousel_Widget() );
			
			// Product Tab Carousel 2
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-tab-carousel-2.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Tab_Carousel_2_Widget() );
			
			// Trending Section
            require_once( __DIR__ . '/elementor/widgets/shopwise-trending-section.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Trending_Section_Widget() );
			
			// Product Grid
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-grid.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Grid_Widget() );
			
			// Product List
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-list.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_List_Widget() );
			
			// Product Carousel
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-carousel.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Carousel_Widget() );
			
			// Product Carousel 2
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-carousel-2.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Carousel_2_Widget() );
			
			// Product Carousel 3
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-carousel-3.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Carousel_3_Widget() );
			
			// Product Carousel 4
            require_once( __DIR__ . '/elementor/widgets/shopwise-product-carousel-4.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Product_Carousel_4_Widget() );
			
			// Testimonial
            require_once( __DIR__ . '/elementor/widgets/shopwise-testimonial.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Testimonial_Widget() );
			
			// Icon Box
            require_once( __DIR__ . '/elementor/widgets/shopwise-icon-box.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Icon_Box_Widget() );
			
			// Client Carousel
            require_once( __DIR__ . '/elementor/widgets/shopwise-clients-carousel.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Clients_Carousel_Widget() );
			
			// Team Box
            require_once( __DIR__ . '/elementor/widgets/shopwise-team-box.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Team_Box_Widget() );
			
			// Contact Form 7
            require_once( __DIR__ . '/elementor/widgets/shopwise-contact-form-7.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Contact_Form_7_Widget() );
			
			// Latest Blog Posts
            require_once( __DIR__ . '/elementor/widgets/shopwise-latest-blog.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Latest_Blog_Widget() );
			
			// Custom Title
            require_once( __DIR__ . '/elementor/widgets/shopwise-custom-title.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Custom_Title_Widget() );
			
			// Image Carousel
            require_once( __DIR__ . '/elementor/widgets/shopwise-image-carousel.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Image_Carousel_Widget() );
			
			// Category Carousel
            require_once( __DIR__ . '/elementor/widgets/shopwise-category-carousel.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Category_Carousel_Widget() );
			
			// Deal Section
            require_once( __DIR__ . '/elementor/widgets/shopwise-deal-section.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Deal_Section_Widget() );
			
			// Deal Carousel
            require_once( __DIR__ . '/elementor/widgets/shopwise-deal-carousel.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Deal_Carousel_Widget() );
			
			// Single Image
            require_once( __DIR__ . '/elementor/widgets/shopwise-single-image.php' );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Shopwise_Single_Image_Widget() );			
	}
	
	
    /**
    * Admin notice
    *
    * Warning when the site doesn't have Elementor installed or activated.
    *
    * @since 1.0
    *
    * @access public
    */
    public function shopwise_admin_notice_missing_main_plugin()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '%1$s requires %2$s to be installed and activated.', 'shopwise' ),
            '<strong>' . esc_html__( 'Shopwise Core', 'shopwise' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'shopwise' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required Elementor version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function shopwise_admin_notice_minimum_elementor_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'shopwise' ),
            '<strong>' . esc_html__( 'Shopwise Core', 'shopwise' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'shopwise' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required PHP version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function shopwise_admin_notice_minimum_php_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'shopwise' ),
            '<strong>' . esc_html__( 'Shopwise Core', 'shopwise' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'shopwise' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
	
    public function widget_styles()
    {
    }

    public function widget_scripts()
    {


		if (is_admin ()){
			wp_enqueue_media ();
			wp_enqueue_script( 'widget-image', plugins_url( 'js/widget-image.js', __FILE__ ));
		}

        // custom-scripts
        wp_enqueue_script( 'shopwise-core-custom-scripts', plugins_url( 'elementor/custom-scripts.js', __FILE__ ), true );
    }


} 
Shopwise_Elementor_Addons::instance();