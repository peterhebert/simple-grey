<?php
/**
 * simple_grey Theme Customizer.
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function simple_grey_customize_register($wp_customize)
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$header_text_color = (object) $wp_customize->get_setting( 'simple_grey_header_text_color' );
	$header_text_color->transport = 'postMessage';

	$header_bg_color = (object) $wp_customize->get_setting( 'simple_grey_header_bg_color' );
	$header_bg_color->transport = 'postMessage';

	$header_link_color = (object) $wp_customize->get_setting( 'simple_grey_header_link_color' );
	$header_link_color->transport = 'postMessage';

	$header_link_hover = (object) $wp_customize->get_setting( 'simple_grey_header_link_hover_color' );
	$header_link_hover->transport = 'postMessage';

	// rename "Header Image' to 'Site Branding'
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Branding', 'simple-grey' );

	// Change Tagline (blogdescription) to textarea control
	$wp_customize->add_control(
		'blogdescription',
		array(
			'label' => __( 'Site Description', 'simple-grey' ),
			'section' => 'title_tagline',
			'settings' => 'blogdescription',
			'type' => 'textarea',
		)
	);

	// logo style
	$wp_customize->add_setting( 'simple_grey_logo_style', array('default' => '', 'sanitize_callback' => 'simple_grey_sanitize_text') );
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
		$wp_customize->add_section('simple_grey_navigation', array(
			'title' => __( 'Navigation', 'simple-grey' ),
			'priority' => 105,
		));

		$wp_customize->add_setting(
			'simple_grey_nav_style',
		array(
			'default' => 'menu-flat',
			'sanitize_callback' => 'simple_grey_sanitize_text',
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


	// rename "Header Image' section to 'Header'
	$wp_customize->get_section( 'header_image' )->title = __( 'Header', 'simple-grey' );

		  // Header background color
		$wp_customize->add_setting( 'simple_grey_header_bg_color', array(
		  'default' => null,
		  'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_grey_header_bg_color', array(
		  'label' => __( 'Header Background Color', 'simple-grey' ),
		  'section' => 'header_image',
		) ) );

		// Header text color
		$wp_customize->add_setting( 'simple_grey_header_text_color', array(
            'default' => null,
            'sanitize_callback' => 'sanitize_hex_color',
          ) );
          $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_grey_header_text_color', array(
            'label' => __( 'Header Text Color', 'simple-grey' ),
            'section' => 'header_image',
          ) ) );

		// Header link color
		$wp_customize->add_setting( 'simple_grey_header_link_color', array(
            'default' => null,
            'sanitize_callback' => 'sanitize_hex_color',
          ) );
          $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_grey_header_link_color', array(
            'label' => __( 'Header Link Color', 'simple-grey' ),
            'section' => 'header_image',
          ) ) );

		// Header link hover color
		$wp_customize->add_setting( 'simple_grey_header_link_hover_color', array(
            'default' => null,
            'sanitize_callback' => 'sanitize_hex_color',
          ) );
          $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_grey_header_link_hover_color', array(
            'label' => __( 'Header Link Hover Color', 'simple-grey' ),
            'section' => 'header_image',
          ) ) );

	// toggle shadow on logo and text
	$wp_customize->add_setting( 'simple_grey_header_drop_shadow', array('default' => 1, 'sanitize_callback' => 'simple_grey_sanitize_int') );
	$wp_customize->add_control(
		'simple_grey_header_drop_shadow',
		array(
			'label' => __( 'Add drop shadow to header elements', 'simple-grey' ),
            'section' => 'header_image',
			'settings' => 'simple_grey_header_drop_shadow',
			'type' => 'checkbox',
		)
	);


		  // add 'Background Size' option to Custom Background
		$wp_customize->add_setting(
			'simple_grey_background_size',
			array(
				'default' => 'auto',
				'sanitize_callback' => 'simple_grey_sanitize_text',
			)
		);
		$wp_customize->add_control(
		    'simple_grey_background_size',
		    array(
					'type'         => 'radio',
		        'label'   => __('Background Size', 'simple-grey'),
		        'section' => 'background_image',
		        'choices' => array(
							'auto'       => __('Auto', 'simple-grey'),
							'cover'      => __('Cover', 'simple-grey'),
							'contain'    => __('Contain', 'simple-grey'),
							'initial'    => __('Initial', 'simple-grey'),
							'inherit'    => __('Inherit', 'simple-grey'),
		        ),
		    )
		);

		// display options
		$wp_customize->add_section('simple_grey_reading', array(
			'title' => __( 'Reading', 'simple-grey' ),
			'priority' => 60,
		));
		$wp_customize->add_setting( 'simple_grey_show_updated', array('default' => 1, 'sanitize_callback' => 'simple_grey_sanitize_int') );
		$wp_customize->add_control(
			'simple_grey_show_updated',
			array(
				'label' => __( 'Show Date Updated', 'simple-grey' ),
				'section' => 'simple_grey_reading',
				'settings' => 'simple_grey_show_updated',
				'type' => 'checkbox',
			)
		);

		// footer text
		$wp_customize->add_section('simple_grey_footer_section', array(
			'title' => __( 'Footer', 'simple-grey' ),
			'priority' => 90,
		));
		$wp_customize->add_setting( 'simple_grey_footer_text_top', array('default' => '', 'sanitize_callback' => 'simple_grey_sanitize_html') );
		$wp_customize->add_control(
			'simple_grey_footer_text_top',
			array(
			'label' => __( 'Footer Top Text', 'simple-grey' ),
			'section' => 'simple_grey_footer_section',
			'settings' => 'simple_grey_footer_text_top',
			'type' => 'textarea',
			)
		);

		$wp_customize->add_setting( 'simple_grey_footer_text_bottom', array('default' => '', 'sanitize_callback' => 'simple_grey_sanitize_html') );
		$wp_customize->add_control(
			'simple_grey_footer_text_bottom',
			array(
			'label' => __( 'Footer Bottom Text', 'simple-grey' ),
			'section' => 'simple_grey_footer_section',
			'settings' => 'simple_grey_footer_text_bottom',
			'type' => 'textarea',
			)
		);

		$wp_customize->add_setting( 'simple_grey_show_footer_credits', array('default' => 1, 'sanitize_callback' => 'simple_grey_sanitize_int') );
		$wp_customize->add_control(
			'simple_grey_show_footer_credits',
			array(
				'label' => __( 'Show WordPress and Theme Credits', 'simple-grey' ),
				'section' => 'simple_grey_footer_section',
				'settings' => 'simple_grey_show_footer_credits',
				'type' => 'checkbox',
			)
		);
}
add_action( 'customize_register', 'simple_grey_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function simple_grey_customize_preview_js()
{
	wp_enqueue_script( 'simple_grey_customizer', get_template_directory_uri().'/js/customizer.js', array('customize-preview'), '20130508', true );
}
add_action( 'customize_preview_init', 'simple_grey_customize_preview_js' );

// options sanitizer callbacks
function simple_grey_sanitize_text($str)
{
	return sanitize_text_field( $str );
}

function simple_grey_sanitize_int($int)
{
	return absint( $int );
}

/**
 * Sanitization: html
 * Control: textarea.
 *
 * Sanitization callback for 'html' type text inputs. This
 * callback sanitizes $input for HTML allowable in posts.
 *
 * https://codex.wordpress.org/Function_Reference/wp_kses
 * https://gist.github.com/adamsilverstein/10783774
 * https://github.com/devinsays/options-framework-plugin/blob/master/options-check/functions.php#L69
 * http://ottopress.com/2010/wp-quickie-kses/
 *
 * @uses	wp_filter_post_kses()	https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 * @uses	wp_kses()	https://developer.wordpress.org/reference/functions/wp_kses/
 */
function simple_grey_sanitize_html($input)
{
	global $allowedposttags;

	return wp_kses( $input, $allowedposttags );
}

function simple_grey_customizer_css() {
	
	$inline_styles = array();
	if ( get_theme_mod( 'simple_grey_header_bg_color' ) ) {
		$inline_styles[] = '.site-header { background-color: ' . get_theme_mod( 'simple_grey_header_bg_color' ) . '; }';
	}

	if ( get_theme_mod( 'simple_grey_header_text_color' ) ) {
		$inline_styles[] = '.site-header { color: ' . get_theme_mod( 'simple_grey_header_text_color' ) . '; }';
	}

	if ( get_theme_mod( 'simple_grey_header_link_color' ) ) {
		$inline_styles[] = '.site-header a, .site-header a:visited { color: ' . get_theme_mod( 'simple_grey_header_link_color' ) . '; }';
	}

	if ( get_theme_mod( 'simple_grey_header_link_hover_color' ) ) {
		$inline_styles[] = '.site-header a:hover { color: ' . get_theme_mod( 'simple_grey_header_link_hover_color' ) . '; }';
	}

	if ( count($inline_styles) > 0 ) {
		echo "<style type=\"text/css\">\n";
		$allcss = implode("\n\t",$inline_styles);
		echo $allcss;
		echo "</style>\n";
	}
}
add_action( 'wp_head', 'simple_grey_customizer_css' );
