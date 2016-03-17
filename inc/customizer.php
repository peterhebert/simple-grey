<?php
/**
 * simple_grey Theme Customizer
 *
 * @package simple_grey
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

    /**
     * Add Textarea Control
     *
    */
    class simple_grey_Customize_Textarea_Control extends WP_Customize_Control {
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

    /**
     * Customize Image Control Class
     *
     * Extend WP_Customize_Image_Control allowing access to uploads made within
     * the same context
     * credit: https://gist.github.com/eduardozulian/4739075
     */
    class simple_grey_Customize_Image_Control extends WP_Customize_Image_Control {
        /**
         * Constructor.
         *
         * @since 3.4.0
         * @uses WP_Customize_Image_Control::__construct()
         *
         * @param WP_Customize_Manager $manager
         */
        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
        }

        /**
         * Search for images within the defined context
         */
        public function tab_uploaded() {
            $my_context_uploads = get_posts( array(
                'post_type'  => 'attachment',
                'meta_key'   => '_wp_attachment_context',
                'meta_value' => $this->context,
                'orderby'    => 'post_date',
                'nopaging'   => true,
            ) );
            ?>

            <div class="uploaded-target"></div>

            <?php
            if ( empty( $my_context_uploads ) )
                return;

            foreach ( (array) $my_context_uploads as $my_context_upload ) {
                $this->print_tab_image( esc_url_raw( $my_context_upload->guid ) );
            }
        }
    }

    //rename "Site Title & Tagline' to 'Site Branding'
    $wp_customize->get_section( 'title_tagline' )->title = __( 'Site Branding', 'simple-grey' );

    // Change Tagline (blogdescription) to textarea control
    $wp_customize->add_control( new simple_grey_Customize_Textarea_Control( $wp_customize, 'blogdescription', array(
        'label' => __( 'Site Description', 'simple-grey' ),
        'section' => 'title_tagline',
        'settings' => 'blogdescription'
  ) ) );

   // toggle shadow on logo and text
    $wp_customize->add_setting( 'simple_grey_header_drop_shadow', array( 'default' => 1, 'sanitize_callback' => 'simple_grey_sanitize_int' ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'simple_grey_header_drop_shadow', array(
    'label' => __( 'Add drop shadow to header elements', 'simple-grey' ),
    'section' => 'title_tagline',
    'settings' => 'simple_grey_header_drop_shadow',
    'type' => 'checkbox'
  ) ) );

    // Logo upload
  $wp_customize->add_setting( 'simple_grey_logo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
  $wp_customize->add_control( new simple_grey_Customize_Image_Control( $wp_customize, 'simple_grey_logo', array(
      'label' => __( 'Logo', 'simple-grey' ),
      'section' => 'title_tagline',
      'settings' => 'simple_grey_logo'
  ) ) );

   // logo style
    $wp_customize->add_setting( 'simple_grey_logo_style', array( 'default' => '', 'sanitize_callback' => 'simple_grey_sanitize_text' ) );

    $wp_customize->add_control(
        'simple_grey_logo_style',
        array(
            'type' => 'select',
            'label' => __( 'Logo Style', 'simple-grey' ),
            'section' => 'title_tagline',
            'choices' => array(
                '' => 'no effects',
                'rounded' => 'rounded corners',
                'circle' => 'circle',
            ),
        )
    );



    // navigation style
		$wp_customize->add_section( 'simple_grey_navigation' , array(
	    'title' => __( 'Navigation', 'peterhebert'),
	    'priority' => 60,
	  ) );

    $wp_customize->add_setting(
        'simple_grey_nav_style',
        array(
            'default' => 'menu-flat',
            'sanitize_callback' => 'simple_grey_sanitize_text'
        )
    );

    $wp_customize->add_control(
        'simple_grey_nav_style',
        array(
            'type' => 'select',
            'label' => __( 'Navigation Style', 'simple-grey' ),
            'section' => 'simple_grey_navigation',
            'choices' => array(
                'flat' => 'Flat',
                'hierarchical' => 'Hierarchical',
								'drop-down' => 'Drop Down',
            ),
						'description' => __( 'Navigation style applied to the primary menu.', 'simple-grey' ),
        )
    );

  // display options
  $wp_customize->add_section( 'simple_grey_reading' , array(
    'title' => __( 'Reading', 'peterhebert'),
    'priority' => 60,
  ) );
  $wp_customize->add_setting( 'simple_grey_show_updated', array( 'default' => 1, 'sanitize_callback' => 'simple_grey_sanitize_int' ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'simple_grey_show_updated', array(
    'label' => __( 'Show Date Updated', 'simple-grey' ),
    'section' => 'simple_grey_reading',
    'settings' => 'simple_grey_show_updated',
    'type' => 'checkbox'
  ) ) );

  // footer text
  $wp_customize->add_section( 'simple_grey_footer_section' , array(
    'title' => __( 'Footer', 'simple-grey' ),
    'priority' => 90,
  ) );
  $wp_customize->add_setting( 'simple_grey_footer_text_top', array( 'default' => '', 'sanitize_callback' => 'simple_grey_sanitize_textarea') );
  $wp_customize->add_control( new simple_grey_Customize_Textarea_Control( $wp_customize, 'simple_grey_footer_text', array(
    'label' => __( 'Footer Top Text', 'simple-grey' ),
    'section' => 'simple_grey_footer_section',
    'settings' => 'simple_grey_footer_text_top',
  ) ) );

  $wp_customize->add_setting( 'simple_grey_footer_text_bottom', array( 'default' => '', 'sanitize_callback' => 'simple_grey_sanitize_textarea') );
  $wp_customize->add_control( new simple_grey_Customize_Textarea_Control( $wp_customize, 'simple_grey_copyright_info', array(
    'label' => __( 'Footer Bottom Text', 'simple-grey' ),
    'section' => 'simple_grey_footer_section',
    'settings' => 'simple_grey_footer_text_bottom',
  ) ) );

  $wp_customize->add_setting( 'simple_grey_show_footer_credits', array( 'default' => 1, 'sanitize_callback' => 'simple_grey_sanitize_int' ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'simple_grey_show_footer_credits', array(
    'label' => __( 'Show WordPress and Theme Credits', 'simple-grey' ),
    'section' => 'simple_grey_footer_section',
    'settings' => 'simple_grey_show_footer_credits',
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

// options sanitizer callbacks
function simple_grey_sanitize_text( $str ) {
	return sanitize_text_field( $str );
}

function simple_grey_sanitize_textarea( $text ) {
	return esc_textarea( $text );
}

function simple_grey_sanitize_int( $int ) {
	return absint( $int );
}
