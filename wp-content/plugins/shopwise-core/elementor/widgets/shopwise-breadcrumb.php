<?php

namespace Elementor;

class Shopwise_Breadcrumb_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-breadcrumb';
    }
    public function get_title() {
        return 'Breadcrumb (K)';
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
				'label' => esc_html__( 'Content', 'shopwise' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'About Us',
                'pleaceholder' => esc_html__( 'Set a title.', 'shopwise' )
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$output = '';
			
		echo '<div class="breadcrumb_section bg_gray page-title-mini">';
		echo '<div class="container">';
		echo '<div class="row align-items-center">';
		echo '<div class="col-md-6">';
		echo '<div class="page-title">';
		echo '<h1>'.esc_html($settings['title']).'</h1>';
		echo '</div>';
		echo '</div>';
		echo '<div class="col-md-6">';
		echo shopwise_breadcrubms();
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';

		
	}

}
