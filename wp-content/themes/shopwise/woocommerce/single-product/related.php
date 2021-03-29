<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<?php wp_enqueue_script('shopwise-carousel-slider'); ?>

	<div class="row">
		<div class="col-12">
			<div class="small_divider"></div>
			<div class="divider"></div>
			<div class="medium_divider"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<section class="related products">
				<?php
				$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related products', 'shopwise' ) );

				if ( $heading ) :
					?>
				<div class="heading_s1"><h3><?php echo esc_html( $heading ); ?></h3></div>
				<?php endif; ?>
				
				<?php woocommerce_product_loop_start(); ?>
					<div class="col-12">
						<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "992":{"items": "2"}, "1199":{"items": "3"}}'>
						<?php foreach ( $related_products as $related_product ) : ?>
								<div class="klb-related-item">
								<?php
								$post_object = get_post( $related_product->get_id() );

								setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

								wc_get_template_part( 'content', 'related-product' );
								?>
								</div>
						<?php endforeach; ?>
						</div>
					</div>

				<?php woocommerce_product_loop_end(); ?>
			</section>
		</div>
	</div>
	<?php
endif;

wp_reset_postdata();
