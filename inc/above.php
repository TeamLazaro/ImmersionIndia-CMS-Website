<?php

// Get utility functions
require_once __DIR__ . '/utils.php';
// Include WordPress for Content Management
if ( CMS_ENABLED )
	initWordPress();

/* -- Lazaro disclaimer and footer -- */
require_once __DIR__ . '/signatures-and-disclaimers.php';

/*
 * A version number for versioning assets to invalidate the browser cache
 */
$ver = '?v=20200713';

/*
 * A class name for temporarily disabling sections or features or content parts while in development
 */
$hide = 'hidden';
$showMedium = 'show-for-medium';


/*
 * Figure out the base URL
 * 	We diff the document root and the directory of this file to determine it
 */
$pathFragments = array_values( array_filter( explode( '/', substr( __DIR__, strlen( $_SERVER[ 'DOCUMENT_ROOT' ] ) ) ) ) );
if ( count( $pathFragments ) > 1 )
	$baseURL = '/' . $pathFragments[ 0 ] . '/';
else
	$baseURL = '/';


// Construct the page's title ( for use in the title tag )
$siteTitle = getContent( '', 'page_title', $urlSlug ) ?: getContent( 'Page Title', 'page_title' );
$pageUrl = $siteUrl . $requestPath;

// Build the Page Title ( if an explicit one is set, use that )
if ( cmsIsEnabled() and ! empty( $thePost ) )
	$pageTitle = ( $pageTitle ?? $thePost[ 'post_title' ] ) . ' | ' . $siteTitle;
else
	$pageTitle = empty( $pageTitle ) ? $siteTitle : ( $pageTitle . ' | ' . $siteTitle );


/*
 * Meta / SEO
 */
$metaDescription = $metaDescription ?? getContent( null, 'meta_description' );
$metaImage = $metaImage ?? getContent( [ ], 'meta_image' );
$metaImage = $metaImage[ 'sizes' ][ 'medium' ] ?? $metaImage[ 'sizes' ][ 'small' ] ?? $metaImage[ 'sizes' ][ 'thumbnail' ] ?? $metaImage[ 'url' ] ?? null;


/*
 * Meta / SEO
 */
$metaDescription = $metaDescription ?? getContent( null, 'meta_description' );
$metaImage = $metaImage ?? getContent( [ ], 'meta_image' );
$metaImage = $metaImage[ 'sizes' ][ 'medium' ] ?? $metaImage[ 'sizes' ][ 'small' ] ?? $metaImage[ 'sizes' ][ 'thumbnail' ] ?? $metaImage[ 'url' ] ?? null;


// #fornow
// Just so that when some social media service (WhatsApp) try to ping URL,
//  	it should not get a 404. This because is setting the response header.
http_response_code( 200 );

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
	prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">

	<?php require_once 'head.php'; ?>

	<body id="body" class="body">

		<?php
			/*
			 * Arbitrary Code ( Top of Body )
			 */
			echo getContent( '', 'arbitrary_code_body_top' );
		?>

	<!--  ★  MARKUP GOES HERE  ★  -->

	<div id="page-wrapper"><!-- Page Wrapper -->

		<?php require_once 'navigation.php'; ?>


		<!-- Page Content -->
		<div id="page-content">

			<!-- Header Section -->
			<section class="header-section space-25-top-bottom">
				<div class="container">
					<div class="row">
						<div class="columns small-12 medium-10 medium-offset-1">
							<a href="/" class="logo">
								<img src="../media/logo-immersion-light.svg<?= $ver ?>">
							</a>
						</div>
						<!-- <div class="columns small-4 medium-5 inline-middle text-right">
							<button class="menu button fill-neutral-1 inline w-500" style="box-shadow: 0 0 0 2px rgba(35, 31, 32, 1);">Menu</button>
						</div> -->
					</div>
				</div>
			</section>
			<!-- END: Header Section -->

			<!-- Menu Section -->
			<section class="menu-section space-25-top-bottom">
				<div class="container">
					<div class="row">
						<div class="columns small-12 medium-10 medium-offset-1">
							<button class="menu button inline w-500"><i class="material-icons">menu</i> Menu</button>
						</div>
					</div>
				</div>
			</section>
			<!-- END: Menu Section -->
