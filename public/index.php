<?php
require_once( "../include/init.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
?>
<?php include_layout_template( "header.php" ); ?>
    <h2>Public home page</h2>
<?php include_layout_template( "footer.php" ); ?>
