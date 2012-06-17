<?php
require_once( "../../include/init.php" );
if( !$session->is_logged_in() ) { redirect_to( "login.php" ); }
include_layout_template( "admin_header.php" );
?>

<?php
$photos = array();
$photos = Photograph::find_all();

// table header
echo( "
    <table> 
    <tr>
    <th>Name</th>
    <th>Size</th>
    <th>Caption</th>
    <th colspan='3'>Actions</th>
    </tr>
    " );
foreach( $photos as $photo ) {
    echo( "
        <tr>
        <td><img src=\"../images/" . $photo->filename . "\" width=100 /></td>
        <td>" . $photo->filename . "</td>" . "
        <td>" . $photo->size . "</td>" . "
        <td>" . $photo->caption . "</td>" . "
        <td><a href=\"#\">Rename</a></td>
        <td><a href=\"#\">Delete</a></td>
        <td><a href=\"#\">Download</a></td>
        </tr>
        ");
}
echo( "</table>" );
?>

<?php include_layout_template( "admin_footer.php" ); ?>
