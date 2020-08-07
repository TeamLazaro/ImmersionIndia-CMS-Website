<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/templating.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class Mailer {

	public function __construct () {
		$this->mailer = $this->getMailer();
	}

	private function getMailer () {
		date_default_timezone_set( 'Asia/Kolkata' );
		$mailer = new PHPMailer( true );
		// Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mailer->SMTPDebug = 0;
		// Tell PHPMailer to use SMTP
		$mailer->isSMTP();
		// Ask for HTML-friendly debug output
		$mailer->Debugoutput = 'html';
		// Set the hostname of the mail server
		$mailer->Host = 'smtp.gmail.com';
		// Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mailer->Port = 587;
		// Set the encryption system to use - ssl (deprecated) or tls
		$mailer->SMTPSecure = 'tls';
		// Use SMTP authentication
		$mailer->SMTPAuth = true;
		$credentials = $this->getCredentials();
		// Username to use for SMTP authentication - use full email address for gmail
		$mailer->Username = $credentials[ 'username' ];
		// Password to use for SMTP authentication
		$mailer->Password = $credentials[ 'password' ];
		// $mailer->addCC( '', '' );
		$mailer->isHTML( true );

		return $mailer;
	}

	private function getCredentials () {
		require_once __DIR__ . '/../content/configuration/mail.php';
		return [
			'username' => USERNAME,
			'password' => PASSWORD
		];
	}

	public function setFrom ( $emailAddress, $name = '' ) {
		$this->mailer->setFrom( $emailAddress, $name );
	}

	public function addRecipient ( $emailAddress, $name = '' ) {
		$this->mailer->addAddress( $emailAddress, $name );
	}

	public function setSubject ( $subject ) {
		$this->mailer->Subject = $subject;
	}

	// Either a string can be passed, or a template file and a data/context object
	public function setBody ( $bodyStringOrTemplate, $data = [ ] ) {
		$body = '';
		if ( empty( $data ) and ! file_exists( $bodyStringOrTemplate ) )
			$body = $bodyStringOrTemplate;
		else
			$body = Templating::render( $bodyStringOrTemplate, $data );
		$this->mailer->Body = $body;
	}

	public function addAttachment ( $name, $path ) {
		$content = file_get_contents( $path );
		$this->mailer->addStringAttachment( $content, $name );
	}

	public function send () {
		try {
			$this->mailer->send();
		}
		catch ( Exception $e ) {
			throw new \Exception( $this->mailer->ErrorInfo );
		}
	}

}
