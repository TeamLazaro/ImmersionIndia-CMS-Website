<?php

/*
 *
 * Build out the data-structure driving the page navigation markup
 *
 */
$navigationMenuItems = getNavigationMenu( 'Primary' );

?>

<!-- Header Section -->
<!-- <section class="header-section">
	<div class="container">
		<div class="header row">
			<div class="columns small-3">
				<a class="logo" href="/">
					<img src="media/logo.svg<?php //echo $ver ?>">
				</a>
			</div>
			<div class="text-right columns small-9">
				<div class="navigation inline">
					<?php //foreach ( $navigationMenuItems as $item ) : ?>
						<a class="button js_nav_button" href="<?php //echo $item[ 'url' ] ?>"><?php echo $item[ 'label' ] ?></a>
					<?php //endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section> --> <!-- END : Header Section -->


<!-- Header Section -->
<section class="header-section space-25-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<a href="/" class="logo">
					<img src="../media/logo-immersion-light.svg<?= $ver ?>">
				</a>
			</div>
		</div>
	</div>
</section>
<!-- END: Header Section -->

<!-- Menu Section -->
<section class="menu-section space-25-top-bottom js_nav_open_trigger">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1">
				<button class="menu button inline w-500 js_nav_open"><i class="material-icons">menu</i> Menu</button>
			</div>
		</div>
	</div>
</section>
<!-- END: Menu Section -->

<!-- Navigation Section -->
<section class="navigation-section">
	<div class="container">
		<div class="row">
			<div class="navigation-list columns small-12 medium-8 medium-offset-4 large-6 large-offset-6 xlarge-5 xlarge-offset-7 fill-dark space-75-top-bottom space-100-left-right">
				<div class="close-button button fill-orange js_nav_close"><i class="material-icons">close</i></div>
				<div class="title h2 strong opacity-50 text-uppercase space-25-bottom">Menu</div>
				<div class="h4"><a class="link space-min-top-bottom" href=""><span class="l">Home</span></a></div>
				<div class="h4"><a class="link active space-min-top-bottom" href=""><span class="l">Why Us</span></a></div>
				<div class="h4"><a class="link space-min-top-bottom" href=""><span class="l">Study Programs</span></a></div>
				<div class="h4"><a class="link space-min-top-bottom" href=""><span class="l">Faqs</span></a></div>
				<div class="h4"><a class="link space-min-top-bottom" href=""><span class="l">Team</span></a></div>
				<div class="h4"><a class="link space-min-top-bottom" href=""><span class="l">Enquire Now</span></a></div>
				<div class="h4"><a class="link space-min-top-bottom" href=""><span class="l">COVID-19</span></a></div>
			</div>
		</div>
	</div>
	<div class="close-area cursor-pointer js_nav_close"></div>
</section>
<!-- END: Navigation Section -->
