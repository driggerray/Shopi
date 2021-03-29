<?php

namespace Elementor;

class Shopwise_Single_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-single-banner';
    }
    public function get_title() {
        return 'Single Banner (K)';
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

		$defaultimage = plugins_url( 'images/shop_banner_img1.jpg', __DIR__ );
		
		$this->add_control( 'image_type',
			[
				'label' => esc_html__( 'Image Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'select-type',
				'options' => [
					'select-type' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
					'type3'		  => esc_html__( 'Type 3', 'shopwise' ),
					'type4'		  => esc_html__( 'Type 4', 'shopwise' ),
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
		
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Super Sale',
                'pleaceholder' => esc_html__( 'Enter title here', 'shopwise' ),
				'condition' => ['image_type' => array('type1','type3','type4','select-type')]
            ]
        );

        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'New Collection',
                'pleaceholder' => esc_html__( 'Enter subtitle here', 'shopwise' ),
				'condition' => ['image_type' => array('type1','type3','type4','select-type')]
            ]
        );

		
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'shopwise' ),
				'condition' => ['image_type' => array('type1','type3','type4','select-type')]
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
		
			if($settings['image_type'] == 'type4'){
				echo '<div class="single_banner">';
				echo '<img src="'.esc_url($settings['image']['url']).'" alt="banner1">';
				echo '<div class="fb_info2">';
				echo '<h5 class="single_bn_title1">'.esc_html($settings['title']).'</h5>';
				echo '<h3 class="single_bn_title">'.esc_html($settings['subtitle']).'</h3>';
				echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="single_bn_link">'.esc_html($settings['btn_title']).'</a>';
				echo '</div>';
				echo '</div>';
			} elseif($settings['image_type'] == 'type3'){
				echo '<div class="single_banner">';
				echo '<img src="'.esc_url($settings['image']['url']).'" alt="banner1">';
				echo '<div class="fb_info">';
				echo '<h5 class="single_bn_title1">'.esc_html($settings['title']).'</h5>';
				echo '<h3 class="single_bn_title">'.esc_html($settings['subtitle']).'</h3>';
				echo '<a href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).' class="single_bn_link">'.esc_html($settings['btn_title']).'</a>';
				echo '</div>';
				echo '</div>';
			} elseif($settings['image_type'] == 'type2'){
				echo '<div class="sale_banner">';
				echo '<a class="hover_effect1" href="'.esc_url($settings['btn_link']['url']).'" '.esc_attr($target.$nofollow).'>';
				echo '<img src="'.esc_url($settings['image']['url']).'" alt="shop_banner_img3">';
				echo '</a>';
				echo '</div>';
			} else {
				echo '<div class="single_banner">';
				echo '<img src="'.esc_url($settings['image']['url']).'" alt="'.esc_attr($settings['title']).'"/>';
				echo '<div class="single_banner_info">';
				echo '<h5 class="single_bn_title1">'.esc_html($settings['title']).'</h5>';
				echo '<h3 class="single_bn_title">'.esc_html($settings['subtitle']).'</h3>';
				if($settings['btn_title']){
				echo '<a href="'.esc_url($settings['btn_link']['url']).'" class="single_bn_link" '.esc_attr($target.$nofollow).'>'.esc_html($settings['btn_title']).'</a>';
				}
				echo '</div>';
				echo '</div>';
			}

	}

}
