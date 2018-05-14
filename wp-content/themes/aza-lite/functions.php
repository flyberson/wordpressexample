<?php
/**
 * AZA Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aza-lite
 */

require_once( trailingslashit( get_template_directory() ) . 'inc/wp_bootstrap_navwalker.php' );

if ( ! function_exists( 'aza_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aza_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AZA Theme, use a find and replace
	 * to change 'aza-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'aza-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-header', array(
		'width'                  => 1920,
		'height'                 => 1080,
	) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'aza-post-small', 390, 250, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'aza-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom logo feature.
	if ( function_exists( 'the_custom_logo' ) ) {
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'flex-width' => true,
			'container' => 'div',
			'container-class' => 'logo-wrapper'
		) );

		if ( get_theme_mod('aza_logo') ) {
			$logo = attachment_url_to_postid( get_theme_mod( 'aza_logo' ) );
			if ( is_int( $logo ) ) {
				set_theme_mod( 'custom_logo', $logo );
  			}
			remove_theme_mod( 'aza_logo' );
		}

	}

	add_theme_support( 'customize-selective-refresh-widgets' );


}
endif; // aza_setup
add_action( 'after_setup_theme', 'aza_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aza_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aza_content_width', 640 );
}
add_action( 'after_setup_theme', 'aza_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aza_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'aza-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => esc_html__('Footer left widget', 'aza-lite'),
		'id'            => 'home_footer_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__('Footer center widget', 'aza-lite'),
		'id'            => 'home_footer_2',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__('Footer right widget', 'aza-lite'),
		'id'            => 'home_footer_3',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'aza_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aza_scripts() {

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.1');

    wp_enqueue_style( 'aza-style', get_stylesheet_uri() );

    wp_enqueue_style( 'aza-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400,700|Homemade+Apple');

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css','4.6.3' );

	wp_enqueue_script( 'aza-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.5', true );

    wp_enqueue_script( 'parallax-scroll', get_template_directory_uri() . '/js/parallax-scroll.js', array('jquery'), '1.0.0', true );

    wp_enqueue_script( 'aza-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true );

    wp_localize_script( 'aza-custom-all', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'aza-lite' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'aza-lite' ) . '</span>',
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aza_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom colors file.
 */
require_once get_template_directory() . '/inc/custom-colors.php';


// Enqueue admin styles and scripts

function aza_admin_styles() {
		wp_register_style ('aza_admin_stylesheet', get_template_directory_uri() . '/css/admin/admin-style.css', NULL, NULL, 'all' );
		wp_enqueue_style( 'aza_admin_stylesheet');

		wp_register_script( 'aza_admin_customizer_script', get_template_directory_uri() . '/js/admin/aza_admin_customizer.js', array( 'jquery' ), NULL, true );
		wp_enqueue_script( 'aza_admin_customizer_script', get_template_directory_uri() . '/js/aza_admin_customizer.js', array("jquery","jquery-ui-draggable"),'1.0.0', true  );
}
add_action( 'customize_controls_print_styles', 'aza_admin_styles');

// Register menus

function aza_register_menus() {
  register_nav_menus(
      array(
          'footer-menu-1' => __( 'Footer Menu', 'aza-lite'),
      ));
}
add_action( 'init', 'aza_register_menus' );

function aza_excerpt_more() {
	$output = '<a href="' . get_the_permalink() . '" class="more-link">'. __(' Read more &raquo;', 'aza-lite' ) . '</a>' ;

	return $output;
}
add_filter('excerpt_more', 'aza_excerpt_more');

/**
 * TGMPA register
 */

require_once get_template_directory() . '/inc/class/class-tgm-plugin-activation.php';

function aza_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Intergeo Maps - Google Maps Plugin',
			'slug'      => 'intergeo-maps',
			'required'  => false
		),
		array(
			'name'     => 'Pirate Forms',
			'slug' 	   => 'pirate-forms',
			'required' => false
		));
	$config = array(
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'aza-lite' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'aza-lite' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'aza-lite' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'aza-lite' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'aza-lite' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'aza-lite' ),
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'aza-lite' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'aza-lite' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'aza-lite' ),
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'aza-lite' ),
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'aza-lite' ),
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'aza-lite' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'aza-lite' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'aza-lite' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'aza-lite' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'aza-lite' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'aza-lite' ),
			'nag_type'                        => 'updated'
		)
	);
	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'aza_register_required_plugins' );
