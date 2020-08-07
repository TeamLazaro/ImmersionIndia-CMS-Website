<?php

require_once __DIR__ . '/../conf.php';
require_once __DIR__ . '/../inc/utils.php';
if ( CMS_ENABLED )
	initWordPress();



$attachmentURL = '';
if ( ! empty( $programId ) )
	$attachmentURL = getContent( null, 'details_pdf -> url', $programId );

?>
<p>
	Dear <?= $name ?>,
</p>

<p>Thanks for your interest in our tours!</p>

<?php if ( ! empty( $programId ) ) : ?>
<p>
	You can find the detailed itinerary <a href="<?= $attachmentURL ?>" target="_blank">here</a>.
</p>
<?php endif; ?>

<p>Someone from our team will get in touch with you to provide any additional information that you may need.</p>
<?php // <p>Someone from our team will contact you soon.</p> ?>

<p>
	Regards,
	<br>
	<br>
	<img src="<?= $hostDomainURL ?>/media/email_signature.jpg" width="550px">
	<br>
	Call <a href="tel:+919591658632">+91 95916 58632</a>
	<br>
	<a href="https://immersionindia.com">immersionindia.com</a>
</p>
