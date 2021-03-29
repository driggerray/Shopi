<?php
/************************************************************
## Setup Wizard
*************************************************************/
require_once get_parent_theme_file_path( '/includes/merlin/vendor/autoload.php' );
require_once get_parent_theme_file_path( '/includes/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/includes/merlin/merlin-config.php' );

/************************************************************
## Setup Wizard Local Import
*************************************************************/
function merlin_local_import_files() {
	return array(
		array(
			'import_file_name'             => 'Import Fashion Demo',
			'local_import_file'            => get_parent_theme_file_path( '/includes/merlin/demo-data/fashion/fashion-content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( '/includes/merlin/demo-data/fashion/fashion-widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( '/includes/merlin/demo-data/fashion/fashion-customizer.dat' ),
		),
		
		array(
			'import_file_name'             => 'Import Furniture Demo',
			'local_import_file'            => get_parent_theme_file_path( '/includes/merlin/demo-data/furniture/furniture-content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( '/includes/merlin/demo-data/furniture/furniture-widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( '/includes/merlin/demo-data/furniture/furniture-customizer.dat' ),
		),
		
		array(
			'import_file_name'             => 'Import Electronic Demo',
			'local_import_file'            => get_parent_theme_file_path( '/includes/merlin/demo-data/electronic/electronic-content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( '/includes/merlin/demo-data/electronic/electronic-widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( '/includes/merlin/demo-data/electronic/electronic-customizer.dat' ),
		),
		
	);
}
add_filter( 'merlin_import_files', 'merlin_local_import_files' );

/************************************************************
## Setup Wizard After Import
*************************************************************/
function prefix_merlin_after_import_setup() {
	// Assign menus to their locations.
	$main_menu 	  = get_term_by( 'name', 'Menu 1', 'nav_menu' );
	$sidebar_menu = get_term_by( 'name', 'Sidebar Menu', 'nav_menu' );
	$toprightmenu = get_term_by( 'name', 'Top Right', 'nav_menu' );
	$topleftmenu  = get_term_by( 'name', 'Top Left', 'nav_menu' );
	
	set_theme_mod(
		'nav_menu_locations', array(
			'main-menu' 	     => $main_menu->term_id,
			'klb-sidebar-menu'   => $sidebar_menu->term_id,
			'top-right-menu' 	 => $toprightmenu->term_id,
			'top-left-menu' 	 => $topleftmenu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Fashion 1' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'merlin_after_all_import', 'prefix_merlin_after_import_setup' );
?>