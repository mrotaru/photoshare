<?php
require_once( "../../include/logger.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
include_layout_template( "admin_header.php" );

if( isset( $_GET[ 'clear' ] ) && $_GET[ 'clear' ] == 'true' ) {
    $user = User::find_by_id( $session->user_id );
    $logger->clear_log_file( $user );
}
?>
<form action="viewlog.php?clear=true" method="get" accepted-charset="utf-8">
    <fieldset>
        <legend>View Log</legend>

        <textarea rows="20" cols="80" readonly="true"><?php
            global $logger;
            echo $logger->get_log_file_contents();?></textarea>
        <br/>
        <?php
        echo ("
            <input type='button' class='button' value='Clear Log File'
            onclick=\"window.location='viewlog.php?clear=true';\" />
          ");
        ?>
    <fieldset>
</form>

<?php include_layout_template( "admin_footer.php" ); ?>
