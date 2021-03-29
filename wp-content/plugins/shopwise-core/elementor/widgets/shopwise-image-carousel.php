<?php

namespace Elementor;

class Shopwise_Image_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-image-carousel';
    }
    public function get_title() {
        return 'Image Carousel (K)';
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
                'type' => Controls_Manager::TEXT,
                'default' => 'instagram',				
            ]
        );

        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => '@shoppingzone',				
            ]
        );

		$customimg = plugins_url( 'images/furniture_insta1.jpg', __DIR__ );
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
		echo '<div class="container-fluid p-0">';
		echo '<div class="row no-gutters">';
		echo '<div class="col-12">';
		echo '<div class="follow_box">';
		echo '<i class="ti-instagram"></i>';
		echo '<h3>'.esc_html($settings['title']).'</h3>';
		echo '<span>'.esc_html($settings['subtitle']).'</span>';
		echo '</div>';
		echo '<div class="client_logo carousel_slider owl-carousel owl-theme" data-dots="false" data-margin="0" data-loop="true" data-autoplay="true" data-responsive=\'{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "6"}}\'>';

		if ( $settings['client_items'] ) {
			foreach ( $settings['client_items'] as $item ) {
				echo '<div class="item">';
				echo '<div class="instafeed_box">';
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
