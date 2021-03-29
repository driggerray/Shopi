<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="row align-items-center mb-4 pb-1">
	<div class="col-12">
		<div class="product_header">
		
			<div class="product_header_left">
				<div class="custom_select">
					<form class="woocommerce-ordering" method="get">
						<select name="orderby" class="form-control form-control-sm orderby" aria-label="<?php esc_attr_e( 'Shop order', 'shopwise' ); ?>">
							<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
								<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="paged" value="1" />
						<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
					</form>
				</div>
			</div>
			<?php if(get_theme_mod('shopwise_grid_list_view','0') == '1'){ ?>
			<div class="product_header_right">
				<div class="products_view">
					<?php if(get_theme_mod('shopwise_view_type') == 'list-view'){ ?>
						<a href="javascript:Void(0);" class="shorting_icon grid"><i class="ti-view-grid"></i></a>
						<a href="javascript:Void(0);" class="shorting_icon list active"><i class="ti-layout-list-thumb"></i></a>
					<?php } else { ?>
						<a href="javascript:Void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
						<a href="javascript:Void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
							
		</div>
	</div>
</div>

