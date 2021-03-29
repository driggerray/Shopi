<?php global $woocommerce; ?>
<li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'shopwise'), $woocommerce->cart->cart_contents_count);?></span></a>
	<div class="cart_box dropdown-menu dropdown-menu-right">
	    <div class="fl-mini-cart-content">
			<?php woocommerce_mini_cart(); ?>
		</div>
	</div>
</li>