<?php
/**
 * header.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 * 
 */
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( "charset" ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<?php if (!get_theme_mod( 'shopwise_loader' )) { ?>
		<div class="preloader">
			<?php if(get_theme_mod('shopwise_loader_image')){ ?>
				<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_loader_image' )) ); ?>" alt="<?php bloginfo("name"); ?>">
			<?php } else { ?>
				<div class="lds-ellipsis">
					<span></span>
					<span></span>
					<span></span>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php  
	if(get_theme_mod('shopwise_subscribe_popup') == 'on'){
		get_template_part( 'includes/header/subscribe-popup' ); 
	}
	?>

	<?php 
	if(shopwise_page_settings('page_header_type') == 'type5'){
		
		get_template_part( 'includes/header/header-type5' );

	} elseif(shopwise_page_settings('page_header_type') == 'type4'){
		
		get_template_part( 'includes/header/header-type4' );

	} elseif(shopwise_page_settings('page_header_type') == 'type3'){
		
		get_template_part( 'includes/header/header-type3' );
		
	} elseif(shopwise_page_settings('page_header_type') == 'type2'){
		
		get_template_part( 'includes/header/header-type2' );
		
	} elseif(shopwise_page_settings('page_header_type') == 'type1') {
		
		get_template_part( 'includes/header/header-type1' );
		
	} elseif(get_theme_mod('shopwise_header_type') == 'type5'){
		
		get_template_part( 'includes/header/header-type5' );
		
	} elseif(get_theme_mod('shopwise_header_type') == 'type4'){
		
		get_template_part( 'includes/header/header-type4' );

	} elseif(get_theme_mod('shopwise_header_type') == 'type3'){

		get_template_part( 'includes/header/header-type3' );

	} elseif(get_theme_mod('shopwise_header_type') == 'type2'){
		
		get_template_part( 'includes/header/header-type2' );
		
	} else {
		
		get_template_part( 'includes/header/header-type1' );
		
	}
	?>

	<div class="main_content">