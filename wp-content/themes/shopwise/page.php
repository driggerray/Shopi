<?php

/**
 * page.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 */
?>

<?php get_header(); ?>

	<?php $elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true ); ?> 

	<?php if ( class_exists( 'woocommerce' ) ) { ?>

		<?php if (is_cart()) { ?>
			<?php $breadcrumb = get_theme_mod('shopwise_shop_breadcrumb','0'); ?>
			<?php if($breadcrumb == '1'){ ?>
				<div class="breadcrumb_section bg_gray page-title-mini">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-6">
								<div class="page-title">
									<h1><?php the_title(); ?></h1>
								</div>
							</div>
							<div class="col-md-6">
								<?php woocommerce_breadcrumb(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="empty-klb"></div>
			<?php } ?>
			
			<div class="section">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<?php while(have_posts()) : the_post(); ?>
								<?php the_content (); ?>
								<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif (is_checkout()) { ?>
			<?php $breadcrumb = get_theme_mod('shopwise_shop_breadcrumb','0'); ?>
			<?php if($breadcrumb == '1'){ ?>
				<div class="breadcrumb_section bg_gray page-title-mini">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-6">
								<div class="page-title">
									<h1><?php the_title(); ?></h1>
								</div>
							</div>
							<div class="col-md-6">
								<?php woocommerce_breadcrumb(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="empty-klb"></div>
			<?php } ?>
		
			<section class="section">
				<div class="container">
					<?php while(have_posts()) : the_post(); ?>
						<?php the_content (); ?>
						<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
					<?php endwhile; ?>
				</div>
			</section>
	   <?php } elseif (is_account_page()) { ?>
			<?php $breadcrumb = get_theme_mod('shopwise_shop_breadcrumb','0'); ?>
			<?php if($breadcrumb == '1'){ ?>
				<div class="breadcrumb_section bg_gray page-title-mini">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-6">
								<div class="page-title">
									<h1><?php the_title(); ?></h1>
								</div>
							</div>
							<div class="col-md-6">
								<?php woocommerce_breadcrumb(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="empty-klb"></div>
			<?php } ?>
	   
			<section class="section">
				<div class="container">
					<div class="row ">
						<div class="col-md-12">
							<?php while(have_posts()) : the_post(); ?>
								<?php the_content (); ?>
								<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</section>
	   <?php } elseif ($elementor_page ) { ?>
		  
			<?php while(have_posts()) : the_post(); ?>
				<?php the_content (); ?>
				<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
			<?php endwhile; ?>
			
		<?php } else { ?>
			<div class="klb-page section">
				<div class="container">
					<div class="row ">
						<div class="col-md-10 offset-md-1">
							<?php while(have_posts()) : the_post(); ?>
								<h1 class="klb-page-title"><?php the_title(); ?></h1>
								<div class="klb-post">
									<?php the_content (); ?>
									<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
								</div>
							<?php endwhile; ?>
							<?php comments_template(); ?>
						</div>
					</div>         
				</div>
			</div>
		<?php } ?>
	<?php } else { ?>

	   <?php if ($elementor_page ) { ?>
		  
			<?php while(have_posts()) : the_post(); ?>
				<?php the_content (); ?>
				<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
			<?php endwhile; ?>
			
		<?php } else { ?>
			<div class="klb-page section">
				<div class="container">
					<div class="row ">
						<div class="col-md-10 offset-md-1">
							<?php while(have_posts()) : the_post(); ?>
								<h1 class="klb-page-title"><?php the_title(); ?></h1>
								<div class="klb-post">
									<?php the_content (); ?>
									<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
								</div>
							<?php endwhile; ?>
							<?php comments_template(); ?>
						</div>
					</div>         
				</div>
			</div>
		<?php } ?>
	<?php } ?>
<?php get_footer(); ?>