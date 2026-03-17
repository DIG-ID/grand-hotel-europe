<?php
/**
 * Setup theme
 */
function ghe_theme_setup() {

	register_nav_menus(
		array(
			'main-menu'      => __( 'Main Menu', 'grand-hotel-europe' ),
			'mega-menu'      => __( 'Mega Menu', 'grand-hotel-europe' ),
			'footer-menu-1'   => __( 'Footer Menu 1', 'grand-hotel-europe' ),
			'footer-menu-2'   => __( 'Footer Menu 2', 'grand-hotel-europe' ),
			'copyright-menu' => __( 'Copyright Menu', 'grand-hotel-europe' ),
		)
	);

	add_theme_support( 'menus' );

	add_theme_support( 'custom-logo' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	add_image_size( 'zimmer-suiten-gallery', 1280, 689, array( 'center', 'center' ) );
 
}

add_action( 'after_setup_theme', 'ghe_theme_setup' );
/**  
 * Register our sidebars and widgetized areas.
 */
function ghe_theme_footer_widgets_init() {

	register_sidebar(
		array(
			'name'          => 'Footer',
			'id'            => 'footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		),
	);

	register_sidebar(
		array(
			'name'          => 'Mega Menu Language Switcher',
			'id'            => 'megamenu_ls',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

}

add_action( 'widgets_init', 'ghe_theme_footer_widgets_init' );

/**
 * Enqueue styles and scripts
 */
function ghe_theme_enqueue_styles() {

	//Get the theme data
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	wp_enqueue_style( 'typekit-fonts', 'https://use.typekit.net/dfu8bst.css', array(), $theme_version );

	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Gilda+Display&display=swap', array(), $theme_version );

	wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/dist/css/main.css', array(), $theme_version );

	wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/dist/js/main.js', array( 'jquery' ), $theme_version, true );

	if ( is_page_template( 'page-templates/page-arrival-contact.php' ) || is_admin() ) :
				wp_enqueue_script( 'google-map-settings', get_stylesheet_directory_uri() . '/assets/js/google-maps.js', array( 'jquery' ), $theme_version, true );
				wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBAZN5TfX1aWmjodZ4e_6sOcaJV4D59jfo&callback=initMap&loading=async', array(), $theme_version, true );
	endif; 
}

add_action( 'wp_enqueue_scripts', 'ghe_theme_enqueue_styles' );


/**
 * Initialize Google Map API key for ACF in admin.
 */

function ghe_google_map_init() {
		if ( is_admin() ) :
				acf_update_setting( 'google_api_key', 'AIzaSyBAZN5TfX1aWmjodZ4e_6sOcaJV4D59jfo' );
		endif;
}

add_action( 'acf/init', 'ghe_google_map_init' );

/**
 * Remove <p> Tag From Contact Form 7.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Lowers the metabox priority to 'core' for Yoast SEO's metabox.
 *
 * @param string $priority The current priority.
 *
 * @return string $priority The potentially altered priority.
 */
function ghe_theme_lower_yoast_metabox_priority( $priority ) {
	return 'core';
}


// Remove reCAPTCHA scripts do CF7 globalmente.
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Carrega só nas páginas que têm formulário.
add_action(
	'wp_enqueue_scripts',
	function () {
		if ( is_page_template( 'page-templates/page-arrival-contact.php' ) ) {
			wpcf7_enqueue_scripts();
			wpcf7_enqueue_styles();
		}
	}
);

/**
 * CF7: Add current page context (title + url) as hidden fields.
 * Works even when the form is rendered via do_shortcode() in templates.
 */
add_filter( 'wpcf7_form_hidden_fields', function ( $hidden_fields ) {
	$post_id = get_queried_object_id();

	// Helps CF7 post-related tags when possible (singular pages).
	if ( $post_id ) {
		$hidden_fields['_wpcf7_container_post'] = (string) $post_id;
	}

	// Title: use real post title when singular, otherwise fallback to document title (archives, etc.).
	$title = ( is_singular() && $post_id ) ? get_the_title( $post_id ) : wp_get_document_title();

	// URL: current URL (includes query string when present).
	$current_url = home_url( add_query_arg( null, null ) );

	$hidden_fields['geh_page_title'] = wp_strip_all_tags( (string) $title );
	$hidden_fields['geh_page_url']   = esc_url_raw( $current_url );

	return $hidden_fields;
}, 10, 1 );

add_filter( 'wpseo_metabox_prio', 'ghe_theme_lower_yoast_metabox_priority' );


//Simple booking integration
add_action('wp', function () {
	if (is_front_page()) {
		require_once get_template_directory() . '/inc/theme-simple-booking.php';
	}
});

// Custom Breadcrumbs for the Zimmer & Suiten
require get_template_directory() . '/inc/theme-custom-breadcrumbs.php';

// Theme custom template tags.
require get_template_directory() . '/inc/theme-template-tags.php';

// The theme admin settings.
require get_template_directory() . '/inc/theme-admin-settings.php';

// The theme custom menu walker settings.
require get_template_directory() . '/inc/theme-custom-menu-walker.php';

function my_console_log(...$data) {
	$json = json_encode($data);
	add_action('shutdown', function() use ($json) {
		 echo "<script>console.log({$json})</script>";
	});
}

