<?php
/**
 * Life Outdoors functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Life_Outdoors
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lifeoutdoors_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Life Outdoors, use a find and replace
		* to change 'lifeoutdoors-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'lifeoutdoors-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in 7 location.
    register_nav_menus(
        array(
            'menu-left'   => __( 'Menu Left' ),
            'menu-center' => __( 'Menu Center' ),
            'menu-right'  => __( 'Menu Right' ),
			'footer-left'  => __( 'Footer Left' ),
            'footer-center'  => __( 'Footer Center' ),
            'footer-center-2'  => __( 'Footer Center-2' ),
            'footer-right'  => __( 'Footer Right' ),
        )
    );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'lifeoutdoors_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lifeoutdoors_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lifeoutdoors_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'lifeoutdoors_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lifeoutdoors_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lifeoutdoors-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lifeoutdoors-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lifeoutdoors_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lifeoutdoors_theme_scripts() {
	wp_enqueue_style( 'lifeoutdoors-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'lifeoutdoors-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'lifeoutdoors-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // preventing empty search submission
    wp_enqueue_script('empty-search-prevent', get_template_directory_uri() . '/js/empty-search-prevent.js', array(), '1.0', true);
    
}
add_action( 'wp_enqueue_scripts', 'lifeoutdoors_theme_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* Register CPTs and Taxonomies.
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// slideshow for hero images on homepage
function enqueue_slick_slider() {
    wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1' );
    wp_enqueue_style( 'slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), '1.8.1' );

    wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true );

    wp_enqueue_script( 'custom-slick-js', get_template_directory_uri() . '/js/custom-slick.js', array('jquery', 'slick-js'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_slick_slider' );

// google maps API keys on contact page
function enqueue_google_maps_script() {
    if (is_page('contact-us')) {
        wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCIhWznK-Bo47A6t_UAoJBLOGH9OUAzut4', null, null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_google_maps_script');

// font awesome for nav menus
function enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );

// add h1 to events page
add_action( 'tribe_template_after_include:events/v2/components/before', function() { ?>
    <div class="tribe-events-calendar-header">
        <h1 class="tribe-events-header-title">Workshops</h1>
    </div>     
<?php } );