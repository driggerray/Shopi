<?php

class widget_footer_about extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => esc_html__('Only Detail Page: Footer About.','shopwise') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'footer_about' );
		 parent::__construct( 'footer_about', esc_html__('Shopwise Footer About','shopwise'), $widget_ops, $control_ops );
	}


	
	// Widget Output
	function widget($args, $instance) {

		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		
		echo $before_widget;

		if($title) {
			echo $before_title . $title . $after_title;
		}
		?>
		
		
		<div class="widget-top">
			<?php if (get_theme_mod( 'shopwise_footer_about_logo' )) { ?>
				<div class="footer_logo">
					<?php $size = get_theme_mod( 'shopwise_footer_about_logo_size', array( 'width' => '182', 'height' => '47') ); ?>
					<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
					<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_footer_about_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>"/>
					</a>
				</div>
			<?php } ?>
			<p><?php echo shopwise_sanitize_data(get_theme_mod('shopwise_footer_about_text')); ?></p>
		</div>
		<?php $socialfooter = get_theme_mod( 'shopwise_footer_about_social' ); ?>
		<?php if(!empty($socialfooter)){ ?>
		
		<ul class="social_icons social_white">
			<?php foreach($socialfooter as $s){ ?>
			<li><a href="<?php echo esc_url($s['social_url']); ?>" target="_blank"><i class="<?php echo esc_attr($s['social_icon']); ?>"></i></a></li>
			<?php } ?>
		</ul>
		
		<?php } ?>
	


		<?php echo $after_widget;

	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','shopwise'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		  <?php esc_html_e('You can customize the social list from Dashboard > Appearance > Customize > Shopwise Widgets > Footer About','shopwise'); ?>

		</p>
	<?php
	}
}

// Add Widget
function widget_footer_about_init() {
	register_widget('widget_footer_about');
}
add_action('widgets_init', 'widget_footer_about_init');

?>