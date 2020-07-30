<?php

// Page-specific preparatory code goes here.
require_once __DIR__ . '/../inc/above.php';

$featuredImageHeight = getContent( '', 'featured_image_height' );
$featuredImageStyle = '';

if( !empty($featuredImageHeight) )
	$featuredImageStyle = 'padding-top: calc( '. $featuredImageHeight . '% - 60px ) !important;';
?>



<!-- Landing Section -->
<section class="landing-section fill-dark" data-section-title="Landing Section" data-section-slug="landing-section">
	<div class="landing-image-bg">
		<div class="image" style="background-image: url( '<?= get_the_post_thumbnail_url($thePost['ID']) ?: 'https://via.placeholder.com/1500' ?>' );"></div>
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
<section class="post-section space-50-top-bottom" style="min-height: 50vh;">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div>
					<?= $thePost[ 'post_content' ] ?: 'Um, what happened to the content?' ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Post Section -->




<?php require_once __DIR__ . '/../inc/below.php'; ?>
