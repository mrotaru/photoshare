<?php
require_once( "../../include/init.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
?>

<?php
    $max_file_size = 1000000;
    $message = "";
    if( isset( $_POST[ 'submit' ] )) {
        $photo = new Photograph();
        $photo->caption = $_POST[ 'caption' ];
        $photo->attach_file( $_FILES[ 'file_upload' ]);
        if( $photo->save() ) {
            $session->message( "Photograph successfully uploaded." );
            redirect_to( "show_photos.php" );
        } else {
            $message = join( "<br/>", $photo->errors );
        }
    }
?>


<?php include_layout_template( "admin_header.php" ); ?>
<h2>Photo Upload</h2>
    <?php info_message( $message ); ?>
    <form action="upload.php" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <p> <input type="file" name="file_upload" /> </p>
        <p> Caption: <input type="text" name="caption" value="" /></p>
        <input type="submit" name="submit" value="Upload" />
    </form>
<?php include_layout_template( "admin_footer.php" ); ?>
