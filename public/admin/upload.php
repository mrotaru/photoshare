<?php
require_once( "../../include/init.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
?>

<?php
    $max_file_size = 1000000;
    $message = "";
    info_message( print_r( $_POST, true ));

    if( isset( $_POST[ 'submit' ] )) {
        $photo = new Photograph();
        $photo->caption = $_POST[ 'caption' ];
        $photo->attach_file( $_FILES[ 'file_upload' ]);
        if( $photo->save() ) {
            $session->message( "Photograph successfully uploaded." );
            //redirect_to( "show_photos.php" );
        } else {
            $message = join( "<br/>", $photo->errors );
        }
    }
    else $message = "Page has not been submitted.";
?>


<?php include_layout_template( "admin_header.php" ); ?>
    <?php info_message( $message ); ?>
    <form action="upload.php" enctype="multipart/form-data" method="POST">
        <fieldset>
            <legend>Photo Upload</legend>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

            <!--
            Styling the `file` input is notoriously difficult.
            The approach used below is described here:
            http://stackoverflow.com/a/9546968/447661  -->
            <p> 
                <input id="file_name" readonly="true" type="text"/>
                <a id="browse_button" class="button">Browse...</a>
                <input id="file_upload" type="file" name="file_upload" class="hidden" /> </p>
            <p> Caption: <input type="text" name="caption" value="" /></p>
            <input class="button" type="submit" name="submit" value="Upload"><!--<span data-icon="'"></span> Upload</button>-->
        </fieldset>
    </form>
<?php include_layout_template( "admin_footer.php" ); ?>
