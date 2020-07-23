
			<!-- ~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/ -->
			<!-- Page-specific content goes here. -->
			<!-- ~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/ -->

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
