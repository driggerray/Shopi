<?php
	echo '<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">';
	echo '<div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">';
	echo '<div class="carousel-inner">';
	
	$count = 1;
	foreach ( $settings['slider_items'] as $item ) {
		$target = $item['slider_btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $item['slider_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
		if($count == 1){
			$active = 'active';
		} else {
			$active = '';
		}
		
		$contentinner = $settings['enable_dots'] == 'yes' ? 'banner_content_inner' : '';
		echo '<div class="carousel-item '.esc_attr($active).' background_bg" data-img-src="'.esc_url($item['slider_image']['url']).'">';
		echo '<div class="banner_slide_content '.esc_attr($contentinner).'">';
		echo '<div class="container">';
		echo '<div class="row">';
		echo '<div class="col-lg-8 col-10">';
		echo '<div class="banner_content overflow-hidden">';
		echo '<h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">'.esc_html($item['slider_title']).'</h5>';
		echo '<h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">'.esc_html($item['slider_subtitle']).'</h2>';
		if($item['slider_btn_title']){
		echo '<a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="'.esc_url($item['slider_btn_link']['url']).'" '.esc_attr($target.$nofollow).' data-animation="slideInLeft" data-animation-delay="1.5s">'.esc_html($item['slider_btn_title']).'</a>';
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		$count++;
	}
	echo '</div>';
	if($settings['enable_dots'] == 'yes'){
		echo '<ol class="carousel-indicators indicators_style1">';
		$slideto = 0;
		foreach ( $settings['slider_items'] as $item ) {
		$activeclass = $slideto == 0 ? 'active' : '';	
		echo '<li data-target="#carouselExampleControls" data-slide-to="'.esc_attr($slideto).'" class="'.esc_attr($activeclass).'"></li>';
		$slideto++;
		}

		echo '</ol>';
	} else {
		echo '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>';
		echo '<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>';
	}
	echo '</div>';
	echo '</div>';

