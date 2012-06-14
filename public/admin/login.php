<?php
require_once( "../../include/functions.php" );
require_once( "../../include/session.php" );
require_once( "../../include/database.php" );
require_once( "../../include/user.php" );

if( $session->is_logged_in() ) {
    redirect_to( "index.php" );
}

if( isset( $_POST[ 'submit' ] )) {
    $username = trim( $_POST[ 'username' ] );
    $password = trim( $_POST[ 'password' ] );

    // check if user exists
    $found_user = User::authenticate( $username, $password );
    if( $found_user ) {
        $session->login( $found_user );
        redirect_to( "index.php" );
    } else {
        $message = "Username/password combination incorrect.";
    }
} else {
    $username = "";
    $password = "";
}
?>
<html>
    <head>
        <title>OO PHP</title>
        <link rel="stylesheet" href="../css/style.css"/>
    </head>
    <body>
        <form action="login.php" method="post" accepted-charset="utf-8">
            <fieldset>
                <legend>Login Details</legend>
                <?php if( isset($message)) { echo info_message($message); }?>
                <label for="username">User ID:</label>
                <input type="text" id="username" name="username" maxlength="50"
                       value="<?php echo htmlentities( $username );?>"/><br/>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" maxlength="40"
                       value="<?php echo htmlentities( $password );?>"/><br/>
                <input type="submit" name="submit" value="Login" class="button" />
            </fieldset>
        </form>                                
    </body>
</html> 
<?php if( isset( $database )) { $database->close_connection(); } ?>
