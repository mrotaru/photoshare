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
    // table header
    echo( "
        <table class=\"photos\"> 
        <tr>
        <th class=\"th-image\"></th>
        <th class=\"th-name\">Name</th>
        <th class=\"th-size\">Size</th>
        <th class=\"th-caption\">Caption</th>
        <th class=\"th-actions\">Actions</th>
        </tr>
        " );
    foreach( $photos as $photo ) {
        echo( "
            <tr>
            <td><img src=\"" . $photo->image_path() . "\" width=\"100px\" /></td>
            <td>" . $photo->filename . "</td>" . "
            <td>" . $photo->human_readable_size() . "</td>
            <td>" . $photo->caption . "</td>" . "
            <td><a href=\"#\" class=\"rename-button\"><span data-icon=\"$\"></span>Rename</a>
            <a href=\"delete.php?id=" . $photo->id . "\" class=\"delete-button\"><span data-icon=\"%\"></span>Delete</a>
            <a href=\"#\" class=\"download-button\"><span data-icon=\"&\"></span>Download</a></td>
            </tr>
            ");
    }
    echo( "</table>" );
} else {
    echo( "<p>There are no photos to display.</p>" );
}
?>
<div class="actions">
    <a href="upload.php" class="link-button"><span data-icon="'"></span>Upload photo</a>
</div>
<?php include_layout_template( "admin_footer.php" ); ?>
