<?php
/**
 * Simple Grey Theme Customizer
 *
 * @package Simple Grey
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function simple_grey_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

  /**
   * Create Textarea Control.
   */

  class peterhebert_Customize_Textarea_Control extends WP_Customize_Control {
      public $type = 'textarea';
   
      public function render_content() {
          ?>
          <label>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
          <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
          </label>
          <?php
      }
  }

  // Site Description
  $wp_customize->add_setting( 'simple_grey_site_description' );
  $wp_customize->add_control( new peterhebert_Customize_Textarea_Control( $wp_customize, 'simple_grey_site_description', array(
      'label' => __( 'Site Description', 'simple-grey' ),
      'section' => 'title_tagline',
      'settings' => 'simple_grey_site_description',
  ) ) );

  // Logo upload
  $wp_customize->add_section( 'simple_grey_logo_section' , array(
    'title' => __( 'Logo', 'simple-grey' ),
    'priority' => 30,
    'description' => 'Upload a logo or avatar to be placed in the header',
  ) );
  $wp_customize->add_setting( 'simple_grey_logo' );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simple_grey_logo', array(
    'label' => __( 'Logo', 'simple-grey' ),
    'section' => 'simple_grey_logo_section',
    'settings' => 'simple_grey_logo',
  ) ) );

  // footer text
  $wp_customize->add_section( 'simple_grey_footer_section' , array(
    'title' => __( 'Footer', 'simple-grey' ),
    'priority' => 90,
  ) );
  $wp_customize->add_setting( 'simple_grey_footer_text' );
  $wp_customize->add_control( new peterhebert_Customize_Textarea_Control( $wp_customize, 'simple_grey_footer_text', array(
    'label' => __( 'Footer Text', 'simple-grey' ),
    'section' => 'simple_grey_footer_section',
    'settings' => 'simple_grey_footer_text',
  ) ) );

  $wp_customize->add_setting( 'simple_grey_copyright_info' );
  $wp_customize->add_control( new peterhebert_Customize_Textarea_Control( $wp_customize, 'simple_grey_copyright_info', array(
    'label' => __( 'Copyright Information', 'simple-grey' ),
    'section' => 'simple_grey_footer_section',
    'settings' => 'simple_grey_copyright_info',
  ) ) );

  $wp_customize->add_setting( 'simple_grey_show_footer_credits', array( 'default' => 1 ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'simple_grey_show_footer_credits', array(
    'label' => __( 'Show WordPress and Theme Credits', 'simple-grey' ),
    'section' => 'simple_grey_footer_section',
    'settings' => 'simple_grey_show_footer_credits',
    'type' => 'checkbox'
  ) ) );

  // display options
  $wp_customize->add_section( 'simple_grey_reading' , array(
    'title' => __( 'Reading', 'peterhebert'),
    'priority' => 60,
  ) );
  $wp_customize->add_setting( 'simple_grey_show_updated', array( 'default' => 1 ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'simple_grey_show_updated', array(
    'label' => __( 'Show Date Updated', 'simple-grey' ),
    'section' => 'simple_grey_reading',
    'settings' => 'simple_grey_show_updated',
    'type' => 'checkbox'
  ) ) );
 
}
add_action( 'customize_register', 'simple_grey_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function simple_grey_customize_preview_js() {
	wp_enqueue_script( 'simple_grey_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'simple_grey_customize_preview_js' );
