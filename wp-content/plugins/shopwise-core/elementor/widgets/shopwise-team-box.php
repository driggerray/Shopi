<?php

namespace Elementor;

class Shopwise_Team_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-team-box';
    }
    public function get_title() {
        return 'Team Box (K)';
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

		$defaultimage = plugins_url( 'images/team_img1.jpg', __DIR__ );
		
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'shopwise' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $defaultimage],
            ]
        );
		
        $this->add_control( 'name',
            [
                'label' => esc_html__( 'Name', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'John Muniz',
                'placeholder' => esc_html__( 'Enter the text', 'shopwise' )
            ]
        );

        $this->add_control( 'position',
            [
                'label' => esc_html__( 'Position', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Project Engineer',
                'placeholder' => esc_html__( 'Enter the text here', 'shopwise' )
            ]
        );

		$repeater = new Repeater();
		
		$repeater->add_control(
			'switcher_icon',
			[
				'label' => esc_html__( 'Use Custom Icon', 'shopwise' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shopwise' ),
				'label_off' => esc_html__( 'No', 'shopwise' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
        $repeater->add_control( 'custom_icon',
            [
                'label' => esc_html__( 'Custom Icon', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'ion-social-facebook',
                'description'=> 'You can add icon code. for example: ion-social-facebook',
				'condition' => ['switcher_icon' => 'yes']
            ]
        );
		
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'shopwise' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-brands',
				],
                'label_block' => true,
				'condition' => ['switcher_icon' => '']
			]
		);
		
        $repeater->add_control( 'social_url',
            [
                'label' => esc_html__( 'Social URL', 'shopwise' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'Place URL here', 'shopwise' )
            ]
        );

        $this->add_control( 'social_items',
            [
                'label' => esc_html__( 'Social Items', 'shopwise' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_icon' => 'fab fa-facebook-f',
                        'social_url' => '#',
                    ],
                    [
                        'social_icon' => 'fab fa-twitter',
                        'social_url' => '#',
                    ],
                    [
                        'social_icon' => 'fab fa-instagram',
                        'social_url' => '#',
                    ],
                    [
                        'social_icon' => 'fab fa-linkedin',
                        'social_url' => '#',
                    ]
                ]
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$output = '';
				
		echo '<div class="team_box team_style1">';
		echo '<div class="team_img">';
		echo '<img src="'.esc_url($settings['image']['url']).'" alt="team_img1">';
		echo '<ul class="social_icons social_style1">';
		foreach($settings['social_items'] as $item){
			$target = $item['social_url']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $item['social_url']['nofollow'] ? ' rel="nofollow"' : '';
			echo '<li>';
			echo '<a href="'.esc_url($item['social_url']['url']).'" '.esc_attr($target.$nofollow).'>';
			if($item['switcher_icon'] == 'yes'){
				echo '<i class="'.esc_attr($item['custom_icon']).'"></i>';
			} else {
				Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'false' ] );						
			}
			echo '</a>';
			echo '</li>';
		}
		echo '</ul>';
		echo '</div>';
		echo '<div class="team_content">';
		echo '<div class="team_title">';
		echo '<h5>'.esc_html($settings['name']).'</h5>';
		echo '<span>'.esc_html($settings['position']).'</span>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

}
