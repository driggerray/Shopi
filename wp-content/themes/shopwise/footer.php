<?php
/**
 * footer.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 * 
 */
 ?>
 
	<?php if(get_theme_mod('shopwise_footer_subscribe_area') == 1){ ?>
		<?php if(shopwise_page_settings('hide_subscribe_form') != 'yes'){ ?>
		<div class="section bg_default small_pt small_pb">
			<div class="container">	
				<div class="row align-items-center">	
					<div class="col-md-6">
						<div class="heading_s1 mb-md-0 heading_light">
							<h3><?php echo esc_html(get_theme_mod('shopwise_footer_subscribe_title')); ?></h3>
						</div>
					</div>
					<div class="col-md-6">
						<div class="newsletter_form">
							<?php echo do_shortcode('[mc4wp_form id="'.get_theme_mod('shopwise_footer_subscribe_formid').'"]'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	<?php } ?>

	</div>
	<?php if(shopwise_page_settings('hide_page_footer') != 'yes'){ ?>
	<footer class="footer_dark">

		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-5' ) ) { ?>
		<div class="footer_top">
			<div class="container">
				<div class="row">
					<?php if(get_theme_mod('shopwise_footer_column') == '3columns'){ ?>
						<div class="col-lg-4 col-md-4 col-sm-12">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					<?php } elseif(get_theme_mod('shopwise_footer_column') == '4columns'){ ?>
						<div class="col-lg-3 col-md-3 col-sm-12">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
					<?php } else { ?>
						<div class="col-lg-3 col-md-6 col-sm-12">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-6">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-6">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<?php dynamic_sidebar( 'footer-5' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<div class="bottom_footer border-top-tran">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php if(get_theme_mod( 'shopwise_copyright' )){ ?>
							<p class="mb-md-0 text-center text-md-left"><?php echo shopwise_sanitize_data(get_theme_mod( 'shopwise_copyright' )); ?></p>
						<?php } else { ?>
							<p class="mb-md-0 text-center text-md-left"><?php esc_html_e('Copyright 2020.KlbTheme . All rights reserved','shopwise'); ?></p>
						<?php } ?>
					</div>
					<div class="col-md-6">
						<?php $paymentimage = get_theme_mod('shopwise_footer_payment'); ?>
						<?php if($paymentimage){ ?> 
							<ul class="footer_payment text-center text-lg-right">
								<?php foreach($paymentimage as $p){ ?> 
									<li><img src="<?php echo esc_url( wp_get_attachment_url($p['payment_image']) ); ?>" alt="<?php esc_attr_e('payment-image','shopwise'); ?>"></li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php } ?>

	<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

	<?php wp_footer(); ?>
	</body>
</html>