<?php

/*
 * Example PHP implementation used for the REST 'create' interface.
 */

include( "staff-rest.php" );

// The REST example uses 'PUT' for the input, so we need to get the 
// parameters being sent to us from php://input
parse_str( file_get_contents('php://input'), $args );

$editor 
	->process($args)
	->json();
if ( Editor::action( $_POST ) === Editor::ACTION_READ ) {
    for ( $i=0, $ien=count($out['data']) ; $i<$ien ; $i++ ) {
        unset( $out['data'][$i]['DT_RowId'] );
    }
}
 
// Send it back to the client
echo json_encode( $out );
