<header class="klb-header5 header_wrap">
	<div class="top-header light_skin bg_dark d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-start">
						<?php 
						   wp_nav_menu(array(
						   'theme_location' => 'top-left-menu',
						   'container' => '',
						   'fallback_cb' => 'show_top_menu',
						   'menu_id' => '',
						   'menu_class' => 'klb-left-menu',
						   'echo' => true,
						   'depth' => 0 
							)); 
						 ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-end">
						<?php 
						   wp_nav_menu(array(
						   'theme_location' => 'top-right-menu',
						   'container' => '',
						   'fallback_cb' => 'show_top_menu',
						   'menu_id' => '',
						   'menu_class' => 'header_list',
						   'echo' => true,
						   'depth' => 0 
							)); 
						 ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-header dark_skin">
    	<div class="container">
            <div class="nav_block">
				<?php if(shopwise_page_settings('logo')['url']){ ?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
						<img class="logo_dark" src="<?php echo esc_url( shopwise_page_settings('logo')['url'] ); ?>" alt="<?php bloginfo("name"); ?>">
					</a>
				<?php } elseif (get_theme_mod( 'shopwise_logo' )) { ?>
					<?php $size = get_theme_mod( 'shopwise_logo_size', array( 'width' => '182', 'height' => '47') ); ?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
						<img class="logo_dark" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_logo' )) ); ?>" width="<?php echo esc_attr( $size["width"] ); ?>" height="<?php echo esc_attr( $size["height"] ); ?>" alt="<?php bloginfo("name"); ?>">
					</a>
				<?php } elseif (get_theme_mod( 'shopwise_logo_text' )) { ?>
					<a class="navbar-brand text" href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
						<span><?php echo esc_html(get_theme_mod( 'shopwise_logo_text' )); ?></span>
					</a>
				<?php } else { ?>
					<a class="navbar-brand text" href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
						<span><?php esc_html_e("Shopwise","shopwise"); ?></span>
					</a>
				<?php } ?>
				
				<?php $searchbutton = get_theme_mod('shopwise_header_search_button','0'); ?>
				<?php if($searchbutton == '1'){ ?>
                <div class="product_search_form radius_input search_form_btn">
                    <?php echo shopwise_category_search_form3(); ?>
                </div>
				<?php } ?>

                <ul class="navbar-nav attr-nav align-items-center">
                    <?php $headercart = get_theme_mod('shopwise_header_cart','0'); ?>
					<?php if($headercart == '1'){ ?>
						<?php get_template_part( 'includes/header/cart' ); ?>
					<?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase border-top">
    	<div class="container">
            <div class="row align-items-center"> 
            	<div class="col-lg-3 col-md-4 col-sm-6 col-3">
                	<div class="categories_wrap">
                        <button type="button" data-toggle="collapse" data-target="#navCatContent" aria-expanded="false" class="categories_btn categories_menu">
                            <span><?php esc_html_e('All Categories','shopwise'); ?> </span><i class="linearicons-menu"></i>
                        </button>
                        <div id="navCatContent" class="navbar collapse">
							<?php 
							   wp_nav_menu(array(
							   'theme_location' => 'klb-sidebar-menu',
							   'container' => '',
							   'fallback_cb' => 'show_top_menu',
							   'menu_id' => '',
							   'menu_class' => '',
							   'echo' => true,
								"walker" => new shopwise_sidebar_walker(),
							   'depth' => 0 
								)); 
							 ?>
                            <div class="more_categories"><?php esc_html_e('More Categories','shopwise'); ?></div>
                        </div>
						<?php
						$itemcount = get_theme_mod('shopwise_sidebar_menu_display_item');
						wp_enqueue_script( 'shopwise-sidebar-menu');
						wp_localize_script('shopwise-sidebar-menu', 'sidebarmenu' , 
						array( 
							'displayitem' => $itemcount,
						));
						?>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                	<nav class="navbar navbar-expand-lg">
                    	<button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="pr_search_icon">
                            <a href="javascript:void(0);" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                        </div> 
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
							<?php 
							   wp_nav_menu(array(
							   'theme_location' => 'main-menu',
							   'container' => '',
							   'fallback_cb' => 'show_top_menu',
							   'menu_id' => '',
							   'menu_class' => 'navbar-nav',
							   'echo' => true,
								"walker" => new shopwise_description_walker(),
							   'depth' => 0 
								)); 
							 ?>
                        </div>
						<?php if(get_theme_mod('shopwise_header_contact_text')){ ?>
							<div class="contact_phone contact_support">
								<a href="<?php echo shopwise_sanitize_data(get_theme_mod('shopwise_header_contact_url')); ?>" title="<?php echo esc_attr(get_theme_mod('shopwise_header_contact_text')); ?>">
									<i class="<?php echo esc_attr(get_theme_mod('shopwise_header_contact_icon')); ?>"></i>
									<span><?php echo esc_html(get_theme_mod('shopwise_header_contact_text')); ?></span>
								</a>
							</div>
						<?php } ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>