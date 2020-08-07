<?php

/*
 *
 * Renders a PHP template given a data context and returns the output as a string
 *
 */
class Templating {

	public static function render ( $templatePath, $context = [ ] ) {
		extract( $context );
		ob_start();
		require $templatePath;
		return ob_get_clean();
	}

}
