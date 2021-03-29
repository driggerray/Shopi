<?php

namespace Elementor;

class Shopwise_Deal_Section_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-deal-section';
    }
    public function get_title() {
        return 'Deal Section (K)';
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

		$defaultimage = plugins_url( 'images/furniture_banner3.jpg', __DIR__ );
		
        $this->add_control( 'bg_image',
            [
                'label' => esc_html__( 'Image', 'shopwise' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $defaultimage],
            ]
        );
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Big Sale Deal',
                'pleaceholder' => esc_html__( 'Enter title here', 'shopwise' ),
            ]
        );

        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Sale 40% Off',
                'pleaceholder' => esc_html__( 'Enter subtitle here', 'shopwise' ),
            ]
        );

        $this->add_control( 'expired_date',
            [
                'label' => esc_html__( 'Expired Date', 'shopwise' ),
                'type' => Controls_Manager::TEXT ,
                'default' => '2020/06/02 12:30:15',
                'label_block' => true,
            ]
        );

		
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'shopwise' ),
            ]
        );
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'shopwise' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'shopwise' )
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$target   = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';

		$output = '';
		
		echo '<div class="section background_bg" data-img-src="'.esc_url($settings['bg_image']['url']).'">';
		echo '<div class="container">';
		echo '<div class="row">';
		echo '<div class="col-lg-6 col-md-8 col-sm-9">';
		echo '<div class="furniture_banner">';
		echo '<h3 class="single_bn_title">'.esc_html($settings['title']).'</h3>';
		echo '<h4 class="single_bn_title1 text_default">'.esc_html($settings['subtitle']).'</h4>';
		echo '<div class="countdown_time countdown_style3 mb-4" data-time="'.esc_attr($settings['expired_date']).'"></div>';
		echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="btn btn-fill-out">'.esc_html($settings['btn_title']).'</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';

	}

}
