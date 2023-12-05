<?php
/**
 * Vancouver Live functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vancouver_Live
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
function vancouver_live_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Vancouver Live, use a find and replace
		* to change 'vancouver-live' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'vancouver-live', get_template_directory() . '/languages' );

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
	add_image_size( 'logo', 75, 75);
	add_action( 'wp_enqueue_scripts', 'vancouver_live_scripts' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'vancouver-live' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'vancouver_live_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);


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
add_action( 'after_setup_theme', 'vancouver_live_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vancouver_live_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vancouver_live_content_width', 640 );
}
add_action( 'after_setup_theme', 'vancouver_live_content_width', 0 );
/**
 * Enqueue scripts and styles.
 */
function vancouver_live_scripts() {
	wp_enqueue_style( 'vancouver-live-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'vancouver-live-style', 'rtl', 'replace' );

	wp_enqueue_script( 'vancouver-live-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function gf_enqueue_forms() {
    gravity_form_enqueue_scripts( 1, true );
	if ( is_post_type_archive('vanlive-vendor') ) { 
        gravity_form_enqueue_scripts( 2, true );
    }
}
add_action( 'get_header', 'gf_enqueue_forms' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load custom post types and taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomies.php';
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

function custom_archive_title($title) {
	if (is_post_type_archive(array('vanlive-performer', 'vanlive-vendor'))) {
		$title = post_type_archive_title('', false);
	}
	return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');


add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );
    return $tabs;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
function woocommerce_template_product_description() {
	woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );

function my_login_logo() { ?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/icons/logo-fav.png);
			height:140px;
			width:140px;
			background-size: 140px 140px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action('wp_dashboard_setup', 'wpdocs_remove_dashboard_widgets');

function wpdocs_remove_dashboard_widgets(){
   remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
   remove_meta_box('dashboard_primary', 'dashboard', 'side');
   remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal');
   remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
   remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
   remove_meta_box('dashboard_activity', 'dashboard', 'normal');
   remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal');
   remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');
   remove_meta_box('wpseo-wincher-dashboard-overview', 'dashboard', 'normal');
}

add_action( 'load-index.php', 'remove_welcome_panel' );

function remove_welcome_panel()
{
    remove_action('welcome_panel', 'wp_welcome_panel');
    $user_id = get_current_user_id();
    if (0 !== get_user_meta( $user_id, 'show_welcome_panel', true ) ) {
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
    }
}

add_action('wp_dashboard_setup', 'my_custom_dashboard_widget');
function my_custom_dashboard_widget() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('tutorial_1', 'How to add tickets/products', 'custom_dashboard_tutorial_product');
	wp_add_dashboard_widget('tutorial_2', 'How to add new vendors/performers', 'custom_dashboard_tutorial_performer_vendor');
	wp_add_dashboard_widget('tutorial_3', 'How to customize vendor tier names and descriptions', 'custom_dashboard_tutorial_customize_vendor');
}

function custom_dashboard_tutorial_product() { ?>
	<video width="800" controls>
		<source src="<?php echo get_stylesheet_directory_uri(); ?>/tutorials/Adding_a_product.mp4" type="video/mp4">
  		Your browser does not support the video tag.
  	</video>;<?php
}

function custom_dashboard_tutorial_performer_vendor() { ?>
	<video width="800" controls>
		<source src="<?php echo get_stylesheet_directory_uri(); ?>/tutorials/Adding_performers_and_vendors.mp4" type="video/mp4">
  		Your browser does not support the video tag.
  	</video>;<?php
}

function custom_dashboard_tutorial_customize_vendor() { ?>
	<video width="800" controls>
		<source src="<?php echo get_stylesheet_directory_uri(); ?>/tutorials/Customising_tier_names_and_descriptions.mp4" type="video/mp4">
  		Your browser does not support the video tag.
  	</video>;<?php
}

function my_add_custom_dashboard_styles() {
    wp_add_inline_style('wp-admin', '
		#dashboard-widgets-wrap {
			display:flex;
			flex-direction: column;
			justify-content: center;
		}
		@media only screen and (min-width: 800px) and (max-width: 1499px) {
			#wpbody-content #dashboard-widgets .postbox-container {
    			width:auto
			}
		}
		#dashboard-widgets .postbox-container {
			width:auto;
		}
		.postbox-container {
			float: none;
		}
		.inside {
			text-align: center;
		}
		#dashboard-widgets-wrap > #dashboard-widgets .empty-container {
			display: none;
		}
    ');
}
add_action('admin_enqueue_scripts', 'my_add_custom_dashboard_styles');
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );
// Enqueue Google Fonts
function enqueue_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;700&family=Merriweather:wght@400;700&display=swap', [], null);
}
add_action('wp_enqueue_scripts', 'enqueue_google_fonts');

// Add custom excerpt length
function vli_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'vli_excerpt_length', 999 );

// Add custom excerpt more
function vli_excerpt_more( $more ) {
	$more = '... <a class="read-more" href="' . esc_url( get_permalink() ) . '">Continue Reading</a>';
	return $more;
}

add_filter( 'excerpt_more', 'vli_excerpt_more' );