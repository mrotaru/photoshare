<?php  
require_once( "../../include/init.php" );
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

if( isset( $_POST[ 'submit' ] )) {
    global $session;
    $body = trim( $_POST[ 'body' ] );
    if( empty( $body ) || !$session->is_logged_in() ) {
        $session->message( "You must be logged in to post comments, and the comments cannot be blank." );
        redirect_to( "photo.php?id=" . $_GET[ 'id' ] );
    } else {
        $new_comment = Comment::generate( $_GET[ 'id' ], $session->user_id, $body );
        if( $new_comment && $new_comment->save() ) {
            $message = "Comment saved.";
        } else {
            $message = "There was an error, preventing the comment from being saved.";
        }
    }
}
info_message( $message );
?>

<section id="image">
    <img src="<?php echo( $photo->image_path() );?>" alt="<?php echo( $photo->caption );?>" />
</section>

<section class="comments">
    <h3>Comments</h3>
<?php
$comments = Comment::find_comments_on( $_GET[ 'id' ] );
if( count( $comments ) > 0 ) {
    foreach( $comments as $comment ) {
        echo( "<div class=\"comment\">" );
        $username = User::find_by_id( $comment->user_id )->username;
        $date = strftime( "%a, %#d %b %Y, %I:%M:%S %p", strtotime( $comment->created ));
        echo( "<h4>" . $username . " on " . $date . ":</h4>" );
        echo( "<p>" . $comment->body . "</b>" );
        echo( "</div>" );
        }
} else { // no comments
    echo( "No comments yet." );
}
?>
</section>
<section class="comment">
<h3>Your Comment</h3>
    <form action="photo.php?id=<?php echo( $_GET[ 'id' ] );?>" enctype="multipart/form-data" method="POST">
        <fieldset>
            <textarea rows="4" cols="40" name="body"></textarea>
            <input class="button" type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
</section>

<?php include_layout_template( "admin_footer.php" ); ?>
