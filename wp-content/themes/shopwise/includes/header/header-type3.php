<header class="klb-header3 header_wrap fixed-top dd_dark_skin transparent_header">
    <div class="light_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg">
				<?php if(shopwise_page_settings('logo')['url']){ ?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
						<img class="logo_light" src="<?php echo esc_url( shopwise_page_settings('logo')['url'] ); ?>" alt="<?php bloginfo("name"); ?>">
					</a>
				<?php } elseif (get_theme_mod( 'shopwise_logo' )) { ?>
					<?php $size = get_theme_mod( 'shopwise_logo_size', array( 'width' => '182', 'height' => '47') ); ?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
						<img class="logo_light" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_logo' )) ); ?>" width="<?php echo esc_attr( $size["width"] ); ?>" height="<?php echo esc_attr( $size["height"] ); ?>" alt="<?php bloginfo("name"); ?>">
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
				
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
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
                <ul class="navbar-nav attr-nav align-items-center">
					<?php $searchbutton = get_theme_mod('shopwise_header_search_button','0'); ?>
					<?php if($searchbutton == '1'){ ?>
						<?php get_template_part( 'includes/header/search' ); ?>
					<?php } ?>
					
					<?php $headercart = get_theme_mod('shopwise_header_cart','0'); ?>
					<?php if($headercart == '1'){ ?>
						<?php get_template_part( 'includes/header/cart' ); ?>
					<?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</header>