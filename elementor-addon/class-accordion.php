<?php

namespace RSAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use RSAddons\Abstracts\Widget_Base;


// NOTE:: Need to add design control for some points


defined( 'ABSPATH' ) || die();

class Accordion extends Widget_Base {

	public function get_title(): string {
		return esc_html__( 'Accordion', 'creaox-addons' );
	}

	public function widget_keywords(): array {
		return [ 'accordion', 'faq', 'toggle', 'collapse', 'expand' ];
	}

	public function widget_styles(): array {
		return [ 'rs-accordion' ];
	}

	public function widget_scripts(): array {
		return [ 'rs-accordion' ];
	}

	protected function register_controls(): void {
		// Accordion Start
		$this->start_controls_section(
			'section_accordion',
			[
				'label' => esc_html__( 'Accordion Items', 'creaox-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$repeater = new Repeater();
			$repeater->add_control(
				'title',
				[
					'label'       => esc_html__( 'Title', 'creaox-addons' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => esc_html__( 'Accordion Item', 'creaox-addons' ),
					'label_block' => true,
					'dynamic'     => [ 'active' => true ],
				]
			);
			$repeater->add_control(
				'sub_title',
				[
					'label'       => esc_html__( 'Sub Title', 'creaox-addons' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => esc_html__( 'The grid-template-rows trick', 'creaox-addons' ),
					'label_block' => true,
					'dynamic'     => [ 'active' => true ],
				]
			);
			$repeater->add_control(
				'content',
				[
					'label'      => esc_html__( 'Content', 'creaox-addons' ),
					'type'       => Controls_Manager::WYSIWYG,
					'default'    => esc_html__( 'Add your content here. Click on the item to expand.', 'creaox-addons' ),
					'show_label' => false,
					'dynamic'    => [ 'active' => true ],
				]
			);
			$repeater->add_control(
				'icon',
				[
					'label'   => esc_html__( 'Icon', 'creaox-addons' ),
					'type'    => Controls_Manager::ICONS,
					'default' => [
						'value'   => 'fas fa-plus',
						'library' => 'fa-solid',
					],
					'skin' => 'inline',
					'label_block' => false
				]
			);
			$repeater->add_control(
				'badge',
				[
					'label'       => esc_html__( 'Badge', 'creaox-addons' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => esc_html__( 'Design', 'creaox-addons' ),
					'label_block' => true,
					'dynamic'     => [ 'active' => true ],
				]
			);
			$repeater->add_control(
				'default_open',
				[
					'label'        => esc_html__( 'Open by Default', 'creaox-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'creaox-addons' ),
					'label_off'    => esc_html__( 'No', 'creaox-addons' ),
					'return_value' => 'yes',
					'default'      => 'no',
				]
			);

			$this->add_control(
				'accordion_items',
				[
					'label'       => esc_html__( 'Items', 'creaox-addons' ),
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => [
						[
							'title'   => esc_html__( 'What is this accordion?', 'creaox-addons' ),
							'badge'   => esc_html__( 'Design', 'creaox-addons' ),
							'content' => esc_html__( 'This is a fully custom accordion widget built for Elementor without any JavaScript libraries.', 'creaox-addons' ),
						],
						[
							'title'   => esc_html__( 'How smooth is the animation?', 'creaox-addons' ),
							'badge'   => esc_html__( 'Dev', 'creaox-addons' ),
							'content' => esc_html__( 'Very smooth! It uses a pure CSS grid-template-rows animation that works flawlessly at any content height.', 'creaox-addons' ),
						],
						[
							'title'   => esc_html__( 'Is it accessible?', 'creaox-addons' ),
							'badge'   => esc_html__( 'SEO', 'creaox-addons' ),
							'content' => esc_html__( 'Yes. Proper ARIA attributes are used on every item, including aria-expanded and role="region" for full screen reader support.', 'creaox-addons' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);
		$this->end_controls_section();
		// Accordion End

		// Settings Start
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'creaox-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'expand_mode',
				[
					'label'   => esc_html__( 'Open Mode', 'creaox-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'exclusive',
					'options' => [
						'exclusive' => esc_html__( 'Exclusive (one open at a time)', 'creaox-addons' ),
						'multi'     => esc_html__( 'Multi-open (independent)', 'creaox-addons' ),
					],
					'frontend_available' => 'true'
				]
			);
			$this->add_control(
				'icon_position',
				[
					'label'   => esc_html__( 'Icon Position', 'creaox-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'left',
					'options' => [
						'left'  => esc_html__( 'Left', 'creaox-addons' ),
						'right' => esc_html__( 'Right', 'creaox-addons' ),
					],
				]
			);
			$this->add_control(
				'title_html_tag',
				[
					'label'   => esc_html__( 'Title HTML Tag', 'creaox-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'span',
					'options' => [
						'h2'   => 'H2',
						'h3'   => 'H3',
						'h4'   => 'H4',
						'h5'   => 'H5',
						'h6'   => 'H6',
						'span' => 'span',
						'p'    => 'p',
					],
				]
			);
			$this->add_control(
				'show_chevron',
				[
					'label'        => esc_html__( 'Show Expand/Collapse Arrow', 'creaox-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Show', 'creaox-addons' ),
					'label_off'    => esc_html__( 'Hide', 'creaox-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);
		$this->end_controls_section();
		// Settings End

		// Wrapper Style Start
		$this->start_controls_section(
			'section_style_wrapper',
			[
				'label' => esc_html__( 'Wrapper', 'creaox-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'items_gap',
				[
					'label'     => esc_html__( 'Gap Between Items', 'creaox-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 40
						],
					],
					'default'   => [
						'size' => 8,
						'unit' => 'px'
					],
					'selectors' => [
						'{{WRAPPER}} .aea-accordion' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Wrapper Style End

		// Item Style Start
		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Item', 'creaox-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'item_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'creaox-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .aea-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'item_tabs' );
				$this->start_controls_tab(
					'item_tab_normal',
					[ 'label' => esc_html__( 'Normal', 'creaox-addons' ) ]
				);
					$this->add_control(
						'item_background',
						[
							'label'     => esc_html__( 'Background', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-item' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'item_border',
							'label'    => esc_html__( 'Border', 'creaox-addons' ),
							'selector' => '{{WRAPPER}} .aea-item',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'     => 'item_box_shadow',
							'selector' => '{{WRAPPER}} .aea-item',
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'item_tab_open',
					[ 'label' => esc_html__( 'Open', 'creaox-addons' ) ]
				);
					$this->add_control(
						'item_background_open',
						[
							'label'     => esc_html__( 'Background', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-item.aea-open' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'item_border_color_open',
						[
							'label'     => esc_html__( 'Border Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-item.aea-open' => 'border-color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'     => 'item_box_shadow_open',
							'label'    => esc_html__( 'Box Shadow', 'creaox-addons' ),
							'selector' => '{{WRAPPER}} .aea-item.aea-open',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		// Item Style End

		// Header Style Start
		$this->start_controls_section(
			'section_style_header',
			[
				'label' => esc_html__( 'Header', 'creaox-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'header_padding',
				[
					'label'      => esc_html__( 'Padding', 'creaox-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .aea-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'header_tabs' );
				$this->start_controls_tab(
					'header_tab_normal',
					[
						'label' => esc_html__( 'Normal', 'creaox-addons' )
					]
				);
					$this->add_control(
						'header_background',
						[
							'label'     => esc_html__( 'Background', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-trigger' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'title_color',
						[
							'label'     => esc_html__( 'Title Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-title' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'header_tab_hover',
					[
						'label' => esc_html__( 'Hover', 'creaox-addons' )
					]
				);
					$this->add_control(
						'header_background_hover',
						[
							'label'     => esc_html__( 'Background', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-trigger:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'title_color_hover',
						[
							'label'     => esc_html__( 'Title Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-trigger:hover .aea-title' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'header_tab_active',
					[
						'label' => esc_html__( 'Active', 'creaox-addons' )
					]
				);
					$this->add_control(
						'header_background_active',
						[
							'label'     => esc_html__( 'Background', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-item.aea-open .aea-trigger' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'title_color_active',
						[
							'label'     => esc_html__( 'Title Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-item.aea-open .aea-title' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'header_divider',
				[
					'type'      => Controls_Manager::DIVIDER,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'selector' => '{{WRAPPER}} .aea-title',
				]
			);
		$this->end_controls_section();
		// Header Style End

		// Icon Style Start
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'creaox-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'icon_size',
				[
					'label'     => esc_html__( 'Icon Size', 'creaox-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [ 'min' => 8, 'max' => 48 ],
					],
					'selectors' => [
						'{{WRAPPER}} .aea-icon-wrap i'   => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .aea-icon-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'icon_box_size',
				[
					'label'     => esc_html__( 'Icon Box Size', 'creaox-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [ 'min' => 24, 'max' => 72 ],
					],
					'selectors' => [
						'{{WRAPPER}} .aea-icon-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'icon_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'creaox-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .aea-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'icon_tabs' );
				$this->start_controls_tab(
					'icon_tab_normal',
					[
						'label' => esc_html__( 'Normal', 'creaox-addons' )
					]
				);
					$this->add_control(
						'icon_color',
						[
							'label'     => esc_html__( 'Icon Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-icon-wrap' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'icon_bg_color',
						[
							'label'     => esc_html__( 'Background Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-icon-wrap' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'icon_tab_active',
					[
						'label' => esc_html__( 'Active', 'creaox-addons' )
					]
				);
					$this->add_control(
						'icon_color_active',
						[
							'label'     => esc_html__( 'Icon Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-item.aea-open .aea-icon-wrap'        => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'icon_bg_color_active',
						[
							'label'     => esc_html__( 'Background Color', 'creaox-addons' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .aea-item.aea-open .aea-icon-wrap' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		// Icon Style End

		// Arrow Style Start
		$this->start_controls_section(
			'section_style_chevron',
			[
				'label'     => esc_html__( 'Expand/Collapse Arrow', 'creaox-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_chevron' => 'yes' ],
			]
		);
			$this->add_control(
				'chevron_size',
				[
					'label'     => esc_html__( 'Size', 'creaox-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 8,
							'max' => 32
						]
					],
					'selectors' => [
						'{{WRAPPER}} .aea-chevron svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'chevron_color',
				[
					'label'     => esc_html__( 'Color', 'creaox-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aea-chevron svg path' => 'stroke: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'chevron_color_active',
				[
					'label'     => esc_html__( 'Active Color', 'creaox-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aea-item.aea-open .aea-chevron svg path' => 'stroke: {{VALUE}};',
					],
				]
			);
		$this->end_controls_section();
		// Arrow Style End

		// Content Style Start
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'creaox-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'content_padding',
				[
					'label'      => esc_html__( 'Padding', 'creaox-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .aea-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'content_color',
				[
					'label'     => esc_html__( 'Text Color', 'creaox-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aea-content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'content_background',
				[
					'label'     => esc_html__( 'Background', 'creaox-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aea-content' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'content_typography',
					'selector' => '{{WRAPPER}} .aea-content',
				]
			);
			$this->add_control(
				'content_separator_color',
				[
					'label'     => esc_html__( 'Separator Color', 'creaox-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .aea-content' => 'border-top-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'animation_speed',
				[
					'label'     => esc_html__( 'Animation Speed (ms)', 'creaox-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [ 'px' => [ 'min' => 100, 'max' => 800, 'step' => 50 ] ],
					'selectors' => [
						'{{WRAPPER}} .aea-body' => 'transition-duration: {{SIZE}}ms;',
					],
				]
			);
		$this->end_controls_section();
		// Content Style End
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$icon_pos     = $settings['icon_position'];
		$show_chevron = $settings['show_chevron'];
		$tag          = $settings['title_html_tag'];

		$this->add_render_attribute( 'accordion', [
			'class'     => 'rs-accordion'
		] );
		?>
		<div <?php echo $this->get_render_attribute_string( 'accordion' ); ?>>

			<div class="open-all-btn">
				<span>Expand all</span>
				<span>Collapse all</span>
			</div>

			<?php foreach ( $settings['accordion_items'] as $index => $item ) :
				$is_open   = ( 'yes' === $item['default_open'] );
				$item_key  = $this->get_repeater_setting_key( 'item', 'accordion_items', $index );
				$this->add_render_attribute( $item_key, [
					'class' => 'aea-item' . ( $is_open ? ' open' : '' ),
				] );
				?>
				<div <?php echo $this->get_render_attribute_string( $item_key ); ?>>
					<button class="aea-trigger aea-icon-pos-<?php echo esc_attr( $icon_pos ); ?>"
							aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
					        type="button">

						<?php if ( 'left' === $icon_pos ) : ?>
							<span class="aea-icon-wrap">
								<?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>

						<span class="aea-title-group">
							<<?php echo esc_html( $tag ); ?> class="aea-title">
								<?php
									echo esc_html( $item['title'] );
									if ( !empty( $item['badge'] ) ) {
										printf(
											'<span class="aea-badge">%1$s</span>',
											esc_html( $item['badge'] )
										);
									}
								?>
							</<?php echo esc_html( $tag ); ?>>
							<?php if ( !empty( $item['sub_title'] ) ) {
								printf(
									'<span class="aea-subtitle">%1$s</span>',
									esc_html( $item['sub_title'] )
								);
							} ?>
						</span>

						<?php if ( 'right' === $icon_pos ) : ?>
							<span class="aea-icon-wrap aea-icon-right">
								<?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>

						<?php if ( 'yes' === $show_chevron ) : ?>
							<span class="aea-chevron" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z"></path></svg>
							</span>
						<?php endif; ?>
					</button>
					<div class="aea-body" role="region">
						<div class="aea-body-inner">
							<div class="aea-content">
								<?php echo wp_kses_post( $item['content'] ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
