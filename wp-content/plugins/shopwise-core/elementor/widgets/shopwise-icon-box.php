<?php

namespace Elementor;

class Shopwise_Icon_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'shopwise-icon-box';
    }
    public function get_title() {
        return 'Icon Box (K)';
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
		
		$this->add_control( 'box_type',
			[
				'label' => esc_html__( 'Box Type', 'shopwise' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'select-type',
				'options' => [
					'select-type' => esc_html__( 'Select a type', 'shopwise' ),
					'type1' 	  => esc_html__( 'Type 1', 'shopwise' ),
					'type2'		  => esc_html__( 'Type 2', 'shopwise' ),
					'type3'		  => esc_html__( 'Type 3', 'shopwise' ),
					'type4'		  => esc_html__( 'Type 4', 'shopwise' ),
					'type5'		  => esc_html__( 'Type 5', 'shopwise' ),
				],
			]
		);
		
		$this->add_control(
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
		
		$this->add_control(
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
		
        $this->add_control( 'custom_icon',
            [
                'label' => esc_html__( 'Custom Icon', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'flaticon-shipped',
                'description'=> 'You can add icon code. for example: flaticon-shipped',
				'condition' => ['switcher_icon' => 'yes']
            ]
        );

       $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'shopwise' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'pleaceholder' => esc_html__( 'Enter title here', 'shopwise' ),
                'default' => 'Free Delivery',
            ]
        );
       $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'shopwise' ),
                'type' => Controls_Manager::TEXTAREA,
                'pleaceholder' => esc_html__( 'Enter desc here', 'shopwise' ),
                'default' => 'If you are going to use of Lorem, you need to be sure there anything',
            ]
        );
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$output = '';
		
			if($settings['box_type'] == 'type5'){
				echo '<div class="icon_box icon_box_style6">';
				echo '<div class="icon">';
				if($settings['switcher_icon'] == 'yes'){
					echo '<i class="'.esc_attr($settings['custom_icon']).'"></i>';
				} else {
					Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'false' ] );						
				}
				echo '</div>';
				echo '<div class="icon_box_content">';
				echo '<h5>'.esc_html($settings['title']).'</h5>';
				echo '<p>'.esc_html($settings['desc']).'</p>';
				echo '</div>';
				echo '</div>';
			}elseif($settings['box_type'] == 'type4'){
				echo '<div class="icon_box icon_box_style3">';
				echo '<div class="icon">';
				if($settings['switcher_icon'] == 'yes'){
					echo '<i class="'.esc_attr($settings['custom_icon']).'"></i>';
				} else {
					Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'false' ] );						
				}
				echo '</div>';
				echo '<div class="icon_box_content">';
				echo '<h6>'.esc_html($settings['title']).'</h6>';
				echo '<p>'.esc_html($settings['desc']).'</p>';
				echo '</div>';
				echo '</div>';
				
			} elseif($settings['box_type'] == 'type3'){
				echo '<div class="contact_wrap contact_style3">';
				echo '<div class="contact_icon">';
				if($settings['switcher_icon'] == 'yes'){
					echo '<i class="'.esc_attr($settings['custom_icon']).'"></i>';
				} else {
					Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'false' ] );						
				}
				echo '</div>';
				echo '<div class="contact_text">';
				echo '<span>'.esc_html($settings['title']).'</span>';
				echo '<p>'.shopwise_sanitize_data($settings['desc']).'</p>';
				echo '</div>';
				echo '</div>';
			}elseif($settings['box_type'] == 'type2'){
				echo '<div class="icon_box icon_box_style5">';
				echo '<div class="icon">';
				if($settings['switcher_icon'] == 'yes'){
					echo '<i class="'.esc_attr($settings['custom_icon']).'"></i>';
				} else {
					Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'false' ] );						
				}
				echo '</div>';
				echo '<div class="icon_box_content">';
				echo '<h5>'.esc_html($settings['title']).'</h5>';
				echo '<p>'.esc_html($settings['desc']).'</p>';
				echo '</div>';
				echo '</div>';
			} else {
				echo '<div class="icon_box icon_box_style1">';
				echo '<div class="icon">';
				if($settings['switcher_icon'] == 'yes'){
					echo '<i class="'.esc_attr($settings['custom_icon']).'"></i>';
				} else {
					Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'false' ] );						
				}
				echo '</div>';
				echo '<div class="icon_box_content">';
				echo '<h5>'.esc_html($settings['title']).'</h5>';
				echo '<p>'.esc_html($settings['desc']).'</p>';
				echo '</div>';
				echo '</div>';
			}
	}

}
