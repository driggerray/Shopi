<?php

namespace Elementor;

class Shopwise_Home_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shopwise-home-slider';
    }
    public function get_title() {
        return 'Home Slider (K)';
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

		$defaultbg = plugins_url( 'images/banner1.jpg', __DIR__ );
		
		$this->add_control( 'slider_type',
			[
				'label' => esc_html__( 'Slider Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'select-type',
				'options' => [
					'select-type' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
					'type3'		  => esc_html__( 'Type 3', 'shopwise' ),
				],
			]
		);
		
		
		$this->add_control(
			'enable_dots',
			[
				'label' => esc_html__( 'Enable Dots', 'shopwise' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shopwise' ),
				'label_off' => esc_html__( 'No', 'shopwise' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$repeater = new Repeater();
        $repeater->add_control( 'slider_image',
            [
                'label' => esc_html__( 'Image', 'shopwise' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
		
        $repeater->add_control( 'slider_title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Title',
                'pleaceholder' => esc_html__( 'Enter title here', 'shopwise' )
            ]
        );

        $repeater->add_control( 'slider_subtitle',
            [
                'label' => esc_html__( 'Subitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Subtitle',
                'pleaceholder' => esc_html__( 'Enter subtitle here', 'shopwise' )
            ]
        );

        $repeater->add_control( 'slider_desc',
            [
                'label' => esc_html__( 'Description', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter desc here', 'shopwise' ),
            ]
        );

        $repeater->add_control( 'slider_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'shopwise' )
            ]
        );
        $repeater->add_control( 'slider_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'shopwise' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'shopwise' )
            ]
        );

        $this->add_control( 'slider_items',
            [
                'label' => esc_html__( 'Slide Items', 'shopwise' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{slider_title}}',
                'default' => [
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Get up to 50% off Today Only!',
                        'slider_subtitle' => 'Woman Fashion',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#0',
                    ],

                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => '50% off in all products',
                        'slider_subtitle' => 'Man Fashion',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#0',
                    ],

                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Taking your Viewing Experience to Next Level',
                        'slider_subtitle' => 'Summer Sale',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#0',
                    ],
                ]
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['slider_items'] ) {
			if($settings['slider_type'] == 'type3'){
				require_once( __DIR__ . '/home-slider/type3.php' );
			} elseif($settings['slider_type'] == 'type2'){
				require_once( __DIR__ . '/home-slider/type2.php' );
			} else {
				require_once( __DIR__ . '/home-slider/type1.php' );
			}
		}
	}

}
