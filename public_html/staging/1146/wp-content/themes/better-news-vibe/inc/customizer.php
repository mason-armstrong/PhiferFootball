<?php

function better_news_vibe_customize_register( $wp_customize ) {

	Class Better_News_Vibe_Switch_Control extends WP_Customize_Control{

		public $type = 'switch';

		public $on_off_label = array();

		public function __construct( $manager, $id, $args = array() ){
	        $this->on_off_label = $args['on_off_label'];
	        parent::__construct( $manager, $id, $args );
	    }

		public function render_content(){
	    ?>
		    <span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php if( $this->description ){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
				</span>
			<?php } ?>

			<?php
				$switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
				$on_off_label = $this->on_off_label;
			?>
			<div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
				<div class="onoffswitch-inner">
					<div class="onoffswitch-active">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
					</div>

					<div class="onoffswitch-inactive">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
					</div>
				</div>	
			</div>
			<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
			<?php
	    }
	}


	class Better_News_Vibe_Dropdown_Taxonomies_Control extends WP_Customize_Control {

		public $type = 'dropdown-taxonomies';

		public $taxonomy = '';

		public function __construct( $manager, $id, $args = array() ) {

			$taxonomy = 'category';
			if ( isset( $args['taxonomy'] ) ) {
				$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
				if ( true === $taxonomy_exist ) {
					$taxonomy = esc_attr( $args['taxonomy'] );
				}
			}
			$args['taxonomy'] = $taxonomy;
			$this->taxonomy = esc_attr( $taxonomy );

			parent::__construct( $manager, $id, $args );
		}

		public function render_content() {

			$tax_args = array(
				'hierarchical' => 0,
				'taxonomy'     => $this->taxonomy,
			);
			$taxonomies = get_categories( $tax_args );

		?>
	    <label>
	      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	      <?php if ( ! empty( $this->description ) ) : ?>
	      	<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	      <?php endif; ?>
	       <select <?php $this->link(); ?>>
				<?php
				printf( '<option value="%s" %s>%s</option>', '', selected( $this->value(), '', false ), esc_html__( '--None--', 'better-news-vibe') );
				?>
				<?php if ( ! empty( $taxonomies ) ) :  ?>
	            <?php foreach ( $taxonomies as $key => $tax ) :  ?>
					<?php
					printf( '<option value="%s" %s>%s</option>', esc_attr( $tax->term_id ), selected( $this->value(), $tax->term_id, false ), esc_html( $tax->name ) );
					?>
	            <?php endforeach ?>
				<?php endif ?>
	       </select>
	    </label>
	    <?php
		}
	}


	$wp_customize->remove_section( 'colors' );

	// Add Slider section
	$wp_customize->add_section( 'better_news_vibe_slider_section', array(
		'title'             => esc_html__( 'Slider Section','better-news-vibe' ),
		'description'       => esc_html__( 'Slider Section options.', 'better-news-vibe' ),
		'panel'             => 'news_vibe_front_page_panel',
		'priority'			=> 41,
		) );

	// Slider content enable control and setting
	$wp_customize->add_setting( 'better_news_vibe_slider_section_enable', array(
		'default'			=> 	false,
		'sanitize_callback' => 'news_vibe_sanitize_switch_control',
		) );

	$wp_customize->add_control( new Better_News_Vibe_Switch_Control( $wp_customize, 'better_news_vibe_slider_section_enable', array(
		'label'             => esc_html__( 'Slider Section Enable', 'better-news-vibe' ),
		'section'           => 'better_news_vibe_slider_section',
		'on_off_label' 		=> news_vibe_switch_options(),
		) ) );

	// Slider btn title setting and control
	$wp_customize->add_setting( 'better_news_vibe_slider_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'better_news_vibe_slider_title', array(
		'label'           	=>  esc_html__( 'Title', 'better-news-vibe' ),
		'section'        	=> 'better_news_vibe_slider_section',
		'active_callback' 	=> 'better_news_vibe_is_slider_section_enable',
		'type'				=> 'text',
		) );

	$wp_customize->add_setting(  'better_news_vibe_slider_content_category', array(
		'sanitize_callback' => 'news_vibe_sanitize_single_category',
		) ) ;

	$wp_customize->add_control( new Better_News_Vibe_Dropdown_Taxonomies_Control( $wp_customize,'better_news_vibe_slider_content_category', array(
		'label'             => esc_html__( 'Select Category', 'better-news-vibe' ),
		'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'better-news-vibe' ),
		'section'           => 'better_news_vibe_slider_section',
		'type'              => 'dropdown-taxonomies',
		'active_callback'	=> 'better_news_vibe_is_slider_section_enable'
		) ) );

}
add_action( 'customize_register', 'better_news_vibe_customize_register' );

function better_news_vibe_is_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'better_news_vibe_slider_section_enable' )->value() );
}
