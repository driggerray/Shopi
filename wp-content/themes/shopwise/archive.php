<?php
/**
 * archive.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 * 
 */
 ?>
 
 <?php get_header(); ?>
 
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-title">
						<h1><?php the_archive_title(); ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<div class="row">
			
				<?php if( get_theme_mod( 'shopwise_blog_layout' ) == 'left-sidebar') { ?>
					<div class="col-lg-9">
						<div class="row">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

							<?php endwhile; ?>
								<div class="col-12">
									<?php get_template_part( 'post-format/pagination' ); ?>
								</div>
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
						<div class="sidebar">
							<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
								<?php dynamic_sidebar( 'blog-sidebar' ); ?>
							<?php } ?>
						</div>
					</div>
				<?php } elseif( get_theme_mod( 'shopwise_blog_layout' ) == 'full-width') { ?>
					<div class="col-lg-10 offset-lg-1">
						<div class="row">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

							<?php endwhile; ?>
								<div class="col-12">
									<?php get_template_part( 'post-format/pagination' ); ?>
								</div>
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

							<?php endif; ?>
						</div>
					</div>
				<?php } else { ?>
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
						<div class="col-lg-9">
							<div class="row">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

								<?php endwhile; ?>
									<div class="col-12">
										<?php get_template_part( 'post-format/pagination' ); ?>
									</div>
								<?php else : ?>

									<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

								<?php endif; ?>
							</div>
						</div>
						<div class="col-lg-3 mt-4 pt-2 mt-lg-0 pt-lg-0">
							<div class="sidebar">
								<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
									<?php dynamic_sidebar( 'blog-sidebar' ); ?>
								<?php } ?>
							</div>
						</div>
					<?php } else { ?>
						<div class="col-lg-10 offset-lg-1">
							<div class="row">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

								<?php endwhile; ?>
									<div class="col-12">
										<?php get_template_part( 'post-format/pagination' ); ?>
									</div>
								<?php else : ?>

									<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

								<?php endif; ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
				
			</div>
		</div>
	</div>

<?php get_footer(); ?>