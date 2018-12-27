<?php

include( "staff-rest.php" );
/*
 * Example PHP implementation used for the REST 'get' interface
 */
$editor
	->process( $_POST )
    ->json();

 
