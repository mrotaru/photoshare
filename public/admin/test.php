<?php
require_once( "../../include/init.php" );

// logout ?
global $session;
if( $session->is_logged_in() && isset( $_GET[ 'logout' ] )) {
    $found_user = User::find_by_id( $session->user_id );
    if( $found_user ) {
        $session->logout();
    }
}
include_layout_template( "admin_header.php" );
?>

<?php
//    $user = new User();
//    $user->username = "johnsmith";
//    $user->password = "asd";
//    $user->first_name = "John";
//    $user->last_name = "Smith";
//    $user->email="john@mail.com";
//    $user->save();

//$user = User::find_by_id(5);
//$user->password="111";
//$user->save();

//$user = User::find_by_id(5);
//$user->delete();

?>

<?php include_layout_template( "admin_footer.php" ); ?>
