<?php
/*
 *
 * This is a sample page you can copy and use as boilerplate for any new page.
 *
 */
require_once __DIR__ . '/../inc/above.php';

// Page-specific preparatory code goes here.

?>





<!-- Landing Section -->
<section class="landing-section fill-dark" data-section-title="Landing Section" data-section-slug="landing-section">
	<div class="landing-image-bg">
		<div class="image" style="background-image: url( 'https://via.placeholder.com/1500' );"></div>
	</div>
	<div class="landing-content">
		<div class="container">
			<div class="row">
				<div class="columns small-12 medium-10 medium-offset-1 space-100-bottom">
					<div class="title h3">Inset Page Title Here</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Landing Section -->

<!-- Sample Section -->
<section class="sample-section space-100-top-bottom" style="min-height: 50vh;">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<div class="h3 space-50-top space-min-bottom">Um, what happened to the sample?</div>
				<div class="h5"><?= $thePost[ 'post_content' ] ?: 'Not sure.' ?></div>
			</div>
		</div>
	</div>
</section>
<!-- END: Sample Section -->





<?php require_once __DIR__ . '/../inc/below.php'; ?>
