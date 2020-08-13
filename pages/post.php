<?php

// Page-specific preparatory code goes here.
require_once __DIR__ . '/../inc/above.php';

$featuredImageHeight = getContent( '', 'featured_image_height' );
$featuredImageStyle = '';

if( !empty($featuredImageHeight) )
	$featuredImageStyle = 'padding-top: calc( '. $featuredImageHeight . '% - 60px ) !important;';


$featuredImageFallback = getContent( '', 'post_featured_fallback_image -> sizes -> medium' );
$featuredImage = get_the_post_thumbnail_url( $thePost[ 'ID' ] ) ?: $featuredImageFallback;

$socialImage = getContent( '', 'social_image -> sizes -> medium' );

$postContent = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $thePost[ 'post_content' ] ) );

?>



<!-- Landing Section -->
<section class="landing-section fill-dark js_sticky_marker" id="landing-section" data-section-title="Landing Section" data-section-slug="landing-section">
	<div class="landing-image-bg">
		<div class="image" style="background-image: url( '<?= $featuredImage ?>' );"></div>
	</div>
	<div class="landing-content" style="<?= $featuredImageStyle ?>">
		<div class="container">
			<div class="row">
				<div class="columns small-12 medium-10 medium-offset-1 space-100-bottom">
					<div class="title h3 space-min-bottom"><?= $thePost[ 'post_title' ] ?></div>
					<div class="row">
						<div class="underline columns small-4 medium-3 large-2"><span class="fill-orange"></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Landing Section -->

<!-- Post Section -->
<section class="post-section space-50-top-bottom" id="post-content-section" style="min-height: 50vh;">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div>
					<?= $postContent ?: 'Um, what happened to the content?' ?>
					<!-- Share -->
					<div class="block share-url js_share_url_widget">
						<span class="share-url-title p text-uppercase inline text-orange js_share_url_title">Share</span>
						<i class="icon material-icons inline-bottom text-orange">link</i>
						<a class="share-url-label h5 inline js_share_url" href="/?view=university-of-central-oklahoma-june-2017#tours" target="_blank">immersionindia.com/?view=university-of-central-oklahoma-june-2017#tours</a>
						<textarea class="visuallyhidden js_share_url_text">immersionindia.com/?view=university-of-central-oklahoma-june-2017#tours</textarea>
					</div>
					<!-- END: Share -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Post Section -->




<?php require_once __DIR__ . '/../inc/below.php'; ?>
