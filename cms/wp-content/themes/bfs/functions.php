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
	 * Block settings
	 *
	 */
	add_action( 'enqueue_block_editor_assets', function () {
		wp_enqueue_script(
			'bfs-guten-script',
			get_template_directory_uri() . '/js/blocks.js',
			[ 'wp-dom-ready', 'wp-blocks', 'wp-edit-post' ],
			filemtime( __DIR__ . '/js/blocks.js' )
		);
	} );



	/*
	 *
	 * Show the Meta-data page if it exists
	 *
	 */
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( [
			'page_title' => 'Options',
			'menu_title' => 'Options',
			'menu_slug' => 'metadata',
			'capability' => 'edit_posts',
			'parent_slug' => '',
			'position' => '5',
			'icon_url' => 'dashicons-admin-generic'
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


/*
 *
 * ----- For Gallery blocks, remove the `srcset` attribute and replace the `src` attribute with `data-lazy`
 *
 */
add_filter( 'render_block', function ( $content, $block ) {
	if ( $block[ 'blockName' ] === 'core/gallery' )
		return str_replace( 'srcset', 'data-srcset', str_replace( '<img src', '<img data-lazy', $content ) );
	else
		return $content;
}, 9999, 2 );



/*
 *
 * ----- Custom Gutenberg blocks
 *
 */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_register_block_type' ) )
		return;

	// Youtube Embed block
	acf_register_block_type( [
		'name' => 'bfs-youtube-embed',
		'title' => __( 'YouTube Embed' ),
		'description' => __( 'Embed YouTube video' ),
		'render_template' => 'template-parts/youtube-embed.php',
		'category' => 'embed',
		'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M21.8 8s-.195-1.377-.795-1.984c-.76-.797-1.613-.8-2.004-.847-2.798-.203-6.996-.203-6.996-.203h-.01s-4.197 0-6.996.202c-.39.046-1.242.05-2.003.846C2.395 6.623 2.2 8 2.2 8S2 9.62 2 11.24v1.517c0 1.618.2 3.237.2 3.237s.195 1.378.795 1.985c.76.797 1.76.77 2.205.855 1.6.153 6.8.2 6.8.2s4.203-.005 7-.208c.392-.047 1.244-.05 2.005-.847.6-.607.795-1.985.795-1.985s.2-1.618.2-3.237v-1.517C22 9.62 21.8 8 21.8 8zM9.935 14.595v-5.62l5.403 2.82-5.403 2.8z"></path></svg>',
		'keywords' => [ 'youtube', 'embed' ],
		'mode' => 'edit'
	] );
} );
