<?php

namespace Elementor;

class Shopwise_Clients_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-clients-carousel';
    }
    public function get_title() {
        return 'Clients Carousel (K)';
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
		
		$this->add_control( 'client_type',
			[
				'label' => esc_html__( 'Client Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'select-type',
				'options' => [
					'select-type' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
				],
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
                'type' => Controls_Manager::TEXT,
                'default' => 'Our Brands',				
            ]
        );

		$customimg = plugins_url( 'images/cl_logo1.png', __DIR__ );
		$repeater = new Repeater();

        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'shopwise' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $customimg],
            ]
        );

        $this->add_control( 'client_items',
            [
                'label' => esc_html__( 'Client Items', 'shopwise' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => ['url' => $customimg],
                    ],
                    [
                        'image' => ['url' => $customimg],
                    ],
                    [
                        'image' => ['url' => $customimg],
                    ],
                    [
                        'image' => ['url' => $customimg],
                    ],
                    [
                        'image' => ['url' => $customimg],
                    ],
                    [
                        'image' => ['url' => $customimg],
                    ],
                    [
                        'image' => ['url' => $customimg],
                    ],
                    [
                        'image' => ['url' => $customimg],
                    ],

					
                ]
            ]
        );
		
		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="klb-section">';
		echo '<div class="container">';
		
		if($settings['title']){
			echo '<div class="row">';
			echo '<div class="col-md-12">';
			echo '<div class="heading_tab_header">';
			echo '<div class="heading_s2">';
			if($settings['title_type'] == 'type2'){
			echo '<h4>'.esc_html($settings['title']).'</h4>';
			} else {
			echo '<h2>'.esc_html($settings['title']).'</h2>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		echo '<div class="row">';
		echo '<div class="col-12">';
		if($settings['client_type'] == 'type2'){
			echo '<div class="client_logo carousel_slider owl-carousel owl-theme" data-dots="false" data-margin="30" data-loop="true" data-autoplay="true" data-responsive=\'{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}}\'>';
		} else {
			echo '<div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false" data-nav="true" data-margin="30" data-loop="true" data-autoplay="true" data-responsive=\'{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}}\'>';
		}
		
		if ( $settings['client_items'] ) {
			foreach ( $settings['client_items'] as $item ) {
				echo '<div class="item">';
				echo '<div class="cl_logo">';
				echo '<img src="'.esc_url($item['image']['url']).'" alt="cl_logo"/>';
				echo '</div>';
				echo '</div>';
			}
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
	}

}
