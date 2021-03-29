<?php

class widget_single_banner2 extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => esc_html__('Single Banner 2.','shopwise') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'single_banner2' );
		 parent::__construct( 'single_banner2', esc_html__('Shopwise Single Banner 2','shopwise'), $widget_ops, $control_ops );
	}


	
	// Widget Output
	function widget($args, $instance) {

		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		
		$bannertitle = $instance['bannertitle'];	
		$subtitle = $instance['subtitle'];	
		$buttontext = $instance['buttontext'];	
		$buttonurl = $instance['buttonurl'];	


		echo $before_widget;

		if($title) {
			echo $before_title . $title . $after_title;
		}
		?>
		
		
		<div class="shop_banner">
			<?php if(isset($instance['imageid'])){ ?>
			<div class="banner_img overlay_bg_20">
				<img src="<?php echo esc_url(wp_get_attachment_url($instance['imageid'])); ?>" alt="sidebar_banner_img">
			</div>
			<?php } ?>
			<div class="shop_bn_content2 text_white">
				<h5 class="text-uppercase shop_subtitle"><?php echo esc_html($bannertitle); ?></h5>
				<h3 class="text-uppercase shop_title"><?php echo esc_html($subtitle); ?></h3>
				<a href="<?php echo esc_url($buttonurl); ?>" class="btn btn-white rounded-0 btn-sm text-uppercase"><?php echo esc_html($buttontext); ?></a>
			</div>
		</div>

		<?php echo $after_widget;

	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['bannertitle'] = $new_instance['bannertitle'];
		$instance['subtitle'] = $new_instance['subtitle'];
		$instance['buttontext'] = $new_instance['buttontext'];
		$instance['buttonurl'] = $new_instance['buttonurl'];
		$instance['imageid'] = $new_instance['imageid'];
		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '', 'bannertitle'=> 'New Arrival', 'subtitle' => '10% Off', 'buttontext' => 'Shop Now', 'buttonurl' => '#', 'imageid' => '#');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php esc_html_e('Title:','shopwise'); ?>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('bannertitle'); ?>"><?php esc_html_e('Banner Title:','shopwise'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('bannertitle'); ?>" name="<?php echo $this->get_field_name('bannertitle'); ?>" value="<?php echo $instance['bannertitle']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php esc_html_e('Subtitle:','shopwise'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" value="<?php echo $instance['subtitle']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('buttontext'); ?>"><?php esc_html_e('Button Text:','shopwise'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('buttontext'); ?>" name="<?php echo $this->get_field_name('buttontext'); ?>" value="<?php echo $instance['buttontext']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('buttonurl'); ?>"><?php esc_html_e('Button URL:','shopwise'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('buttonurl'); ?>" name="<?php echo $this->get_field_name('buttonurl'); ?>" value="<?php echo $instance['buttonurl']; ?>" />
		</p>
		
		<p>
		  <label for="<?php echo $this->get_field_id('imageid'); ?>"><?php esc_html_e('Image:','shopwise'); ?></label>
		  <input type="text" class="img" name="<?php echo $this->get_field_name('imageid'); ?>" id="<?php echo $this->get_field_id('imageid'); ?>" value="<?php echo $instance['imageid']; ?>" />
		  <input type="button" class="set_custom_images button button-primary" value="<?php esc_attr_e('Select Image','shopwise'); ?>" />
		</p>
	<?php
	}
}

// Add Widget
function widget_single_banner2_init() {
	register_widget('widget_single_banner2');
}
add_action('widgets_init', 'widget_single_banner2_init');
?>