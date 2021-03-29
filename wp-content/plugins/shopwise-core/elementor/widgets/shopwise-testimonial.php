<?php

namespace Elementor;

class Shopwise_Testimonial_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-testimonial';
    }
    public function get_title() {
        return 'Testimonial (K)';
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
                'default' => 'Our Client Say!',
                'placeholder' => esc_html__( 'Enter title here', 'shopwise' )
            ]
        );
		
        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Testimonial',
                'placeholder' => esc_html__( 'Enter subtitle here', 'shopwise' )
            ]
        );
		
        $this->add_control( 'description',
            [
                'label' => esc_html__( 'Description', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Description Here!',
                'placeholder' => esc_html__( 'Enter description here', 'shopwise' )
            ]
        );
		
		$customimg = plugins_url( 'images/user_img1.jpg', __DIR__ );
		$repeater = new Repeater();
		
        $repeater->add_control( 'customer_image',
            [
                'label' => esc_html__( 'Image', 'shopwise' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $customimg],
            ]
        );
		
        $repeater->add_control( 'customer_name',
            [
                'label' => esc_html__( 'Name', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
				'label_block' => true,
                'pleaceholder' => esc_html__( 'Enter the name here', 'shopwise' ),
                'default' => 'Add some text here',
            ]
        );
		
        $repeater->add_control( 'customer_position',
            [
                'label' => esc_html__( 'Position', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
				'label_block' => true,
                'pleaceholder' => esc_html__( 'Enter the customer job.', 'shopwise' ),
                'default' => 'Add some text here',
            ]
        );
		
        $repeater->add_control( 'customer_comment',
            [
                'label' => esc_html__( 'Comment', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'pleaceholder' => esc_html__( 'Enter desc here', 'shopwise' ),
                'default' => 'Add some text here',
            ]
        );

        $this->add_control( 'testimonial_items',
            [
                'label' => esc_html__( 'Testimonial Items', 'shopwise' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'customer_name' => 'Lissa Castro',
                        'customer_position' => 'Designer',
                        'customer_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem.',
                        'customer_image' => ['url' => $customimg],
                    ],
                    [
                        'customer_name' => 'Alden Smith',
                        'customer_position' => 'Designer',
                        'customer_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem.',
                        'customer_image' => ['url' => $customimg],
                    ],
                    [
                        'customer_name' => 'Daisy Lana',
                        'customer_position' => 'Designer',
                        'customer_comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi nam natus perferendis possimus quasi sint sit tempora voluptatem.',
                        'customer_image' => ['url' => $customimg],
                    ],
					
                ]
            ]
        );

		$this->add_control( 'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'shopwise' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF1F1',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .section.bg_redon.klb-testi2' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		

		echo '<div class="section bg_redon klb-testi2">';
		echo '<div class="container">';
		echo '<div class="row align-items-center">';

		echo '<div class="col-lg-4">';
		echo '<div class="heading_s1">';
		echo '<span class="sub_heading">'.esc_html($settings['subtitle']).'</span>';
		echo '<h2>'.esc_html($settings['title']).'</h2>';
		echo '</div>';
		echo '<p class="leads mb-lg-0">'.$settings['description'].'</p>';
		echo '</div>';

		echo '<div class="col-lg-8">';
		echo '<div class="testimonial_slider testimonial_style2 carousel_slider owl-carousel owl-theme nav_style1" data-dots="false" data-nav="true" data-margin="10" data-loop="true" data-autoplay="true" data-responsive=\'{"0":{"items": "1"}, "767":{"items": "2"}, "1199":{"items": "2"}}\'>';

		
		if ( $settings['testimonial_items'] ) {
			foreach ( $settings['testimonial_items'] as $item ) {
		
				echo '<div class="testimonial_box box_shadow1">';
				echo '<div class="author_img">';
				echo '<img class="rounded-circle" src="'.esc_url($item['customer_image']['url']).'" alt="user1" />';
				echo '</div>';
				echo '<div class="author_name">';
				echo '<h6>'.esc_html($item['customer_name']).'</h6>';
				echo '<span>'.esc_html($item['customer_position']).'</span>';
				echo '</div>';
				echo '<div class="testimonial_desc">';
				echo '<p>'.esc_html($item['customer_comment']).'</p>';
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