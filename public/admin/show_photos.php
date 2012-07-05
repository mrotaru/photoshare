<?php
require_once( "../../include/init.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
include_layout_template( "admin_header.php" );
?>

<?php
$photos = array();
$photos = Photograph::find_all();

info_message( $message );

if( !empty( $photos )) {
    echo( "<h2>Your uploaded photos</h2>" );
    echo( " <div id=\"gallery\" class=\"clearfix set\"> " );
    $n = sizeof( $photos );
    for( $i=0; $i < $n; $i++ ) {
        $photo = $photos[$i];
        if( $i == 0  ) $class = "image first";
        else if( $i == $n-1 ) $class = "image last";
        else $class = "image";
        echo( "
            <div class=\"" . $class . "\">
            <a href=\"photo.php?id=" . $photo->id . "\" title=\"" . $photo->caption . "\">
            <img src=\"" . $photo->image_path() . "\" width=\"197px\" height=\"197px\" />
            </a>
            </div>
            ");
    }
    echo( " </div> " );
} else {
    echo( "<p>There are no photos to display.</p>" );
}
?>
<div class="actions">
    <a href="upload.php" class="link-button"><span data-icon="'"></span>Upload photo</a>
</div>
<?php include_layout_template( "admin_footer.php" ); ?>
