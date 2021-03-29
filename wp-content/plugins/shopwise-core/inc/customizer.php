<?php
/*======
*
* Kirki Settings
*
======*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

Kirki::add_config(
	'shopwise_customizer', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);

/*======
*
* Sections
*
======*/
$sections = array(
	'shop_settings' => array (
		esc_attr__( 'Shop Settings', 'shopwise' ),
		esc_attr__( 'You can customize the shop settings.', 'shopwise' ),
	),
	
	'blog_settings' => array (
		esc_attr__( 'Blog Settings', 'shopwise' ),
		esc_attr__( 'You can customize the blog settings.', 'shopwise' ),
	),

	'header_settings' => array (
		esc_attr__( 'Header Settings', 'shopwise' ),
		esc_attr__( 'You can customize the header settings.', 'shopwise' ),
	),

	'main_color' => array (
		esc_attr__( 'Main Color', 'shopwise' ),
		esc_attr__( 'You can customize the main color.', 'shopwise' ),
	),
	
	'map_settings' => array (
		esc_attr__( 'Map Settings', 'shopwise' ),
		esc_attr__( 'You can customize the map settings.', 'shopwise' ),
	),

	'footer_settings' => array (
		esc_attr__( 'Footer Settings', 'shopwise' ),
		esc_attr__( 'You can customize the footer settings.', 'shopwise' ),
	),
	
	'shopwise_widgets' => array (
		esc_attr__( 'Shopwise Widgets', 'shopwise' ),
		esc_attr__( 'You can customize the shopwise widgets.', 'shopwise' ),
	),

);

foreach ( $sections as $section_id => $section ) {
	$section_args = array(
		'title' => $section[0],
		'description' => $section[1],
	);

	if ( isset( $section[2] ) ) {
		$section_args['type'] = $section[2];
	}

	if( $section_id == "colors" ) {
		Kirki::add_section( str_replace( '-', '_', $section_id ), $section_args );
	} else {
		Kirki::add_section( 'shopwise_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
	}
}


/*======
*
* Fields
*
======*/
function shopwise_customizer_add_field ( $args ) {
	Kirki::add_field(
		'shopwise_customizer',
		$args
	);
}

	/*====== Shop ======*/
		/*====== Shop Panels ======*/
		Kirki::add_panel (
			'shopwise_shop_panel',
			array(
				'title' => esc_html__( 'Shop Settings', 'shopwise' ),
				'description' => esc_html__( 'You can customize the shop from this panel.', 'shopwise' ),
			)
		);

		$sections = array (
			'shop_general' => array(
				esc_attr__( 'General', 'shopwise' ),
				esc_attr__( 'You can customize shop settings.', 'shopwise' )
			),
			
			'single_product' => array(
				esc_attr__( 'Single Product', 'shopwise' ),
				esc_attr__( 'You can customize shop single settings.', 'shopwise' )
			),
			
			'testimonial_slider_widget' => array(
				esc_attr__( 'Testimonial Slider Widget', 'shopwise' ),
				esc_attr__( 'When you add the Testimonial Slider Widget in Dashboard > Appearance > Widgets, you can customize the settings from there.', 'shopwise' )
			),

		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'shopwise_shop_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'shopwise_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Shop Layouts ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'shopwise_product_type',
				'label' => esc_attr__( 'Product Type', 'shopwise' ),
				'description' => esc_attr__( 'You can choose a type for the products.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => 'type1',
				'choices' => array(
					'type1' => esc_attr__( 'Type 1', 'shopwise' ),
					'type2' => esc_attr__( 'Type 2', 'shopwise' ),
					'type3' => esc_attr__( 'Type 3', 'shopwise' ),
				),
			)
		);
		
		/*====== Shop Layouts ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'shopwise_shop_layout',
				'label' => esc_attr__( 'Layout', 'shopwise' ),
				'description' => esc_attr__( 'You can choose a layout for the shop.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => 'left-sidebar',
				'choices' => array(
					'left-sidebar' => esc_attr__( 'Left Sidebar', 'shopwise' ),
					'full-width' => esc_attr__( 'Full Width', 'shopwise' ),
					'right-sidebar' => esc_attr__( 'Right Sidebar', 'shopwise' ),
				),
			)
		);
		
		/*====== View Type ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'shopwise_view_type',
				'label' => esc_attr__( 'Default View', 'shopwise' ),
				'description' => esc_attr__( 'You can choose a view type for the shop page.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => 'grid-view',
				'choices' => array(
					'grid-view' => esc_attr__( 'Grid View', 'shopwise' ),
					'list-view' => esc_attr__( 'List view', 'shopwise' ),
				),
			)
		);
		
		/*====== Breadcrumb Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_shop_breadcrumb',
				'label' => esc_attr__( 'Breadcrumb', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable breadcrumb on shop pages.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Breadcrumb Text ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_breadcrumb_title',
				'label' => esc_attr__( 'Breadcrumb Title', 'shopwise' ),
				'description' => esc_attr__( 'You can set a title for the breadcrumb..', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => 'Products',
				'required' => array(
					array(
					  'setting'  => 'shopwise_shop_breadcrumb',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Header Cart Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_header_cart',
				'label' => esc_attr__( 'Header Cart', 'shopwise' ),
				'description' => esc_attr__( 'You can choose status of the mini cart on the header.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Header Search Button Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_header_search_button',
				'label' => esc_attr__( 'Header Search Button', 'shopwise' ),
				'description' => esc_attr__( 'You can choose status of the search button on the header.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		
		/*====== Gris-List View Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_grid_list_view',
				'label' => esc_attr__( 'Grid-List View', 'shopwise' ),
				'description' => esc_attr__( 'You can choose status of the product view button on the shop page.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Quick View Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_quick_view_button',
				'label' => esc_attr__( 'Quick View Button', 'shopwise' ),
				'description' => esc_attr__( 'You can choose status of the quick view button.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Wishlist Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_wishlist_button',
				'label' => esc_attr__( 'Custom Wishlist Button', 'shopwise' ),
				'description' => esc_attr__( 'You can choose status of the wishlist button.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Compare Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_compare_button',
				'label' => esc_attr__( 'Custom Compare Button', 'shopwise' ),
				'description' => esc_attr__( 'You can choose status of the compare button.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Single Social Share ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_shop_social_share',
				'label' => esc_attr__( 'Social Share', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable social share buttons.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);

		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_mobile_bottom_menu',
				'label' => esc_attr__( 'Mobile Bottom Menu', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable the bottom menu on mobile.', 'shopwise' ),
				'section' => 'shopwise_shop_general_section',
				'default' => '0',
			)
		);
		
		/*====== Featured List Single ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'shopwise_featured_listem',
				'label' => esc_attr__( 'Featured List', 'shopwise' ),
				'description' => esc_attr__( 'You can create featured list.', 'shopwise' ),
				'section' => 'shopwise_single_product_section',
				'row_label' => array (
					'type' => 'field',
					'field' => 'link_text',
				),
				'fields' => array(
					'featured_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Featured Icon', 'shopwise' ),
						'description' => esc_attr__( 'You can set a icon.For example; linearicons-bag-dollar.', 'shopwise' ),
					),
				
					'featured_text' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Featured Content', 'shopwise' ),
						'description' => esc_attr__( 'You can enter a text.', 'shopwise' ),
					),
				),
			)
		);
		

	/*====== Blog Settings ======*/
		/*====== Layouts ======*/
		
		shopwise_customizer_add_field (
			array(
				'type' => 'radio-buttonset',
				'settings' => 'shopwise_blog_layout',
				'label' => esc_attr__( 'Layout', 'shopwise' ),
				'description' => esc_attr__( 'You can choose a layout.', 'shopwise' ),
				'section' => 'shopwise_blog_settings_section',
				'default' => 'right-sidebar',
				'choices' => array(
					'left-sidebar' => esc_attr__( 'Left Sidebar', 'shopwise' ),
					'full-width' => esc_attr__( 'Full Width', 'shopwise' ),
					'right-sidebar' => esc_attr__( 'Right Sidebar', 'shopwise' ),
				),
			)
		);
		
		/*====== Blog Breadcrumb Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_blog_breadcrumb',
				'label' => esc_attr__( 'Breadcrumb', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable breadcrumb on blog pages.', 'shopwise' ),
				'section' => 'shopwise_blog_settings_section',
				'default' => '1',
			)
		);
		
		/*====== Blog Breadcrumb Text ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_blog_breadcrumb_title',
				'label' => esc_attr__( 'Breadcrumb Title', 'shopwise' ),
				'description' => esc_attr__( 'You can set a title for the breadcrumb..', 'shopwise' ),
				'section' => 'shopwise_blog_settings_section',
				'default' => 'Our Blog',
				'required' => array(
					array(
					  'setting'  => 'shopwise_blog_breadcrumb',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Main color ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#FF324D',
				'settings' => 'shopwise_main_color',
				'label' => esc_attr__( 'Main Color', 'luxe' ),
				'description' => esc_attr__( 'You can customize the main color.', 'luxe' ),
				'section' => 'shopwise_main_color_section',
			)
		);

		/*====== Map Settings ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_mapapi',
				'label' => esc_attr__( 'Google Map Api key', 'shopwise' ),
				'description' => esc_attr__( 'Add your google map api key', 'shopwise' ),
				'section' => 'shopwise_map_settings_section',
				'default' => '',
			)
		);
		
	/*====== Header ======*/
		/*====== Header Panels ======*/
		Kirki::add_panel (
			'shopwise_header_panel',
			array(
				'title' => esc_html__( 'Header Settings', 'shopwise' ),
				'description' => esc_html__( 'You can customize the header from this panel.', 'shopwise' ),
			)
		);

		$sections = array (
			'header_logo' => array(
				esc_attr__( 'Logo', 'shopwise' ),
				esc_attr__( 'You can customize the logo which is on header..', 'shopwise' )
			),
			
			'header_contact_detail' => array(
				esc_attr__( 'Contact Detail', 'shopwise' ),
				esc_attr__( 'You can customize contact detail which is on top header..', 'shopwise' )
			),
		
			'header_general' => array(
				esc_attr__( 'Header General', 'shopwise' ),
				esc_attr__( 'You can customize the header.', 'shopwise' )
			),

			'header_color' => array(
				esc_attr__( 'Header Color', 'shopwise-core' ),
				esc_attr__( 'You can customize the header color.', 'shopwise-core' )
			),

			'header_loader' => array(
				esc_attr__( 'Preloader', 'shopwise' ),
				esc_attr__( 'You can customize the loader.', 'shopwise' )
			),
			
			'subscribe_popup' => array(
				esc_attr__( 'Subscribe Popup', 'shopwise' ),
				esc_attr__( 'You can customize the subscribe popup.', 'shopwise' )
			),

		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'shopwise_header_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'shopwise_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Logo ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'shopwise_logo',
				'label' => esc_attr__( 'Logo', 'shopwise' ),
				'description' => esc_attr__( 'You can upload a logo.', 'shopwise' ),
				'section' => 'shopwise_header_logo_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);
		
		/*====== Logo Text ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_logo_text',
				'label' => esc_attr__( 'Set Logo Text', 'shopwise' ),
				'description' => esc_attr__( 'You can set logo as text.', 'shopwise' ),
				'section' => 'shopwise_header_logo_section',
				'default' => 'Shopwise',
			)
		);
		
		/*====== Logo Size ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'dimensions',
				'settings' => 'shopwise_logo_size',
				'label' => esc_attr__( 'Logo Size', 'shopwise' ),
				'description' => esc_attr__( 'You can set size of the logo.', 'shopwise' ),
				'section' => 'shopwise_header_logo_section',
				'default' => array(
					'width' => '182',
					'height' => '47',
				),
			)
		);
		
		
		/*====== Header Contact Text ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_header_contact_text',
				'label' => esc_attr__( 'Text', 'shopwise' ),
				'description' => esc_attr__( 'You can set contact details.', 'shopwise' ),
				'section' => 'shopwise_header_contact_detail_section',
				'default' => '',
			)
		);

		/*====== Header Contact Text ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_header_contact_text',
				'label' => esc_attr__( 'Text', 'shopwise' ),
				'description' => esc_attr__( 'You can set contact details.', 'shopwise' ),
				'section' => 'shopwise_header_contact_detail_section',
				'default' => '',
			)
		);

		/*====== Header Contact Icon ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_header_contact_icon',
				'label' => esc_attr__( 'Icon', 'shopwise' ),
				'description' => esc_attr__( 'You can set contact icon e.g: linearicons-phone-wave .', 'shopwise' ),
				'section' => 'shopwise_header_contact_detail_section',
				'default' => 'linearicons-phone-wave',
			)
		);
		
		/*====== Header Contact URL ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_header_contact_url',
				'label' => esc_attr__( 'URL', 'shopwise' ),
				'description' => esc_attr__( 'Add an url.', 'shopwise' ),
				'section' => 'shopwise_header_contact_detail_section',
				'default' => 'tel:1234567689',
			)
		);
		
		shopwise_customizer_add_field(
			array (
			'type'        => 'select',
			'settings'    => 'shopwise_header_type',
			'label'       => esc_html__( 'Header Type', 'shopwise' ),
			'section'     => 'shopwise_header_general_section',
			'default'     => 'type-1',
			'priority'    => 10,
			'choices'     => array(
				'type1' => esc_attr__( 'Type 1', 'shopwise' ),
				'type2' => esc_attr__( 'Type 2', 'shopwise' ),
				'type3' => esc_attr__( 'Type 3', 'shopwise' ),
				'type4' => esc_attr__( 'Type 4', 'shopwise' ),
				'type5' => esc_attr__( 'Type 5', 'shopwise' ),
			),
			) 
		);

		
		/*====== Header Sidebar Menu ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_header_sidebar_menu',
				'label' => esc_attr__( 'Sidebar Menu', 'shopwise' ),
				'description' => esc_attr__( 'You can choose status of the sidebar menu on the cart.', 'shopwise' ),
				'section' => 'shopwise_header_general_section',
				'default' => '0',
			)
		);

		/*====== Header Sidebar Menu Display Item ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'number',
				'settings' => 'shopwise_sidebar_menu_display_item',
				'label' => esc_attr__( 'Display Menu Item', 'shopwise' ),
				'description' => esc_attr__( 'You can set a count for the sidebar menu.', 'shopwise' ),
				'section' => 'shopwise_header_general_section',
				'default' => 11,
				'choices'     => [
					'min'  => 0,
					'max'  => 80,
					'step' => 1,
				],
				'required' => array(
					array(
					  'setting'  => 'shopwise_header_sidebar_menu',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		/*====== Top Header Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_top_header',
				'label' => esc_attr__( 'Top Header', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable the top header', 'shopwise' ),
				'section' => 'shopwise_header_general_section',
				'default' => '0',
			)
		);

		/*====== Header BG color ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#fff',
				'settings' => 'shopwise_header_bg',
				'label' => esc_attr__( 'Top Header Bg', 'shopwise-core' ),
				'description' => esc_attr__( 'You can set a color for top header background.', 'shopwise-core' ),
				'section' => 'shopwise_header_color_section',
			)
		);

		/*====== Header Font color ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'color',
				'default' => '#292b2c',
				'settings' => 'shopwise_header_font_color',
				'label' => esc_attr__( 'Header Font Color', 'shopwise-core' ),
				'description' => esc_attr__( 'You can set a color for header font.', 'shopwise-core' ),
				'section' => 'shopwise_header_color_section',
			)
		);

		/*====== Loader Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_loader',
				'label' => esc_attr__( 'Disable Loader', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable the loader.', 'shopwise' ),
				'section' => 'shopwise_header_loader_section',
				'default' => '0',
			)
		);

		/*====== Loader Image ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'shopwise_loader_image',
				'label' => esc_attr__( 'Image', 'shopwise' ),
				'description' => esc_attr__( 'You can upload an image.', 'shopwise' ),
				'section' => 'shopwise_header_loader_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'required' => array(
					array(
					  'setting'  => 'shopwise_loader',
					  'operator' => '==',
					  'value'    => '0',
					),
				),
			)
		);

		/*====== Subscribe Popup Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_subscribe_popup',
				'label' => esc_attr__( 'Subscribe Popup', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable the subscribe popup.', 'shopwise' ),
				'section' => 'shopwise_subscribe_popup_section',
				'default' => '0',
			)
		);
		
		/*====== Subscribe Popup Image ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'shopwise_subscribe_popup_image',
				'label' => esc_attr__( 'Image', 'shopwise' ),
				'description' => esc_attr__( 'You can upload an image for the popup.', 'shopwise' ),
				'section' => 'shopwise_subscribe_popup_section',
				'choices' => array(
					'save_as' => 'id',
				),
				'required' => array(
					array(
					  'setting'  => 'shopwise_subscribe_popup',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subscribe Popup Title======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_subscribe_popup_title',
				'label' => esc_attr__( 'Title', 'shopwise' ),
				'description' => esc_attr__( 'You can set the title for the popup.', 'shopwise' ),
				'section' => 'shopwise_subscribe_popup_section',
				'default' => 'Subscribe Our Newsletter',
				'required' => array(
					array(
					  'setting'  => 'shopwise_subscribe_popup',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subscribe Popup Subtitle======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_subscribe_popup_subtitle',
				'label' => esc_attr__( 'Subtitle', 'shopwise' ),
				'description' => esc_attr__( 'You can set the subtitle for the popup.', 'shopwise' ),
				'section' => 'shopwise_subscribe_popup_section',
				'default' => 'Subscribe to the newsletter to receive updates about new products.',
				'required' => array(
					array(
					  'setting'  => 'shopwise_subscribe_popup',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subcribe Popup FORM ID======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_subscribe_popup_formid',
				'label' => esc_attr__( 'Subscribe Form Id.', 'shopwise' ),
				'description' => esc_attr__( 'You can find the form id in Dashboard > Mailchimp For Wp > Form.', 'shopwise' ),
				'section' => 'shopwise_subscribe_popup_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'shopwise_subscribe_popup',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
	/*====== Shopwise Widgets ======*/
		/*====== Widgets Panels ======*/
		Kirki::add_panel (
			'shopwise_widgets_panel',
			array(
				'title' => esc_html__( 'Shopwise Widgets', 'shopwise' ),
				'description' => esc_html__( 'You can customize the shopwise widgets.', 'shopwise' ),
			)
		);

		$sections = array (
			'footer_about' => array(
				esc_attr__( 'Footer About', 'shopwise' ),
				esc_attr__( 'You can customize the footer about widget.', 'shopwise' )
			),
		
			'contact_box' => array(
				esc_attr__( 'Contact Box', 'shopwise' ),
				esc_attr__( 'You can customize the contact box widget.', 'shopwise' )
			),
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'shopwise_widgets_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'shopwise_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		/*====== Footer About Widget Logo ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'image',
				'settings' => 'shopwise_footer_about_logo',
				'label' => esc_attr__( 'Logo', 'shopwise' ),
				'description' => esc_attr__( 'You can upload a logo.', 'shopwise' ),
				'section' => 'shopwise_footer_about_section',
				'choices' => array(
					'save_as' => 'id',
				),
			)
		);
		
		/*====== Footer About Widget Logo Size ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'dimensions',
				'settings' => 'shopwise_footer_about_logo_size',
				'label' => esc_attr__( 'Logo Size', 'shopwise' ),
				'description' => esc_attr__( 'You can set size of the logo.', 'shopwise' ),
				'section' => 'shopwise_footer_about_section',
				'default' => array(
					'width' => '182',
					'height' => '47',
				),
			)
		);
		
		
		/*====== Footer About Widget Textarea ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'shopwise_footer_about_text',
				'label' => esc_attr__( 'Content', 'shopwise' ),
				'description' => esc_attr__( 'You can set text for the about widget.', 'shopwise' ),
				'section' => 'shopwise_footer_about_section',
				'default' => '',
			)
		);
		
		/*====== Footer About Widget Social======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'shopwise_footer_about_social',
				'label' => esc_attr__( 'Footer About Social', 'shopwise' ),
				'description' => esc_attr__( 'You can set the widget settings.', 'shopwise' ),
				'section' => 'shopwise_footer_about_section',
				'fields' => array(
					'social_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'shopwise' ),
						'description' => esc_attr__( 'You can set an icon from fontawesome.com for example; "ion-social-facebook"', 'shopwise' ),
					),

					'social_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'shopwise' ),
						'description' => esc_attr__( 'You can set url for the item.', 'shopwise' ),
					),

				),
			)
		);
		
		
		
		/*====== Contact Box Widget ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'shopwise_contact_box_widget',
				'label' => esc_attr__( 'Contact Box Widget', 'shopwise' ),
				'description' => esc_attr__( 'You can set contact detail.', 'shopwise' ),
				'section' => 'shopwise_contact_box_section',
				'fields' => array(
					'contact_detail' => array(
						'type' => 'textarea',
						'label' => esc_attr__( 'Content', 'shopwise' ),
						'description' => esc_attr__( 'You can enter a text.', 'shopwise' ),
					),
					
					'contact_icon' => array(
						'type' => 'text',
						'label' => esc_attr__( 'Icon', 'shopwise' ),
						'description' => esc_attr__( 'You can set an icon from fontawesome.com for example; "ti-location-pin"', 'shopwise' ),
					),

					'contact_url' => array(
						'type' => 'text',
						'label' => esc_attr__( 'URL', 'shopwise' ),
						'description' => esc_attr__( 'You can set url for the list.', 'shopwise' ),
					),

				),
			)
		);
		
	/*====== Footer ======*/
		/*====== Footer Panels ======*/
		Kirki::add_panel (
			'shopwise_footer_panel',
			array(
				'title' => esc_html__( 'Footer Settings', 'shopwise' ),
				'description' => esc_html__( 'You can customize the footer from this panel.', 'shopwise' ),
			)
		);

		$sections = array (
			'footer_subscribe' => array(
				esc_attr__( 'Subscribe', 'shopwise' ),
				esc_attr__( 'You can customize the subscribe area..', 'shopwise' )
			),

			'top_footer' => array(
				esc_attr__( 'Top Footer', 'shopwise' ),
				esc_attr__( 'You can customize the top footer settings.', 'shopwise' )
			),
			
			'footer_general' => array(
				esc_attr__( 'Footer General', 'shopwise' ),
				esc_attr__( 'You can customize the footer settings.', 'shopwise' )
			),
		);

		foreach ( $sections as $section_id => $section ) {
			$section_args = array(
				'title' => $section[0],
				'description' => $section[1],
				'panel' => 'shopwise_footer_panel',
			);

			if ( isset( $section[2] ) ) {
				$section_args['type'] = $section[2];
			}

			Kirki::add_section( 'shopwise_' . str_replace( '-', '_', $section_id ) . '_section', $section_args );
		}
		
		
		/*====== Subcribe Toggle ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'toggle',
				'settings' => 'shopwise_footer_subscribe_area',
				'label' => esc_attr__( 'Subcribe', 'shopwise' ),
				'description' => esc_attr__( 'Disable or Enable subscribe section on the footer.', 'shopwise' ),
				'section' => 'shopwise_footer_subscribe_section',
				'default' => '0',
			)
		);
		
		/*====== Subscribe Title ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'textarea',
				'settings' => 'shopwise_footer_subscribe_title',
				'label' => esc_attr__( 'Title', 'shopwise' ),
				'description' => esc_attr__( 'You can set text for subscribe section.', 'shopwise' ),
				'section' => 'shopwise_footer_subscribe_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'shopwise_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);
		
		/*====== Subcribe FORM ID======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_footer_subscribe_formid',
				'label' => esc_attr__( 'Subscribe Form Id.', 'shopwise' ),
				'description' => esc_attr__( 'You can find the form id in Dashboard > Mailchimp For Wp > Form.', 'shopwise' ),
				'section' => 'shopwise_footer_subscribe_section',
				'default' => '',
				'required' => array(
					array(
					  'setting'  => 'shopwise_footer_subscribe_area',
					  'operator' => '==',
					  'value'    => '1',
					),
				),
			)
		);

		
		/*====== Copyright ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'text',
				'settings' => 'shopwise_copyright',
				'label' => esc_attr__( 'Copyright', 'shopwise' ),
				'description' => esc_attr__( 'You can set a copyright text for the footer.', 'shopwise' ),
				'section' => 'shopwise_footer_general_section',
				'default' => '',
			)
		);

		/*====== Payment Images ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'repeater',
				'settings' => 'shopwise_footer_payment',
				'label' => esc_attr__( 'Payment Images', 'shopwise' ),
				'description' => esc_attr__( 'You can create payment images for the footer.', 'shopwise' ),
				'section' => 'shopwise_footer_general_section',
				'fields' => array(
					'payment_image' => array(
						'type' => 'image',
						'label' => esc_attr__( 'Image', 'shopwise' ),
						'description' => esc_attr__( 'Upload an image.', 'shopwise' ),
					),
				),
			)
		);

		/*====== Footer Column ======*/
		shopwise_customizer_add_field (
			array(
				'type' => 'select',
				'settings' => 'shopwise_footer_column',
				'label' => esc_attr__( 'Footer Column', 'shopwise' ),
				'description' => esc_attr__( 'You can set footer column.', 'shopwise' ),
				'section' => 'shopwise_footer_general_section',
				'default' => 'type1',
				'choices' => array(
					'5columns' => esc_attr__( '5 Columns', 'shopwise' ),
					'4columns' => esc_attr__( '4 Columns', 'shopwise' ),
					'3columns' => esc_attr__( '3 Columns', 'shopwise' ),
				),
			)
		);
		

