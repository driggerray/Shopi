<?php

namespace Elementor;

class Shopwise_Single_Image_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-single-image';
    }
    public function get_title() {
        return 'Single Image (K)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'shopwise' ];
    }

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$defaultimage = plugins_url( 'images/about_img.jpg', __DIR__ );
		
		$this->add_control( 'type',
			[
				'label' => esc_html__( 'Image Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	=> esc_html__( 'Type 1', 'shopwise' ),
					'type2' 	=> esc_html__( 'Type 2', 'shopwise' ),
				],
			]
		);
		
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'shopwise' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $defaultimage],
            ]
        );
		
        $this->add_control( 'video_url',
            [
                'label' => esc_html__( 'Video URL', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://www.youtube.com/watch?v=ZE2HxTmxfrI',
                'description'=> 'You can add a link from youtube.',
				'condition' => ['type' => 'type2']
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$output = '';
		
		if($settings['type'] == 'type2'){
			echo '<div class="about_single_img">';
			echo '<div class="mission_img mb-4 mb-lg-0">';
			echo '<img class="w-100" src="'.esc_url($settings['image']['url']).'" alt="mission"/>';
			echo '</div>';
			echo '<div class="play_icon">';
			echo '<a href="'.esc_url($settings['video_url']).'" class="btn btn-ripple video_popup"><span class="ripple"><i class="ion-play"></i></span></a>';
			echo '</div>';
			echo '</div>';
		} else {
			echo '<div class="klb-single-image single_img fb_style1 mt-4 mt-md-0">';
			echo '<img src="'.esc_url($settings['image']['url']).'" alt="about_img"/>';
			echo '</div>';
		}
	}

}
