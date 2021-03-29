<?php
/**
 * searchform.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 * 
 */
 ?>
<div class="search_form">
	<form id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get"> 
		<input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e('Search...', 'shopwise') ?>" autocomplete="off">
		<button type="submit" title="Subscribe" class="btn icon_search" name="submit" value="Submit">
			<i class="ion-ios-search-strong"></i>
		</button>
	</form>
</div>