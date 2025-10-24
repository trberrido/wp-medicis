<?php if ( ! defined( 'ABSPATH' ) ) exit;

function console(): void {

	$fn_argv = func_get_args();

	echo '<pre style="position: relative; z-index: 100; background-color:#ececec; color: black; padding: 1rem; border: 1px solid #666666; font-size: .8rem; border-radius: .5rem;">';
	foreach ( $fn_argv as $fn_arg ) {
		var_dump( $fn_arg );
		echo '-----------<br>';
	}
	echo '</pre>';

}