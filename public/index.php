<?php
require_once( "../include/session.php" );

// logout ?
global $session;
if( $session->is_logged_in() && isset( $_GET[ 'logout' ] )) {
    $found_user = User::find_by_id( $session->user_id );
    if( $found_user ) {
        $session->logout();
    }
}
?>
<?php include_layout_template( "header.php" ); ?>
    <h2>Public home page</h2>
<?php include_layout_template( "footer.php" ); ?>
