<?php

namespace Elementor;

class Shopwise_Custom_Title_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-custom-title';
    }
    public function get_title() {
        return 'Custom Title (K)';
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
		
		$this->add_control( 'title_type',
			[
				'label' => esc_html__( 'Title Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'select-column' => esc_html__( 'Select Type', 'shopwise' ),
					'type1'	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'	  => esc_html__( 'Type 2', 'shopwise' ),
				],
			]
		);
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Exclusive Products',
                'pleaceholder' => esc_html__( 'Set a title.', 'shopwise' )
            ]
        );

        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Subtitle here',
                'pleaceholder' => esc_html__( 'Set a subtitle.', 'shopwise' ),
				'condition' => ['title_type' => 'type2']

            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$output = '';
		
		if($settings['title_type'] == 'type2'){
			echo '<div class="heading_s4 text-center">';
			echo '<h2>'.esc_html($settings['title']).'</h2>';
			echo '</div>';
			echo '<p class="text-center leads">'.esc_html($settings['subtitle']).'</p>';
		} else {
			echo '<div class="heading_s3 text-center">';
			echo '<h2>'.esc_html($settings['title']).'</h2>';
			echo '</div>';
			echo '<div class="small_divider clearfix"></div>';
		}
	}

}
