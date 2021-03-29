<?php

namespace Elementor;

class Shopwise_Home_Full_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shopwise-home-full-slider';
    }
    public function get_title() {
        return 'Home Full Slider (K)';
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

		$defaultbg = plugins_url( 'images/banner10.jpg', __DIR__ );

		
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
                        'slider_title' => 'Starting $90.00',
                        'slider_subtitle' => 'Unique Furniture Style',
                        'slider_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#0',
                    ],
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Starting $90.00',
                        'slider_subtitle' => 'Unique Furniture Style',
                        'slider_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.',
                        'slider_btn_title' => 'Shop Now',
                        'slider_btn_link' => '#0',
                    ],
                    [
                        'slider_image' => ['url' => $defaultbg],
                        'slider_title' => 'Starting $90.00',
                        'slider_subtitle' => 'Unique Furniture Style',
                        'slider_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.',
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
			echo '<div class="banner_section full_screen staggered-animation-wrap">';
			echo '<div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow carousel_style2" data-ride="carousel">';
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

				echo '<div class="carousel-item '.esc_attr($active).' background_bg overlay_bg_50" data-img-src="'.esc_url($item['slider_image']['url']).'">';
				echo '<div class="banner_slide_content banner_content_inner">';
				echo '<div class="container">';
				echo '<div class="row justify-content-center">';
				echo '<div class="col-lg-7 col-md-10">';
				echo '<div class="banner_content text_white text-center">';
				echo '<h5 class="mb-3 bg_strip staggered-animation text-uppercase" data-animation="fadeInDown" data-animation-delay="0.2s">'.esc_html($item['slider_title']).'</h5>';
				echo '<h2 class="staggered-animation" data-animation="fadeInDown" data-animation-delay="0.3s">'.esc_html($item['slider_subtitle']).'</h2>';
				echo '<p class="staggered-animation" data-animation="fadeInUp" data-animation-delay="0.4s">'.esc_html($item['slider_desc']).'</p>';
				if($item['slider_btn_title']){
					echo '<a class="btn btn-white staggered-animation" href="'.esc_url($item['slider_btn_link']['url']).'" '.esc_attr($target.$nofollow).' data-animation="fadeInUp" data-animation-delay="0.5s">'.esc_html($item['slider_btn_title']).'</a>';
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

			echo '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>';
			echo '<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>';

			echo '</div>';
			echo '</div>';
		}
	}

}
