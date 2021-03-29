<?php
/**
 * woocommerce-single.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 * 
 */
?>

<?php get_header(); ?>
<?php $breadcrumb = get_theme_mod('shopwise_shop_breadcrumb','1'); ?>

<?php if($breadcrumb == '1'){ ?>
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<?php $breadcrumb_title = get_theme_mod('shopwise_breadcrumb_title'); ?>
				<div class="col-md-6">
					<div class="page-title">
						<h1><?php echo esc_html_e('Product Detail','shopwise'); ?></h1>
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
		<?php woocommerce_content(); ?>
	</div>
</div>


<?php get_footer(); ?>