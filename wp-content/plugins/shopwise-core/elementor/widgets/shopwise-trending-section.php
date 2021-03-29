<?php

namespace Elementor;

class Shopwise_Trending_Section_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-trending-section';
    }
    public function get_title() {
        return 'Trending Section (K)';
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

		$defaultimage = plugins_url( 'images/tranding_img.png', __DIR__ );
		
        $this->add_control( 'image',
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
                'default' => 'New season trends!',
                'pleaceholder' => esc_html__( 'Enter title here', 'shopwise' )
            ]
        );

        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Best Summer Collection',
                'pleaceholder' => esc_html__( 'Enter subtitle here', 'shopwise' )
            ]
        );
		
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Sale Get up to 50% Off',
                'pleaceholder' => esc_html__( 'Enter desc here', 'shopwise' )
            ]
        );

		
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'shopwise' )
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
			
			echo '<div class="section bg_light_blue2 pb-0 pt-md-0">';
			echo '<div class="container">';
			echo '<div class="row align-items-center flex-row-reverse">';
			echo '<div class="col-md-6 offset-md-1">';
			echo '<div class="medium_divider d-none d-md-block clearfix"></div>';
			echo '<div class="trand_banner_text text-center text-md-left">';
			echo '<div class="heading_s1 mb-3">';
			echo '<span class="sub_heading">'.esc_html($settings['title']).'</span>';
			echo '<h2>'.esc_html($settings['subtitle']).'</h2>';
			echo '</div>';
			echo '<h5 class="mb-4">'.esc_html($settings['desc']).'</h5>';
			if($settings['btn_title']){
			echo '<a href="'.esc_url($settings['btn_link']['url']).'" class="btn btn-fill-out rounded-0" '.esc_attr($target.$nofollow).'>'.esc_html($settings['btn_title']).'</a>';
			}
			echo '</div>';
			echo '<div class="medium_divider clearfix"></div>';
			echo '</div>';
			echo '<div class="col-md-5">';
			echo '<div class="text-center trading_img">';
			if($settings['image']['url']){
			echo '<img src="'.esc_url($settings['image']['url']).'" alt="'.esc_attr($settings['title']).'"/>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';

	}

}
