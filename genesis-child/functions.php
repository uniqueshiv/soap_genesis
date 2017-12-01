<?php
/*
* Functions
* @package Shiva
* @author  Shiva Chauhan <shiv@webninjaz.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/


//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Soaphub' );
define( 'CHILD_THEME_URL', 'http://www.soaphub.com' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'webninjaz_soaphub_enqueue_styles');
function webninjaz_soaphub_enqueue_styles() {
  wp_enqueue_style( 'soaphub-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Montserrat:300,400,500,600,700|Poppins:300,400,500,600', array(), CHILD_THEME_VERSION );
	//wp_enqueue_style( 'soaphub-lato-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic', array(), CHILD_THEME_VERSION );
	//wp_enqueue_style( 'soaphub-gvollkorn-fonts', '//fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'soaphub-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
  //wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );

}

//* Reposition the Primary Navigation Menu
add_action( 'genesis_before_header', 'genesis_do_nav' );

// Register and display Footer Navigation Menu
add_action('genesis_before_footer', 'webninjaz_soaphub_footer_menu', 10);
	function webninjaz_soaphub_footer_menu() {

	register_nav_menu( 'footer', 'Footer Navigation Menu' );
	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'menu_class'     => 'menu genesis-nav-menu menu-footer',
	) );

}

// Add Theme Support for Genesis Menus
add_theme_support( 'genesis-menus', array(
  'primary'   => __( 'Top Navigation Menu', 'genesis' ),
  'secondary' => __( 'Secondary Navigation Menu', 'genesis' ),
  'footer' => __( 'Footer Navigation Menu', 'genesis' ),
  )
 );

// Add structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'menu-footer',
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer'
) );


//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );
//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );

//* Add HTML5 responsive recognition
add_theme_support( 'genesis-responsive-viewport' );

// add_action( 'wp_enqueue_scripts', 'my_child_theme_scripts' );
// function my_child_theme_scripts() {
//     wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
// }


/*add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {
  // ** Backend **

	// Remove Metaboxes
	add_action( 'genesis_theme_settings_metaboxes', 'be_remove_metaboxes' );

	// Add Home Sidebar
	genesis_register_sidebar( array( 'name' => 'Home Sidebar', 'id' => 'home-sidebar' ) );

	// Add Footer Widgets
	add_theme_support( 'genesis-footer-widgets', 6 );

  // ** Frontend **

	// Add Nav to Header
	add_action( 'genesis_header', 'be_nav_menus' );

	// Add Search to Footer
	add_action( 'genesis_before_footer', 'be_search', 4 );
	add_filter( 'genesis_search_text', '__return_false' );
	add_filter( 'genesis_search_button_text', 'be_search_button_text' );

	// Footer
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	add_action( 'genesis_footer', 'be_footer' );
}*/

/**
 * Remove Metaboxes
 * This removes unused or unneeded metaboxes from Genesis > Theme Settings. See /genesis/lib/admin/theme-settings.php for all metaboxes.
 *
 */

function be_remove_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}

/**
 * Add Nav Menus to Header
 *
 */

function be_nav_menus() {
	echo '<div class="menus" id="sssss"><div class="primary ssss">';
	wp_nav_menu( array( 'menu' => 'Primary' ) );
	echo '</div><!-- .primary --><div class="secondary">';
	wp_nav_menu( array( 'menu' => 'Secondary' ) );
	echo '</div><!-- .secondary --></div><!-- .menus -->';

}

remove_action( 'genesis_after_header', 'genesis_do_nav' );
/**
 * Add Search to Footer
 *
 */

function be_search() {
	?>
	<div id="searchbar">
		<div class="wrap">
			<p>Can't find what you're looking for? </p> <?php get_search_form(); ?>
		</div>
	</div>
	<?php
}

/**
 * Change search button text to Go
 *
 */

function be_search_button_text( $text ) {
	return esc_attr( 'Go' );
}

/**
* Top Section
*
*/
add_action( 'genesis_before_header', 'be_header', 4 );
function be_header() {
  echo '<div class="wrap"> <div class="left">';
  wp_nav_menu( array( 'menu' => 'primary' ) );
  echo '</div>';
	echo '<div class="right">';
	wp_nav_menu( array( 'menu' => 'Footer' ) );
	echo '</div></div>';
}
/**
 * Footer
 *
 */
add_action( 'genesis_before_footer', 'be_search', 4 );
function be_footer() {
	echo '<div class="left"><p>© Copyright ' . date('Y') . ' : All Rights Reserved</p></div>';
	echo '<div class="right">';
	wp_nav_menu( array( 'menu' => 'Footer' ) );
	echo '</div>';
}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-sidebar',
	'name'        => __( 'Home Sidebar', 'soaphub' ),
	'description' => __( 'This is the homepage sidebar.', 'soaphub' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-featured-full',
	'name'        => __( 'Home Featured', 'soaphub' ),
	'description' => __( 'This is the featured section of the homepage.', 'soaphub' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-top-full',
	'name'        => __( 'Home Top', 'soaphub' ),
	'description' => __( 'This is the top section of the content area on the homepage.', 'soaphub' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-full',
	'name'        => __( 'Home Middle', 'soaphub' ),
	'description' => __( 'This is the middle section of the content area on the homepage.', 'soaphub' ),
) )
;genesis_register_sidebar( array(
	'id'          => 'home-bottom-full',
	'name'        => __( 'Home Bottom', 'soaphub' ),
	'description' => __( 'This is the bottom section of the content area on the homepage.', 'soaphub' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'soaphub' ),
	'description' => __( 'This is the after entry widget area.', 'soaphub' ),
) );
genesis_register_sidebar( array(
	'id'          => 'sub-footer-left',
	'name'        => __( 'Sub Footer - Left', 'soaphub' ),
	'description' => __( 'This is the left section of the sub footer.', 'soaphub' ),
) );
genesis_register_sidebar( array(
	'id'          => 'sub-footer-right',
	'name'        => __( 'Sub Footer - Right', 'soaphub' ),
	'description' => __( 'This is the right section of the sub footer.', 'soaphub' ),
) );

//cusotm Logo

add_theme_support( 'custom-logo', array(
	'width'       => 600,
	'height'      => 160,
	'flex-width' => true,
	'flex-height' => true,
) );
add_filter( 'genesis_seo_title', 'custom_header_inline_logo', 10, 3 );
/**
 * Add an image inline in the site title element for the logo
 *
 * @param string $title Current markup of title.
 * @param string $inside Markup inside the title.
 * @param string $wrap Wrapping element for the title.
 *
 * @author @_AlphaBlossom
 * @author @_neilgee
 * @author @_JiveDig
 * @author @_srikat
 */
function custom_header_inline_logo( $title, $inside, $wrap ) {
	// If the custom logo function and custom logo exist, set the logo image element inside the wrapping tags.
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$inside = sprintf( '<span class="screen-reader-text">%s</span>%s', esc_html( get_bloginfo( 'name' ) ), get_custom_logo() );
	} else {
		// If no custom logo, wrap around the site name.
		$inside	= sprintf( '<a href="%s">%s</a>', trailingslashit( home_url() ), esc_html( get_bloginfo( 'name' ) ) );
	}

	// Build the title.
	$title = genesis_markup( array(
		'open'    => sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ),
		'close'   => "</{$wrap}>",
		'content' => $inside,
		'context' => 'site-title',
		'echo'    => false,
		'params'  => array(
			'wrap' => $wrap,
		),
	) );

	return $title;
}

add_filter( 'genesis_attr_site-description', 'custom_add_site_description_class' );
/**
 * Add class for screen readers to site description.
 * This will keep the site description markup but will not have any visual presence on the page
 * This runs if there is a logo image set in the Customizer.
 *
 * @param array $attributes Current attributes.
 *
 * @author @_neilgee
 * @author @_srikat
 */
function custom_add_site_description_class( $attributes ) {
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$attributes['class'] .= ' screen-reader-text';
	}

	return $attributes;
}

// search idcon
add_filter( 'genesis_search_button_text', 'wpsites_search_button_icon' );
function wpsites_search_button_icon( $text ) {
	return esc_attr( '&#xf179;' );
}


// Add Search to Header Nav
add_filter( 'wp_nav_menu_items', 'genesis_search_header_nav_menu', 10, 2 );
function genesis_search_header_nav_menu( $menu, stdClass $args ){
  if ( 'header' != $args->theme_location )
    return $menu;
        if( genesis_get_option( 'nav_extras' ) )
          return $menu;
    $menu .= sprintf( '<li id="menu-item-4439205 ssss" class="custom-search menu-item">%s</li>', __( genesis_search_form( $echo ) ) );
    return $menu;
}

// Add Social Widget Area for Primay Nav
genesis_register_sidebar( array(
	'id'          => 'nav-social-menu',
	'name'        => __( 'Nav Social Menu' ),
	'description' => __( 'This is the nav social menu section.' ),
) );
// Add Search to Primary Nav
add_filter( 'wp_nav_menu_items', 'genesis_search_primary_nav_menu', 10, 2 );
function genesis_search_primary_nav_menu( $menu, stdClass $args ){
  if ( 'primary' != $args->theme_location )
    return $menu;
        if( genesis_get_option( 'nav_extras' ) )
          return $menu;
	ob_start();
	echo '<li id="menu-item-4439203" class="custom-social menu-item">';
	genesis_widget_area('nav-social-menu');
	$social = ob_get_clean();
    $menu_search = sprintf( '%s</li>', __( genesis_search_form( $echo ) ) );
    return $menu . $social . $menu_search;
}
