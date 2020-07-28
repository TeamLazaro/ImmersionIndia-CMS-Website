
			<!-- ~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/ -->
			<!-- Page-specific content goes here. -->
			<!-- ~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/ -->
			
			<!-- Footer Section -->
			<section class="footer-section space-100-top-bottom fill-black" data-section-title="Footer Section" data-section-slug="footer-section">
				<div class="container">
					<div class="row">
						<div class="columns small-12 medium-10 medium-offset-1">
							<div class="h2 text-uppercase space-min-bottom">Quick Links</div>
							<div class="row">
								<div class="underline columns small-4 medium-3 large-2 space-min-bottom"><span class="fill-orange"></span></div>
								<div class="content columns small-12 large-10">
									<div class="links row">
										<div class="columns small-12 medium-6">
											<div class="p w-500 space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><span class="l">Home</span></a></div>
											<div class="p w-500 space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><span class="l">Why Us</span></a></div>
											<div class="p w-500 space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><span class="l">Study Programs</span></a></div>
											<div class="p w-500 space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><span class="l">Faqs</span></a></div>
											<div class="p w-500 space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><span class="l">Team</span></a></div>
											<div class="p w-500 space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><span class="l">Enquire Now</span></a></div>
											<div class="p w-500 space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><span class="l">COVID-19</span></a></div>
										</div>
										<div class="columns small-12 medium-6 xlarge-5">
											<div class="p space-min-bottom"><a href="" tabindex="-1" class="link line-height-small" style="line-height: .85"><img class="icon" src="./media/icon/icon-phone.svg<?= $ver ?>"><span class="inline-top"><span class="l">+91 95916 58632</span><br><span class="small opacity-50">Also on WhatsApp & FaceTime.</span></span></a></div>
											<div class="p space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><img class="icon" src="./media/icon/icon-linkedin.svg<?= $ver ?>"><span class="l">vineeth@immersionindia.com</span></a></div>
											<div class="p space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><img class="icon" src="./media/icon/icon-email.svg<?= $ver ?>"><span class="l">Connect on LinkedIn</span></a></div>
											<div class="p space-min-bottom"><a href="" tabindex="-1" class="link line-height-small"><img class="icon" src="./media/icon/icon-gmaps.svg<?= $ver ?>"><span class="l">Immersion India</span></a></div>
											<div class="p space-25-top-bottom"><a href="" tabindex="-1" class="link line-height-small"><img src="../media/logo-immersion-light.svg<?= $ver ?>"></a></div>
											<div class="p space-min-bottom"><span class="opacity-50">303, Milwaukee, 40 Promenade Road, Frazer Town. Bangalore—560005. Karnataka. India.</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- END: Footer Section -->


		</div> <!-- END : Page Content -->


		<!-- Lazaro Signature -->
		<?php lazaro_signature(); ?>
		<!-- END : Lazaro Signature -->

	</div><!-- END : Page Wrapper -->

	<?php require_once 'modals.php' ?>

	<!--  ☠  MARKUP ENDS HERE  ☠  -->

	<?php lazaro_disclaimer(); ?>









	<!-- JS Modules -->
	<script type="text/javascript" src="/js/modules/utils.js<?php echo $ver ?>"></script>
	<!-- <script type="text/javascript" src="/js/modules/device-charge.js<?php echo $ver ?>"></script> -->
	<script type="text/javascript" src="/js/modules/modal_box.js<?php echo $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/video_embed.js<?php echo $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/carousel.js<?php echo $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/form.js<?php echo $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/disclaimer.js<?php echo $ver ?>"></script>
	<!-- Slick Carousel -->
	<script type="text/javascript" src="/plugins/slick/slick.min.js<?php echo $ver ?>"></script>

	<script type="text/javascript">

		$( function () {

		/*
		 * Slick Slide Gallery
		 */
		
			$('.slide-gallery').slick({
				autoplay: true,
				arrows: true,
				dots: true,
				infinite: true,
				speed: 800,
				autoplaySpeed: 3000,
				slidesToShow: 1,
				adaptiveHeight: true
			});

		} );

	</script>

	<!-- Other Modules -->
	<?php // require __DIR__ . '/inc/can-user-hover.php' ?>


	<?php
		/*
		 * Arbitrary Code ( Bottom of Body )
		 */
		echo getContent( '', 'arbitrary_code_body_bottom' );
	?>

</body>

</html>
