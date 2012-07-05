<?php  
require_once( "../../include/init.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
include_layout_template( "admin_header.php" );

if( empty( $_GET[ 'id' ] )) {
    $session->message( "No photograph ID was provided." );
    redirect_to( "index.php" );
}

$photo = Photograph::find_by_id( $_GET[ 'id' ] );
if( !$photo ) {
    $session->message( "The photo could not be found." );
    redirect_to( "show_photos.php" );
}

?>

<div id="image">
    <img src="<?php echo( $photo->image_path() );?>" alt="<?php echo( $photo->caption );?>" />
</div>

<?php include_layout_template( "admin_footer.php" ); ?>
