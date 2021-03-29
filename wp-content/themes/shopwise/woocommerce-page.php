<?php

/**
 * woocommerce-page.php
 * @package WordPress
 * @subpackage shopwise
 * @since shopwise 1.0
 * 
 */

?>

<?php get_header(); ?>

<?php $breadcrumb = get_theme_mod('shopwise_shop_breadcrumb','1'); ?>

<?php if($breadcrumb == '1'){ ?>
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
			<?php if(is_product_category()){ ?>
				<div class="col-md-12">
					<div class="page-title">
						<h1><?php the_archive_title(); ?></h1>
					</div>
				</div>
			<?php } elseif(is_search()){ ?>
				<div class="col-md-12">
					<div class="page-title">
						<h1><?php printf( esc_html__( 'Search Results for: %s', 'shopwise' ), get_search_query() ); ?></h1>
					</div>
				</div>
			<?php } else { ?>
				<?php $breadcrumb_title = get_theme_mod('shopwise_breadcrumb_title'); ?>
				<div class="col-md-6">
					<div class="page-title">
						<?php if($breadcrumb_title){ ?>
							<h1><?php echo esc_html($breadcrumb_title); ?></h1>
						<?php } else { ?>
							<h1><?php echo esc_html_e('Products','shopwise'); ?></h1>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<?php woocommerce_breadcrumb(); ?>
				</div>
			<?php } ?>
        </div>
    </div>
</div>
<?php } else { ?>
	<div class="empty-klb"></div>
<?php } ?>

<div class="section">
	<div class="container">
    	<div class="row">
			<?php if( get_theme_mod( 'shopwise_shop_layout' ) == 'full-width') { ?>
				<div class="col-lg-12">
					<?php woocommerce_content(); ?>
				</div>
			<?php } elseif( get_theme_mod( 'shopwise_shop_layout' ) == 'right-sidebar') { ?>
				<div class="col-lg-9">
					<?php woocommerce_content(); ?>
				</div>
				<div class="col-lg-3">
					<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'shop-sidebar' ); ?>
					<?php } ?> 
				</div>
			<?php } else { ?>
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
					<div class="col-lg-9">
						<?php woocommerce_content(); ?>
					</div>
					<div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
						<div class="sidebar">
							<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
								<?php dynamic_sidebar( 'shop-sidebar' ); ?>
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="col-lg-10 offset-lg-1">
						<?php woocommerce_content(); ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>