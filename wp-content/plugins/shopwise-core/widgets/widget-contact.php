<?php

class widget_contact_box extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => esc_html__('Only Detail Page: Contact Box.','shopwise') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact_box' );
		 parent::__construct( 'contact_box', esc_html__('Shopwise Contact Box','shopwise'), $widget_ops, $control_ops );
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
		
		<?php $contact_detail = get_theme_mod( 'shopwise_contact_box_widget' ); ?>
		<?php if(!empty($contact_detail)){ ?>
			<ul class="contact_info contact_info_light">
				<?php foreach($contact_detail as $c){ ?>
				<li>
					<a href="<?php echo shopwise_sanitize_data($c['contact_url']); ?>">
					<i class="<?php echo esc_attr($c['contact_icon']); ?>"></i>
					<p><?php echo shopwise_sanitize_data($c['contact_detail']); ?></p>
					</a>
				</li>
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
		
		$defaults = array('title' => 'Contact Info');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','shopwise'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		  <?php esc_html_e('You can customize the contact details from Dashboard > Appearance > Customize > Shopwise Widgets > Contact Box','shopwise'); ?>

		</p>
	<?php
	}
}

// Add Widget
function widget_contact_box_init() {
	register_widget('widget_contact_box');
}
add_action('widgets_init', 'widget_contact_box_init');

?>