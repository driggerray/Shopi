<?php
/**
 * sinle.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 * 
 */
 ?>
 
 <?php get_header(); ?>

	<div class="section">
		<div class="container">
			<div class="row">
			
				<?php if( get_theme_mod( 'shopwise_blog_layout' ) == 'left-sidebar') { ?>
					<div class="col-lg-9">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

						<?php endwhile; ?>
							<?php comments_template(); ?>
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

						<?php endif; ?>
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
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

						<?php endwhile; ?>
							<?php comments_template(); ?>
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

						<?php endif; ?>
					</div>
				<?php } else { ?>
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
						<div class="col-lg-9">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

							<?php endwhile; ?>
								<?php comments_template(); ?>
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

							<?php endif; ?>
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
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

							<?php endwhile; ?>
								<?php comments_template(); ?>
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'shopwise') ?></h2>

							<?php endif; ?>
						</div>
					<?php } ?>
				<?php } ?>
				
			</div>
		</div>
	</div>

<?php get_footer(); ?>