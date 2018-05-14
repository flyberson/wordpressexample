<?php
/**
 * AZA Theme Customizer.
 *
 * @package aza-lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function aza_customize_register($wp_customize) {


// Load Customizer repeater control.
	require_once( 'customizer-repeater/class/customizer-repeater-control.php' );
// Load Alpha Colorpicker control.
	require_once( 'class/alpha-general-customizer.php' );


	/*=============================================================================
	Sticky Navbar
	=============================================================================*/
	$wp_customize->add_setting( 'aza_sticky_navbar', array(
		'default'           => false,
		'priority'          => 50,
		'sanitize_callback' => 'aza_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'aza_sticky_navbar', array(
		'label'       => __( 'Enable Sticky Navigation', 'aza-lite' ),
		'description' => __( 'If this box is checked, the navigation menu will stick to the top of your website.', 'aza-lite' ),
		'type'        => 'checkbox',
		'section'     => 'title_tagline'
	) );


	/*=============================================================================
	Logo
	=============================================================================*/
	if ( ! function_exists( 'the_custom_logo' ) ) {

		$wp_customize->add_setting( 'aza_logo', array(
			'sanitize_callback' => 'esc_url_raw'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aza_logo', array(
			'label'       => __( 'Website Logo', 'aza-lite' ),
			'section'     => 'title_tagline',
			'priority'    => 1,
			'description' => __( 'We recommend using a logo that has a <b>maximum height</b> of <b>60px</b>.', 'aza-lite' )
		) ) );
	}

	$wp_customize->add_setting( 'aza_navbar_color', array(
		'default'           => 'rgba(0, 0, 0, 0.75)',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );
	$wp_customize->add_control( new Aza_Customize_Alpha_Color_Control( $wp_customize, 'aza_navbar_color', array(
		'label'       => __( ' Navigation bar color', 'aza-lite' ),
		'section'     => 'colors',
		'priority'    => 2,
		'description' => __( 'Change color and opacity of the menu bar', 'aza-lite' ),
		'palette'     => false
	) ) );

	$wp_customize->add_setting( 'aza_navbar_color_after_scroll', array(
		'default'           => 'rgba(0, 0, 0, 0.8)',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );
	$wp_customize->add_control( new Aza_Customize_Alpha_Color_Control( $wp_customize, 'aza_navbar_color_after_scroll', array(
		'label'       => __( ' Navigation bar color after scroll', 'aza-lite' ),
		'section'     => 'colors',
		'priority'    => 3,
		'description' => __( 'Change color and opacity of the menu bar after scroll', 'aza-lite' ),
		'palette'     => false
	) ) );

	/********************************************************/
	/********************* PRELOADER ************************/
	/********************************************************/

	$wp_customize->add_section( 'aza_preloader_section', array(
		'title'       => __( 'Preloader', 'aza-lite' ),
		'priority'    => 25,
		'description' => __( 'Preloader options', 'aza-lite' )
	) );

	/*
	Preloader Colors
	*/
	$wp_customize->add_setting( 'aza_preloader_color', array(
		'default'           => '#fc535f',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'preloader_color', array(
		'label'       => __( 'Color', 'aza-lite' ),
		'section'     => 'aza_preloader_section',
		'settings'    => 'aza_preloader_color',
		'description' => __( 'Change the color of the preloader object', 'aza-lite' )

	) ) );

	$wp_customize->add_setting( 'aza_preloader_background_color', array(
		'default'           => '#333333',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'preloader_background-color', array(
		'label'       => __( 'Background Color', 'aza-lite' ),
		'section'     => 'aza_preloader_section',
		'settings'    => 'aza_preloader_background_color',
		'description' => __( 'Change the background color of the preloader', 'aza-lite' )

	) ) );

	/*=============================================================================
	Preloader Toggle
	=============================================================================*/

	$wp_customize->add_setting( 'aza_preloader_toggle', array(
		'default'           => 1,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'aza_preloader_toggle', array(
		'label'       => __( 'Enable Preloader', 'aza-lite' ),
		'type'        => 'checkbox',
		'section'     => 'aza_preloader_section',
		'settings'    => 'aza_preloader_toggle',
		'description' => __( 'Toggle the website preloader ON or OFF', 'aza-lite' ),
		'priority'    => 0
	) );

	/*=============================================================================
	Preloader Types
	=============================================================================*/
	$wp_customize->add_setting( 'aza_preloader_type', array(
		'default'           => '1',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_select'
	) );

	$wp_customize->add_control( 'aza_preloader_type', array(
		'type'        => 'radio',
		'label'       => __( 'Preloader type', 'aza-lite' ),
		'section'     => 'aza_preloader_section',
		'choices'     => array(
			'1' => 'Rotating plane',
			'2' => 'Bouncing circles',
			'3' => 'Folding square',
			'4' => 'Bouncing lines'
		),
		'description' => __( 'Change the preloader animation', 'aza-lite' )
	) );

	/********************************************************/
	/********************* SECTIONS  **********************/
	/********************************************************/

	$wp_customize->add_panel( 'sections_panel', array(
		'priority'        => 30,
		'capability'      => 'edit_theme_options',
		'theme_supports'  => '',
		'title'           => __( 'Sections', 'aza-lite' ),
		'description'     => __( 'Customize the appearance of the front page sections', 'aza-lite' ),
		'active_callback' => 'frontpage_check',
	) );


	$wp_customize->add_section( 'aza_appearance_cover', array(
		'title'       => __( 'Hero Area', 'aza-lite' ),
		'priority'    => 1,
		'description' => __( 'Edit the hero area content', 'aza-lite' ),
		'panel'       => 'sections_panel'
	) );

	/*=============================================================================
	Site header title
	=============================================================================*/

	$wp_customize->add_setting( 'aza_header_title', array(
		'sanitize_callback' => 'aza_sanitize_text',
		'transport'         => 'postMessage',

	) );

	$wp_customize->add_control( 'aza_header_title', array(
		'label'       => __( 'Site heading', 'aza-lite' ),
		'section'     => 'aza_appearance_cover',
		'priority'    => 2,
		'description' => __( 'Main heading', 'aza-lite' )
	) );

	/*=============================================================================
	Site header subtitle
	=============================================================================*/

	$wp_customize->add_setting( 'aza_subheader_title', array(
		'sanitize_callback' => 'aza_sanitize_text',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'aza_subheader_title', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => 3,
		'description' => __( 'Subheading', 'aza-lite' )

	) );

	/*=============================================================================
	Site Header Partials
	=============================================================================*/
	$wp_customize->selective_refresh->add_partial( 'aza_header_title', array(
		'selector'        => '.cover-text h1',
		'settings'        => 'aza_header_title',
		'render_callback' => function () {
			return get_theme_mod( 'aza_header_title' );
		},
	) );


	/*=============================================================================
	Header buttons
	=============================================================================*/
	$wp_customize->add_setting( 'aza_header_buttons_type', array(
		'default'           => 'normal_buttons',
		'sanitize_callback' => 'aza_sanitize_select'
	) );

	$wp_customize->add_control( 'aza_header_buttons_type', array(
		'type'        => 'radio',
		'priority'    => 5,
		'label'       => __( 'Button options', 'aza-lite' ),
		'description' => __( 'Change the header buttons type or remove them', 'aza-lite' ),
		'section'     => 'aza_appearance_cover',
		'choices'     => array(
			'normal_buttons'   => 'Normal buttons',
			'store_buttons'    => 'Store buttons',
			'disabled_buttons' => 'Disable buttons'
		)
	) );

	/*=============================================================================
	Store Buttons
	=============================================================================*/
	$wp_customize->add_setting( 'aza_appstore_link', array(
		'default'           => esc_url( '#' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'aza_appstore_link', array(
		'label'       => __( 'Store links', 'aza-lite' ),
		'section'     => 'aza_appearance_cover',
		'priority'    => 6,
		'description' => __( 'Apple Appstore link to your app', 'aza-lite' )
	) );

	$wp_customize->add_setting( 'aza_playstore_link', array(
		'default'           => esc_url( '#' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'aza_playstore_link', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => 7,
		'description' => __( 'Google Playstore link to your app', 'aza-lite' )
	) );


	/*=============================================================================
	Regular Buttons
	=============================================================================*/
	//first button controls
	$wp_customize->add_setting( 'aza_button_text_1', array(
		'default'           => esc_html__( 'Button 1', 'aza-lite' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_text'
	) );
	$wp_customize->add_control( 'aza_button_text_1', array(
		'label'       => __( 'First button', 'aza-lite' ),
		'section'     => 'aza_appearance_cover',
		'priority'    => 8,
		'description' => __( 'Text on the first button of the hero area', 'aza-lite' )
	) );

	$wp_customize->add_setting( 'aza_button_link_1', array(
		'default'           => esc_url( '#' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'aza_button_link_1', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => 9,
		'description' => __( 'Link for the <b>first button</b>', 'aza-lite' )
	) );

	$wp_customize->add_setting( 'aza_button_color_1', array(
		'default'           => '#3399df',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_colors',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aza_button_color_1', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => '10',
		'settings'    => 'aza_button_color_1',
		'description' => __( 'Button color', 'aza-lite' ),

	) ) );

	$wp_customize->add_setting( 'aza_button_text_color_1', array(
		'default'           => '#ffffff',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aza_button_text_color_1', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => '11',
		'settings'    => 'aza_button_text_color_1',
		'description' => __( 'Text color', 'aza-lite' ),

	) ) );

	//second button controls
	$wp_customize->add_setting( 'aza_button_text_2', array(
		'default'           => esc_html__( 'Button 2', 'aza-lite' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_text'
	) );
	$wp_customize->add_control( 'aza_button_text_2', array(
		'label'       => __( 'Second button', 'aza-lite' ),
		'section'     => 'aza_appearance_cover',
		'priority'    => 12,
		'description' => __( 'Text on the second button of the hero area', 'aza-lite' ),
	) );

	$wp_customize->add_setting( 'aza_button_link_2', array(
		'default'           => esc_url( '#' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'aza_button_link_2', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => 13,
		'description' => __( 'Link for the <b>second button</b>', 'aza-lite' )
	) );

	$wp_customize->add_setting( 'aza_button_color_2', array(
		'default'           => '#fc535f',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aza_button_color_2', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => '14',
		'settings'    => 'aza_button_color_2',
		'description' => __( 'Button color', 'aza-lite' )

	) ) );

	$wp_customize->add_setting( 'aza_button_text_color_2', array(
		'default'           => '#ffffff',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aza_button_text_color_2', array(
		'section'     => 'aza_appearance_cover',
		'priority'    => '15',
		'settings'    => 'aza_button_text_color_2',
		'description' => __( 'Text color', 'aza-lite' )

	) ) );

	//background-color


	$wp_customize->add_setting( 'aza_hero_color', array(
		'default'           => 'rgba(0, 0, 0, 0.25)',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );
	$wp_customize->add_control( new Aza_Customize_Alpha_Color_Control( $wp_customize, 'aza_hero_color', array(
		'label'       => __( ' Hero overlay color', 'aza-lite' ),
		'section'     => 'aza_appearance_cover',
		'priority'    => 0,
		'description' => __( 'Change color and opacity of the menu bar', 'aza-lite' ),
		'palette'     => false
	) ) );

	/*=============================================================================
	 BLOG SECTION
	 =============================================================================*/

	$wp_customize->add_section( 'aza_appearance_blog', array(
		'title'       => __( 'Blog Section', 'aza-lite' ),
		'description' => __( 'Blog section options', 'aza-lite' ),
		'priority'    => 5,
		'panel'       => 'sections_panel',
	) );

	/*=============================================================================
	Blog headings
	=============================================================================*/

	$wp_customize->add_setting( 'aza_blog_title', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'aza_blog_title', array(
		'label'    => __( 'Title', 'aza-lite' ),
		'section'  => 'aza_appearance_blog',
		'priority' => 1
	) );

	$wp_customize->add_setting( 'aza_blog_subtitle', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'aza_blog_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'aza-lite' ),
		'section'  => 'aza_appearance_blog',
		'priority' => 2
	) );

	/*=============================================================================
	Blog Posts Number
	=============================================================================*/

	$wp_customize->add_setting( 'aza_blog_posts_number', array(
		'default'           => 3,
		'priority'          => 3,
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'aza_blog_posts_number', array(
		'label'   => __( 'Blog Posts Number', 'aza-lite' ),
		'section' => 'aza_appearance_blog'
	) );

	/*=============================================================================
	Blog Excerpt Length
	=============================================================================*/
	$wp_customize->add_setting( 'aza_frontpage_blog_excerpt_length', array(
		'default'           => 50,
		'priority'          => 4,
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'aza_frontpage_blog_excerpt_length', array(
		'label'   => __( 'Excerpt Length', 'aza-lite' ),
		'type'    => 'number',
		'section' => 'aza_appearance_blog'
	) );

	/*=============================================================================
	Blog Separators
	=============================================================================*/

	$wp_customize->add_setting( 'aza_separator_blog_top', array(
		'default'           => 1,
		'sanitize_callback' => 'aza_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'aza_separator_blog_top', array(
		'label'   => __( 'Separator top', 'aza-lite' ),
		'type'    => 'checkbox',
		'section' => 'aza_appearance_blog'
	) );

	$wp_customize->add_setting( 'aza_separator_blog_bottom', array(
		'default'           => 0,
		'sanitize_callback' => 'aza_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'aza_separator_blog_bottom', array(
		'label'   => __( 'Separator bottom', 'aza-lite' ),
		'type'    => 'checkbox',
		'section' => 'aza_appearance_blog'
	) );


	/*=============================================================================
	PARALLAX SECTION
	=============================================================================*/

	$wp_customize->add_section( 'aza_appearance_parallax', array(
		'title'       => __( 'Parallax Section', 'aza-lite' ),
		'priority'    => 10,
		'description' => __( 'Parallax section options', 'aza-lite' ),
		'panel'       => 'sections_panel'
	) );

	/*=============================================================================
	Parallax content
	=============================================================================*/


	$wp_customize->add_setting( 'aza_parallax_image', array(
		'default'           => get_template_directory_uri() . '/images/parallax-image.png',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aza_parallax_image', array(
		'label'       => __( 'Parallax content', 'aza-lite' ),
		'description' => __( 'Image', 'aza-lite' ),
		'section'     => 'aza_appearance_parallax',
		'priority'    => 1
	) ) );

	$wp_customize->add_setting( 'aza_parallax_text', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'aza_sanitize_text',
	) );

	$wp_customize->add_control( 'aza_parallax_text', array(
		'description' => __( 'Text - You can also use html basic tags here.', 'aza-lite' ),
		'section'     => 'aza_appearance_parallax',
		'type'        => 'textarea',
		'priority'    => 2,
	) );

	/*=============================================================================
	Parallax Text Partials
	=============================================================================*/
	$wp_customize->selective_refresh->add_partial( 'aza_parallax_text', array(
		'selector'        => '.parallax-features h3',
		'settings'        => 'aza_parallax_text',
		'render_callback' => function () {
			return get_theme_mod( 'aza_parallax_text' );
		},
	) );
	/*=============================================================================
	Parallax layers
	=============================================================================*/

	$wp_customize->add_setting( 'aza_parallax_background', array(
		'default'           => esc_url( get_template_directory_uri() . '/images/parallax-background.jpg' ),
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aza_parallax_background', array(
		'label'       => __( 'Parallax Layers', 'aza-lite' ),
		'description' => __( 'Background', 'aza-lite' ),
		'section'     => 'aza_appearance_parallax',
		'priority'    => 3
	) ) );

	$wp_customize->add_setting( 'aza_parallax_layer_1', array(
		'default'           => esc_url( get_template_directory_uri() . '/images/parallax-layer1.png' ),
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aza_parallax_layer_1', array(
		'description' => __( 'First layer image', 'aza-lite' ),
		'section'     => 'aza_appearance_parallax',
		'priority'    => 4
	) ) );

	$wp_customize->add_setting( 'aza_parallax_layer_2', array(
		'default'           => esc_url( get_template_directory_uri() . '/images/parallax-layer2.png' ),
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aza_parallax_layer_2', array(
		'description' => __( 'Second layer image', 'aza-lite' ),
		'section'     => 'aza_appearance_parallax',
		'priority'    => 5
	) ) );

	/*=============================================================================
	RIBBON SECTION
	=============================================================================*/
	$wp_customize->add_section( 'aza_appearance_ribbon', array(
		'title'       => __( 'Ribbon Section', 'aza-lite' ),
		'description' => __( 'Call to action ribbon options', 'aza-lite' ),
		'panel'       => 'sections_panel',
		'priority'    => 15,
	) );


	//Layout

	$wp_customize->add_setting( 'aza_ribbon_layout', array(
		'default'           => '2',
		'sanitize_callback' => 'aza_sanitize_select'
	) );

	$wp_customize->add_control( 'aza_ribbon_layout', array(
		'priority'    => '1',
		'type'        => 'radio',
		'label'       => __( 'Section layout', 'aza-lite' ),
		'section'     => 'aza_appearance_ribbon',
		'choices'     => array(
			'1' => 'Button first',
			'2' => 'Text first',
		),
		'description' => __( 'Change the layout of the ribbon', 'aza-lite' )
	) );

	//Color

	$wp_customize->add_setting( 'aza_ribbon_background_color', array(
		'default'           => 'rgba(0, 69, 97, 0.35)',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );
	$wp_customize->add_control( new Aza_Customize_Alpha_Color_Control( $wp_customize, 'aza_ribbon_background_color', array(
		'label'       => __( 'Background overlay ', 'aza-lite' ),
		'section'     => 'aza_appearance_ribbon',
		'description' => __( 'Change color and opacity of ribbon overlay', 'aza-lite' ),
		'palette'     => false,
		'priority'    => 2,
	) ) );


	//Text options

	$wp_customize->add_setting( 'aza_ribbon_text', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'aza_ribbon_text', array(
		'label'       => __( 'Text options', 'aza-lite' ),
		'description' => __( 'Ribbon text', 'aza-lite' ),
		'section'     => 'aza_appearance_ribbon',
		'priority'    => 3
	) );

	$wp_customize->add_setting( 'aza_ribbon_text_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aza_ribbon_text_color', array(
		'section'     => 'aza_appearance_ribbon',
		'settings'    => 'aza_ribbon_text_color',
		'description' => __( 'Text color', 'aza-lite' ),
		'priority'    => 4,
	) ) );


	//Button options

	$wp_customize->add_setting( 'aza_ribbon_button_text', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'aza_ribbon_button_text', array(
		'label'       => __( 'Button options', 'aza-lite' ),
		'description' => __( 'Button text', 'aza-lite' ),
		'section'     => 'aza_appearance_ribbon',
		'priority'    => 5
	) );

	$wp_customize->add_setting( 'aza_ribbon_button_link', array(
		'default'           => esc_url( '#' ),
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( 'aza_ribbon_button_link', array(
		'description' => __( 'Button link', 'aza-lite' ),
		'section'     => 'aza_appearance_ribbon',
		'priority'    => 6
	) );

	$wp_customize->add_setting( 'aza_ribbon_button_color', array(
		'default'           => '#fc535f',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aza_ribbon_button_color', array(
		'section'     => 'aza_appearance_ribbon',
		'priority'    => '7',
		'settings'    => 'aza_ribbon_button_color',
		'description' => __( 'Button color', 'aza-lite' )
	) ) );

	$wp_customize->add_setting( 'aza_ribbon_button_text_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aza_ribbon_button_text_color', array(
		'section'     => 'aza_appearance_ribbon',
		'priority'    => '8',
		'settings'    => 'aza_ribbon_button_text_color',
		'description' => __( 'Button text color', 'aza-lite' )
	) ) );

	/*=============================================================================
	SOCIAL RIBBON
	=============================================================================*/
	$wp_customize->add_section( 'aza_appearance_social_ribbon', array(
		'title'       => __( 'Social Ribbon', 'aza-lite' ),
		'description' => __( 'Social ribbon options.', 'aza-lite' ),
		'panel'       => 'sections_panel',
		'priority'    => 20,
	) );


	/*=============================================================================
	Social ribbon heading 1
	=============================================================================*/

	$wp_customize->add_setting( 'aza_social_heading_1', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'aza_social_heading_1', array(
		'label'    => __( 'Heading 1', 'aza-lite' ),
		'section'  => 'aza_appearance_social_ribbon',
		'priority' => 1
	) );


	/*=============================================================================
	Social ribbon separator
	=============================================================================*/

	$wp_customize->add_setting( 'aza_separator_social_ribbon', array(
		'default'           => 1,
		'sanitize_callback' => 'aza_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'aza_separator_social_ribbon', array(
		'label'   => __( 'Separator', 'aza-lite' ),
		'type'    => 'checkbox',
		'section' => 'aza_appearance_social_ribbon'
	) );

	/*=============================================================================
	Social ribbon icons
	=============================================================================*/

	$wp_customize->add_setting( 'aza_social_ribbon_icons', array(
		'sanitize_callback' => 'aza_sanitize_repeater',
		'default'           => json_encode( array(
			array(
				'icon_value' => 'fa-facebook',
				'link'       => esc_url( '#' ),
				'color'      => '#4597d1',
				'id'         => 'customizer_repeater_56d7ea7f40f64',
			),
			array(
				'icon_value' => 'fa-twitter',
				'link'       => esc_url( '#' ),
				'color'      => '#45d1c2',
				'id'         => 'customizer_repeater_56d7ea7f40f65',

			),
			array(
				'icon_value' => 'fa-google-plus',
				'link'       => esc_url( '#' ),
				'color'      => '#fc535f',
				'id'         => 'customizer_repeater_56d7ea7f40f66',
			),
		) )
	) );

	$wp_customize->add_control( new AZA_Repeater( $wp_customize, 'aza_social_ribbon_icons', array(
		'label'                             => __( 'Social Icons', 'aza-lite' ),
		'section'                           => 'aza_appearance_social_ribbon',
		'priority'                          => 2,
		'customizer_repeater_icon_control'  => true,
		'customizer_repeater_link_control'  => true,
		'customizer_repeater_color_control' => true
	) ) );

	/*=============================================================================
	Social ribbon heading 2
	=============================================================================*/

	$wp_customize->add_setting( 'aza_social_heading_2', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'aza_social_heading_2', array(
		'label'    => __( 'Heading 2', 'aza-lite' ),
		'section'  => 'aza_appearance_social_ribbon',
		'priority' => 3
	) );

	/*=============================================================================
	Social ribbon store buttons
	=============================================================================*/
	$wp_customize->add_setting( 'aza_social_ribbon_store_buttons', array(
		'default'           => 0,
		'sanitize_callback' => 'aza_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'aza_social_ribbon_store_buttons', array(
		'label'   => __( 'Show store buttons', 'aza-lite' ),
		'type'    => 'checkbox',
		'section' => 'aza_appearance_social_ribbon'
	) );

	/*=============================================================================
  CONTACT SECTION
  =============================================================================*/

	$wp_customize->add_section( 'aza_appearance_contact', array(
		'title'       => __( 'Contact Section', 'aza-lite' ),
		'description' => __( 'Contact section shortcode', 'aza-lite' ),
		'panel'       => 'sections_panel'
	) );

	/*=============================================================================
	Contact headings
	=============================================================================*/


	$wp_customize->add_setting( 'aza_contact_title', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'aza_contact_title', array(
		'label'       => __( 'Section heading', 'aza-lite' ),
		'section'     => 'aza_appearance_contact',
		'description' => __( 'Title', 'aza-lite' ),
		'priority'    => 1,
	) );

	$wp_customize->add_setting( 'aza_contact_subtitle', array(
		'sanitize_callback' => 'aza_sanitize_input'
	) );

	$wp_customize->add_control( 'aza_contact_subtitle', array(
		'description' => __( 'Subtitle', 'aza-lite' ),
		'section'     => 'aza_appearance_contact',
		'priority'    => 2,
	) );

	/*=============================================================================
	Contact shortcode
	=============================================================================*/

	$wp_customize->add_setting( 'frontpage_contact_shortcode', array(
		'sanitize_callback' => 'aza_sanitize_text'
	) );

	$wp_customize->add_control( 'frontpage_contact_shortcode', array(
		'label'    => __( 'Form Shortcode', 'aza-lite' ),
		'section'  => 'aza_appearance_contact',
		'priority' => 3,
	) );


	/*=============================================================================
	Contact background
	=============================================================================*/

	$wp_customize->add_setting( 'aza_contact_background', array(
		'default'           => 'rgba(0, 0, 0, 0.75)',
		'sanitize_callback' => 'aza_sanitize_colors'
	) );
	$wp_customize->add_control( new Aza_Customize_Alpha_Color_Control( $wp_customize, 'aza_contact_background', array(
		'label'    => __( ' Background color', 'aza-lite' ),
		'section'  => 'aza_appearance_contact',
		'palette'  => false,
		'priority' => 4,
	) ) );


	/*=============================================================================
	Contact separators
	=============================================================================*/

	$wp_customize->add_setting( 'aza_separator_contact_top', array(
		'default'           => 1,
		'sanitize_callback' => 'aza_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'aza_separator_contact_top', array(
		'label'    => __( 'Top Separator', 'aza-lite' ),
		'type'     => 'checkbox',
		'section'  => 'aza_appearance_contact',
		'priority' => 5,
	) );


	/*=============================================================================
	INTERGEO MAPS SECTION
	=============================================================================*/

	$wp_customize->add_section( 'aza_appearance_map', array(
		'title' => __( 'Maps Section', 'aza-lite' ),
		'panel' => 'sections_panel'
	) );
	$wp_customize->add_setting( 'frontpage_map_shortcode', array(
		'sanitize_callback' => 'aza_sanitize_input'
	) );
	$wp_customize->add_control( 'frontpage_map_shortcode', array(
		'label'       => __( 'Map Shortcode', 'aza-lite' ),
		'description' => __( 'We suggest using the <b>Intergeo Maps</b> plugin for the best possible experience', 'aza-lite' ),
		'section'     => 'aza_appearance_map',
		'priority'    => 1
	) );


}

add_action('customize_register', 'aza_customize_register');


//=============================================================================
function aza_sanitize_repeater($input)
{
    $input_decoded = json_decode($input, true);
    $allowed_html  = array(
                          'br'      => array(),
                          'em'      => array(),
                          'strong'  => array(),
                          'a'       => array(
                                            'href'    => array(),
                                            'class'   => array(),
                                            'id'      => array(),
                                            'target'  => array()
                          ),
                          'button'  => array(
                                            'class'   => array(),
                                            'id'      => array()
        )
    );
    foreach ($input_decoded as $boxk => $box) {
        foreach ($box as $key => $value) {
            if ($key == 'text') {
                $input_decoded[$boxk][$key] = wp_kses($value, $allowed_html);

            } else {
                $input_decoded[$boxk][$key] = wp_kses_post($value);
            }

        }
    }

    return json_encode($input_decoded);
}

//=============================================================================

/**
 * Sanitize text
 *
 * @param $input
 *
 * @return mixed
 */
function aza_sanitize_text( $input )
{
    return wp_filter_post_kses ( $input );
}

/**
 * Sanitize checkbox
 *
 * @param $checked
 *
 * @return bool
 */
function aza_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize colors
 *
 * @param $input
 *
 * @return mixed
 */
function aza_sanitize_colors( $input ) {
	$mode = ( false === strpos( $input, 'rgba' ) ) ? 'hex' : 'rgba';
	if ( 'rgba' === $mode ) {
		return aza_sanitize_rgba( $input );
	} else {
		return sanitize_hex_color( $input );
	}
}

/**
 * RGBA sanitize utility function
 *
 * @param $value
 *
 * @return string
 */
function aza_sanitize_rgba( $value ) {
	$red = $green = $blue = $alpha = 'rgba(0,0,0,0)';
	if ( empty( $value ) || is_array( $value ) ) {
		return '';
	}
	$value = str_replace( ' ', '', $value );
	sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
	return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
}

/**
 * Sanitize select / radio
 *
 * @param $input
 * @param $setting
 *
 * @return mixed
 */
function aza_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize variables to allow HTML tags
 *
 * @param string $input Text to sanitize.
 *
 * @return string
 */
function aza_sanitize_input( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function aza_customize_preview_js()
{
    wp_enqueue_script('aza_customizer', get_template_directory_uri() . '/js/admin/customizer.js', array(
        'customize-preview'
    ), '20130508', true);
}
add_action('customize_preview_init', 'aza_customize_preview_js');

function frontpage_check() {
	return is_page_template('template-frontpage.php');
}