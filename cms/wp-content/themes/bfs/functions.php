<?php
/**
 * Brownie Fudge Sundae functions and definitions
 *
 * @package Brownie Fudge Sundae
 * @since 1.0.0
 */



/**
 * Global Settings Pages
 */
function bfs_theme_setup () {

	/*
	 * Theme Supports
	 *
	 * Register support for certain features
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
	 */
	// Enable support for Post Thumbnails on posts and pages.
	// @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
	// Full and wide align images
	add_theme_support( 'align-wide' );
	// Responsive embeds
	add_theme_support( 'responsive-embeds' );


	/*
	 *
	 * Media Settings
	 *
	 */
	add_image_size( 'small', 400, 400, false );


	/*
	 *
	 * Show the Meta-data page if it exists
	 *
	 */
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( [
			'page_title' => 'Metadata',
			'menu_title' => 'Metadata',
			'menu_slug' => 'metadata',
			'capability' => 'edit_posts',
			'parent_slug' => '',
			'position' => false,
			'icon_url' => 'dashicons-info'
		] );
	}

}

add_action( 'after_setup_theme', 'bfs_theme_setup' );



/*
 *
 * Change the REST API base URL to match the WordPress URL instead of the Site URL
 * 	This is because things break on the admin dashboard; you can't create/edit posts.
 *
 */
// add_filter( 'rest_url_prefix', function ( $prefix ) {
	// For older versions of WordPress
	// return substr( site_url(), strlen( home_url() ) + 1 ) . '/' . $prefix;
	// From WordPress 5.4.2 onwards
	// return substr( site_url(), strlen( home_url() ) + 1 ) . '?rest_route=';
	// return '?rest_route=';
// } );



/*
 *
 * Prevent auto-"correction" of URLs
 * 	Based on `https://core.trac.wordpress.org/ticket/16557`
 *
 */
add_filter( 'redirect_canonical', function ( $redirectUrl ) {
	if ( is_404() && ! isset( $_GET[ 'p' ] ) )
		return false;
	else
		return $redirectUrl;
} );
