<?php

namespace Elementor;

class Shopwise_Home_Slider_2_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shopwise-home-slider-2';
    }
    public function get_title() {
        return 'Home Slider 2 (K)';
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

        $repeater->add_control( 'regular_price',
            [
                'label' => esc_html__( 'Regular Price', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter price here', 'shopwise' ),
            ]
        );
		
        $repeater->add_control( 'sale_price',
            [
                'label' => esc_html__( 'sale Price', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter price here', 'shopwise' ),
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
			echo '<div class="banner_section shop_el_slider staggered-animation-wrap">';
			echo '<div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">';
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
				
				$contentinner = $settings['enable_dots'] == 'yes' ? 'banner_content_inner' : '';
				echo '<div class="carousel-item '.esc_attr($active).' background_bg" data-img-src="'.esc_url($item['slider_image']['url']).'">';
				echo '<div class="banner_slide_content '.esc_attr($contentinner).'">';

				echo '<div class="col-lg-8 col-10">';
				echo '<div class="banner_content3 overflow-hidden">';
				echo '<h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">'.esc_html($item['slider_title']).'</h5>';
				echo '<h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">'.esc_html($item['slider_subtitle']).'</h2>';
				echo '<h4 class="staggered-animation mb-4 product-price" data-animation="slideInLeft" data-animation-delay="1.2s"><span class="price">'.esc_html($item['regular_price']).'</span><del>'.esc_html($item['sale_price']).'</del></h4>';
				if($item['slider_btn_title']){
				echo '<a class="btn btn-fill-out btn-radius staggered-animation text-uppercase" href="'.esc_url($item['slider_btn_link']['url']).'" '.esc_attr($target.$nofollow).' data-animation="slideInLeft" data-animation-delay="1.5s">'.esc_html($item['slider_btn_title']).'</a>';
				}
				echo '</div>';
				echo '</div>';
				

				echo '</div>';
				echo '</div>';
				$count++;
			}
			echo '</div>';
			if($settings['enable_dots'] == 'yes'){
				echo '<ol class="carousel-indicators indicators_style3">';
				$slideto = 0;
				foreach ( $settings['slider_items'] as $item ) {
				$activeclass = $slideto == 0 ? 'active' : '';	
				echo '<li data-target="#carouselExampleControls" data-slide-to="'.esc_attr($slideto).'" class="'.esc_attr($activeclass).'"></li>';
				$slideto++;
				}

				echo '</ol>';
			} else {
				echo '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>';
				echo '<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>';
			}
			echo '</div>';
			echo '</div>';
		}
	}

}
